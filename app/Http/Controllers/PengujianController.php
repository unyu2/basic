<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Pengujian;
use App\Models\User;
use PDF;

class PengujianController extends Controller
{
    public function index()
    {
        return view('pengujian.index');
    }

    public function data()
    {
        $pengujian = Pengujian::orderBy('id_pengujian', 'desc')->get();

        return datatables()
            ->of($pengujian)
            ->addIndexColumn()
            ->addColumn('nilai', function ($pengujian) {
                return 'Rp. '. format_uang($pengujian->nilai);
            })
            ->addColumn('aksi', function ($pengujian) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('pengujian.update', $pengujian->id_pengujian) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('pengujian.destroy', $pengujian->id_pengujian) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $pengujian = Pengujian::create($request->all());

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
        $pengujian = Pengujian::find($id);

        return response()->json($pengujian);
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
        $pengujian = Pengujian::find($id)->update($request->all());

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
        $pengujian = Pengujian::find($id)->delete();

        return response(null, 204);
    }
}
