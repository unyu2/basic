<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Design;
use App\Models\DesignDetail;
use App\Models\Proyek;
use Carbon\Carbon;

class ChartCurvaController extends Controller
{

    public function index()
    {
        $proyek = Proyek::all()->pluck('nama_proyek', 'id_proyek');

        $fetch_id_proyek = Design::select("id_proyek")
            ->groupBy('id_proyek')
            ->orderBy('id_proyek', 'DESC')
            ->get();
        return view('charts.chartsCurva', compact('fetch_id_proyek', 'proyek'));
    }

//*------------------------------------------------------------------------------------/*

    public function fetch_data_curvaS_sample(Request $request)
    {
        $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();

        $id_proyek = $request->input('id_proyek');

        $chart_data = Design::select("rev_for_curva", "prediksi_akhir", "tanggal_prediksi", "prediksi_hari", "created_at")
            ->orderBy('prediksi_akhir', 'ASC');

        if (!empty($id_proyek)) {
            $chart_data->where('id_proyek', $id_proyek);
        } else {
            $chart_data->whereIn('id_proyek', $proyek_dengan_status_open);
        }

        $chart_data = $chart_data->get();

        $output = [];
        $totalCountTarget = 0;

        foreach ($chart_data as $row) {
            if ($row->rev_for_curva == 'Rev.0') {
                $totalCountTarget++;
            }

            $output[] = [
                'prediksi_akhir' => $row->prediksi_akhir,
                'totalCountTarget' => $totalCountTarget,
            ];
        }

        return response()->json($output);
    }


    public function fetch_data_curvaS_sample_dua(Request $request)
    {
        $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();
    
        $id_proyek = $request->input('id_proyek');
    
        // Ambil data dari model, sesuaikan dengan kolom yang diperlukan
        $chart_data_release = Design::select("duplicate_status", "time_release_rev0", "rev_for_curva", "prediksi_akhir")
            ->orderBy('time_release_rev0', 'ASC')
            ->where('duplicate_status', 'Release');
    
        // Filter data jika $id_proyek tidak kosong
        if (!empty($id_proyek)) {
            $chart_data_release->where('id_proyek', $id_proyek);
        } else {
            $chart_data_release->whereIn('id_proyek', $proyek_dengan_status_open);
        }
    
        $chart_data_release = $chart_data_release->get();
    
        // Inisialisasi array untuk menyimpan data kurva S
        $output = [];
        $totalCountRelease = 0;
    
        foreach ($chart_data_release as $row) {
            // Mengecek status dan menghitung total
            if ($row->rev_for_curva == 'Rev.0') {
                $totalCountRelease++;
            }
    
            // Menambahkan data ke array untuk kurva S
            $output[] = [
                'time_release_rev0' => $row->time_release_rev0,
                'totalCountRelease' => $totalCountRelease,
            ];
        }
    
        return response()->json($output);
    }
    

    public function fetch_data_combined(Request $request)
    {

        $proyek_dengan_status_open = Proyek::where('status', 'Open')->pluck('id_proyek')->toArray();
        $id_proyek = $request->input('id_proyek');

        $chart_data = Design::select("rev_for_curva", "prediksi_akhir", "tanggal_prediksi", "prediksi_hari", "created_at")
            ->orderBy('prediksi_akhir', 'ASC');

            if (!empty($id_proyek)) {
                $chart_data->whereIn('id_proyek', $proyek_dengan_status_open);
            } else {
                $chart_data->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
            }

        $chart_data = $chart_data->get();

        $chart_data_release = Design::select("duplicate_status", "time_release_rev0", "rev_for_curva", "prediksi_akhir")
            ->orderBy('time_release_rev0', 'ASC')
            ->where('duplicate_status', 'Release');

            if (!empty($id_proyek)) {
                $chart_data_release->whereIn('id_proyek', $proyek_dengan_status_open);
            } else {
                $chart_data_release->where('id_proyek', $id_proyek)->whereIn('id_proyek', $proyek_dengan_status_open);
            }

        $chart_data_release = $chart_data_release->get();

        $outputTarget = [];
        $outputRealisasi = [];
        $totalCountTarget = 0;
        $totalCountRelease = 0;

        foreach ($chart_data as $row) {
            if ($row->rev_for_curva == 'Rev.0') {
                $totalCountTarget++;
            }
            $outputTarget[] = [
                'prediksi_akhir' => $row->prediksi_akhir,
                'totalCountTarget' => $totalCountTarget,
            ];
        }

        foreach ($chart_data_release as $row) {
            if ($row->rev_for_curva == 'Rev.0') {
                $totalCountRelease++;
            }
            $outputRealisasi[] = [
                'time_release_rev0' => $row->time_release_rev0,
                'totalCountRelease' => $totalCountRelease,
            ];
        }
        $combinedOutput = [
            'target' => $outputTarget,
            'realisasi' => $outputRealisasi,
        ];
        return response()->json($combinedOutput);
    }

    /*

    public function fetch_data_combined(Request $request)
    {
        if ($request->input('id_proyek')) {
            $id_proyek = $request->input('id_proyek');

            // Ambil data dari model untuk kurva S Target
            $chart_data = Design::select("rev_for_curva", "prediksi_akhir", "tanggal_prediksi", "prediksi_hari", "created_at")
                ->orderBy('prediksi_akhir', 'ASC')
                ->where('id_proyek', $id_proyek)
                ->get();

            // Ambil data dari model untuk kurva S Realisasi
            $chart_data_release = Design::select("duplicate_status", "time_release_rev0", "rev_for_curva", "prediksi_akhir")
                ->orderBy('time_release_rev0', 'ASC')
                ->where('duplicate_status', 'Release')
                ->where('id_proyek', $id_proyek)
                ->get();

            // Inisialisasi array untuk menyimpan data kurva S Target dan Realisasi
            $outputTarget = [];
            $outputRealisasi = [];
            $totalCountTarget = 0;
            $totalCountRelease = 0;

            foreach ($chart_data as $row) {
                // Mengecek status dan menghitung total untuk Target
                if ($row->rev_for_curva == 'Rev.0') {
                    $totalCountTarget++;
                }
                // Menambahkan data ke array untuk kurva S Target
                $outputTarget[] = [
                    'prediksi_akhir' => $row->prediksi_akhir,
                    'totalCountTarget' => $totalCountTarget,
                ];
            }

            foreach ($chart_data_release as $row) {
                // Mengecek status dan menghitung total untuk Realisasi
                if ($row->rev_for_curva == 'Rev.0') {
                    $totalCountRelease++;
                }
                // Menambahkan data ke array untuk kurva S Realisasi
                $outputRealisasi[] = [
                    'time_release_rev0' => $row->time_release_rev0,
                    'totalCountRelease' => $totalCountRelease,
                ];
            }
            // Gabungkan kedua array ke dalam satu array asosiatif
            $combinedOutput = [
                'target' => $outputTarget,
                'realisasi' => $outputRealisasi,
            ];

            return response()->json($combinedOutput);
        }
    }
*/


}
