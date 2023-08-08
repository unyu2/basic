<?php

namespace App\Http\Controllers;

use App\Events\DesignRevisiUpdated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\designExport;
use App\Exports\designExportLog;
use App\Imports\designImports; 

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

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $design = Design::select('id_design')->orderBy('id_design', 'DESC')->get();
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
        
    
        $proyek = Proyek::where('status', 'open')->pluck('nama_proyek' , 'id_proyek');

        $konfigurasi = Konfigurasi::all()->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_dmu = Konfigurasi::where('tipe_konfigurasi', 'DMU')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_emu = Konfigurasi::where('tipe_konfigurasi', 'EMU')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_light = Konfigurasi::where('tipe_konfigurasi', 'Light')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_coach = Konfigurasi::where('tipe_konfigurasi', 'Single Coach')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_wagon = Konfigurasi::where('tipe_konfigurasi', 'Wagon')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_other = Konfigurasi::where('tipe_konfigurasi', 'Other')->pluck('nama_konfigurasi','id_konfigurasi');
    
        return view('design.index', compact('design', 'kepala', 'subsistem', 'approver', 'drafter', 'proyek',
        'konfigurasi', 'konfigurasi_dmu', 'konfigurasi_emu', 'konfigurasi_light', 'konfigurasi_coach', 'konfigurasi_wagon', 'konfigurasi_other',
        'approver', 'drafter'
       ));
    }


    public function data()
    {

        $design = Design::leftJoin('proyek', 'proyek.id_proyek', 'design.id_proyek')
            ->select('design.*', 'nama_proyek')
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
                $buttons .= '<button type="button" onclick="editForm4(`'. route('design.update', $design->id_design) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil">Edit</i></button>';
                $buttons .= '<button type="button" onclick="editForm2(`'. route('design.updatex', $design->id_design) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-reply-all">Rev</i></button>';        
                $buttons .= '<button type="button" onclick="deleteData(`'. route('design.destroy', $design->id_design) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
                $buttons .= '<button type="button" onclick="showDetail(`'. route('design.showDetail', $design->id_design) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-eye"></i></button>';
                $buttons .= '</div>';
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_design', 'select_all'])
            ->make(true);
    }

    public function dataModal()

    {
        $design = Design::leftJoin('proyek', 'proyek.id_proyek', 'design.id_proyek')
            ->select('design.*', 'nama_proyek')
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
                $buttons .= '<button type="button" onclick="pilihDesign(`'. route('design.pilihData', $design->id_design) .'`)" class="btn btn-xs btn-success btn-flat">Pilih</button>';
                $buttons .= '</div>';
        
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_design', 'select_all'])
            ->make(true);
    }


    public function dataDetail(Request $request)
    {

        $id_design = $request->query('id_design');
        $detail = DesignDetail::with('design')->where('id_design', $id_design)->get();
    
        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_design', function ($detail) {
                return '<span class="label label-success">'. $detail->design->id_design .'</span>';
            })
            ->addColumn('created_at', function ($detail) {
                return tanggal_indonesia($detail->created_at, false);
            })
            ->rawColumns(['kode_design'])
            ->make(true);
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

    public function showDetail($id)
    {
        $detail = DesignDetail::with('design')->where('id_design', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_design', function ($detail) {
                return '<span class="label label-success">'. $detail->kode_design .'</span>';
            })
            ->addColumn('created_at', function ($detail) {
                return tanggal_indonesia($detail->created_at, false);
            })
            ->rawColumns(['kode_design'])
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

    public function store(Request $request)
    {
        $design = Design::create($request->all());
    
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
            $design->tanggal_refrensi = $request->tanggal_refrensi;
            $design->tanggal_prediksi = $request->tanggal_prediksi; // Gunakan tanggal_prediksi dari form
        } else {
            // Jika tanggal_refrensi tidak diisi, periksa apakah tanggal_prediksi diisi dari form
            if ($request->filled('tanggal_prediksi')) {
                $design->tanggal_prediksi = $request->tanggal_prediksi;
            }
        }
    
        // Jika tanggal_prediksi diisi, perbarui kolom prediksi_akhir
        if ($request->filled('tanggal_prediksi')) {
            $design->prediksi_akhir = \Carbon\Carbon::parse($design->tanggal_prediksi)->addDays($design->prediksi_hari);
        }
    
        // Simpan perubahan
        $design->save();
    
        return response()->json(['message' => 'Data berhasil diupdate']);
    }

    public function updates(Request $request, $id)
        {
            $design = Design::find($id);

            if ($request->filled('tanggal_refrensi')) {
                $design->tanggal_prediksi = $request->tanggal_refrensi;
            } else {
                $design->tanggal_prediksi = $request->tanggal_prediksi;
            }
            $design->prediksi_akhir = \Carbon\Carbon::parse($design->tanggal_prediksi)->addDays($design->prediksi_hari);

            $design->save();

            return response()->json(['message' => 'Data berhasil diupdate']);
            
        }
    
    public function updatex(Request $request, $id)
    {
            $design = Design::find($id);

            if ($design) {
                $nilairev = $design->revisi;
            
                if ($nilairev === 'Rev.0') {
                    $inputrev = 'Rev.A';
                } elseif ($nilairev === 'Rev.A') {
                    $inputrev = 'Rev.B';
                } elseif ($nilairev === 'Rev.B') {
                    $inputrev = 'Rev.C';
                } elseif ($nilairev === 'Rev.C') {
                    $inputrev = 'Rev.D';
                } elseif ($nilairev === 'Rev.D') {
                    $inputrev = 'Rev.E';
                } elseif ($nilairev === 'Rev.E') {
                    $inputrev = 'Rev.F';
                } elseif ($nilairev === 'Rev.F') {
                    $inputrev = 'Rev.G';
                } elseif ($nilairev === 'Rev.G') {
                    $inputrev = 'Rev.H';
                } elseif ($nilairev === 'Rev.H') {
                    $inputrev = 'Rev.I';
                } elseif ($nilairev === 'Rev.I') {
                    $inputrev = 'Rev.J';
                } elseif ($nilairev === 'Rev.J') {
                    $inputrev = 'Rev.K';
                } elseif ($nilairev === 'Rev.K') {
                    $inputrev = 'Rev.L';
                } elseif ($nilairev === 'Rev.L') {
                    $inputrev = 'Rev.M';
                } elseif ($nilairev === 'Rev.M') {
                    $inputrev = 'Rev.N';
                } elseif ($nilairev === 'Rev.N') {
                    $inputrev = 'Rev.O';
                } elseif ($nilairev === 'Rev.O') {
                    $inputrev = 'Rev.P';
                } elseif ($nilairev === 'Rev.P') {
                    $inputrev = 'Rev.Q';
                } elseif ($nilairev === 'Rev.Q') {
                    $inputrev = 'Rev.R';
                } elseif ($nilairev === 'Rev.R') {
                    $inputrev = 'Rev.S';
                } elseif ($nilairev === 'Rev.S') {
                    $inputrev = 'Rev.T';
                } elseif ($nilairev === 'Rev.T') {
                    $inputrev = 'Rev.U';
                } elseif ($nilairev === 'Rev.U') {
                    $inputrev = 'Rev.V';
                } elseif ($nilairev === 'Rev.V') {
                    $inputrev = 'Rev.W';
                } elseif ($nilairev === 'Rev.W') {
                    $inputrev = 'Rev.X';
                } elseif ($nilairev === 'Rev.X') {
                    $inputrev = 'Rev.Y';
                } elseif ($nilairev === 'Rev.Y') {
                    $inputrev = 'Rev.Z';
                } else {
                    $inputrev = '0';
                }
        
                $design->revisi = $inputrev;
            
            $design->update($request->all());
        
            return response()->json(['nama_design' => $design->nama_design]);
        }
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



    public function cetakPdf(Request $request)
    {
        $datadesign = array();
        foreach ($request->id_design as $id) {      
            $design = Design::leftJoin('proyek', 'proyek.id_proyek', '=', 'design.id_proyek')
                ->leftJoin('users as check_user', 'check_user.id', '=', 'design.id_check')
                ->leftJoin('users as approve_user', 'approve_user.id', '=', 'design.id_approve')
                ->leftJoin('users as draft_user', 'draft_user.id', '=', 'design.id_draft')
                ->select('design.*', 'proyek.nama_proyek', 'check_user.name as check_user_name', 'approve_user.name as approve_user_name', 'draft_user.name as draft_user_name')
                ->find($id);
        
            if ($design) {
                $datadesign[] = $design;
            }
        }

        $no  = 1;
        $pdf = PDF::loadView('design.cetakPdf', compact('datadesign', 'no'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('design.pdf');
    }
    

    public function exportExcel()
    {
        $design = Design::leftJoin('proyek', 'proyek.id_proyek', '=', 'design.id_proyek')
        ->leftJoin('users as check_user', 'check_user.id', '=', 'design.id_check')
        ->leftJoin('users as approve_user', 'approve_user.id', '=', 'design.id_approve')
        ->leftJoin('users as draft_user', 'draft_user.id', '=', 'design.id_draft')
        ->select('design.*', 'proyek.nama_proyek', 'check_user.name as check_user_name', 'approve_user.name as approve_user_name', 'draft_user.name as draft_user_name')
        ->get();
    
        return Excel::download(new designExport($design), 'design.xlsx');
    }

    public function exportExcelLog()
    {
        $designlog = DesignDetail::leftJoin('design', 'design.id_design', '=', 'design_detail.id_design')
        ->select('design_detail.*', 'design.nama_design')
        ->get();
    
        return Excel::download(new designExportLog($designlog), 'Log.xlsx');
    }

    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file'); // Ambil file Excel dari request
    
            // Pastikan Anda sudah membuat class Import yang sesuai dengan skema impor Anda
            Excel::import(new designImports, $file);
    
            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('design.index')->with('success', 'Import data berhasil.');
        } catch (\Exception $e) {
            // Tampilkan pesan error yang lebih rinci
            return redirect()->route('design.index')->with('error', 'Import data gagal: ' . $e->getMessage() . ' Line: ' . $e->getLine());
        }
    }
    

}

