<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Design;
use App\Models\DesignDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $user = User::pluck('name');
        $userId = auth()->user()->id;


        $statusCounts = Design::whereIn('status', ['Release', 'Open', 'Proses Revisi'])
        ->where(function ($query) use ($userId) {
            $query->where('id_draft', $userId)
                ->orWhere('id_check', $userId)
                ->orWhere('id_approve', $userId);
        })
        ->selectRaw('status, count(*) as count')
        ->groupBy('status')
        ->get();

        $job_closed = $statusCounts->firstWhere('status', 'Release')->count ?? 0;
        $job_open = $statusCounts->firstWhere('status', 'Open')->count ?? 0;
        $job_revisi = $statusCounts->firstWhere('status', 'Proses Revisi')->count ?? 0;

        $all_open = $job_open + $job_revisi;
        $open [] = $all_open;


        $statusCountsJam = Design::whereIn('status', ['Release', 'Open', 'Proses Revisi'])
        ->where(function ($query) use ($userId) {
            $query->where('id_draft', $userId)
                ->orWhere('id_check', $userId)
                ->orWhere('id_approve', $userId);
        })
        ->selectRaw('status, sum(size * lembar) as total')
        ->groupBy('status')
        ->get();

        $job_closed_jam = $statusCountsJam->firstWhere('status', 'Release')->total ?? 0;
        $job_open_jam = $statusCountsJam->firstWhere('status', 'Open')->total ?? 0;
        $job_revisi_jam = $statusCountsJam->firstWhere('status', 'Proses Revisi')->total ?? 0;

        $all_open_jam = $job_open_jam + $job_revisi_jam;
        $open_jam [] = $all_open_jam;

        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');
        $range_bulan = [$tanggal_awal, $tanggal_akhir];

        $hari_ini = date('y-m-d');
        $bulan_awal = date('Y-01-d');
        $bulan_akhir = date('Y-m-d');
        $range_tahun = [$bulan_awal, $bulan_akhir];

        $data_tanggal = array();
        $data_release = array();
        $data_release_jam = array();
        $data_open = array();
        $data_open_jam = array();
        $data_target = array();

        $accumulated_closed = array();
        $accumulated_open = array();
        $accumulated_target = array();

        $jumlah_hari_kerja = 0;
        $current_date = $tanggal_awal;
        while (strtotime($current_date) <= strtotime($tanggal_akhir)) {
            $dayOfWeek = date('N', strtotime($current_date));
            if ($dayOfWeek < 6) { // Jika bukan Sabtu (6) atau Minggu (7)
                $jumlah_hari_kerja++;
            }
            $current_date = date('Y-m-d', strtotime("+1 day", strtotime($current_date)));
        }

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);
        
            $dayOfWeek = date('N', strtotime($tanggal_awal));
            
            // Periksa apakah hari ini adalah hari kerja atau akhir pekan
            if ($dayOfWeek >= 6) {
                // Jika hari Sabtu (6) atau Minggu (7), tambahkan 0 ke semua data
                $target = 0;
                $release_jam = 0;
            } else {
                // Jika hari kerja (Senin-Jumat), lakukan perhitungan seperti biasa
                $target = 8;
           

            // Berdasarkan jam
            $design_release_jam = Design::where('status', 'Release')
            ->where(function ($query) use ($userId) {
                $query->where('id_draft', $userId)
                    ->orWhere('id_check', $userId)
                    ->orWhere('id_approve', $userId);
            })
            ->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->sum(DB::raw('lembar * size'));

            $design_open_jam = Design::where('status', 'Open')
            ->where(function ($query) use ($userId) {
                $query->where('id_draft', $userId)
                    ->orWhere('id_check', $userId)
                    ->orWhere('id_approve', $userId);
            })
            ->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->sum(DB::raw('lembar * size'));

            $design_revisi_jam = Design::where('status', 'Proses Revisi')
            ->where(function ($query) use ($userId) {
                $query->where('id_draft', $userId)
                    ->orWhere('id_check', $userId)
                    ->orWhere('id_approve', $userId);
            })
            ->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->sum(DB::raw('lembar * size'));

            $release_jam = ($jumlah_hari_kerja > 0) ? ($design_release_jam / $jumlah_hari_kerja) : 0;

        }

            $open_jam = $design_open_jam + $design_revisi_jam;
            $data_open_jam [] += $open_jam;
        
            $data_release_jam[] = $release_jam;

            $targets = $target;
            $data_target[] = $targets;

            $accumulated_closed += $data_release;
            $accumulated_open += $data_open;
            $accumulated_target += $data_target;
        
            $data_closed_curva[] = $accumulated_closed;
            $data_open_curva[] = $accumulated_open;
            $data_target_curva[] = $accumulated_target;

 //Normal OUtput
            $design_release = Design::where('status', 'Release')
                ->where(function ($query) use ($userId) {
                    $query->where('id_draft', $userId)
                        ->orWhere('id_check', $userId)
                        ->orWhere('id_approve', $userId);
                })
                ->where('created_at', 'LIKE', "%$tanggal_awal%")
                ->count();
            
            $design_open = Design::where('status', 'Open')
                ->where(function ($query) use ($userId) {
                    $query->where('id_draft', $userId)
                        ->orWhere('id_check', $userId)
                        ->orWhere('id_approve', $userId);
                })
                ->where('created_at', 'LIKE', "%$tanggal_awal%")
                ->count();
            
            $design_revisi = Design::where('status', 'Proses Revisi')
                ->where(function ($query) use ($userId) {
                    $query->where('id_draft', $userId)
                        ->orWhere('id_check', $userId)
                        ->orWhere('id_approve', $userId);
                })
                ->where('created_at', 'LIKE', "%$tanggal_awal%")
                ->count();

            $open = $design_open + $design_revisi;
            $data_open [] += $open;
        
            $release = $design_release;
            $data_release [] += $release;

            $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }
        

        $tanggal_awal = date('Y-m-01');

        if (auth()->user()->level == 2 || auth()->user()->level == 1 || auth()->user()->level == 9 || auth()->user()->level == 11) {
            return view('admin.dashboard', compact( 
                'data_target', 
                'data_open',
                'data_open_jam',
                'data_release',
                'data_release_jam',
                'data_closed_curva',
                'data_open_curva',
                'data_target_curva',
                'open',
                'all_open',
                'all_open_jam',
                'job_closed',
                'job_closed_jam',
                'job_open',
                'tanggal_awal', 
                'tanggal_akhir', 
                'data_tanggal',
                'user',));
        }

  //      if (auth()->user()->level == 1) {
 //           return view('admin.dashboard');
 //       }
    }
}
