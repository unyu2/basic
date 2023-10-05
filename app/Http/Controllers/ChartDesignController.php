<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Design;
use App\Models\DesignDetail;
use App\Models\Tekprod;
use App\Models\TekprodDetail;
use App\Models\Proyek;
use Carbon\Carbon;

class ChartDesignController extends Controller
{
    public function index()
    {
        $proyek = Proyek::all()->pluck('nama_proyek', 'id_proyek');

        $fetch_id_proyek = Design::select("id_proyek")
            ->groupBy('id_proyek')
            ->orderBy('id_proyek', 'DESC')
            ->get();
        return view('charts.chartsDesign', compact('fetch_id_proyek', 'proyek'));
    }


//*-----------------------------------------OVERALL TECHNOLOGY NORMAL--------------------------------------------------/*

public function fetch_data_overall(Request $request)
{
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $id_proyek = $request->input('id_proyek');

    $chart_data_design = Design::select("id_design", "id_proyek", "status")->where('jenis', 'Doc');

    if (empty($id_proyek)) {
        $chart_data_design->whereIn('id_proyek', $proyek_dengan_status_open);
    } else {
        $chart_data_design->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
    }

    $chart_data_design = $chart_data_design->get();

    $chart_data_tekprod = Tekprod::select("id_tekprod", "id_proyek", "status_tekprod")->where('jenis_tekprod', 'Doc');

    if (empty($id_proyek)) {
        $chart_data_tekprod->whereIn('id_proyek', $proyek_dengan_status_open);
    } else {
        $chart_data_tekprod->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
    }

    $chart_data_tekprod = $chart_data_tekprod->get();

    $openCountDesign = $chart_data_design->where('status', 'Open')->count();
    $releaseCountDesign = $chart_data_design->where('status', 'Release')->count();
    $prosesRevisiCountDesign = $chart_data_design->where('status', 'Proses Revisi')->count();

    $openCountTekprod = $chart_data_tekprod->where('status_tekprod', 'Open')->count();
    $releaseCountTekprod = $chart_data_tekprod->where('status_tekprod', 'Release')->count();
    $prosesRevisiCountTekprod = $chart_data_tekprod->where('status_tekprod', 'Proses Revisi')->count();

    $output = [
        [
            'status' => 'Open',
            'jumlah' => $openCountDesign + $openCountTekprod
        ],
        [
            'status' => 'Release',
            'jumlah' => $releaseCountDesign + $releaseCountTekprod
        ],
        [
            'status' => 'Proses Revisi',
            'jumlah' => $prosesRevisiCountDesign + $prosesRevisiCountTekprod
        ]
    ];

    return response()->json($output);
}


//*--------------------------------------OVERALL TECHNOLOGY BOBOT----------------------------------------------/*
public function fetch_data_overall_bobot(Request $request)
{
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $id_proyek = $request->input('id_proyek');

    $chart_data_design = Design::select("status", "size", "lembar", "tipe", "bobot_rev", "bobot_design", "id_design", "id_proyek")->where('jenis', 'Doc');

    if (empty($id_proyek)) {
        $chart_data_design->whereIn('id_proyek', $proyek_dengan_status_open);
    } else {
        $chart_data_design->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
    }

    $chart_data_design = $chart_data_design->get();

    $chart_data_tekprod = Tekprod::select("status_tekprod", "size_tekprod", "lembar_tekprod", "tipe_tekprod", "bobot_rev_tekprod", "bobot_design_tekprod", "id_tekprod", "id_proyek")->where('jenis_tekprod', 'Doc');

    if (empty($id_proyek)) {
        $chart_data_tekprod->whereIn('id_proyek', $proyek_dengan_status_open);
    } else {
        $chart_data_tekprod->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
    }

    $chart_data_tekprod = $chart_data_tekprod->get();

    $totalStatusDesign = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatusTekprod = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data_design as $row) {
        $status = $row->status;
        $size = $row->size;
        $lembar = $row->lembar;
        $bobot_rev = $row->bobot_rev;
        $bobot_design = $row->bobot_design;
        $tipe = $row->tipe;

        $jumlahDesign = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatusDesign[$status] += $jumlahDesign;
    }

