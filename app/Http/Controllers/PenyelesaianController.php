<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyelesaian;
use App\Models\PenyelesaianDetail;
use App\Models\User;
use App\Models\Temuan;

class PenyelesaianController extends Controller
{
    public function index()
    {
        $temuan = Temuan::orderBy('nama_temuan')->get();

        return view('penyelesaian.index', compact('temuan'));
    }
    public function data()
    {
        $penyelesaians = Penyelesaian::leftJoin('temuan', 'temuan.id_temuan', 'penyelesaian.id_temuan')
        ->select('penyelesaian.*', 'nama_temuan')
        ->get();
    $penyelesaian = Penyelesaian::orderBy('id_penyelesaian', 'desc')->get();
    //  $temuan = Temuan::orderBy('id_temuan')->get();

        return datatables()
            ->of($penyelesaian)
            ->addIndexColumn()
            ->addColumn('total_item', function ($penyelesaian) {
                return format_uang($penyelesaian->total_item);
            })
            ->addColumn('total_harga', function ($penyelesaian) {
                return 'Rp. '. format_uang($penyelesaian->total_harga);
            })
            ->addColumn('bayar', function ($penyelesaian) {
                return 'Rp. '. format_uang($penyelesaian->bayar);
            })
            ->addColumn('nama_temuan', function ($penyelesaians) {
                $temuan = $penyelesaians->temuan->nama_temuan ?? '';
                return $temuan;
            })
            ->addColumn('tanggal', function ($penyelesaian) {
                return tanggal_indonesia($penyelesaian->created_at, false);
            })
            ->editColumn('diskon', function ($penyelesaian) {
                return $penyelesaian->diskon . '%';
            })
            ->addColumn('aksi', function ($penyelesaian) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('penyelesaian.show', $penyelesaian->id_penyelesaian) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('penyelesaian.destroy', $penyelesaian->id_penyelesaian) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create($id)
    {
        $penyelesaian = new Penyelesaian();
        $penyelesaian->id_temuan = $id;
        $penyelesaian->total_item  = 0;
        $penyelesaian->total_harga = 0;
        $penyelesaian->diskon      = 0;
        $penyelesaian->bayar       = 0;
        $penyelesaian->save();

        session(['id_penyelesaian' => $penyelesaian->id_penyelesaian]);
        session(['id_temuan' => $penyelesaian->id_temuan]);

        return redirect()->route('pembelian_detail.index');
    }

    public function store(Request $request)
    {
        $penyelesaian = Penyelesaian::findOrFail($request->id_penyelesaian);
        $penyelesaian->total_item = $request->total_item;
        $penyelesaian->total_harga = $request->total;
        $penyelesaian->diskon = $request->diskon;
        $penyelesaian->bayar = $request->bayar;
        $penyelesaian->update();

        $detail = PenyelesaianDetail::where('id_penyelesaian', $penyelesaian->id_penyelesaian)->get();
        foreach ($detail as $item) {
            $produk = User::find($item->id_produk);
            $produk->stok += $item->jumlah;
            $produk->update();
        }

        return redirect()->route('penyelesaian.index');
    }

    public function show($id)
    {
        $detail = PenyelesaianDetail::with('produk')->where('id_penyelesaian', $id)->get();

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
        $penyelesaian = Penyelesaian::find($id);
        $detail    = PenyelesaianDetail::where('id_penyelesaian', $penyelesaian->id_penyelesaian)->get();
        foreach ($detail as $item) {
            $produk = User::find($item->id_produk);
            if ($produk) {
                $produk->stok -= $item->jumlah;
                $produk->update();
            }
            $item->delete();
        }

        $penyelesaian->delete();

        return response(null, 204);
    }
}
