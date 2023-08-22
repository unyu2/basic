<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\KepalaGambar;
use App\Models\Jabatan;
use App\Imports\kepalaImports;
use Maatwebsite\Excel\Facades\Excel; 

class KepalaGambarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $kepala = KepalaGambar::orderBy('id_kepala_gambar', 'desc')->get();
       $jabatan = Jabatan::all()->pluck('nama_jabatan', 'id_jabatan');

        return view('kepala_gambar.index', compact('kepala','jabatan'));
    }

    public function data()
    {
   //     $kepala = KepalaGambar::orderBy('id_kepala_gambar', 'desc')->get();
        $kepala = KepalaGambar::leftJoin('jabatan', 'jabatan.id_jabatan', 'kepala_gambar.id_jabatan')
        ->select('kepala_gambar.*', 'nama_jabatan')
        ->orderBy('id_jabatan', 'DESC')
        ->get();

        return datatables()
            ->of($kepala)
            ->addIndexColumn()
            ->editColumn('id_jabatan', function ($kepala) {
                return $kepala->nama_jabatan ?? '';
            })
            ->addColumn('aksi', function ($kepala) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('kepala_gambar.update', $kepala->id_kepala_gambar) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button onclick="deleteData(`'. route('kepala_gambar.destroy', $kepala->id_kepala_gambar) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $kepala = KepalaGambar::create($request->all());

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
        $kepala = KepalaGambar::find($id);

        return response()->json($kepala);
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
        $kepala = KepalaGambar::find($id);
        $kepala->update($request->all());

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
        $kepala = KepalaGambar::find($id);
        $kepala->delete();

        return response(null, 204);
    }

    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file'); // Ambil file Excel dari request
    
            // Pastikan Anda sudah membuat class Import yang sesuai dengan skema impor Anda
            Excel::import(new kepalaImports, $file);
    
            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('kepala_gambar.index')->with('success', 'Import data berhasil.');
        } catch (\Exception $e) {
            // Tampilkan pesan error yang lebih rinci
            return redirect()->route('kepala_gambar.index')->with('error', 'Import data gagal: ' . $e->getMessage() . ' Line: ' . $e->getLine());
        }
    }


}