    foreach ($chart_data_tekprod as $row) {
        $status_tekprod = $row->status_tekprod;
        $size_tekprod = $row->size_tekprod;
        $lembar_tekprod = $row->lembar_tekprod;
        $bobot_rev_tekprod = $row->bobot_rev_tekprod;
        $bobot_design_tekprod = $row->bobot_design_tekprod;
        $tipe_tekprod = $row->tipe_tekprod;

        $jumlahTekprod = $size_tekprod * $lembar_tekprod * $tipe_tekprod * ($bobot_rev_tekprod/3) * ($bobot_design_tekprod/3);

        $totalStatusTekprod[$status_tekprod] += $jumlahTekprod;
    }

    $totalJumlah = array_sum($totalStatusDesign) + array_sum($totalStatusTekprod);

    $output = [];
    foreach ($totalStatusDesign as $status => $totalDesign) {
        $totalTekprod = $totalStatusTekprod[$status] ?? 0;
        if ($totalJumlah != 0) {
            $prosentase = (($totalDesign + $totalTekprod) / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}

//*-----------------------------------------ENGINEERING DEPARTMENT NORMAL--------------------------------------------------/*

public function fetch_data_engineering(Request $request)
{
    // Mendapatkan daftar proyek dengan status "Open" dari tabel proyek
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $id_proyek = $request->input('id_proyek');

    $chart_data = Design::select("id_design", "id_proyek", "status", "created_at", "pemilik")->where('jenis', 'Doc');

    // Jika id_proyek kosong, ambil semua data dengan pemilik "Design" yang terkait dengan proyek "Open"
    if (empty($id_proyek)) {
        $chart_data->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Engineering');
    } else {
        // Jika id_proyek tidak kosong, ambil data berdasarkan proyek, pemilik "Design", dan proyek "Open"
        $chart_data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Engineering');
    }

    $chart_data = $chart_data->get();

    // Inisialisasi array untuk menyimpan jumlah status
    $statusData = [];

    // Menghitung jumlah setiap status desain
    foreach ($chart_data as $row) {
        $status = $row->status;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    // Mengubah data ke format yang sesuai untuk pie chart
    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }

    // Mengembalikan data dalam format JSON
    return response()->json($output);
}

//*--------------------------------------ENGINEERING DEPARTMENT BOBOT----------------------------------------------/*

public function fetch_data_engineering_bobot(Request $request)
{
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $id_proyek = $request->input('id_proyek');

    // Inisialisasi query builder
    $chart_data = Design::select("status", "size", "lembar", "tipe", "bobot_rev", "bobot_design", "id_design", "id_proyek", "pemilik")->where('jenis', 'Doc');

    // Jika id_proyek kosong, ambil semua data dengan status "Open"
    if (empty($id_proyek)) {
        $chart_data->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Engineering');
    } else {
        // Jika id_proyek tidak kosong, ambil data berdasarkan proyek dan status "Open"
        $chart_data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Engineering');
    }

    // Ambil data dari model dengan filter yang telah ditentukan
    $chart_data = $chart_data->get();
    
    // Inisialisasi counter
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    // Inisialisasi variabel total untuk masing-masing status
    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    // Hitung jumlah status dan total berdasarkan perkalian "size", "lembar", dan "bobot_rev"
    foreach ($chart_data as $row) {
        $status = $row->status;
        $size = $row->size;
        $lembar = $row->lembar;
        $bobot_rev = $row->bobot_rev;
        $bobot_design = $row->bobot_design;
        $tipe = $row->tipe;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        // Menambahkan jumlah ke total masing-masing status
        $totalStatus[$status] += $jumlah;
    }

    // Menghitung total keseluruhan
    $totalJumlah = array_sum($totalStatus);

    // Mengubah data ke format yang sesuai untuk pie chart
    $output = [];
    foreach ($totalStatus as $status => $total) {
        // Menghitung prosentase jumlah terhadap total jumlah
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0; // Hindari pembagian oleh nol
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    // Mengembalikan data dalam format JSON
    return response()->json($output);
}


//*-----------------------------------------DESIGN DEPARTMENT NORMAL--------------------------------------------------/*

public function fetch_data_status(Request $request)
{
    // Mendapatkan daftar proyek dengan status "Open" dari tabel proyek
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $id_proyek = $request->input('id_proyek');

    $chart_data = Design::select("id_design", "id_proyek", "status", "created_at", "pemilik")->where('jenis', 'Doc');

    // Jika id_proyek kosong, ambil semua data dengan pemilik "Design" yang terkait dengan proyek "Open"
    if (empty($id_proyek)) {
        $chart_data->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Design');
    } else {
        // Jika id_proyek tidak kosong, ambil data berdasarkan proyek, pemilik "Design", dan proyek "Open"
        $chart_data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Design');
    }

    $chart_data = $chart_data->get();

    // Inisialisasi array untuk menyimpan jumlah status
    $statusData = [];

    // Menghitung jumlah setiap status desain
    foreach ($chart_data as $row) {
        $status = $row->status;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    // Mengubah data ke format yang sesuai untuk pie chart
    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }

    // Mengembalikan data dalam format JSON
    return response()->json($output);
}

//*--------------------------------------DESIGN DEPARTMENT BOBOT----------------------------------------------/*

public function fetch_data_status_bobot(Request $request)
{
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $id_proyek = $request->input('id_proyek');

    // Inisialisasi query builder
    $chart_data = Design::select("status", "size", "lembar", "tipe", "bobot_rev", "bobot_design", "id_design", "id_proyek", "pemilik")->where('jenis', 'Doc');

    // Jika id_proyek kosong, ambil semua data dengan status "Open"
    if (empty($id_proyek)) {
        $chart_data->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Design');
    } else {
        // Jika id_proyek tidak kosong, ambil data berdasarkan proyek dan status "Open"
        $chart_data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Design');
    }

    // Ambil data dari model dengan filter yang telah ditentukan
    $chart_data = $chart_data->get();
    
    // Inisialisasi counter
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    // Inisialisasi variabel total untuk masing-masing status
    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    // Hitung jumlah status dan total berdasarkan perkalian "size", "lembar", dan "bobot_rev"
    foreach ($chart_data as $row) {
        $status = $row->status;
        $size = $row->size;
        $lembar = $row->lembar;
        $bobot_rev = $row->bobot_rev;
        $bobot_design = $row->bobot_design;
        $tipe = $row->tipe;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        // Menambahkan jumlah ke total masing-masing status
        $totalStatus[$status] += $jumlah;
    }

    // Menghitung total keseluruhan
    $totalJumlah = array_sum($totalStatus);

    // Mengubah data ke format yang sesuai untuk pie chart
    $output = [];
    foreach ($totalStatus as $status => $total) {
        // Menghitung prosentase jumlah terhadap total jumlah
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0; // Hindari pembagian oleh nol
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    // Mengembalikan data dalam format JSON
    return response()->json($output);
}


//*-----------------------------------------TEKNOLOGI PRODUKSI DEPARTMENT NORMAL--------------------------------------------------/*

public function fetch_data_tekprod(Request $request)
{
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $id_proyek = $request->input('id_proyek');

    $chart_data = Tekprod::select("id_tekprod", "id_proyek", "status_tekprod")->where('jenis_tekprod', 'Doc');

    if (empty($id_proyek)) {
        $chart_data->whereIn('id_proyek', $proyek_dengan_status_open);
    } else {
        $chart_data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
    }

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status_tekprod;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }

    return response()->json($output);
}

//*--------------------------------------TEKNOLOGI PRODUKSI DEPARTMENT BOBOT----------------------------------------------/*

public function fetch_data_tekprod_bobot(Request $request)
{
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $id_proyek = $request->input('id_proyek');

    // Inisialisasi query builder
    $chart_data = Tekprod::select("status_tekprod", "size_tekprod", "lembar_tekprod", "tipe_tekprod", "bobot_rev_tekprod", "bobot_design_tekprod", "id_tekprod", "id_proyek")->where('jenis_tekprod', 'Doc');

    // Jika id_proyek kosong, ambil semua data dengan status "Open"
    if (empty($id_proyek)) {
        $chart_data->whereIn('id_proyek', $proyek_dengan_status_open);
    } else {
        // Jika id_proyek tidak kosong, ambil data berdasarkan proyek dan status "Open"
        $chart_data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
    }

    // Ambil data dari model dengan filter yang telah ditentukan
    $chart_data = $chart_data->get();
    
    // Inisialisasi counter
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    // Inisialisasi variabel total untuk masing-masing status
    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    // Hitung jumlah status dan total berdasarkan perkalian "size", "lembar", dan "bobot_rev"
    foreach ($chart_data as $row) {
        $status = $row->status_tekprod;
        $size = $row->size_tekprod;
        $lembar = $row->lembar_tekprod;
        $bobot_rev = $row->bobot_rev_tekprod;
        $bobot_design = $row->bobot_design_tekprod;
        $tipe = $row->tipe_tekprod;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        // Menambahkan jumlah ke total masing-masing status
        $totalStatus[$status] += $jumlah;
    }

    // Menghitung total keseluruhan
    $totalJumlah = array_sum($totalStatus);

    // Mengubah data ke format yang sesuai untuk pie chart
    $output = [];
    foreach ($totalStatus as $status => $total) {
        // Menghitung prosentase jumlah terhadap total jumlah
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0; // Hindari pembagian oleh nol
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    // Mengembalikan data dalam format JSON
    return response()->json($output);
}


//*-----------------------------------------NORMAL SELECTION DESIGN---------------------------------------------*/

    public function fetch_chart_all_normal($id_proyek, $kode_unit)
    {
        $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

        $data = Design::select("id_design", "id_proyek", "status")
            ->where('jenis', 'Doc')
            ->where('pemilik', 'Design') 
            ->join('kepala_gambar', 'design.id_kepala_gambar', '=', 'kepala_gambar.id_kepala_gambar')
            ->join('jabatan', 'kepala_gambar.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('jabatan.kode_unit', $kode_unit); 

        if (empty($id_proyek)) {
            $data->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Design');
        } else {
            $data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Design');
        }

        return $data;
    }

//*-----------------------------------------BOBOT SELECTION DESIGN---------------------------------------------*/

    public function fetch_chart_all_bobot($id_proyek, $kode_unit)
    {
        $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

        $data = Design::select("status", "size", "lembar", "tipe", "bobot_rev", "bobot_design", "id_design", "id_proyek", "pemilik")
        ->where('jenis', 'Doc')
        ->where('pemilik', 'Design')
        ->join('kepala_gambar', 'design.id_kepala_gambar', '=', 'kepala_gambar.id_kepala_gambar')
        ->join('jabatan', 'kepala_gambar.id_jabatan', '=', 'jabatan.id_jabatan')
        ->where('jabatan.kode_unit', $kode_unit);

        if (empty($id_proyek)) {
            $data->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Design');
        } else {
            $data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open)->where('pemilik', 'Design');
        }
    
        return $data;
    }

//*--------------------------------------------ELECTRICAL DESIGN-----------------------------------------------*/

    public function fetch_data_eld(Request $request)
    {
        $id_proyek = $request->input('id_proyek');
        $kode_unit = '312.EDE';

        $chart_data = $this->fetch_chart_all_normal($id_proyek, $kode_unit);

        $chart_data = $chart_data->get();

        $statusData = [];

        foreach ($chart_data as $row) {
            $status = $row->status;
            if (isset($statusData[$status])) {
                $statusData[$status]++;
            } else {
                $statusData[$status] = 1;
            }
        }

        $output = [];
        foreach ($statusData as $status => $jumlah) {
            $output[] = [
                'status' => $status,
                'jumlah' => $jumlah
            ];
        }
        return response()->json($output);
    }

  
    public function fetch_data_eld_bobot(Request $request)
    {
        $id_proyek = $request->input('id_proyek');
        $kode_unit = '312.EDE';

        // Panggil fungsi untuk mengambil data chart berdasarkan proyek dengan status "Open"
        $chart_data = $this->fetch_chart_all_bobot($id_proyek, $kode_unit);
    
        // Ambil data dari model dengan filter yang telah ditentukan
        $chart_data = $chart_data->get();
        
        // Inisialisasi counter
        $statusData = [
            'Open' => 0,
            'Release' => 0,
            'Proses Revisi' => 0,
        ];
    
        // Inisialisasi variabel total untuk masing-masing status
        $totalStatus = [
            'Open' => 0,
            'Release' => 0,
            'Proses Revisi' => 0,
        ];
    
        // Hitung jumlah status dan total berdasarkan perkalian "size", "lembar", dan "bobot_rev"
        foreach ($chart_data as $row) {
            $status = $row->status;
            $size = $row->size;
            $lembar = $row->lembar;
            $bobot_rev = $row->bobot_rev;
            $bobot_design = $row->bobot_design;
            $tipe = $row->tipe;

            $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);
    
            // Menambahkan jumlah ke total masing-masing status
            $totalStatus[$status] += $jumlah;
        }
    
        // Menghitung total keseluruhan
        $totalJumlah = array_sum($totalStatus);
    
        // Mengubah data ke format yang sesuai untuk pie chart
        $output = [];
        foreach ($totalStatus as $status => $total) {
            // Menghitung prosentase jumlah terhadap total jumlah
            if ($totalJumlah != 0) {
                $prosentase = ($total / $totalJumlah) * 100;
            } else {
                $prosentase = 0; // Hindari pembagian oleh nol
            }
            $output[] = [
                'status' => $status,
                'prosentase' => $prosentase,
            ];
        }
    
        // Mengembalikan data dalam format JSON
        return response()->json($output);
    }

//*--------------------------------------------MECHANICAL AND INTERIOR DESIGN-----------------------------------------------*/

public function fetch_data_mid(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '312.MID';

    $chart_data = $this->fetch_chart_all_normal($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_mid_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '312.MID';

    $chart_data = $this->fetch_chart_all_bobot($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status;
        $size = $row->size;
        $lembar = $row->lembar;
        $bobot_rev = $row->bobot_rev;
        $bobot_design = $row->bobot_design;
        $tipe = $row->tipe;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}


//*--------------------------------------------CARBODY DESIGN-----------------------------------------------*/

public function fetch_data_ced(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '312.CED';

    $chart_data = $this->fetch_chart_all_normal($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_ced_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '312.CED';

    $chart_data = $this->fetch_chart_all_bobot($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status;
        $size = $row->size;
        $lembar = $row->lembar;
        $bobot_rev = $row->bobot_rev;
        $bobot_design = $row->bobot_design;
        $tipe = $row->tipe;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}


//*--------------------------------------------BOGIE & WAGON DESIGN-----------------------------------------------*/

public function fetch_data_bwd(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '312.BWD';

    $chart_data = $this->fetch_chart_all_normal($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_bwd_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '312.BWD';

    $chart_data = $this->fetch_chart_all_bobot($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status;
        $size = $row->size;
        $lembar = $row->lembar;
        $bobot_rev = $row->bobot_rev;
        $bobot_design = $row->bobot_design;
        $tipe = $row->tipe;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}


//*--------------------------------------------PRODUCT ENGINEERING-----------------------------------------------*/

public function fetch_data_pen(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '311.PEN';

    $chart_data = $this->fetch_chart_all_normal($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_pen_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '311.PEN';

    $chart_data = $this->fetch_chart_all_bobot($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status;
        $size = $row->size;
        $lembar = $row->lembar;
        $bobot_rev = $row->bobot_rev;
        $bobot_design = $row->bobot_design;
        $tipe = $row->tipe;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}


//*--------------------------------------------QUALITY ENGINEERING-----------------------------------------------*/

public function fetch_data_qen(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '311.QEN';

    $chart_data = $this->fetch_chart_all_normal($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_qen_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '311.QEN';

    $chart_data = $this->fetch_chart_all_bobot($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status;
        $size = $row->size;
        $lembar = $row->lembar;
        $bobot_rev = $row->bobot_rev;
        $bobot_design = $row->bobot_design;
        $tipe = $row->tipe;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}

//*--------------------------------------------ELECTRICAL ENGINEERING SYSTEM-----------------------------------------------*/

public function fetch_data_ees(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '311.EES';

    $chart_data = $this->fetch_chart_all_normal($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_ees_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '311.EES';

    $chart_data = $this->fetch_chart_all_bobot($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status;
        $size = $row->size;
        $lembar = $row->lembar;
        $bobot_rev = $row->bobot_rev;
        $bobot_design = $row->bobot_design;
        $tipe = $row->tipe;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}

//*--------------------------------------------MECHANICAL ENGINEERING SYSTEM-----------------------------------------------*/

public function fetch_data_mes(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '311.EES';

    $chart_data = $this->fetch_chart_all_normal($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_mes_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $kode_unit = '311.MES';

    $chart_data = $this->fetch_chart_all_bobot($id_proyek, $kode_unit);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status;
        $size = $row->size;
        $lembar = $row->lembar;
        $bobot_rev = $row->bobot_rev;
        $bobot_design = $row->bobot_design;
        $tipe = $row->tipe;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}

//*--------------------------------------------TP - TECHNOLOGY PRODUKSI-----------------------------------------------*/
//*--------------------------------------------TP - TECHNOLOGY PRODUKSI-----------------------------------------------*/
//*--------------------------------------------TP - TECHNOLOGY PRODUKSI-----------------------------------------------*/
//*--------------------------------------------TP - TECHNOLOGY PRODUKSI-----------------------------------------------*/

//*-----------------------------------------NORMAL SELECTION TEKNOLOGI PRODUKSI---------------------------------------------*/

public function fetch_chart_tp_normal($id_proyek, $pemilik_doc)
{
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $data = Tekprod::select("id_tekprod", "id_proyek", "status_tekprod")
        ->where('pemilik_tekprod', $pemilik_doc) 
        ->where('jenis_tekprod', 'Doc');

    if (empty($id_proyek)) {
        $data->whereIn('id_proyek', $proyek_dengan_status_open);
    } else {
        $data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
    }

    return $data;
}

//*-----------------------------------------BOBOT SELECTION TEKNOLOGI PRODUKSI---------------------------------------------*/

public function fetch_chart_tp_bobot($id_proyek, $pemilik_doc)
{
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $data = Tekprod::select("status_tekprod", "size_tekprod", "lembar_tekprod", "tipe_tekprod", "bobot_rev_tekprod", "bobot_design_tekprod", "id_tekprod", "id_proyek")
    ->where('pemilik_tekprod', $pemilik_doc) 
    ->where('jenis_tekprod', 'Doc');

    if (empty($id_proyek)) {
        $data->whereIn('id_proyek', $proyek_dengan_status_open);
    } else {
        $data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
    }

    return $data;
}

//*--------------------------------------------TP - TECHNOLOGY PROCESS-----------------------------------------------*/

public function fetch_data_tps(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $pemilik_doc = 'Teknologi Proses';

    $chart_data = $this->fetch_chart_tp_normal($id_proyek, $pemilik_doc);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status_tekprod;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_tps_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $pemilik_doc = 'Teknologi Proses';

    $chart_data = $this->fetch_chart_tp_bobot($id_proyek, $pemilik_doc);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status_tekprod;
        $size = $row->size_tekprod;
        $lembar = $row->lembar_tekprod;
        $bobot_rev = $row->bobot_rev_tekprod;
        $bobot_design = $row->bobot_design_tekprod;
        $tipe = $row->tipe_tekprod;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}

//*--------------------------------------------TP - PREPARATION & SUPPORT-----------------------------------------------*/

public function fetch_data_prs(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $pemilik_doc = 'Preparation Support';

    $chart_data = $this->fetch_chart_tp_normal($id_proyek, $pemilik_doc);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status_tekprod;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_prs_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $pemilik_doc = 'Preparation Support';

    $chart_data = $this->fetch_chart_tp_bobot($id_proyek, $pemilik_doc);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status_tekprod;
        $size = $row->size_tekprod;
        $lembar = $row->lembar_tekprod;
        $bobot_rev = $row->bobot_rev_tekprod;
        $bobot_design = $row->bobot_design_tekprod;
        $tipe = $row->tipe_tekprod;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}

//*--------------------------------------------TP - SHOP DRAWING-----------------------------------------------*/

public function fetch_data_sdr(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $pemilik_doc = 'Shop Drawing';

    $chart_data = $this->fetch_chart_tp_normal($id_proyek, $pemilik_doc);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status_tekprod;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_sdr_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $pemilik_doc = 'Shop Drawing';

    $chart_data = $this->fetch_chart_tp_bobot($id_proyek, $pemilik_doc);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status_tekprod;
        $size = $row->size_tekprod;
        $lembar = $row->lembar_tekprod;
        $bobot_rev = $row->bobot_rev_tekprod;
        $bobot_design = $row->bobot_design_tekprod;
        $tipe = $row->tipe_tekprod;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}


//*--------------------------------------------TP - WELDING TECHNOLOGY-----------------------------------------------*/

public function fetch_data_wlt(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $pemilik_doc = 'Welding Technology';

    $chart_data = $this->fetch_chart_tp_normal($id_proyek, $pemilik_doc);

    $chart_data = $chart_data->get();

    $statusData = [];

    foreach ($chart_data as $row) {
        $status = $row->status_tekprod;
        if (isset($statusData[$status])) {
            $statusData[$status]++;
        } else {
            $statusData[$status] = 1;
        }
    }

    $output = [];
    foreach ($statusData as $status => $jumlah) {
        $output[] = [
            'status' => $status,
            'jumlah' => $jumlah
        ];
    }
    return response()->json($output);
}


public function fetch_data_wlt_bobot(Request $request)
{
    $id_proyek = $request->input('id_proyek');
    $pemilik_doc = 'Welding Technology';

    $chart_data = $this->fetch_chart_tp_bobot($id_proyek, $pemilik_doc);

    $chart_data = $chart_data->get();
    
    $statusData = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    $totalStatus = [
        'Open' => 0,
        'Release' => 0,
        'Proses Revisi' => 0,
    ];

    foreach ($chart_data as $row) {
        $status = $row->status_tekprod;
        $size = $row->size_tekprod;
        $lembar = $row->lembar_tekprod;
        $bobot_rev = $row->bobot_rev_tekprod;
        $bobot_design = $row->bobot_design_tekprod;
        $tipe = $row->tipe_tekprod;

        $jumlah = $size * $lembar * $tipe * ($bobot_rev/3) * ($bobot_design/3);

        $totalStatus[$status] += $jumlah;
    }

    $totalJumlah = array_sum($totalStatus);

    $output = [];
    foreach ($totalStatus as $status => $total) {
        if ($totalJumlah != 0) {
            $prosentase = ($total / $totalJumlah) * 100;
        } else {
            $prosentase = 0;
        }
        $output[] = [
            'status' => $status,
            'prosentase' => $prosentase,
        ];
    }

    return response()->json($output);
}



}
