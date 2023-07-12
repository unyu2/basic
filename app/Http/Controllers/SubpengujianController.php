<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subpengujian;

class SubpengujianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subpengujian.index');
    }

    public function data()
    {
        $subpengujian = Subpengujian::orderBy('id_subpengujian', 'desc')->get();

        return datatables()
            ->of($subpengujian)
            ->addIndexColumn()
            ->addColumn('aksi', function ($subpengujian) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('subpengujian.update', $subpengujian->id_subpengujian) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button onclick="deleteData(`'. route('subpengujian.destroy', $subpengujian->id_subpengujian) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $subpengujian = new Subpengujian();
        $subpengujian->nama_subpengujian = $request->nama_subpengujian;
        $subpengujian->save();

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
        $subpengujian = Subpengujian::find($id);

        return response()->json($subpengujian);
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
        $subpengujian = Subpengujian::find($id);
        $subpengujian->nama_subpengujian = $request->nama_subpengujian;
        $subpengujian->update();

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
        $subpengujian = Subpengujian::find($id);
        $subpengujian->delete();

        return response(null, 204);
    }
}
