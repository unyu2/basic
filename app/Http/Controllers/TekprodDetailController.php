<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\tekprodDetailImports; 

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Design;
use App\Models\DesignDetail;
use App\Models\Tekprod;
use App\Models\TekprodDetail;
use App\Models\Subpengujian;
use App\Models\Proyek;
use App\Models\Sistem;
use App\Models\Konfigurasi;
use App\Models\Subsistem;
use App\Models\KepalaGambar;
use App\Models\User;
use PDF;

class TekprodDetailController extends Controller
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
        $level4Users = User::where('level', '4')->pluck('id');

        $design = Design::all()->pluck('nama_design', 'id_design');
        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');
    
        $approver = User::where('bagian', $bagianUser)->pluck('name', 'id');
        $drafter = User::where(function ($query) use ($bagianUser) {
          $query->where('bagian', $bagianUser)->where('level', '3');
        })
        ->orWhereIn('id', $level4Users)
        ->pluck('name', 'id');
        
        $tekprod = Tekprod::All();
        $tekprodDetail = TekprodDetail::All();
        
    
        $proyek = Proyek::where('status', 'open')->pluck('nama_proyek' , 'id_proyek');

        $konfigurasi = Konfigurasi::all()->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_dmu = Konfigurasi::where('tipe_konfigurasi', 'DMU')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_emu = Konfigurasi::where('tipe_konfigurasi', 'EMU')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_light = Konfigurasi::where('tipe_konfigurasi', 'Light')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_coach = Konfigurasi::where('tipe_konfigurasi', 'Single Coach')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_wagon = Konfigurasi::where('tipe_konfigurasi', 'Wagon')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_other = Konfigurasi::where('tipe_konfigurasi', 'Other')->pluck('nama_konfigurasi','id_konfigurasi');
    
        return view('tekprod_detail.index', compact('tekprod', 'design', 'subsistem', 'approver', 'drafter', 'proyek',
        'konfigurasi', 'konfigurasi_dmu', 'konfigurasi_emu', 'konfigurasi_light', 'konfigurasi_coach', 'konfigurasi_wagon', 'konfigurasi_other',
        'approver', 'drafter', 'tekprodDetail'
       ));
    }


    public function data()
    {
        $userId = auth()->user()->id;

        $tekprod = Tekprod::leftJoin('proyek', 'proyek.id_proyek', 'tekprod.id_proyek')
        ->leftJoin('users as check_user', 'check_user.id', '=', 'tekprod.id_check_tekprod')
        ->leftJoin('users as approve_user', 'approve_user.id', '=', 'tekprod.id_approve_tekprod')
        ->leftJoin('users as draft_user', 'draft_user.id', '=', 'tekprod.id_draft_tekprod')
        ->select('tekprod.*', 'nama_proyek', 'tekprod.jenis_tekprod as design_jenis','tekprod.status_tekprod as design_status', 'tekprod.revisi_tekprod as design_revisi', 'proyek.status as proyek_status', 'check_user.name as check_user_name', 'approve_user.name as approve_user_name', 'draft_user.name as draft_user_name')
        ->where(function ($query) use ($userId) {
            $query->where('tekprod.id_draft_tekprod', $userId)
                  ->orWhere('tekprod.id_check_tekprod', $userId)
                  ->orWhere('tekprod.id_approve_tekprod', $userId);
        })
        ->where(function ($query) {
            $query->where('proyek.status', 'Open');
        })
        ->where(function ($query) {
            $query->where('tekprod.jenis_tekprod', 'Doc');
        })
        ->orderBy('id_tekprod', 'DESC')
        ->get();

        return datatables()
            ->of($tekprod)
            ->addIndexColumn()
            ->addColumn('select_all', function ($tekprod) {
                return '
                    <input type="checkbox" name="id_tekprod[]" value="'. $tekprod->id_tekprod .'">
                ';
            })
            ->editColumn('id_proyek', function ($tekprod) {
                return $tekprod->nama_proyek ?? '';
            })
            ->addColumn('aksi', function ($tekprod) {
                $buttons = '<div class="btn-group">';
                if ($tekprod->status_tekprod == 'Open' || $tekprod->status_tekprod == 'Proses Revisi') {
                    if ($tekprod->revisi_tekprod == 'Rev.0') {
                        $buttons .= '<button type="button" onclick="editForm3(`'. route('tekprod_detail.updatex', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-reply-all">Release Rev. 0</i></button>';
                    } else {
                        $buttons .= '<button type="button" onclick="editForm4(`'. route('tekprod_detail.update', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-reply-all">Release Revisi</i></button>';
                    }
                }
                $buttons .= '</div>';
            
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_tekprod', 'select_all'])
            ->make(true);
    }

    public function dataModal()
    {
        $tekprod = TekprodDetail::leftJoin('tekprod', 'tekprod.id_tekprod', 'tekprod_detail.id_tekprod')
            ->select('tekprod_detail.*', 'nama_tekprod')
            ->get();

        return datatables()
            ->of($tekprod)
            ->addIndexColumn()
            ->addColumn('select_all', function ($tekprod) {
                return '
                    <input type="checkbox" name="id_tekprod_detail[]" value="'. $tekprod->id_tekprod_detail .'">
                ';
            })
            ->editColumn('id_tekprod', function ($tekprod) {
                return $tekprod->nama_tekprod ?? '';
            })
            ->addColumn('aksi', function ($tekprod) {
                $buttons = '<div class="btn-group">';                   
                $buttons .= '<button type="button" onclick="deleteData(`'. route('tekprod_detail.destroy', $tekprod->id_tekprod_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
                $buttons .= '</div>';
        
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_tekprod', 'select_all'])
            ->make(true);
    }

    public function dataAdmin()
    {
        $userId = auth()->user()->id;

        $tekprod = Tekprod::leftJoin('design', 'design.id_design', 'tekprod.id_design')
            ->leftJoin('proyek', 'proyek.id_proyek', 'tekprod.id_proyek')
            ->select('tekprod.*', 'nama_proyek')
            ->orderBy('id_tekprod', 'DESC')
            ->get();

        return datatables()
            ->of($tekprod)
            ->addIndexColumn()
            ->addColumn('select_all', function ($tekprod) {
                return '
                    <input type="checkbox" name="id_tekprod[]" value="'. $tekprod->id_tekprod .'">
                ';
            })
            ->editColumn('id_proyek', function ($tekprod) {
                return $tekprod->nama_proyek ?? '';
            })
            ->addColumn('aksi', function ($tekprod) {
                $buttons = '<div class="btn-group">';
                if ($tekprod->status_tekprod == 'Open' || $tekprod->status_tekprod == 'Proses Revisi') {
                    if ($tekprod->revisi_tekprod == 'Rev.0') {
                        $buttons .= '<button type="button" onclick="editForm3(`'. route('tekprod_detail.updatex', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-reply-all">Release Rev. 0</i></button>';
                    } else {
                        $buttons .= '<button type="button" onclick="editForm4(`'. route('tekprod_detail.update', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-reply-all">Release Revisi</i></button>';
                    }
                }
                $buttons .= '</div>';
            
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_tekprod', 'select_all'])
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
        $tekprod_detail = TekprodDetail::create($request->all());

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
        $tekprod = Tekprod::find($id);

        return response()->json($tekprod);
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
        $tekprod = Tekprod::find($id);
        $tekprod->id_tekprod =$request->id_tekprod;
        $tekprod->kode_tekprod =$request->kode_tekprod;
        $tekprod->nama_tekprod =$request->nama_tekprod;
        $tekprod->revisi_tekprod = $request->revisi_tekprod;
        $tekprod->status_tekprod = $request->status_tekprod;
        $tekprod->prediksi_akhir_tekprod = $request->prediksi_akhir_tekprod;

        $tekprod->id_draft_tekprod = $request->id_draft_tekprod;
        $tekprod->id_check_tekprod = $request->id_check_tekprod;
        $tekprod->id_approve_tekprod = $request->id_approve_tekprod;
        $tekprod->jenis_tekprod = $request->jenis_tekprod;
        $tekprod->pemilik_tekprod = $request->pemilik_tekprod;
        $tekprod->bobot_rev_tekprod = $request->bobot_rev_tekprod;
        $tekprod->bobot_design_tekprod = $request->bobot_design_tekprod;
        $tekprod->size_tekprod = $request->size_tekprod;
        $tekprod->lembar_tekprod = $request->lembar_tekprod;

        $tekprod->prosentase_tekprod = $request->prosentase_tekprod;

        $tekprod->update();
    
        $detail = new TekprodDetail();
        $detail->id_tekprod = $tekprod->id_tekprod;
        $detail->kode_tekprod = $tekprod->kode_tekprod;
        $detail->revisi_tekprod = $tekprod->revisi_tekprod;
        $detail->status_tekprod = $tekprod->status_tekprod;
        $detail->prediksi_akhir_tekprod = $tekprod->prediksi_akhir_tekprod;

        $detail->id_draft_tekprod = $tekprod->id_draft_tekprod;
        $detail->id_check_tekprod = $tekprod->id_check_tekprod;
        $detail->id_approve_tekprod = $tekprod->id_approve_tekprod;
        $detail->jenis_tekprod = $tekprod->jenis_tekprod;
        $detail->pemilik_tekprod = $tekprod->pemilik_tekprod;
        $detail->bobot_rev_tekprod = $tekprod->bobot_rev_tekprod;
        $detail->bobot_design_tekprod = $tekprod->bobot_design_tekprod;
        $detail->size_tekprod = $tekprod->size_tekprod;
        $detail->lembar_tekprod = $tekprod->lembar_tekprod;
        $detail->tipe_tekprod = $tekprod->tipe_tekprod;

        $detail->save();

        return response()->json(['message' => 'Data berhasil diupdate']);
    }

    public function updatex(Request $request, $id)
        {
            $tekprod = Tekprod::find($id);
            $tekprod->id_tekprod =$request->id_tekprod;
            $tekprod->kode_tekprod =$request->kode_tekprod;
            $tekprod->nama_tekprod =$request->nama_tekprod;
            $tekprod->revisi_tekprod = $request->revisi_tekprod;
            $tekprod->status_tekprod = $request->status_tekprod;
            $tekprod->prediksi_akhir_tekprod = $request->prediksi_akhir_tekprod;

            $tekprod->id_draft_tekprod = $request->id_draft_tekprod;
            $tekprod->id_check_tekprod = $request->id_check_tekprod;
            $tekprod->id_approve_tekprod = $request->id_approve_tekprod;
            $tekprod->jenis_tekprod = $request->jenis_tekprod;
            $tekprod->pemilik_tekprod = $request->pemilik_tekprod;
            $tekprod->bobot_rev_tekprod = $request->bobot_rev_tekprod;
            $tekprod->bobot_design_tekprod = $request->bobot_design_tekprod;
            $tekprod->size_tekprod = $request->size_tekprod;
            $tekprod->lembar_tekprod = $request->lembar_tekprod;

            $tekprod->prosentase_tekprod = $request->prosentase_tekprod;

            $tekprod->duplicate_status_tekprod = $request->duplicate_status_tekprod;
            $tekprod->time_release_rev0_tekprod = $request->time_release_rev0_tekprod;

            $tekprod->update();
        
            $detail = new TekprodDetail();
            $detail->id_tekprod = $tekprod->id_tekprod;
            $detail->kode_tekprod = $tekprod->kode_tekprod;
            $detail->revisi_tekprod = $tekprod->revisi_tekprod;
            $detail->status_tekprod = $tekprod->status_tekprod;
            $detail->prediksi_akhir_tekprod = $tekprod->prediksi_akhir_tekprod;

            $detail->id_draft_tekprod = $tekprod->id_draft_tekprod;
            $detail->id_check_tekprod = $tekprod->id_check_tekprod;
            $detail->id_approve_tekprod = $tekprod->id_approve_tekprod;
            $detail->jenis_tekprod = $tekprod->jenis_tekprod;
            $detail->pemilik_tekprod = $tekprod->pemilik_tekprod;
            $detail->bobot_rev_tekprod = $tekprod->bobot_rev_tekprod;
            $detail->bobot_design_tekprod = $tekprod->bobot_design_tekprod;
            $detail->size_tekprod = $tekprod->size_tekprod;
            $detail->lembar_tekprod = $tekprod->lembar_tekprod;
            $detail->tipe_tekprod = $tekprod->tipe_tekprod;

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
        $tekprod = TekprodDetail::find($id);
        $tekprod->delete();

        return response(null, 204);
    }

    public function importExcel(Request $request)
        {
            try {
                $file = $request->file('file'); 
                Excel::import(new TekprodDetailImports, $file);
        
                return redirect()->route('tekprod_detail.index')->with('success', 'Import data berhasil.');
            } catch (\Exception $e) {
                return redirect()->route('tekprod_detail.index')->with('error', 'Import data gagal: ' . $e->getMessage() . ' Line: ' . $e->getLine());
            }
        }
    
}

