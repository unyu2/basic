<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Design;
use App\Models\DesignDetail;
use App\Models\Proyek;
use Carbon\Carbon;

class ChartJadwalController extends Controller
{
    public function index()
    {
        $proyek = Proyek::where('status', 'Open')->pluck('nama_proyek', 'id_proyek');
    
        $design = Design::whereIn('id_proyek', $proyek->keys())->get();
    
        return view('charts.chartsJadwal', compact('design', 'proyek'));
    }

}
