<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

//*------------------------------------------------------------------------------------/*

    public function fetch_chart_data($id_proyek)
    {
        $data = Design::select("id_design", "id_proyek", "status", "created_at")
            ->orderBy('id_proyek', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        return $data;
    }

// Fungsi untuk mengambil data status desain dan menghitung jumlahnya
public function fetch_data_status(Request $request)
{
    if ($request->input('id_proyek')) {
        // Mengambil data design berdasarkan proyek
        $chart_data = $this->fetch_chart_data($request->input('id_proyek'));

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
}

//*------------------------------------------------------------------------------------/*

public function fetch_chart_data_bobot($id_proyek)
{
    $data = Design::select("id_design", "id_proyek", "status", "lembar", "size", "bobot_rev", "created_at")
        ->orderBy('id_proyek', 'ASC')
        ->where('id_proyek', $id_proyek)
        ->get();

    return $data;
}

public function fetch_data_status_bobot(Request $request)
{
    if ($request->has('id_proyek')) {
        $id_proyek = $request->input('id_proyek');

        // Ambil data dari model, gantilah dengan model dan kolom yang sesuai
        $chart_data = Design::select("status", "size", "lembar", "bobot_rev")
            ->where('id_proyek', $id_proyek)
            ->get();

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
    } else {
        // Jika id_proyek tidak ada dalam request, kembalikan respon kosong
        return response()->json([]);
    }
}

//*------------------------------------------------------------------------------------/*

public function fetch_chart_gantt($id_proyek)
{
    $data = Design::select("id_design", "nama_design", "refrensi_design", "id_proyek", "kode_design", "tanggal_prediksi", "prediksi_hari", "status", "created_at")
        ->orderBy('id_proyek', 'ASC')
        ->where('id_proyek', $id_proyek)
        ->get();

    return $data;
}

public function fetch_data_gantt(Request $request)
{
    if ($request->input('id_proyek')) {
        // Mengambil data design berdasarkan proyek
        $chart_data = $this->fetch_chart_gantt($request->input('id_proyek'));

        // Inisialisasi array untuk menyimpan data Gantt Chart
        $ganttData = [];

        // Mengisi data Gantt Chart
        foreach ($chart_data as $row) {
            $nama_design = $row->nama_design;
            $kode_design = $row->kode_design;
            $refrensi_design = $row->refrensi_design;
            $tanggal_prediksi = Carbon::parse($row->tanggal_prediksi)->format('Y-m-d');
            $prediksi_hari = $row->prediksi_hari;
        
            // Menghitung tanggal prediksi akhir dengan menambahkan prediksi_hari ke tanggal_prediksi
            $tanggal_prediksi_akhir = Carbon::parse($tanggal_prediksi)->addDays($prediksi_hari)->format('Y-m-d');
        
            $status = $row->status;

            // Inisialisasi variabel $prosentase
            $prosentase = 0;

            // Mengubah nilai $prosentase sesuai dengan kolom "status"
            if ($status === 'Release') {
                $prosentase = 100; // Bila Release, prosentase 100%
            } elseif ($status === 'Proses Revisi') {
                $prosentase = 50; // Bila Proses Revisi, prosentase 50%
            } else {
                // Bila status tidak sesuai dengan Open, Release, atau Proses Revisi, maka tetap 0%
                $prosentase = 0;
            }

            $ganttData[] = [
                'task' => $nama_design,
                'code' => $kode_design,
                'startDate' => $tanggal_prediksi,
                'endDate' => $tanggal_prediksi_akhir,
                'duration' => $prediksi_hari,
                'prosentase' => $prosentase,
                'refrensi' => $refrensi_design,
            ];
        }


        // Mengembalikan data Gantt Chart dalam format JSON
        return response()->json($ganttData);
    }
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
