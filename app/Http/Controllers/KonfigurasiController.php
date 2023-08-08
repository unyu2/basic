<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konfigurasi;

class KonfigurasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('konfigurasi.index');
    }

    public function data()
    {
        $konfigurasi = Konfigurasi::orderBy('id_konfigurasi', 'desc')->get();

        return datatables()
            ->of($konfigurasi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($konfigurasi) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('konfigurasi.update', $konfigurasi->id_konfigurasi) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button onclick="deleteData(`'. route('konfigurasi.destroy', $konfigurasi->id_konfigurasi) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $konfigurasi = new Konfigurasi();
        $konfigurasi->nama_konfigurasi = $request->nama_konfigurasi;
        $konfigurasi->tipe_konfigurasi = $request->tipe_konfigurasi;
        $konfigurasi->save();
      //  $konfigurasi = Konfigurasi::save($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $konfigurasi = Konfigurasi::find($id);

        return response()->json($konfigurasi);
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
        $konfigurasi = Konfigurasi::find($id);
        $konfigurasi->nama_konfigurasi = $request->nama_konfigurasi;
        $konfigurasi->tipe_konfigurasi = $request->tipe_konfigurasi;
        $konfigurasi->update();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $konfigurasi = Konfigurasi::find($id);
        $konfigurasi->delete();

        return response(null, 204);
    }
}
