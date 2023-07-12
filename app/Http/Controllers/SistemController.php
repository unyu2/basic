<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sistem;

class SistemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sistem.index');
    }

    public function data()
    {
        $sistem = Sistem::orderBy('id_sistem', 'desc')->get();

        return datatables()
            ->of($sistem)
            ->addIndexColumn()
            ->addColumn('aksi', function ($sistem) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('sistem.update', $sistem->id_sistem) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button onclick="deleteData(`'. route('sistem.destroy', $sistem->id_sistem) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $sistem = new Sistem();
        $sistem->nama_sistem = $request->nama_sistem;
        $sistem->save();

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
        $sistem = Sistem::find($id);

        return response()->json($sistem);
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
        $sistem = Sistem::find($id);
        $sistem->nama_sistem = $request->nama_sistem;
        $sistem->update();

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
        $sistem = Sistem::find($id);
        $sistem->delete();

        return response(null, 204);
    }
}

