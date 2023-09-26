<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Design;
use App\Models\DesignDetail;

use App\Models\Emu;
use App\Models\Temuan;
use App\Models\PermintaanDetail;
use App\Models\PemesananDetail;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::pluck('name');
        $userId = auth()->user()->id;

//---------------------------------------------------Status Normal Output Dokumen-------------------------------------//

        $statusCounts = Design::whereIn('design.status', ['Release', 'Open', 'Proses Revisi'])
            ->where(function ($query) use ($userId) {
                $query->where('id_draft', $userId)
                    ->orWhere('id_check', $userId)
                    ->orWhere('id_approve', $userId);
            })
            ->where('jenis', 'Doc')
            ->selectRaw('design.status, count(*) as count')
            ->groupBy('design.status')
            ->join('proyek', 'design.id_proyek', '=', 'proyek.id_proyek')
            ->where('proyek.status', 'Open')
            ->get();

        $job_closed = $statusCounts->firstWhere('status', 'Release')->count ?? 0;
        $job_open = $statusCounts->firstWhere('status', 'Open')->count ?? 0;
        $job_revisi = $statusCounts->firstWhere('status', 'Proses Revisi')->count ?? 0;

        $all_open = $job_open + $job_revisi;
        $open [] = $all_open;

//---------------------------------------------------Status Normal Berdasarkan Jam-------------------------------------//



//---------------------------------------------------Status Berdasarkan Jam---------------------------------------------//

        $statusCountsJamDraft = Design::whereIn('design.status', ['Release', 'Open', 'Proses Revisi'])
            ->where(function ($query) use ($userId) {
                $query->where('id_draft', $userId);
            })
            ->where('jenis','Doc')
            ->selectRaw('design.status, sum(size * lembar * tipe * (bobot_rev / 3) * (bobot_design / 3) * 1) as total') // 3 ini apa ya??
            ->groupBy('design.status')
            ->join('proyek', 'design.id_proyek', '=', 'proyek.id_proyek')
            ->where('proyek.status', 'Open')
            ->get();

        $statusCountsJamCheck = Design::whereIn('design.status', ['Release', 'Open', 'Proses Revisi'])
            ->where(function ($query) use ($userId) {
                $query->where('id_check', $userId);
            })
            ->selectRaw('design.status, sum(size * lembar * (bobot_rev / 3) * (bobot_design / 3) * tipe * 0.5) as total')
            ->groupBy('design.status')
            ->join('proyek', 'design.id_proyek', '=', 'proyek.id_proyek')
            ->where('proyek.status', 'Open')
            ->get();

        $statusCountsJamApprove = Design::whereIn('design.status', ['Release', 'Open', 'Proses Revisi'])
            ->where(function ($query) use ($userId) {
                $query->where('id_approve', $userId);
            })
            ->selectRaw('design.status, sum(size * lembar * tipe * (bobot_rev / 3) * (bobot_design / 3) * 0.25) as total')
            ->groupBy('design.status')
            ->join('proyek', 'design.id_proyek', '=', 'proyek.id_proyek')
            ->where('proyek.status', 'Open')
            ->get();

        $job_closed_jam_draft = $statusCountsJamDraft->firstWhere('status', 'Release')->total ?? 0;
        $job_open_jam_draft = $statusCountsJamDraft->firstWhere('status', 'Open')->total ?? 0;
        $job_revisi_jam_draft = $statusCountsJamDraft->firstWhere('status', 'Proses Revisi')->total ?? 0;

        $job_closed_jam_check = $statusCountsJamCheck->firstWhere('status', 'Release')->total ?? 0;
        $job_open_jam_check = $statusCountsJamCheck->firstWhere('status', 'Open')->total ?? 0;
        $job_revisi_jam_check = $statusCountsJamCheck->firstWhere('status', 'Proses Revisi')->total ?? 0;

        $job_closed_jam_approve = $statusCountsJamApprove->firstWhere('status', 'Release')->total ?? 0;
        $job_open_jam_approve = $statusCountsJamApprove->firstWhere('status', 'Open')->total ?? 0;
        $job_revisi_jam_approve = $statusCountsJamApprove->firstWhere('status', 'Proses Revisi')->total ?? 0;

        $all_open_jam [] = $job_open_jam_draft + $job_open_jam_check + $job_open_jam_approve;
        $all_closed_jam [] = $job_closed_jam_draft + $job_closed_jam_check + $job_closed_jam_approve;
        $all_revisi_jam [] = ($job_revisi_jam_draft * 0.25) + ($job_revisi_jam_check * 0.25) + ($job_revisi_jam_approve * 0.25);


