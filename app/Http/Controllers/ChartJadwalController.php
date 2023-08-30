<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Design;
use App\Models\DesignDetail;
use App\Models\Proyek;
use App\Models\KepalaGambar;
use App\Models\Jabatan;
use Carbon\Carbon;

class ChartJadwalController extends Controller
{
    public function index()
    {
        $proyek = Proyek::where('status', 'Open')->pluck('nama_proyek', 'id_proyek');
    
        $design = Design::whereIn('id_proyek', $proyek->keys())->get();
    
        return view('charts.chartsJadwal', compact('design', 'proyek'));
    }

    public function chartMes()
    {
        $proyek = Proyek::where('status', 'Open')->pluck('nama_proyek', 'id_proyek');
    
        $design = Design::whereIn('id_proyek', $proyek->keys())
            ->whereIn('id_kepala_gambar', function ($query) {
                $query->select('kepala_gambar.id_kepala_gambar')
                    ->from('kepala_gambar')
                    ->join('jabatan', 'kepala_gambar.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->where('jabatan.kode_unit', '311.MES');
            })
            ->get();
    
        return view('charts.chartsMes', compact('design', 'proyek'));
    }

    public function chartEes()
    {
        $proyek = Proyek::where('status', 'Open')->pluck('nama_proyek', 'id_proyek');
    
        $design = Design::whereIn('id_proyek', $proyek->keys())
            ->whereIn('id_kepala_gambar', function ($query) {
                $query->select('kepala_gambar.id_kepala_gambar')
                    ->from('kepala_gambar')
                    ->join('jabatan', 'kepala_gambar.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->where('jabatan.kode_unit', '311.EES');
            })
            ->get();
    
        return view('charts.chartsEes', compact('design', 'proyek'));
    }

    public function chartQen()
    {
        $proyek = Proyek::where('status', 'Open')->pluck('nama_proyek', 'id_proyek');
    
        $design = Design::whereIn('id_proyek', $proyek->keys())
            ->whereIn('id_kepala_gambar', function ($query) {
                $query->select('kepala_gambar.id_kepala_gambar')
                    ->from('kepala_gambar')
                    ->join('jabatan', 'kepala_gambar.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->where('jabatan.kode_unit', '311.QEN');
            })
            ->get();
    
        return view('charts.chartsEes', compact('design', 'proyek'));
    }

    public function chartPre()
    {
        $proyek = Proyek::where('status', 'Open')->pluck('nama_proyek', 'id_proyek');
    
        $design = Design::whereIn('id_proyek', $proyek->keys())
            ->whereIn('id_kepala_gambar', function ($query) {
                $query->select('kepala_gambar.id_kepala_gambar')
                    ->from('kepala_gambar')
                    ->join('jabatan', 'kepala_gambar.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->where('jabatan.kode_unit', '311.PEN');
            })
            ->get();
    
        return view('charts.chartsEes', compact('design', 'proyek'));
    }

    public function chartCbd()
    {
        $proyek = Proyek::where('status', 'Open')->pluck('nama_proyek', 'id_proyek');
    
        $design = Design::whereIn('id_proyek', $proyek->keys())
            ->whereIn('id_kepala_gambar', function ($query) {
                $query->select('kepala_gambar.id_kepala_gambar')
                    ->from('kepala_gambar')
                    ->join('jabatan', 'kepala_gambar.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->where('jabatan.kode_unit', '312.CED');
            })
            ->get();
    
        return view('charts.chartsEes', compact('design', 'proyek'));
    }

    public function chartBwd()
    {
        $proyek = Proyek::where('status', 'Open')->pluck('nama_proyek', 'id_proyek');
    
        $design = Design::whereIn('id_proyek', $proyek->keys())
            ->whereIn('id_kepala_gambar', function ($query) {
                $query->select('kepala_gambar.id_kepala_gambar')
                    ->from('kepala_gambar')
                    ->join('jabatan', 'kepala_gambar.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->where('jabatan.kode_unit', '312.BWD');
            })
            ->get();
    
        return view('charts.chartsEes', compact('design', 'proyek'));
    }

    public function chartEld()
    {
        $proyek = Proyek::where('status', 'Open')->pluck('nama_proyek', 'id_proyek');
    
        $design = Design::whereIn('id_proyek', $proyek->keys())
            ->whereIn('id_kepala_gambar', function ($query) {
                $query->select('kepala_gambar.id_kepala_gambar')
                    ->from('kepala_gambar')
                    ->join('jabatan', 'kepala_gambar.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->where('jabatan.kode_unit', '312.EDE');
            })
            ->get();
    
        return view('charts.chartsEes', compact('design', 'proyek'));
    }

    public function chartMid()
    {
        $proyek = Proyek::where('status', 'Open')->pluck('nama_proyek', 'id_proyek');
    
        $design = Design::whereIn('id_proyek', $proyek->keys())
            ->whereIn('id_kepala_gambar', function ($query) {
                $query->select('kepala_gambar.id_kepala_gambar')
                    ->from('kepala_gambar')
                    ->join('jabatan', 'kepala_gambar.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->where('jabatan.kode_unit', '312.MID');
            })
            ->get();
    
        return view('charts.chartsEes', compact('design', 'proyek'));
    }

}
