<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjam;
use App\Models\PinjamDetail;
use App\Models\Kembali;
use App\Models\KembaliDetail;
use App\Models\Barang;
use App\Models\User;
use App\Models\Setting;

class DataPinjamKembaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data_pinjam_kembali.index');
    }

    public function data()
    {
        $peminjaman = Pinjam::orderBy('id_pinjam', 'desc')
        ->where('status', 'pinjam')
        ->leftJoin('users', 'users.id', 'pinjam.id_peminjam')
        ->select('pinjam.*', 'name')
        ->get();

        return datatables()
            ->of($peminjaman)
            ->addIndexColumn()
            ->editColumn('id_peminjam', function ($peminjaman) {
                return $peminjaman->user->name ?? '';
            })
            ->addColumn('aksi', function ($peminjaman) {
                return '
                <div class="btn-group">
                    <button onclick="deleteData(`'. route('data_pinjam_kembali.destroy', $peminjaman->id_pinjam) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                    <button onclick="showDetail(`'. route('data_pinjam_kembali.showDetail', $peminjaman->id_pinjam) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-eye"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function dataKembali()
    {
        $peminjaman = Pinjam::orderBy('id_pinjam', 'desc')
        ->where('status', 'Kembali')
        ->leftJoin('users', 'users.id', 'pinjam.id_peminjam')
        ->select('pinjam.*', 'name')
        ->get();

        return datatables()
            ->of($peminjaman)
            ->addIndexColumn()
            ->editColumn('id_peminjam', function ($peminjaman) {
                return $peminjaman->user->name ?? '';
            })
            ->addColumn('aksi', function ($peminjaman) {
                return '
                <div class="btn-group">
                    <button onclick="deleteData(`'. route('data_pinjam_kembali.destroy', $peminjaman->id_pinjam) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                    <button onclick="showDetail(`'. route('data_pinjam_kembali.showDetail', $peminjaman->id_pinjam) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-eye"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $pinjam = Pinjam::find($id);
        return response()->json($pinjam);
    }

    public function showDetail($id)
    {
        $detail = PinjamDetail::with('pinjam')
        ->leftJoin('barang', 'barang.id_barang', '=', 'pinjam_detail.id_barang')
        ->where('id_pinjam', $id)
        ->select('pinjam_detail.*', 'nama_barang')
        ->get();
    
    
        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('id_pinjam', function ($detail) {
                return '<span class="label label-info">'. $detail->id_pinjam .'</span>';
            })
            ->editColumn('id_barang', function ($detail) {
                return $detail->barang->nama_barang ?? '';
            })
            ->rawColumns(['id_pinjam'])
            ->make(true);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjam = Pinjam::find($id);
        $pinjam->delete();
    
        PinjamDetail::where('id_pinjam', $id)->delete();
    
        return response(null, 204);
    }
    
}