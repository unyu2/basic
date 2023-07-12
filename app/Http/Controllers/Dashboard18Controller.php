<?php

namespace App\Http\Controllers;

use App\Models\Emu;
use App\Models\Temuan;
use Illuminate\Http\Request;

class Dashboard18Controller extends Controller
{
    public function index()
    {
        
        $temuan_closed= Temuan::where ('status','Closed')->where('id_proyek','123')->where('id_car','29')->count();
        $temuan_open= Temuan::where ('status','Open Bo')->where('id_proyek','123')->where('id_car','29')->count();
        $temuan_all= Temuan::where('id_proyek','123')->where('id_car','29')->count();
        $temuan_control= Temuan::where ('status','Open Bo')->where('id_proyek','123')->where('id_car','29')->sum('operasi');

        $temuan_closed_medium= Temuan::where ('status','Closed')->where('id_proyek','123')->where('id_car','29')->where('level','Medium')->count();
        $temuan_open_medium= Temuan::where ('status','Open Bo')->where('id_proyek','123')->where('id_car','29')->where('level','Medium')->count();
        $temuan_closed_high= Temuan::where ('status','Closed')->where('id_proyek','123')->where('id_car','29')->where('level','High')->count();
        $temuan_open_high= Temuan::where ('status','Open Bo')->where('id_proyek','123')->where('id_car','29')->where('level','High')->count();
        
        if ($temuan_closed && $temuan_all != 0)
        $temuan3 = ($temuan_closed + $temuan_closed_medium + ($temuan_closed_high * 2))  / ($temuan_all + $temuan_open_medium + $temuan_closed_medium + (($temuan_closed_high + $temuan_open_high) * 2)) * 100;
        else
        $temuan3 = 0;

        if ($temuan_closed && $temuan_all != 0)
        $temuan5 = (($temuan_closed / $temuan_all) * 100) + ($temuan_open_high *102);
        else
        $temuan5 = 0;

        if ($temuan5 > 101 ) {
            $temuan4 = "TSO";
        } elseif($temuan5 >1 && $temuan5 != 100){
           $temuan4 = "SO";
        }
        
        $tang_1 = date('Y-01');
        $tang_2 = date('Y-m');
        $tang = [$tang_1, $tang_2];
        
        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');
        $range = [$tanggal_awal, $tanggal_akhir];
        $ranges = date('y-m-d');
        $data_tanggal = array();
        $temuans = array();
        $temuans2 = array();

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);


$temuan_closeds= Temuan::where ('status','Closed')->where('id_proyek','123')->where('id_car','29')->where('created_at', 'LIKE', "%$tanggal_awal%")->count();
$temuan_opens= Temuan::where ('status','Open Bo')->where('id_proyek','123')->where('id_car','29')->where('created_at', 'LIKE', "%$tanggal_awal%")->count();

$temuan = $temuan_opens + $temuan_closeds;
$temuans [] += $temuan;

$temuan2 = $temuan_closeds;
$temuans2 [] += $temuan2;


$tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }

        $tanggal_awal = date('Y-m-01');

        if (auth()->user()->level == 1) {
            return view('admin.dashboard18', compact(
            'temuans',
            'temuans2',
            'temuan3',
            'temuan4',
            'temuan_all',
            'temuan_opens',
            'temuan_open',
            'temuan_open_high',  
            'temuan_closed', 
            'temuan_closeds',   
            'tanggal_awal', 
            'tanggal_akhir', 
            'range',
            'ranges',
            'data_tanggal'));
        } 
        
    }
}