//---------------------------------------------------------Data Array------------------------------------------------------//

        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');
        $range_bulan = [$tanggal_awal, $tanggal_akhir];

        $hari_ini = date('y-m-d');
        $bulan_awal = date('Y-01-d');
        $bulan_akhir = date('Y-m-d');
        $range_tahun = [$bulan_awal, $bulan_akhir];

        $data_tanggal = array();
        $data_release = array();
        $data_open = array();
        $data_open_jam = array();

        $jumlah_hari_kerja = 0;
        $current_date = $tanggal_awal;
        while (strtotime($current_date) <= strtotime($tanggal_akhir)) {
            $dayOfWeek = date('N', strtotime($current_date));
            if ($dayOfWeek < 6) {
                $jumlah_hari_kerja++;
            }
            $current_date = date('Y-m-d', strtotime("+1 day", strtotime($current_date)));
        }

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);
        
            $dayOfWeek = date('N', strtotime($tanggal_awal));
            
            if ($dayOfWeek >= 6) {
                $target = 0;
                $release_jam = 0;
                $release_jam_detail = 0;
                $release_jam_overall = 0;
            } else {
                $target = 8;
           
//-------------------------------------------------New Kurva Output Berdasarkan Jam-------------------------------------------//

            $design_release_jam_draft = Design::where('status', 'Release')->where('id_draft', $userId)->where('jenis', 'Dinas')
            ->whereBetween('created_at', [$range_bulan])->sum(DB::raw('lembar * size', 0));

            $design_release_jam_draft_detail = DesignDetail::where('id_draft', $userId)->where('status', 'Release')
            ->whereBetween('created_at', [$range_bulan])->sum(DB::raw('lembar * size * tipe * (bobot_rev / 3) * (bobot_design / 3) * 1' , 0));

            $design_release_jam_check_detail = DesignDetail::where('id_check', $userId)->where('status', 'Release')
            ->whereBetween('created_at', [$range_bulan])->sum(DB::raw('lembar * size * tipe * (bobot_rev / 3) * (bobot_design / 3) * 0.5', 0));

            $design_release_jam_approve_detail = DesignDetail::where('id_approve', $userId)->where('status', 'Release')
            ->whereBetween('created_at', [$range_bulan])->sum(DB::raw('lembar * size * tipe * (bobot_rev / 3) * (bobot_design / 3) * 0.25', 0));

            $release_jam = ($jumlah_hari_kerja > 0) ? ($design_release_jam_draft / $jumlah_hari_kerja)  : 0;
            $release_jam_detail = ($jumlah_hari_kerja > 0) ? ($design_release_jam_draft_detail + $design_release_jam_check_detail + $design_release_jam_approve_detail) / ($jumlah_hari_kerja) : 0;

            }

            $data_release_jam[] = $release_jam;
            $data_release_jam_detail[] = $release_jam_detail;
            $data_release_jam_overall[] = $release_jam + $release_jam_detail;

            $targets = $target;
            $data_target[] = $targets;

//---------------------------------------------------Kurva Normal Output---------------------------------------------//

            $design_release = DesignDetail::where('status', 'Release')
                ->where(function ($query) use ($userId) {
                    $query->where('id_draft', $userId)
                        ->orWhere('id_check', $userId)
                        ->orWhere('id_approve', $userId);
                })
                ->where('jenis', 'Doc')
                ->where('created_at', 'LIKE', "%$tanggal_awal%")
                ->count();
            
            $design_open = Design::where('status', 'Open')
                ->where(function ($query) use ($userId) {
                    $query->where('id_draft', $userId)
                        ->orWhere('id_check', $userId)
                        ->orWhere('id_approve', $userId);
                })
                ->where('jenis', 'Doc')
                ->where('prediksi_akhir', 'LIKE', "%$tanggal_awal%")
                ->count();
            
            $design_revisi = DesignDetail::where('status', 'Proses Revisi')
                ->where(function ($query) use ($userId) {
                    $query->where('id_draft', $userId)
                        ->orWhere('id_check', $userId)
                        ->orWhere('id_approve', $userId);
                })
                ->where('jenis', 'Doc')
                ->where('created_at', 'LIKE', "%$tanggal_awal%")
                ->count();

            $open = $design_open + $design_revisi;
            $data_open [] += $open;
        
            $release = $design_release;
            $data_release [] += $release;

            $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }
        

        $tanggal_awal = date('Y-m-01');

        if (auth()->user()->level == 2 || auth()->user()->level == 3 || auth()->user()->level == 1 || auth()->user()->level == 9 || auth()->user()->level == 10 || auth()->user()->level == 13 || auth()->user()->level == 14) {
            return view('admin.dashboard', compact( 
                'data_target', 
                'data_open',
                'data_open_jam',
                'release_jam',
                'data_release',
                'data_release_jam',
                'data_release_jam_detail',
                'data_release_jam_overall',
                'open',
                'all_open',
                'job_closed',
                'job_open',
                'job_revisi',
                'tanggal_awal', 
                'tanggal_akhir', 
                'data_tanggal',
                'all_open_jam',
                'all_closed_jam',
                'all_revisi_jam',
                'user',));
        }

        if (auth()->user()->level == 6 ||  auth()->user()->level == 7 || auth()->user()->level == 3|| auth()->user()->level == 2 || auth()->user()->level == 1  || auth()->user()->level == 11 || auth()->user()->level == 12) {
            return view('tamu.dashboard');
        }
    }
}
