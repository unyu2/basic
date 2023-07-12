<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use App\Models\PermintaanDetail;
use App\Models\Produk;
use App\Models\Proyek;

class PermintaanController extends Controller
{
    public function index()
    {
        $proyek = Proyek::orderBy('nama_proyek')->get();

        return view('permintaan.index', compact('proyek'));
    }
    public function data()
    {
        $pembelians = Permintaan::leftJoin('proyek', 'proyek.id_proyek', 'permintaan.id_proyek')
        ->select('permintaan.*', 'nama_proyek')
        ->get();
        $permintaan = Permintaan::orderBy('id_permintaan', 'desc')->get();
    //  $proyek = Proyek::orderBy('id_proyek')->get();

        return datatables()
            ->of($permintaan)
            ->addIndexColumn()
            ->addColumn('total_item', function ($permintaan) {
                return format_uang($permintaan->total_item);
            })
            ->addColumn('total_harga', function ($permintaan) {
                return 'Rp. '. format_uang($permintaan->total_harga);
            })
            ->addColumn('bayar', function ($permintaan) {
                return 'Rp. '. format_uang($permintaan->bayar);
            })
            ->addColumn('nama_proyek', function ($pembelians) {
                $proyek = $pembelians->proyek->nama_proyek ?? '';
                return $proyek;
            })
            ->addColumn('tanggal', function ($permintaan) {
                return tanggal_indonesia($permintaan->created_at, false);
            })
            ->addColumn('memo', function ($permintaan) {
                return $permintaan->memo;
            })
            ->editColumn('diskon', function ($permintaan) {
                return $permintaan->diskon . '%';
            })
            ->addColumn('aksi', function ($permintaan) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('permintaan.show', $permintaan->id_permintaan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('permintaan.destroy', $permintaan->id_permintaan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create($id)
    {
        $permintaan = new Permintaan();
        $permintaan->id_proyek = $id;
        $permintaan->id_user     = auth()->id();
        $permintaan->total_item  = 0;
        $permintaan->total_harga = 0;
        $permintaan->memo        = 0;
        $permintaan->nama_proyeks = 0;
        $permintaan->diskon      = 0;
        $permintaan->bayar       = 0;
        $permintaan->save();

        session(['id_permintaan' => $permintaan->id_permintaan]);
        session(['id_proyek' => $permintaan->id_proyek]);

        return redirect()->route('permintaan_detail.index');
    }

    public function store(Request $request)
    {
        $permintaan = Permintaan::findOrFail($request->id_permintaan);
        $permintaan->total_item = $request->total_item;
        $permintaan->total_harga = $request->total;
        $permintaan->memo = $request->memo;
        $permintaan->nama_proyeks = $request->nama_proyeks;
        $permintaan->diskon = $request->diskon;
        $permintaan->bayar = $request->bayar;
        $permintaan->update();

        $detail = PermintaanDetail::where('id_permintaan', $permintaan->id_permintaan)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            $produk->stok_minta += $item->jumlah;
            $produk->update();
        }

        return redirect()->route('permintaan.index');
    }

    public function show($id)
    {
        $detail = PermintaanDetail::with('produk')->where('id_permintaan', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">'. $detail->produk->kode_produk .'</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_beli', function ($detail) {
                return 'Rp. '. format_uang($detail->harga_beli);
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
        $permintaan = Permintaan::find($id);
        $detail    = PermintaanDetail::where('id_permintaan', $permintaan->id_permintaan)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok_minta -= $item->jumlah;
                $produk->update();
            }
            $item->delete();
        }

        $permintaan->delete();

        return response(null, 204);
    }
}
