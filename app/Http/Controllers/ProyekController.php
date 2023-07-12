<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proyek.index');
    }

    public function data()
    {
        $proyek = Proyek::orderBy('id_proyek', 'desc')->get();

        return datatables()
            ->of($proyek)
            ->addIndexColumn()
            ->addColumn('aksi', function ($proyek) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('proyek.update', $proyek->id_proyek) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button onclick="deleteData(`'. route('proyek.destroy', $proyek->id_proyek) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $proyek = new Proyek();
        $proyek->kode_proyek = $request->kode_proyek;
        $proyek->nama_proyek = $request->nama_proyek;
        $proyek->save();

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
        $proyek = Proyek::find($id);

        return response()->json($proyek);
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
        $proyek = Proyek::find($id);
        $proyek->kode_proyek = $request->kode_proyek;
        $proyek->nama_proyek = $request->nama_proyek;
        $proyek->update();

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
        $proyek = Proyek::find($id);
        $proyek->delete();

        return response(null, 204);
    }
}

