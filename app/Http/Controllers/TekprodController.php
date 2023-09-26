<?php

namespace App\Http\Controllers;

use App\Events\DesignRevisiUpdated;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\tekprodExport;
use App\Exports\tekprodExportLog;
use App\Imports\tekprodImports; 

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Subpengujian;
use App\Models\Tekprod;
use App\Models\TekprodDetail;
use App\Models\Design;
use App\Models\Proyek;
use App\Models\Sistem;
use App\Models\Konfigurasi;
use App\Models\Subsistem;
use App\Models\KepalaGambar;
use App\Models\DesignDetail;
use App\Models\User;
use DateTime;
use PDF;

class TekprodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tekprod = Tekprod::select('id_tekprod')->orderBy('id_tekprod', 'DESC')->get();
        $userLoggedIn = Auth::user(); 
        $bagianUser = $userLoggedIn->bagian;
        $levelUser = $userLoggedIn->level;

        $kepala = KepalaGambar::all()->pluck('nama', 'id_kepala_gambar', 'bobot_kepala');
        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');
    
        $approver = User::where('bagian', $bagianUser)->where('level', $levelUser)->pluck('name', 'id');
        $drafter = User::where('bagian', $bagianUser)->where('level', '3')->pluck('name', 'id');
    
        $proyek = Proyek::where('status', 'open')->pluck('nama_proyek' , 'id_proyek');

        $konfigurasi = Konfigurasi::all()->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_dmu = Konfigurasi::where('tipe_konfigurasi', 'DMU')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_emu = Konfigurasi::where('tipe_konfigurasi', 'EMU')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_light = Konfigurasi::where('tipe_konfigurasi', 'Light')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_coach = Konfigurasi::where('tipe_konfigurasi', 'Single Coach')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_wagon = Konfigurasi::where('tipe_konfigurasi', 'Wagon')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_other = Konfigurasi::where('tipe_konfigurasi', 'Other')->pluck('nama_konfigurasi','id_konfigurasi');
    
        return view('tekprod.index', compact('tekprod', 'kepala', 'subsistem', 'approver', 'drafter', 'proyek',
        'konfigurasi', 'konfigurasi_dmu', 'konfigurasi_emu', 'konfigurasi_light', 'konfigurasi_coach', 'konfigurasi_wagon', 'konfigurasi_other',
        'approver'
       ));
    }

    public function indexOverall()
    {

        $tekprod = Tekprod::select('id_tekprod')->orderBy('id_tekprod', 'DESC')->get();
        $userLoggedIn = Auth::user(); 
        $bagianUser = $userLoggedIn->bagian;
        $levelUser = $userLoggedIn->level;

        $kepala = KepalaGambar::all()->pluck('nama', 'id_kepala_gambar');
        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');
    
        $approver = User::where('bagian', $bagianUser)->where('level', $levelUser)->pluck('name', 'id');
        $drafter = User::where('bagian', $bagianUser)->where('level', '3')->pluck('name', 'id');
    
        $proyek = Proyek::where('status', 'open')->pluck('nama_proyek' , 'id_proyek');

        $konfigurasi = Konfigurasi::all()->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_dmu = Konfigurasi::where('tipe_konfigurasi', 'DMU')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_emu = Konfigurasi::where('tipe_konfigurasi', 'EMU')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_light = Konfigurasi::where('tipe_konfigurasi', 'Light')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_coach = Konfigurasi::where('tipe_konfigurasi', 'Single Coach')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_wagon = Konfigurasi::where('tipe_konfigurasi', 'Wagon')->pluck('nama_konfigurasi','id_konfigurasi');
        $konfigurasi_other = Konfigurasi::where('tipe_konfigurasi', 'Other')->pluck('nama_konfigurasi','id_konfigurasi');
    
        return view('tekrod_overall.index', compact('tekprod', 'kepala', 'subsistem', 'approver', 'drafter', 'proyek',
        'konfigurasi', 'konfigurasi_dmu', 'konfigurasi_emu', 'konfigurasi_light', 'konfigurasi_coach', 'konfigurasi_wagon', 'konfigurasi_other',
        'approver'
       ));
    }

    public function dataOverall()
    {
        $tekprod = Tekprod::leftJoin('kepala_gambar', 'kepala_gambar.id_kepala_gambar', 'tekprod.id_kepala_gambar')
            ->leftJoin('proyek', 'proyek.id_proyek', 'tekprod.id_proyek')
            ->leftJoin('users as check_user', 'check_user.id', '=', 'tekprod.id_check_tekprod')
            ->leftJoin('users as approve_user', 'approve_user.id', '=', 'tekprod.id_approve_tekprod')
            ->leftJoin('users as draft_user', 'draft_user.id', '=', 'tekprod.id_draft_tekprod')
            ->select('tekprod.*', 'nama_proyek', 'nama', 'tekprod.jenis_tekprod', 'tekprod.status_tekprod as tekprod_status', 'proyek.status as proyek_status', 'check_user.name as check_user_name', 'approve_user.name as approve_user_name', 'draft_user.name as draft_user_name')
            ->where('jenis_tekprod', 'Doc')
            ->where(function ($query) {
                $query->where('proyek.status', 'Open');
            })
            ->orderBy('id_tekprod', 'DESC')
            ->get();

        return datatables()
            ->of($tekprod)
            ->addIndexColumn()
            ->editColumn('id_proyek', function ($tekprod) {
                return $tekprod->nama_proyek ?? '';
            })
            ->addColumn('kondisi', function ($tekprod) {
                if ($tekprod->status_tekprod !== 'Release') {
                    $tanggalPrediksi = new DateTime($tekprod->tanggal_prediksi_tekprod);
                    $today = new DateTime();
                    $interval = $tanggalPrediksi->diff($today);
                    $selisihHari = $interval->days;
            
                    if ($tanggalPrediksi > $today) {
                        return $selisihHari . ' Hari';
                    } else {
                        return '-' . $selisihHari . ' Hari';
                    }
                } else {
                    return '';
                }
            })
            ->editColumn('id_draft_tekprod', function ($tekprod) {
                return $tekprod->draft_user_name ?? '';
            })
            ->editColumn('id_check_tekprod', function ($tekprod) {
                return $tekprod->check_user_name ?? '';
            })
            ->editColumn('id_approve_tekprod', function ($tekprod) {
                return $tekprod->approve_user_name ?? '';
            })
            ->addColumn('aksi', function ($tekprod) {
                $buttons = '<div class="btn-group">';      
                $buttons .= '<button type="button" onclick="showDetail(`'. route('tekprod.showDetail', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-eye"></i></button>';
                $buttons .= '</div>';
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_tekprod'])
            ->make(true);
    }

    public function dataDetail(Request $request)
    {
        $id_tekprod = $request->query('id_tekprod');
        $detail = TekprodDetail::with('tekprod')
            ->select('tekprod_detail.*')
            ->where('tekprod_detail.id_tekprod', $id_tekprod)
            ->get();
    
        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_tekprod', function ($detail) {
                return '<span class="label label-success">'. $detail->tekprod->id_tekprod .'</span>';
            })
            ->addColumn('created_at', function ($detail) {
                return tanggal_indonesia($detail->created_at, false);
            })
            ->rawColumns(['kode_tekprod'])
            ->make(true);
    }

    public function data()
    {
        $userId = auth()->user()->id;

        $tekprod = Tekprod::leftJoin('proyek', 'proyek.id_proyek', 'tekprod.id_proyek')
        ->leftJoin('users as check_user', 'check_user.id', '=', 'tekprod.id_check_tekprod')
        ->leftJoin('users as approve_user', 'approve_user.id', '=', 'tekprod.id_approve_tekprod')
        ->leftJoin('users as draft_user', 'draft_user.id', '=', 'tekprod.id_draft_tekprod')
        ->select('tekprod.*', 'nama_proyek', 'tekprod.status_tekprod as tekprod_status', 'proyek.status as proyek_status', 'check_user.name as check_user_name', 'approve_user.name as approve_user_name', 'draft_user.name as draft_user_name')
        ->where('jenis_tekprod', 'Doc')
        ->where(function ($query) use ($userId) {
            $query->where('tekprod.id_draft_tekprod', $userId)
                  ->orWhere('tekprod.id_check_tekprod', $userId)
                  ->orWhere('tekprod.id_approve_tekprod', $userId);
        })
        ->where(function ($query) {
            $query->where('proyek.status', 'Open');
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
            ->editColumn('id_draft_tekprod', function ($tekprod) {
                return $tekprod->draft_user_name ?? '';
            })
            ->editColumn('id_check_tekprod', function ($tekprod) {
                return $tekprod->check_user_name ?? '';
            })
            ->editColumn('id_approve_tekprod', function ($tekprod) {
                return $tekprod->approve_user_name ?? '';
            })
            ->addColumn('kondisi', function ($tekprod) {
                if ($tekprod->status_tekprod !== 'Release') {
                    $tanggalPrediksi = new DateTime($tekprod->tanggal_prediksi);
                    $today = new DateTime();
                    $interval = $tanggalPrediksi->diff($today);
                    $selisihHari = $interval->days;
            
                    if ($tanggalPrediksi > $today) {
                        return $selisihHari . ' Hari';
                    } else {
                        return '-' . $selisihHari . ' Hari';
                    }
                } else {
                    return '';
                }
            })
            ->addColumn('aksi', function ($tekprod) {
                $buttons = '<div class="btn-group">';
                if ($tekprod->status_tekprod !== 'Release') {
                    $buttons .= '<button type="button" onclick="editForm4(`'. route('tekprod.update', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil">Edit</i></button>';
                    $buttons .= '<button type="button" onclick="deleteData(`'. route('tekprod.destroy', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
                }
                if ($tekprod->status_tekprod === 'Release') {
                    $buttons .= '<button type="button" onclick="editForm2(`'. route('tekprod.updatex', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-reply-all">Rev</i></button>'; 
                }
                $buttons .= '<button type="button" onclick="showDetail(`'. route('tekprod.showDetail', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-eye"></i></button>';
                $buttons .= '</div>';
                return $buttons;
            })
            
            ->rawColumns(['aksi', 'id_tekprod', 'select_all'])
            ->make(true);
    }

    public function dataAdmin()
    {
        $tekprod = Tekprod::leftJoin('proyek', 'proyek.id_proyek', 'tekprod.id_proyek')
            ->select('tekprod.*', 'nama_proyek','proyek.status', 'tekprod.status_tekprod')
            ->where(function ($query) {
                $query->where('proyek.status', 'Open');
            })
            ->where('jenis_tekprod', 'Doc')
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
            ->addColumn('kondisi', function ($tekprod) {
                $tanggalPrediksi = new DateTime($tekprod->tanggal_prediksi);

                $today = new DateTime();
                $interval = $tanggalPrediksi->diff($today);
                $selisihHari = $interval->days;
            
                if ($tanggalPrediksi > $today) {
                    return $selisihHari . ' Hari';
                } else {
                    return '-' . $selisihHari . ' Hari';
                }
            })
            ->addColumn('aksi', function ($tekprod) {
                $buttons = '<div class="btn-group">';
                if ($tekprod->status_tekprod !== 'Release') {
                    $buttons .= '<button type="button" onclick="editForm4(`'. route('tekprod.update', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil">Edit</i></button>';
                    $buttons .= '<button type="button" onclick="deleteData(`'. route('tekprod.destroy', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
                }
                if ($tekprod->status === 'Release') {
                    $buttons .= '<button type="button" onclick="editForm2(`'. route('tekprod.updatex', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-reply-all">Rev</i></button>'; 
                }
                $buttons .= '<button type="button" onclick="showDetail(`'. route('tekprod.showDetail', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-eye"></i></button>';
                $buttons .= '</div>';
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_tekprod', 'select_all'])
            ->make(true);
    }

    public function dataModal()
    {
        $tekprod = Tekprod::leftJoin('proyek', 'proyek.id_proyek', 'tekprod.id_proyek')
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
                $buttons .= '<button type="button" onclick="pilihDesign(`'. route('tekprod.pilihData', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-success btn-flat">Pilih</button>';
                $buttons .= '</div>';
        
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_tekprod', 'select_all'])
            ->make(true);
    }

    public function dataModal2()
    {
        $tekprod = Tekprod::leftJoin('proyek', 'proyek.id_proyek', 'tekprod.id_proyek')
        ->where('tekprod.status_tekprod', 'Open')
        ->select('tekprod.*', 'proyek.nama_proyek', 'tekprod.status_tekprod')
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
                $buttons .= '<button type="button" onclick="pilihBaru(`'. route('tekprod.pilihData', $tekprod->id_tekprod) .'`)" class="btn btn-xs btn-success btn-flat">Pilih</button>';
                $buttons .= '</div>';
        
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_tekprod', 'select_all'])
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
        $tekprod = Tekprod::find($id);
        return response()->json($tekprod);
    }

    public function showDetail($id)
    {
        $detail = TekprodDetail::with('tekprod')->where('id_tekprod', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_tekprod', function ($detail) {
                return '<span class="label label-success">'. $detail->kode_tekprod .'</span>';
            })
            ->addColumn('created_at', function ($detail) {
                return tanggal_indonesia($detail->created_at, false);
            })
            ->rawColumns(['kode_tekprod'])
            ->make(true);
    }


    public function modalRef()
    {
        $tekprod = Tekprod::select('nama_tekprod', 'id_tekprod');
        return view ('tekprod.dwg', compact('tekprod'));
    }

    public function pilihData($id)
    {
        $tekprod = Tekprod::find($id);
        return response()->json($tekprod);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existingTekprod = Tekprod::where('kode_tekprod', $request->kode_tekprod)->first();

        if ($existingTekprod) {
            $existingTekprod->delete();
        }

        $tekprod = Tekprod::create($request->all());

        $tekprod->kode_tekprod = $request->kode_tekprod;

        if ($request->filled('tanggal_refrensi_tekprod')) {
            $tekprod->tanggal_prediksi_tekprod = $request->tanggal_prediksi_tekprod;
        } else {
            $tekprod->tanggal_prediksi_tekprod = $request->tanggal_prediksi_tekprod;
        }

        $tekprod->prediksi_akhir_tekprod = \Carbon\Carbon::parse($tekprod->tanggal_prediksi_tekprod)->addDays($tekprod->prediksi_hari_tekprod);
        $tekprod->pa_yy_tekprod = $tekprod->prediksi_akhir_tekprod->format('Y');
        $tekprod->pa_mm_tekprod = $tekprod->prediksi_akhir_tekprod->format('m');
        $tekprod->pa_dd_tekprod = $tekprod->prediksi_akhir_tekprod->format('d');

        list($year, $month, $day) = explode('-', $tekprod->tanggal_prediksi_tekprod);
        $tekprod->tp_yy_tekprod = $year;
        $tekprod->tp_mm_tekprod = $month;
        $tekprod->tp_dd_tekprod = $day;

        $tekprod->save();

        return response()->json('Data berhasil disimpan', 200);
    }

public function stores(Request $request)
{
        Tekprod::where('kode_tekprod', $request->kode_tekprod)->delete();

        $tekprod = new Tekprod($request->all());
        $tekprod->prosentase_tekprod = '30';
        $tekprod->bobot_rev_tekprod = '3';
        $tekprod->rev_for_curva_tekprod = 'Rev.0';
        $tekprod->jenis_tekprod = 'Doc';

        $tekprod->pemilik_tekprod = $request->pemilik_tekprod;
        $tekprod->bobot_design_tekprod = $request->bobot_design_tekprod;
        $tekprod->lembar_tekprod = $request->lembar_tekprod;
        $tekprod->size_tekprod = $request->size_tekprod;
        $tekprod->prediksi_hari_tekprod = $tekprod->lembar_tekprod * $tekprod->size_tekprod / 8; //tipe integer

        $tekprod->tanggal_prediksi_tekprod = \Carbon\Carbon::now()->format('Y-m-d');
        $tekprod->prediksi_akhir_tekprod = \Carbon\Carbon::parse($tekprod->tanggal_prediksi_tekprod)->addDays($tekprod->prediksi_hari_tekprod)->format('Y-m-d'); //tipe date

        list($year, $month, $day) = explode('-', $tekprod->prediksi_akhir_tekprod);
        $tekprod->pa_yy_tekprod = $year;
        $tekprod->pa_mm_tekprod = $month;
        $tekprod->pa_dd_tekprod = $day;

        list($year, $month, $day) = explode('-', $tekprod->tanggal_prediksi_tekprod);
        $tekprod->tp_yy_tekprod = $year;
        $tekprod->tp_mm_tekprod = $month;
        $tekprod->tp_dd_tekprod = $day;

        $tekprod->save();

        return response()->json('Data berhasil disimpan', 200);
}

    public function storeRevisi(Request $request)
    {
        // Mencari data dengan kode yang sama
        $existingTekprod = Tekprod::where('kode_tekprod', $request->kode_tekprod)->first();
    
        // Jika ada data dengan kode yang sama, hapus data tersebut
        if ($existingTekprod) {
            $existingTekprod->delete();
        }
    
        // Buat dan simpan data baru
        $tekprod = Tekprod::create($request->all());
        $tekprod->kode_tekprod = $request->kode_tekprod;
    
        if ($request->filled('tanggal_refrensi_tekprod')) {
            $tekprod->tanggal_prediksi_tekprod = $request->tanggal_refrensi_tekprod;
        } else {
           $tekprod->tanggal_prediksi_tekprod = $request->tanggal_prediksi_tekprod;
        }
    
        $tekprod->prediksi_akhir_tekprod = \Carbon\Carbon::parse($tekprod->tanggal_prediksi_tekprod)->addDays($tekprod->prediksi_hari_tekprod);
    
        $tekprod->save();
    
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
        $tekprod = Tekprod::find($id);
        return response()->json('Data berhasil disimpan', 200);
    }
    
    public function updatex(Request $request, $id)
    {
            $tekprod = Tekprod::find($id);

            if ($tekprod) {
                $nilairev = $tekprod->revisi_tekprod;
            
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
        
                $tekprod->revisi_tekprod = $inputrev;

            $tekprod->bobot_rev_tekprod = $request->bobot_rev_tekprod;
            $tekprod->prosentase_tekprod = "60";
            
            $tekprod->update($request->all());
        
            return response()->json('Data berhasil disimpan', 200);
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
        $tekprod = Tekprod::find($id);
        $tekprod->delete();

        return response(null, 204);
    }


    public function deleteSelected(Request $request)
    {
        foreach ($request->id_tekprod as $id) {
        $tekprod = Tekprod::find($id);
        $tekprod->delete();
        }

        return response(null, 204);
    }


    public function cetakPdf(Request $request)
    {
        $datatekprod = array();
        foreach ($request->id_tekprod as $id) {      
            $tekprod = Tekprod::leftJoin('proyek', 'proyek.id_proyek', '=', 'tekprod.id_proyek')
                ->leftJoin('users as check_user', 'check_user.id', '=', 'tekprod.id_check_tekprod')
                ->leftJoin('users as approve_user', 'approve_user.id', '=', 'tekprod.id_approve_tekprod')
                ->leftJoin('users as draft_user', 'draft_user.id', '=', 'tekprod.id_draft_tekprod')
                ->select('tekprod.*', 'proyek.nama_proyek', 'check_user.name as check_user_name', 'approve_user.name as approve_user_name', 'draft_user.name as draft_user_name')
                ->find($id);
        
            if ($tekprod) {
                $datatekprod[] = $tekprod;
            }
        }

        $no  = 1;
        $pdf = PDF::loadView('tekprod.cetakPdf', compact('datatekprod', 'no'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('teknologi_produksi.pdf');
    }
    

    public function exportExcel()
    {
        $tekprod = Tekprod::leftJoin('proyek', 'proyek.id_proyek', '=', 'tekprod.id_proyek')
        ->leftJoin('kepala_gambar', 'kepala_gambar.id_kepala_gambar', '=', 'tekprod.id_kepala_gambar')
        ->leftJoin('users as check_user', 'check_user.id', '=', 'tekprod.id_check_tekprod')
        ->leftJoin('users as approve_user', 'approve_user.id', '=', 'tekprod.id_approve_tekprod')
        ->leftJoin('users as draft_user', 'draft_user.id', '=', 'tekprod.id_draft_tekprod')
        ->select('tekprod.*', 'proyek.nama_proyek', 'kepala_gambar.nama', 'check_user.name as check_user_name', 'approve_user.name as approve_user_name', 'draft_user.name as draft_user_name')
        ->get();
    
        return Excel::download(new tekprodExport($tekprod), 'teknologi_produksi.xlsx');
    }

    public function exportExcelLog()
    {
        $tekprodlog = TekprodDetail::leftJoin('tekprod', 'tekprod.id_design', '=', 'tekprod_detail.id_design')
        ->leftJoin('users as check_user', 'check_user.id', '=', 'tekprod.id_check_tekprod')
        ->leftJoin('users as approve_user', 'approve_user.id', '=', 'tekprod.id_approve_tekprod')
        ->leftJoin('users as draft_user', 'draft_user.id', '=', 'tekprod.id_draft_tekprod')
        ->select('tekprod_detail.*', 'tekprod.nama_design', 'check_user.name as check_user_name', 'approve_user.name as approve_user_name', 'draft_user.name as draft_user_name')
        ->get();
    
        return Excel::download(new tekprodExportLog($tekprodlog), 'Log_teknologi_produksi.xlsx');
    }

    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file');
    
            Excel::import(new tekprodImports, $file);
    
            return redirect()->route('tekprod.index')->with('success', 'Import data berhasil.');
        } catch (\Exception $e) {

            return redirect()->route('tekprod.index')->with('error', 'Import data gagal: ' . $e->getMessage() . ' Line: ' . $e->getLine());
        }
    }
    

}