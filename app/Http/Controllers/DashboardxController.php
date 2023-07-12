<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temuan;
use App\Models\Proyek;
use App\Models\PermintaanDetail;
use Carbon\Carbon;

class DashboardxController extends Controller
{
    public function index(Request $request)
    {
        $proyek = Proyek::all()->pluck('nama_proyek', 'id_proyek');
    
        $fetch_id_proyek = Temuan::select("id_proyek")
            ->groupBy('id_proyek')
            ->orderBy('id_proyek', 'DESC')
            ->get();
        $fetch_id_proyek_2 = PermintaanDetail::select("id_proyek")
            ->groupBy('id_proyek')
            ->orderBy('id_proyek', 'DESC')
            ->get();
    
        $id_proyek = $request->input('id_proyek');
    
        $query_pr = PermintaanDetail::query();
        $query_request = PermintaanDetail::query();
        $query_diterima = PermintaanDetail::query();
    
        if ($id_proyek) {
            $query_pr->where('id_proyek', $id_proyek);
            $query_request->where('id_proyek', $id_proyek);
            $query_diterima->where('id_proyek', $id_proyek);
        }
    
        $barang_pr = $query_pr->where('status2', 'PR')->count();
        $barang_request = $query_request->where('status', 'Request')->count();
        $barang_diterima = $query_diterima->where('status', 'Diterima')->count();
    
        return view('admin.dashboardx', compact('fetch_id_proyek', 'proyek', 'fetch_id_proyek_2', 'barang_pr', 'barang_request', 'barang_diterima'));
    }
    
    

    public function fetch_data_jumlah(Request $request)
    {
        if ($request->input('id_proyek')) {
            $chart_data = $this->fetch_chart_data($request->input('id_proyek'));

            $output = [];

            foreach ($chart_data as $row) {
                $output[] = [
                    'status' => $row->status,
                    'jumlah' => floatval($row->jumlah)
                ];
            }

            return response()->json($output);
        }
    }

    public function fetch_data_warna(Request $request)
    {
        $id_proyek = $request->input('id_proyek');
    
        $query = PermintaanDetail::query();
    
        if ($id_proyek) {
            $query->where('id_proyek', $id_proyek);
        }
    
        $barang_pr = $query->where('status2', 'PR')->count();
        $barang_request = PermintaanDetail::query()->where('status', 'Request');
        $barang_diterima = PermintaanDetail::query()->where('status', 'Diterima');
    
        if ($id_proyek) {
            $barang_request->where('id_proyek', $id_proyek);
            $barang_diterima->where('id_proyek', $id_proyek);
        }
    
        $barang_request = $barang_request->count();
        $barang_diterima = $barang_diterima->count();
    
        return view('nama_view', compact('barang_pr', 'barang_request', 'barang_diterima'));
    }

    public function fetch_chart_data_warna($id_proyek)
    {
        $data = Temuan::select(
            "temuan_all",
            "temuan_closed",
            "temuan_open",
            "temuan_closed_medium",
            "temuan_open_medium",
            "temuan_closed_high",
            "temuan_convert_c1",
            "temuan_convert_c2",
            )
            ->orderBy('id_proyek', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        return $data;
    }
 
    public function fetch_chart_data($id_proyek)
    {
        $data = Temuan::select("id_temuan", "id_proyek", "jumlah", "status", "created_at")
            ->orderBy('id_proyek', 'ASC')
            ->where('id_proyek', $id_proyek)
            ->get();

        return $data;
    }

}

