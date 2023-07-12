<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\PendaftaranDetail;
use App\Models\Pengujian;
use App\Models\Subpengujian;

class PendaftaranController extends Controller
{
    public function index()
    {
        $subpengujian = Subpengujian::orderBy('nama_subpengujian')->get();

        return view('pendaftaran.index', compact('subpengujian'));
    }

    public function data()
    {
        $pendaftaran = Pendaftaran::orderBy('id_pendaftaran', 'desc')->get();

        return datatables()
            ->of($pendaftaran)
            ->addIndexColumn()
            ->addColumn('total_item', function ($pendaftaran) {
                return format_uang($pendaftaran->total_item);
            })
            ->addColumn('total_harga', function ($pendaftaran) {
                return 'Rp. '. format_uang($pendaftaran->total_harga);
            })
            ->addColumn('bayar', function ($pendaftaran) {
                return 'Rp. '. format_uang($pendaftaran->bayar);
            })
            ->addColumn('tanggal', function ($pendaftaran) {
                return tanggal_indonesia($pendaftaran->created_at, false);
            })
            ->addColumn('subpengujian', function ($pendaftaran) {
                return $pendaftaran->subpengujian->nama_subpengujian;
            })
            ->editColumn('diskon', function ($pendaftaran) {
                return $pendaftaran->diskon . '%';
            })
            ->addColumn('aksi', function ($pendaftaran) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('pendaftaran.show', $pendaftaran->id_pendaftaran) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('pendaftaran.destroy', $pendaftaran->id_pendaftaran) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create($id)
    {
        $pendaftaran = new Pendaftaran();
        $pendaftaran->id_subpengujian = $id;
        $pendaftaran->total_item  = 0;
        $pendaftaran->total_harga = 0;
        $pendaftaran->diskon      = 0;
        $pendaftaran->bayar       = 0;
        $pendaftaran->save();

        session(['id_pendaftaran' => $pendaftaran->id_pendaftaran]);
        session(['id_subpengujian' => $pendaftaran->id_subpengujian]);

        return redirect()->route('pendaftaran_detail.index');
    }

    public function store(Request $request)
    {
        $pendaftaran = Pendaftaran::findOrFail($request->id_pendaftaran);
        $pendaftaran->total_item = $request->total_item;
        $pendaftaran->total_harga = $request->total;
        $pendaftaran->diskon = $request->diskon;
        $pendaftaran->bayar = $request->bayar;
        $pendaftaran->update();

        $detail = PendaftaranDetail::where('id_pendaftaran', $pendaftaran->id_pendaftaran)->get();
        foreach ($detail as $item) {
            $pengujian = Pengujian::find($item->id_pengujian);
            $pengujian->stok += $item->jumlah;
            $pengujian->update();
        }

        return redirect()->route('pendaftaran.index');
    }

    public function show($id)
    {
        $detail = PendaftaranDetail::with('pengujian')->where('id_pendaftaran', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_pengujian', function ($detail) {
                return '<span class="label label-success">'. $detail->pengujian->kode_pengujian .'</span>';
            })
            ->addColumn('nama', function ($detail) {
                return $detail->pengujian->nama;
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
            ->rawColumns(['kode_pengujian'])
            ->make(true);
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $detail    = PendaftaranDetail::where('id_pendaftaran', $pendaftaran->id_pendaftaran)->get();
        foreach ($detail as $item) {
            $pengujian = Pengujian::find($item->id_pengujian);
            if ($pengujian) {
                $pengujian->stok -= $item->jumlah;
                $pengujian->update();
            }
            $item->delete();
        }

        $pendaftaran->delete();

        return response(null, 204);
    }
}