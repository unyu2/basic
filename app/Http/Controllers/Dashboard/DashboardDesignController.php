<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;

use App\Models\Design;
use App\Models\DesignDetail;

class DashboardDesignController extends Controller
{

    public function index()
    {
        $userId = auth()->user()->id;

        $job_closed = Design::where('status', 'Release')
        ->where('id_draft', $userId)
        ->where('id_check', $userId)
        ->where('id_approve', $userId)
        ->count();

        $job_open = Design::where('status', 'Open')
        ->where('id_draft', $userId)
        ->where('id_check', $userId)
        ->where('id_approve', $userId)
        ->count();

        $job_revisi = Design::where('status', 'Proses Revisi')
        ->where('id_draft', $userId)
        ->where('id_check', $userId)
        ->where('id_approve', $userId)
        ->count();

        $all_open = $job_open + $job_revisi;
        $open [] += $all_open;

        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');
        $range_bulan = [$tanggal_awal, $tanggal_akhir];

        $hari_ini = date('y-m-d');
        $bulan_awal = date('Y-01-d');
        $bulan_akhir = date('Y-m-d');
        $range_bulan = [$bulan_awal, $bulan_akhir];

        $data_tanggal = array();
        $data_barang = array();

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);

        $temuan_closeds= Temuan::where ('status','Closed')->where('id_proyek','123')->where('created_at', 'LIKE', "%$tanggal_awal%")->count();
        $temuan_opens= Temuan::where ('status','Open')->where('id_proyek','123')->where('created_at', 'LIKE', "%$tanggal_awal%")->count();

        $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }

    $tanggal_awal = date('Y-m-01');

    if (auth()->user()->level == 1) {
        return view('admin.dashboard', compact(  
            'tanggal_awal', 
            'tanggal_akhir', 
            'range',
            'ranges',
            'data_tanggal',
            'data_barang',
            'barang_po',
            'barang_pr',
            'barang_request',
            'barang_diterima',));
            }

   if (auth()->user()->level == 2 || auth()->user()->level == 9 || auth()->user()->level == 11) {
       return view('pengguna.dashboard_design');
   }
   

    }

}
