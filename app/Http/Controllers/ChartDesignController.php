<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Design;
use App\Models\DesignDetail;
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

    $chart_data = Design::select("id_design", "id_proyek", "status", "created_at")->where('jenis', 'Doc');

    if (empty($id_proyek)) {
        $chart_data->whereIn('id_proyek', $proyek_dengan_status_open);
    } else {
        $chart_data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
    }

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

//*--------------------------------------OVERALL TECHNOLOGY BOBOT----------------------------------------------/*

public function fetch_data_overall_bobot(Request $request)
{
    $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

    $id_proyek = $request->input('id_proyek');

    $chart_data = Design::select("status", "size", "lembar", "bobot_rev", "id_design", "id_proyek")->where('jenis', 'Doc');

    if (empty($id_proyek)) {
        $chart_data->whereIn('id_proyek', $proyek_dengan_status_open);
    } else {
        $chart_data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
    }

    $chart_data = $chart_data->get();
    
    // Inisialisasi counter
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

        $jumlah = $size * $lembar * $bobot_rev;

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

    // Mengembalikan data dalam format JSON
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
    $chart_data = Design::select("status", "size", "lembar", "bobot_rev", "id_design", "id_proyek", "pemilik")->where('jenis', 'Doc');

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

        // Menghitung jumlah (size * lembar * bobot_rev)
        $jumlah = $size * $lembar * $bobot_rev;

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
    $chart_data = Design::select("status", "size", "lembar", "bobot_rev", "id_design", "id_proyek", "pemilik")->where('jenis', 'Doc');

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

        // Menghitung jumlah (size * lembar * bobot_rev)
        $jumlah = $size * $lembar * $bobot_rev;

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

        $data = Design::select("status", "size", "lembar", "bobot_rev", "id_design", "id_proyek", "pemilik")
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
    
            // Menghitung jumlah (size * lembar * bobot_rev)
            $jumlah = $size * $lembar * $bobot_rev;
    
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

        $jumlah = $size * $lembar * $bobot_rev;

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

        $jumlah = $size * $lembar * $bobot_rev;

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

        $jumlah = $size * $lembar * $bobot_rev;

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

        $jumlah = $size * $lembar * $bobot_rev;

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

        $jumlah = $size * $lembar * $bobot_rev;

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

        $jumlah = $size * $lembar * $bobot_rev;

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

        $jumlah = $size * $lembar * $bobot_rev;

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

















//*------------------------------------------------------------------------------------/*

public function fetch_chart_data_CurvaS($id_proyek)
{
    $data = Design::select("id_design", "id_proyek", "status", "created_at")
    ->orderBy('created_at', 'ASC')
    ->where('id_proyek', $id_proyek)
    ->get();

    return $data;
}


public function fetch_data_curvaS(Request $request)
{
    if ($request->input('id_proyek')) {
        $id_proyek = $request->input('id_proyek');

        // Ambil data dari model, sesuaikan dengan kolom yang diperlukan
        $chart_data = Design::select("status", "tanggal_prediksi", "prediksi_hari", "created_at")
            ->orderBy('created_at', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        // Inisialisasi array untuk menyimpan data kurva S
        $output = [];
        $totalCountRelease = 0;
        $totalCountRevisi = 0;

        foreach ($chart_data as $row) {
            // Mengecek status dan menghitung total
            if ($row->status == 'Release') {
                $totalCountRelease++;
            } elseif ($row->status == 'Proses Revisi') {
                $totalCountRevisi++;
            }

            // Menghitung total berdasarkan prediksi hari (tanggal_prediksi + prediksi_hari)
            $prediksi_hari = $row->prediksi_hari;  
            $tanggal_prediksi = \Carbon\Carbon::parse($row->tanggal_prediksi); // Mengubah ke format Carbon untuk manipulasi tanggal
            $totalCountPrediksi = $tanggal_prediksi->addDays($prediksi_hari)->diffInDays(\Carbon\Carbon::now());  // Menghitung selisih hari antara tanggal_prediksi + prediksi_hari dengan hari ini

            // Menambahkan data ke array untuk kurva S
            $output[] = [
                'created_at' => $row->created_at,
                'totalCountRelease' => $totalCountRelease,
                'totalCountRevisi' => $totalCountRevisi,
                'totalCountPrediksi' => $totalCountPrediksi
            ];
        }

        return response()->json($output);
    }
}





}
