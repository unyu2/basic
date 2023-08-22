<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temuan;
use App\Models\Proyek;
use App\Models\Car;
use App\Models\PermintaanDetail;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        $proyek = Proyek::all()->pluck('nama_proyek', 'id_proyek');
        $car = Car::all()->pluck('nama_car', 'id_car');

        $fetch_id_proyek = Temuan::select("id_proyek")
            ->groupBy('id_proyek')
            ->orderBy('id_proyek', 'DESC')
            ->get();
            
        return view('charts.charts', compact('fetch_id_proyek', 'proyek', 'car'));
    }

    
    public function fetch_data_jumlah(Request $request)
    {
        if ($request->input('id_proyek')) {
            $chart_data = $this->fetch_chart_level($request->input('id_proyek'));
            $output = [];
    
            foreach ($chart_data as $row) {
                $level = $row->level;
                $jumlah = 1; // Mengubah nilai $jumlah menjadi 1
    
                $output[] = [
                    'level' => $level,
                    'jumlah' => $jumlah
                ];
            }
    
            return response()->json($output);
        }
    }
    
    public function fetch_chart_level($id_proyek)
    {
        $data = Temuan::select("id_temuan", "id_proyek", "jumlah", "level", "created_at")
            ->orderBy('id_proyek', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        return $data;
    }


    public function fetch_data_car(Request $request)
    {
        if ($request->input('id_proyek')) {
            $chart_data = $this->fetch_chart_car($request->input('id_proyek'));
            $output = [];
    
            foreach ($chart_data as $row) {
                $car = $row->car;
                $jumlah = 1; // Mengubah nilai $jumlah menjadi 1
    
                $output[] = [
                    'car' => $car,
                    'jumlah' => $jumlah
                ];
            }
    
            return response()->json($output);
        }
    }
    public function fetch_chart_car($id_proyek)
    {
        $data = Temuan::select("id_temuan", "id_proyek", "jumlah", "car", "created_at")
            ->orderBy('id_proyek', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        return $data;
    }


    public function fetch_data_produk(Request $request)
    {
        if ($request->input('id_proyek')) {
            $chart_data = $this->fetch_chart_produk($request->input('id_proyek'));
            $output = [];
    
            foreach ($chart_data as $row) {
                $produk = $row->nama_produks;
                $jumlah = 1; // Mengubah nilai $jumlah menjadi 1
    
                $output[] = [
                    'nama_produks' => $produk,
                    'jumlah' => $jumlah
                ];
            }
    
            return response()->json($output);
        }
    }
    public function fetch_chart_produk($id_proyek)
    {
        $data = Temuan::select("id_temuan", "id_proyek", "jumlah", "nama_produks", "created_at")
            ->orderBy('id_proyek', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        return $data;
    }

    public function fetch_data_detail(Request $request)
    {
        if ($request->input('id_proyek')) {
            $chart_data = $this->fetch_chart_detail($request->input('id_proyek'));
            $output = [];
    
            foreach ($chart_data as $row) {
                $produk = $row->nama_produks;
                $jumlah = 1; // Mengubah nilai $jumlah menjadi 1
    
                $output[] = [
                    'nama_produks' => $produk,
                    'jumlah' => $jumlah
                ];
            }
    
            return response()->json($output);
        }
    }

    public function fetch_chart_detail($id_proyek)
    {
        $data = Temuan::select("id_temuan", "id_proyek", "jumlah", "nama_produks", "created_at")
            ->orderBy('id_proyek', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        return $data;
    }

    public function fetch_data_bagian(Request $request)
    {
        if ($request->input('id_proyek')) {
            $chart_data = $this->fetch_chart_bagian($request->input('id_proyek'));

            $bagianData = [];
            foreach ($chart_data as $row) {
                $bagian = $row->bagian;
                if (isset($bagianData[$bagian])) {
                    $bagianData[$bagian]++;
                } else {
                    $bagianData[$bagian] = 1;
                }
            }

            $output = [];
            foreach ($bagianData as $bagian => $jumlah) {
                $output[] = [
                    'bagian' => $bagian,
                    'jumlah' => $jumlah
                ];
            }

            return response()->json($output);
        }
    }

    public function fetch_chart_bagian($id_proyek)
    {
        $data = Temuan::select("id_temuan", "id_proyek", "jumlah", "bagian", "created_at")
            ->orderBy('id_proyek', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        return $data;
    }


    
    

    public function fetch_data_status(Request $request)
    {
        if ($request->input('id_proyek')) {
            $chart_data = $this->fetch_chart_data($request->input('id_proyek'));

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
    }

    public function fetch_data_tanggal_status(Request $request)
    {
        if ($request->input('id_proyek')) {
            $chart_data = $this->fetch_chart_data($request->input('id_proyek'));

            $output = [];
            $openCount = 0;
            $closedCount = 0;

            foreach ($chart_data as $row) {
                if ($row->status == 'Open') {
                    $openCount += $row->jumlah;
                } elseif ($row->status == 'Closed') {
                    $closedCount += $row->jumlah;
                }

                $output[] = [
                    'status' => 'Open',
                    'created_at' => $row->created_at,
                    'jumlah' => $openCount
                ];

                $output[] = [
                    'status' => 'Closed',
                    'created_at' => $row->created_at,
                    'jumlah' => $closedCount
                ];
            }

            return response()->json($output);
        }
    }


    public function fetch_chart_data_tahun($id_proyek)
    {
        $data = Temuan::select("id_temuan", "id_proyek", "jumlah", "status", "created_at")
            ->orderBy('created_at', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();
    
        return $data;
    }
    
    public function fetch_data_curvas_tahun(Request $request)
    {
        if ($request->input('id_proyek')) {
            $chart_data = $this->fetch_chart_data_tahun($request->input('id_proyek'));
    
            $output = [];
            $totalCountOpenBo = 0;
            $totalCountClosed = 0;
            $totalTemuan = 0;
    
            foreach ($chart_data as $row) {
                if ($row->status == 'Open') {
                    $totalCountOpenBo = $row->jumlah;
                    $totalCountClosed = 0; // Reset the closed count
                } elseif ($row->status == 'Closed') {
                    $totalCountClosed = $row->jumlah;
                    $totalCountOpenBo = 0; // Reset the open count
                }
            
                // Tambahkan jumlah temuan ke totalTemuan
                $totalTemuan = $totalCountOpenBo + $totalCountClosed;
            
                // Ubah nilai negatif menjadi nol
                $totalCountClosedNonNegative = max($totalCountClosed, 0);
                $totalTemuanNonNegative = max($totalTemuan, 0);
            
                // Tambahkan data ke dalam output
                $output[] = [
                    'created_at' => $row->created_at,
                    'totalCount' => $totalTemuanNonNegative,
                    'closedCount' => $totalCountClosedNonNegative,
                    'totalTemuan' => $totalTemuanNonNegative
                ];
            }
    
            return response()->json($output);
        }
    }
    
    
    public function fetch_data_curvas_minggu(Request $request)
    {
        if ($request->input('id_proyek')) {
            $chart_data = $this->fetch_chart_data_minggu($request->input('id_proyek'));
    
            $output = [];
            $totalCountOpenBo = 0;
            $totalCountClosed = 0;
    
            foreach ($chart_data as $row) {
                if ($row->status == 'Open') {
                    $totalCountOpenBo += $row->jumlah;
                } elseif ($row->status == 'Closed') {
                    $totalCountClosed += $row->jumlah;
                }
    
                $output[] = [
                    'created_at' => $row->created_at,
                    'totalCount' => $totalCountOpenBo + $totalCountClosed,
                    'closedCount' => $totalCountClosed
                ];
            }
    
            return response()->json($output);
        }
    }
 
    public function fetch_chart_data($id_proyek)
    {
        $data = Temuan::select("id_temuan", "id_proyek", "jumlah", "status", "created_at")
            ->orderBy('id_proyek', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        return $data;
    }


    public function fetch_chart_data_minggu($id_proyek)
    {
        $data = Temuan::select("id_temuan", "id_proyek", "jumlah", "status", "created_at")
            ->orderBy('created_at', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        return $data;
    }

}