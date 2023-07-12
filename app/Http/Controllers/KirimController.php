<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangDetail;
use App\Models\Produk;
use App\Models\Setting;
use Illuminate\Http\Request;
use PDF;

class KirimController extends Controller
{
    public function index()
    {
        return view('barang.index');
    }

    public function data()
    {
        $barang = Barang::with('member')->orderBy('id_barang', 'desc')->get();

        return datatables()
            ->of($barang)
            ->addIndexColumn()
            ->addColumn('total_item', function ($barang) {
                return format_uang($barang->total_item);
            })
            ->addColumn('total_harga', function ($barang) {
                return 'Rp. '. format_uang($barang->total_harga);
            })
            ->addColumn('bayar', function ($barang) {
                return 'Rp. '. format_uang($barang->bayar);
            })
            ->addColumn('tanggal', function ($barang) {
                return tanggal_indonesia($barang->created_at, false);
            })
            ->addColumn('kode_member', function ($barang) {
                $member = $barang->member->kode_member ?? '';
                return '<span class="label label-success">'. $member .'</spa>';
            })
            ->addColumn('status', function ($barang) {
                return $barang->status;
            })
            ->editColumn('diskon', function ($barang) {
                return $barang->diskon . '%';
            })
            ->editColumn('kasir', function ($barang) {
                return $barang->user->name ?? '';
            })
            ->addColumn('aksi', function ($barang) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('barang.show', $barang->id_barang) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('barang.destroy', $barang->id_barang) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_member'])
            ->make(true);
    }

    public function create()
    {
        $barang = new Barang();
        $barang->id_member = 0;
        $barang->total_item = 0;
        $barang->total_harga = 0;
        $barang->diskon = 0;
        $barang->status = 0;
        $barang->surat = 0;
        $barang->eta = 0;
        $barang->id_user = auth()->id();
        $barang->save();

        session(['id_barang' => $barang->id_barang]);
        return redirect()->route('transaksi.index');
    }

    public function store(Request $request)
    {
        $barang = Barang::findOrFail($request->id_barang);
        $barang->id_member = $request->id_member;
        $barang->total_item = $request->total_item;
        $barang->total_harga = $request->total;
        $barang->diskon = $request->diskon;
        $barang->status = $request->status;
        $barang->surat = $request->surat;
        $barang->eta = $request->eta;
        $barang->update();

        $detail = BarangDetail::where('id_barang', $barang->id_barang)->get();
        foreach ($detail as $item) {
            $item->diskon = $request->diskon;
            $item->update();

            $produk = Produk::find($item->id_produk);
            $produk->stok += $item->jumlah;
            $produk->update();
        }

        return redirect()->route('transaksi.selesai');
    }

    public function show($id)
    {
        $detail = BarangDetail::with('produk')->where('id_barang', $id)->get();

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
        $barang = Barang::find($id);
        $detail    = BarangDetail::where('id_barang', $barang->id_barang)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok += $item->jumlah;
                $produk->update();
            }

            $item->delete();
        }

        $barang->delete();

        return response(null, 204);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('barang.selesai', compact('setting'));
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $barang = Barang::find(session('id_barang'));
        if (! $barang) {
            abort(404);
        }
        $detail = BarangDetail::with('produk')
            ->where('id_barang', session('id_barang'))
            ->get();
        
        return view('barang.nota_kecil', compact('setting', 'barang', 'detail'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $barang = Barang::find(session('id_barang'));
        if (! $barang) {
            abort(404);
        }
        $detail = BarangDetail::with('produk')
            ->where('id_barang', session('id_barang'))
            ->get();

        $pdf = PDF::loadView('barang.nota_besar', compact('setting', 'barang', 'detail'));
        $pdf->setPaper(0,0,609,440, 'potrait');
        return $pdf->stream('Transaksi-'. date('Y-m-d-his') .'.pdf');
    }
}


