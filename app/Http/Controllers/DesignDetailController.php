<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\designDetailImports; 

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
        $kepala = KepalaGambar::all()->pluck('nama', 'id_kepala_gambar');
        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');
    
        $userLoggedIn = Auth::user(); 
        $bagianUser = $userLoggedIn->bagian;
        $level4Users = User::where('level', '4')->pluck('id');
    
        $approver = User::where('bagian', $bagianUser)->pluck('name', 'id');
        $drafter = User::where(function ($query) use ($bagianUser) {
          $query->where('bagian', $bagianUser)->where('level', '3');
        })
        ->orWhereIn('id', $level4Users)
        ->pluck('name', 'id');

        $design = Design::All();
        $designDetail = DesignDetail::All();
        
    
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
        'approver', 'drafter', 'designDetail'
       ));
    }


    public function data()
    {
        $userId = auth()->user()->id;

        $design = Design::leftJoin('proyek', 'proyek.id_proyek', 'design.id_proyek')
        ->leftJoin('users as check_user', 'check_user.id', '=', 'design.id_check')
        ->leftJoin('users as approve_user', 'approve_user.id', '=', 'design.id_approve')
        ->leftJoin('users as draft_user', 'draft_user.id', '=', 'design.id_draft')
        ->select('design.*', 'nama_proyek', 'design.jenis as design_jenis','design.status as design_status', 'design.revisi as design_revisi', 'proyek.status as proyek_status', 'check_user.name as check_user_name', 'approve_user.name as approve_user_name', 'draft_user.name as draft_user_name')
        ->where(function ($query) use ($userId) {
            $query->where('design.id_draft', $userId)
                  ->orWhere('design.id_check', $userId)
                  ->orWhere('design.id_approve', $userId);
        })
        ->where(function ($query) {
            $query->where('proyek.status', 'Open');
        })
        ->where(function ($query) {
            $query->where('design.jenis', 'Doc');
        })
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
            ->editColumn('id_proyek', function ($design) {
                return $design->nama_proyek ?? '';
            })
            ->addColumn('aksi', function ($design) {
                $buttons = '<div class="btn-group">';
                if ($design->status == 'Open' || $design->status == 'Proses Revisi') {
                    if ($design->revisi == 'Rev.0') {
                        // Jika status adalah "Rev.0", tampilkan tombol "Release Rev.0"
                        $buttons .= '<button type="button" onclick="editForm3(`'. route('design_detail.updatex', $design->id_design) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-reply-all">Release Rev. 0</i></button>';
                    } else {
                        // Jika status bukan "Rev.0", tampilkan tombol "Release"
                        $buttons .= '<button type="button" onclick="editForm4(`'. route('design_detail.update', $design->id_design) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-reply-all">Release Revisi</i></button>';
                    }
                }
                $buttons .= '</div>';
            
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_design', 'select_all'])
            ->make(true);
    }

    public function dataModal()
    {
        $design = DesignDetail::leftJoin('design', 'design.id_design', 'design_detail.id_design')
            ->select('design_detail.*', 'nama_design')
            ->get();

        return datatables()
            ->of($design)
            ->addIndexColumn()
            ->addColumn('select_all', function ($design) {
                return '
                    <input type="checkbox" name="id_design_detail[]" value="'. $design->id_design_detail .'">
                ';
            })
            ->editColumn('id_design', function ($design) {
                return $design->nama_design ?? '';
            })
            ->addColumn('aksi', function ($design) {
                $buttons = '<div class="btn-group">';                   
                $buttons .= '<button type="button" onclick="deleteData(`'. route('design_detail.destroy', $design->id_design_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
                $buttons .= '</div>';
        
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_design', 'select_all'])
            ->make(true);
    }

    public function dataAdmin()
    {
        $userId = auth()->user()->id;

        $design = Design::leftJoin('kepala_gambar', 'kepala_gambar.id_kepala_gambar', 'design.id_kepala_gambar')
            ->leftJoin('proyek', 'proyek.id_proyek', 'design.id_proyek')
            ->select('design.*', 'nama', 'nama_proyek')
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
            ->editColumn('id_proyek', function ($design) {
                return $design->nama_proyek ?? '';
            })
            ->addColumn('aksi', function ($design) {
                $buttons = '<div class="btn-group">';
                if ($design->status == 'Open' || $design->status == 'Proses Revisi') {
                    if ($design->revisi == 'Rev.0') {
                        // Jika status adalah "Rev.0", tampilkan tombol "Release Rev.0"
                        $buttons .= '<button type="button" onclick="editForm3(`'. route('design_detail.updatex', $design->id_design) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-reply-all">Release Rev. 0</i></button>';
                    } else {
                        // Jika status bukan "Rev.0", tampilkan tombol "Release"
                        $buttons .= '<button type="button" onclick="editForm4(`'. route('design_detail.update', $design->id_design) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-reply-all">Release Revisi</i></button>';
                    }
                }
                $buttons .= '</div>';
            
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_design', 'select_all'])
            ->make(true);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store()
    {
        $design_detail = DesignDetail::create($request->all());

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
        $design->id_design =$request->id_design;
        $design->kode_design =$request->kode_design;
        $design->nama_design =$request->nama_design;
        $design->revisi = $request->revisi;
        $design->status = $request->status;
        $design->prediksi_akhir = $request->prediksi_akhir;

        $design->id_draft = $request->id_draft;
        $design->id_check = $request->id_check;
        $design->id_approve = $request->id_approve;
        $design->jenis = $request->jenis;
        $design->pemilik = $request->pemilik;
        $design->bobot_rev = $request->bobot_rev;
        $design->bobot_design = $request->bobot_design;
        $design->size = $request->size;
        $design->lembar = $request->lembar;

        $design->prosentase = $request->prosentase;

        $design->update();
    
        $detail = new DesignDetail();
        $detail->id_design = $design->id_design;
        $detail->kode_design = $design->kode_design;
        $detail->revisi = $design->revisi;
        $detail->status = $design->status;
        $detail->prediksi_akhir = $design->prediksi_akhir;

        $detail->id_draft = $design->id_draft;
        $detail->id_check = $design->id_check;
        $detail->id_approve = $design->id_approve;
        $detail->jenis = $design->jenis;
        $detail->pemilik = $design->pemilik;
        $detail->bobot_rev = $design->bobot_rev;
        $detail->bobot_design = $design->bobot_design;
        $detail->size = $design->size;
        $detail->lembar = $design->lembar;
        $detail->tipe = $design->tipe;

        $detail->save();

        return response()->json(['message' => 'Data berhasil diupdate']);
    }

    public function updatex(Request $request, $id)
        {
            $design = Design::find($id);
            $design->id_design =$request->id_design;
            $design->kode_design =$request->kode_design;
            $design->nama_design =$request->nama_design;
            $design->revisi = $request->revisi;
            $design->status = $request->status;
            $design->prediksi_akhir = $request->prediksi_akhir;

            $design->id_draft = $request->id_draft;
            $design->id_check = $request->id_check;
            $design->id_approve = $request->id_approve;
            $design->jenis = $request->jenis;
            $design->pemilik = $request->pemilik;
            $design->bobot_rev = $request->bobot_rev;
            $design->bobot_design = $request->bobot_design;
            $design->size = $request->size;
            $design->lembar = $request->lembar;

            $design->prosentase = $request->prosentase;

            $design->duplicate_status = $request->duplicate_status;
            $design->time_release_rev0 = $request->time_release_rev0;

            $design->update();
        
            $detail = new DesignDetail();
            $detail->id_design = $design->id_design;
            $detail->kode_design = $design->kode_design;
            $detail->revisi = $design->revisi;
            $detail->status = $design->status;
            $detail->prediksi_akhir = $design->prediksi_akhir;

            $detail->id_draft = $design->id_draft;
            $detail->id_check = $design->id_check;
            $detail->id_approve = $design->id_approve;
            $detail->jenis = $design->jenis;
            $detail->pemilik = $design->pemilik;
            $detail->bobot_rev = $design->bobot_rev;
            $detail->bobot_design = $design->bobot_design;
            $detail->size = $design->size;
            $detail->lembar = $design->lembar;
            $detail->tipe = $design->tipe;

            $detail->save();
    
            return response()->json(['message' => 'Data berhasil diupdate']);
        }


    public function tambah(Request $request, $id)
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
        $design = DesignDetail::find($id);
        $design->delete();

        return response(null, 204);
    }


        public function importExcel(Request $request)
        {
            try {
                $file = $request->file('file'); 
                Excel::import(new designDetailImports, $file);
        
                return redirect()->route('design_detail.index')->with('success', 'Import data berhasil.');
            } catch (\Exception $e) {
                return redirect()->route('design_detail.index')->with('error', 'Import data gagal: ' . $e->getMessage() . ' Line: ' . $e->getLine());
            }
        }
    
}

