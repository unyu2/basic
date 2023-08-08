<?php

namespace App\Http\Controllers;

use App\Events\DesignRevisiUpdated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Subpengujian;
use App\Models\Design;
use App\Models\Proyek;
use App\Models\Sistem;
use App\Models\Konfigurasi;
use App\Models\Subsistem;
use App\Models\KepalaGambar;
use App\Models\DesignDetail;
use App\Models\User;
use PDF;

class DesignDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userLoggedIn = Auth::user(); 
        $bagianUser = $userLoggedIn->bagian;
        $levelUser = $userLoggedIn->level;
    
        $approver = User::where('bagian', $bagianUser)->where('level', $levelUser)->pluck('name', 'id');
        $drafter = User::where('bagian', $bagianUser)->where('level', '2')->pluck('name', 'id');

        $kepala = KepalaGambar::all()->pluck('nama', 'id_kepala_gambar');
        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');
    
        $userLoggedIn = Auth::user(); 
        $bagianUser = $userLoggedIn->bagian;
        $levelUser = $userLoggedIn->level;
    
        $approver = User::where('bagian', $bagianUser)->where('level', $levelUser)->pluck('name', 'id');
        $drafter = User::where('bagian', $bagianUser)->where('level', '2')->pluck('name', 'id');
        $design = Design::All();
        
    
        $proyek = Proyek::where('status', 'open')->pluck('nama_proyek' , 'id_proyek');

        $konfigurasi = Konfigurasi::all()->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_dmu = Konfigurasi::where('tipe_konfigurasi', 'DMU')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_emu = Konfigurasi::where('tipe_konfigurasi', 'EMU')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_light = Konfigurasi::where('tipe_konfigurasi', 'Light')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_coach = Konfigurasi::where('tipe_konfigurasi', 'Single Coach')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_wagon = Konfigurasi::where('tipe_konfigurasi', 'Wagon')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_other = Konfigurasi::where('tipe_konfigurasi', 'Other')->pluck('nama_konfigurasi','id_konfigurasi');
    
        return view('design_detail.index', compact('design', 'kepala', 'subsistem', 'approver', 'drafter', 'proyek',
        'konfigurasi', 'konfigurasi_dmu', 'konfigurasi_emu', 'konfigurasi_light', 'konfigurasi_coach', 'konfigurasi_wagon', 'konfigurasi_other',
        'approver', 'drafter'
       ));
    }


    public function data()
    {
        $design = Design::leftJoin('kepala_gambar', 'kepala_gambar.id_kepala_gambar', 'design.id_kepala_gambar')
            ->select('design.*', 'nama')
            ->orderBy('id_design', 'DESC')
            ->get();

        return datatables()
            ->of($design)
            ->addIndexColumn()
            ->addColumn('select_all', function ($design) {
                return '
                    <input type="checkbox" name="id_design[]" value="'. $design->id_design .'">
                ';
            })
            ->addColumn('aksi', function ($design) {
                $buttons = '<div class="btn-group">';
                $buttons .= '<button type="button" onclick="editForm4(`'. route('design_detail.update', $design->id_design) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil">Edit</i></button>';
                $buttons .= '<button type="button" onclick="editForm3(`'. route('design_detail.updatex', $design->id_design) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-reply-all">Release</i></button>';        
                $buttons .= '<button type="button" onclick="deleteData(`'. route('design_detail.destroy', $design->id_design) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
                $buttons .= '</div>';
        
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_design', 'select_all'])
            ->make(true);
    }

    public function dataModal()
    {
        $design = Design::leftJoin('kepala_gambar', 'kepala_gambar.id_kepala_gambar', 'design.id_kepala_gambar')
            ->select('design.*', 'nama')
            ->get();

        return datatables()
            ->of($design)
            ->addIndexColumn()
            ->addColumn('select_all', function ($design) {
                return '
                    <input type="checkbox" name="id_design[]" value="'. $design->id_design .'">
                ';
            })
            ->addColumn('aksi', function ($design) {
                $buttons = '<div class="btn-group">';                   
                $buttons .= '<button type="button" onclick="pilihDesign(`'. route('design.pilihData', $design->id_design) .'`)" class="btn btn-xs btn-danger btn-flat">Pilih</button>';
                $buttons .= '</div>';
        
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_design', 'select_all'])
            ->make(true);
    }

    public function modalRef()
    {
        $design = Design::select('nama_design', 'id_design');
        return view ('design.dwg', compact('design'));
    }

    public function pilihData($id)
    {
        $design = Design::find($id);
        return response()->json($design);

    }

    public function tampilEdit($id)
    {

        $design = Design::find($id);

        $kepala = KepalaGambar::all()->pluck('nama', 'id_kepala_gambar');
        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');
        $userLoggedIn = Auth::user(); 
        $bagianUser = $userLoggedIn->bagian;
        $levelUser = $userLoggedIn->level;
        $approver = User::where('bagian', $bagianUser)->where('level', $levelUser)->pluck('name', 'id');
        $drafter = User::where('bagian', $bagianUser)->where('level', '2')->pluck('name', 'id');
        $proyek = Proyek::where('status', 'open')->pluck('nama_proyek', 'id_proyek');
        $konfigurasi = Konfigurasi::all()->pluck('nama_konfigurasi','id_konfigurasi');

        return view('design.form1', compact('design', 'kepala', 'subsistem', 'approver', 'drafter', 'proyek',
        'konfigurasi'));
    }

    public function storeModal(Request $request)
    {
        $design = Design::create($request->all());
        $revisi->id_design = $design->id_design;
        $revisi->id_revisi_design = $id;
        $revisi->revisi = $design->revisi;
        $revisi->save();

        return response()->json(['message' => 'Data berhasil diupdate']);
    }



        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $design = DesignDetail::findOrFail($request->id_design);
        $design->save();

        return response()->json(['message' => 'Data berhasil diupdate']);

    }



    public function store(Request $request)
    {
        $design = Design::create($request->all());
    
        // Cek apakah tanggal_refrensi diisi atau tidak
        if ($request->filled('tanggal_refrensi')) {
            $design->tanggal_prediksi = $request->tanggal_refrensi;
        } else {
            $design->tanggal_prediksi = $request->tanggal_prediksi;
        }
        $design->prediksi_akhir = \Carbon\Carbon::parse($design->tanggal_prediksi)->addDays($design->prediksi_hari);

        $design->save();
    
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
        $design = Design::find($id);

        return response()->json($design);
    }

    public function showRef($id)
    {
        $design = Design::find($id);

        return response()->json($design);
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
            $design = Design::find($id);

            // Cek apakah tanggal_refrensi diisi atau tidak
            if ($request->filled('tanggal_refrensi')) {
                $design->tanggal_prediksi = $request->tanggal_refrensi;
            } else {
                $design->tanggal_prediksi = $request->tanggal_prediksi;
            }

            $design->save();
        

            return response()->json(['message' => 'Data berhasil diupdate']);
            
        }
    

        public function updatex(Request $request, $id)
        {
            $design = Design::find($id);
            $design->kode_design =$request->kode_design;
            $design->nama_design =$request->nama_design;
            $design->revisi = $request->revisi;
            $design->status = $request->status;
            $design->save();
        
            $designDetail = new DesignDetail();
            $designDetail->id_design = $design->id_design;
            $designDetail->kode_design = $design->kode_design;
            $designDetail->nama_design = $design->nama_design;
            $designDetail->revisi = $design->revisi;
            $designDetail->save();
    
            return response()->json(['message' => 'Data telah diperbarui dan disimpan di design_detail']);
        }


    public function tambah(Request $request, $id)
    {
        $design = Design::find($id);
        $design->tambah($request->all());

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
        $design = Design::find($id);
        $design->delete();

        return response(null, 204);
    }


    public function deleteSelected(Request $request)
    {
        foreach ($request->id_design as $id) {
        $design = Design::find($id);
        $design->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $datadesign = array();
        foreach ($request->id_design as $id) {
            $design = Design::find($id);
            $datadesign[] = $design;
        }

        $no  = 1;
        $pdf = PDF::loadView('design.barcode', compact('datadesign', 'no'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('design.pdf');
    }

    public function exportExcel()
        {
            $design = Design::all();
            return Excel::download(new DesignExport($design), 'design.xlsx');
        }
}

