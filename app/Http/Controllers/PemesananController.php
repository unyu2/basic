<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Member;
use Illuminate\Http\Request;
use PDF;

class PemesananController extends Controller
{
    public function index()
    {
        $member = Member::all()->pluck('nama', 'id_member','bagian','kode_member');

        return view('pemesanan.index', compact('member'));
    }

    public function data()
    {
        $pemesanan = Pemesanan::leftJoin('member', 'member.id_member', 'pemesanan.id_member')
        ->select('pemesanan.*', 'nama')
        ->get();

        return datatables()
            ->of($pemesanan)
            ->addIndexColumn()
            ->addColumn('total_item', function ($pemesanan) {
                return format_uang($pemesanan->total_item);
            })
            ->addColumn('total_harga', function ($pemesanan) {
                return 'Rp. '. format_uang($pemesanan->total_harga);
            })
            ->addColumn('bayar', function ($pemesanan) {
                return 'Rp. '. format_uang($pemesanan->bayar);
            })
            ->addColumn('tanggal', function ($pemesanan) {
                return tanggal_indonesia($pemesanan->created_at, false);
            })
            ->addColumn('kode_member', function ($pemesanan) {
                $member = $pemesanan->member->kode_member ?? '';
                return '<span class="label label-success">'. $member .'</spa>';
            })
            ->editColumn('diskon', function ($pemesanan) {
                return $pemesanan->diskon . '%';
            })
            ->editColumn('kasir', function ($pemesanan) {
                return $pemesanan->user->name ?? '';
            })
            ->addColumn('aksi', function ($pemesanan) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('pemesanan.show', $pemesanan->id_pemesanan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('pemesanan.destroy', $pemesanan->id_pemesanan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_member'])
            ->make(true);
    }

    public function create()
    {
        $pemesanan = new Pemesanan();
        $pemesanan->id_member = Null;
        $pemesanan->total_item = 0;
        $pemesanan->total_harga = 0;
        $pemesanan->diskon = 0;
        $pemesanan->bayar = 0;
        $pemesanan->diterima = 0;
        $pemesanan->eta = 0;
        $pemesanan->surat = 0;
        $pemesanan->kode_pemesanan_detail =0;
        $pemesanan->id_user = auth()->id();
        $pemesanan->save();

        session(['id_pemesanan' => $pemesanan->id_pemesanan]);
        return redirect()->route('transaksi_pemesanan.index');
    }

    public function store(Request $request)
    {
        $pemesanan = Pemesanan::findOrFail($request->id_pemesanan);
        $pemesanan->id_member = $request->id_member;
        $pemesanan->total_item = $request->total_item;
        $pemesanan->total_harga = 0;
        $pemesanan->diskon = 0;
        $pemesanan->bayar = 0;
        $pemesanan->diterima = 0;
        $pemesanan->eta = $request->eta;
        $pemesanan->surat = $request->surat;
        $pemesanan->kode_pemesanan_detail = 'KR-'. tambah_nol_didepan((int)$pemesanan->id_pemesanan +1, 6);
        $pemesanan->update();

        $detail = PemesananDetail::where('id_pemesanan', $pemesanan->id_pemesanan)->get();
        foreach ($detail as $item) {
            $item->diskon = $request->diskon;
            $item->update();

            $produk = Produk::find($item->id_produk);
            $produk->stok_kirim += $item->jumlah;
            $produk->stok_minta -= $item->jumlah;
            $produk->update();
        }

        return redirect()->route('transaksi_pemesanan.selesai');
    }

    public function show($id)
    {
        $detail = PemesananDetail::with('produk')->where('id_pemesanan', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">'. $detail->produk->kode_produk .'</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_jual', function ($detail) {
                return 'Rp. '. format_uang($detail->harga_jual);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. '. format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::find($id);
        $detail    = PemesananDetail::where('id_pemesanan', $pemesanan->id_pemesanan)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok_kirim -= $item->jumlah;
                $produk->stok_minta += $item->jumlah;
                $produk->update();
            }

            $item->delete();
        }

        $pemesanan->delete();

        return response(null, 204);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('pemesanan.selesai', compact('setting'));
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $pemesanan = Pemesanan::find(session('id_pemesanan'));
        if (! $pemesanan) {
            abort(404);
        }
        $detail = PemesananDetail::with('produk')
            ->where('id_pemesanan', session('id_pemesanan'))
            ->get();
        
        return view('pemesanan.nota_kecil', compact('setting', 'pemesanan', 'detail'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $pemesanan = Pemesanan::find(session('id_pemesanan'));
        if (! $pemesanan) {
            abort(404);
        }
        $detail = PemesananDetail::with('produk')
            ->where('id_pemesanan', session('id_pemesanan'))
            ->get();

        $pdf = PDF::loadView('pemesanan.nota_besar', compact('setting', 'pemesanan', 'detail'));
        $pdf->setPaper(0,0,609,440, 'potrait');
        return $pdf->stream('Transaksi-Pemesanan-'. date('Y-m-d-his') .'.pdf');
    }
}

