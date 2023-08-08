<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subsistem;
use App\Models\KepalaGambar;
use App\Models\Dwg;
use App\Models\User;
use App\Models\Proyek;
use App\Models\Konfigurasi;
use PDF;

class DwgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kepala = KepalaGambar::all()->pluck('nama', 'id_kepala_gambar');
        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');
    
        $userLoggedIn = Auth::user(); 
        $bagianUser = $userLoggedIn->bagian;
        $levelUser = $userLoggedIn->level;
    
        $approver = User::where('bagian', $bagianUser)->where('level', $levelUser)->pluck('name', 'id');
        $drafter = User::where('bagian', $bagianUser)->where('level', '2')->pluck('name', 'id');
        $dwg = Dwg::all();
        
    
        $proyek = Proyek::all()->pluck('nama_proyek', 'id_proyek');

        $konfigurasi = Konfigurasi::all()->pluck('nama_konfigurasi','id_konfigurasi');
    
        return view('dwg.index', compact('dwg', 'kepala', 'subsistem', 'approver', 'drafter', 'proyek',
        'konfigurasi'
       ));
    }

    public function data()
    {
        $dwg = Dwg::leftJoin('kepala_gambar', 'kepala_gambar.id_kepala_gambar', 'dwg.id_kepala_gambar')
            ->select('dwg.*', 'nama')
            ->get();

        return datatables()
            ->of($dwg)
            ->addIndexColumn()
            ->addColumn('select_all', function ($dwg) {
                return '
                    <input type="checkbox" name="id_dwg[]" value="'. $dwg->id_dwg .'">
                ';
            })
            ->addColumn('kode_dwg', function ($dwg) {
                return '<span class="label label-success">'. $dwg->kode_dwg .'</span>';
            })
            ->addColumn('aksi', function ($dwg) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('dwg.update', $dwg->id_dwg) .'`)" class="btn btn-xs btn-info btn-flat">Edit</button> 
                    <button type="button" onclick="closedForm(`'. route('dwg.closed', $dwg->id_dwg) .'`)" class="btn btn-xs btn-success btn-flat">Release</button>
                    <button type="button" onclick="deleteData(`'. route('dwg.destroy', $dwg->id_dwg) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                
                ';
            })
            ->rawColumns(['aksi', 'kode_dwg', 'select_all'])
            ->make(true);
    }

    public function datas()
    {
        // Mengambil data dari model Dwg (gantikan 'Dwg' dengan nama model yang sesuai)
        $dwg = Dwg::all(); // Contoh pengambilan semua data dari model Dwg

        // Render view untuk modal 'dwg' dan kirimkan data $dwg ke dalam view
        return view('dwg.dwg', compact('dwg'));
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
        $dwg = Dwg::create($request->all());

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
        $dwg = Dwg::find($id);

        return response()->json($dwg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            $dwg = dwg::find($id);
            return $dwg;
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
        $dwg = Dwg::find($id);
        $dwg->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }


        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function closed(Request $request, $id)
    {
        $dwg = Dwg::find($id);
        $dwg->update($request->all());

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
        $dwg = Dwg::find($id);
        $dwg->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_Dwg as $id) {
            $dwg = Dwg::find($id);
            $dwg->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $dataDwg = array();
        foreach ($request->id_Dwg as $id) {
            $dwg = Dwg::find($id);
            $dataDwg[] = $dwg;
        }

        $no  = 1;
        $pdf = PDF::loadView('Dwg.barcode', compact('dataDwg', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Dwg.pdf');
    }
}
