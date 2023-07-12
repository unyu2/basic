<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjam;
use App\Models\PinjamDetail;
use App\Models\Barang;
use App\Models\Setting;
use PDF;

class PinjamController extends Controller
{
    public function index()
    {
        return view('pinjam.index');
    }

    public function data()
    {
        $pinjam = Pinjam::orderBy('id_pinjam', 'desc')->get();

        return datatables()
            ->of($pinjam)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($pinjam) {
                return tanggal_indonesia($pinjam->created_at, false);
            })
            ->editColumn('peminjam', function ($pinjam) {
                return $pinjam->user->name ?? '';
            })
            ->addColumn('aksi', function ($pinjam) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('pinjam.show', $pinjam->id_pinjam) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('pinjam.destroy', $pinjam->id_pinjam) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $pinjam = new Pinjam();
        $pinjam->fungsi = 0;
        $pinjam->total_item = 0;
        $pinjam->id_user = auth()->id();
        $pinjam->save();

        session(['id_pinjam' => $pinjam->id_pinjam]);
        return redirect()->route('transaksi.index');
    }

    public function store(Request $request)
    {
        $pinjam = Pinjam::findOrFail($request->id_pinjam);
        $pinjam->total_item = $request->total_item;
        $pinjam->fungsi = $request->fungsi;
        $pinjam->update();

        $detail = PinjamDetail::where('id_pinjam', $pinjam->id_pinjam)->get();
        foreach ($detail as $item) {
            $barang = Barang::find($item->id_barang);
            $barang->stok -= $item->jumlah;
            $barang->update();
        }

        return redirect()->route('transaksi.selesai');
    }

    public function show($id)
    {
        $detail = PinjamDetail::with('barang')->where('id_pinjam', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_barang', function ($detail) {
                return '<span class="label label-success">'. $detail->barang->kode_barang .'</span>';
            })
            ->addColumn('nama_barang', function ($detail) {
                return $detail->barang->nama_barang;
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->rawColumns(['kode_barang'])
            ->make(true);
    }

    public function destroy($id)
    {
        $pinjam = Pinjam::find($id);
        $detail    = PinjamDetail::where('id_pinjam', $pinjam->id_pinjam)->get();
        foreach ($detail as $item) {
            $barang = Barang::find($item->id_barang);
            if ($barang) {
                $barang->stok += $item->jumlah;
                $barang->update();
            }

            $item->delete();
        }

        $pinjam->delete();

        return response(null, 204);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('pinjam.selesai', compact('setting'));
    }
}

