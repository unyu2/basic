<?php

namespace App\Http\Controllers;

use App\Models\Emu;
use App\Models\Temuan;
use App\Models\PermintaanDetail;
use App\Models\PemesananDetail;
use Illuminate\Http\Request;

class DashboardOilController extends Controller
{

    public function index()
    {
        $barang_pr = PermintaanDetail::where ('id_proyek','123')->where('status2','PR')->count();
        $barang_po = PermintaanDetail::where ('id_proyek','123')->where('status3','PO')->count();
        $barang_request = PermintaanDetail::where ('id_proyek','123')->where('status','Request')->count();
        $barang_diterima = PermintaanDetail::where ('id_proyek','123')->where('status','Diterima')->count();
        
        $temuan_all= Temuan::where('id_proyek','123')->count();
        $temuan_closed= Temuan::where ('status','Closed')->where('id_proyek','123')->count();
        $temuan_open= Temuan::where ('status','Open')->where('id_proyek','123')->count();
        $temuan_closed_medium= Temuan::where ('status','Closed')->where('id_proyek','123')->where('level','Medium')->count();
        $temuan_open_medium= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','Medium')->count();
        $temuan_closed_high= Temuan::where ('status','Closed')->where('id_proyek','123')->where('level','High')->count();
        $temuan_open_high= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->count();
        $temuan_convert_c1= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','13')->count();
        $temuan_convert_c2= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','14')->count();
        $temuan_convert_c3= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','15')->count();
        $temuan_convert_c4= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','16')->count();
        $temuan_convert_c5= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','17')->count();
        $temuan_convert_c6= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','18')->count();
        $temuan_convert_c7= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','19')->count();
        $temuan_convert_c8= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','20')->count();
        $temuan_convert_c9= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','21')->count();
        $temuan_convert_c10= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','22')->count();
        $temuan_convert_c11= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','23')->count();
        $temuan_convert_c12= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','24')->count();
        $temuan_convert_c13= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','25')->count();
        $temuan_convert_c14= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','26')->count();
        $temuan_convert_c15= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','27')->count();
        $temuan_convert_c16= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','28')->count();
        $temuan_convert_c17= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','29')->count();
        $temuan_convert_c18= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','30')->count();
        $temuan_convert_c19= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','31')->count();
        $temuan_convert_c20= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','32')->count();
        $temuan_convert_c21= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','33')->count();
        $temuan_convert_c22= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','34')->count();
        $temuan_convert_c23= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','35')->count();
        $temuan_convert_c24= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','36')->count();
        $temuan_convert_c25= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','37')->count();
        $temuan_convert_c26= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','38')->count();
        $temuan_convert_c27= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','39')->count();
        $temuan_convert_c28= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','40')->count();
        $temuan_convert_c29= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','41')->count();
        $temuan_convert_c30= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','42')->count();
        $temuan_convert_c31= Temuan::where ('status','Open')->where('id_proyek','123')->where('level','High')->where('id_car','43')->count();
        


        if ($temuan_closed && $temuan_all != 0)
        $temuan3 = ($temuan_closed + $temuan_closed_medium + ($temuan_closed_high * 2))  / ($temuan_all + $temuan_open_medium + $temuan_closed_medium + (($temuan_closed_high + $temuan_open_high) * 2)) * 100;
        else
        $temuan3 = 0;


        if ($temuan_convert_c1 <1 ) {
            $temuanc1 = "badge bg-green";
        } elseif($temuan_convert_c1 >=1 ){
            $temuanc1 = "badge bg-red";
        } 

        if ($temuan_convert_c2 <1 ) {
            $temuanc2 = "badge bg-green";
        } elseif($temuan_convert_c2 >=1 ){
            $temuanc2 = "badge bg-red";
        } 

        if ($temuan_convert_c3 <1 ) {
            $temuanc3 = "badge bg-green";
        } elseif($temuan_convert_c4 >=1 ){
            $temuanc3 = "badge bg-red";
        } 

        if ($temuan_convert_c4 <1 ) {
            $temuanc4 = "badge bg-green";
        } elseif($temuan_convert_c4 >=1 ){
            $temuanc4 = "badge bg-red";
        } 

        if ($temuan_convert_c5 <1 ) {
            $temuanc5 = "badge bg-green";
        } elseif($temuan_convert_c5 >=1 ){
            $temuanc5 = "badge bg-red";
        } 

        if ($temuan_convert_c6 <1 ) {
            $temuanc6 = "badge bg-green";
        } elseif($temuan_convert_c6 >=1 ){
            $temuanc6 = "badge bg-red";
        } 

        if ($temuan_convert_c7 <1 ) {
            $temuanc7 = "badge bg-green";
        } elseif($temuan_convert_c7 >=1 ){
            $temuanc7 = "badge bg-red";
        } 

        if ($temuan_convert_c8 <1 ) {
            $temuanc8 = "badge bg-green";
        } elseif($temuan_convert_c8 >=1 ){
            $temuanc8 = "badge bg-red";
        }

        if ($temuan_convert_c9 <1 ) {
            $temuanc9 = "badge bg-green";
        } elseif($temuan_convert_c9 >=1 ){
            $temuanc9 = "badge bg-red";
        }
        
        if ($temuan_convert_c10 <1 ) {
            $temuanc10 = "badge bg-green";
        } elseif($temuan_convert_c10 >=1 ){
            $temuanc10 = "badge bg-red";
        }

        if ($temuan_convert_c11 <1 ) {
            $temuanc11 = "badge bg-green";
        } elseif($temuan_convert_c11 >=1 ){
            $temuanc11 = "badge bg-red";
        }

        if ($temuan_convert_c12 <1 ) {
            $temuanc12 = "badge bg-green";
        } elseif($temuan_convert_c12 >=1 ){
            $temuanc12 = "badge bg-red";
        }

        if ($temuan_convert_c13 <1 ) {
            $temuanc13 = "badge bg-green";
        } elseif($temuan_convert_c13 >=1 ){
            $temuanc13 = "badge bg-red";
        }

        if ($temuan_convert_c14 <1 ) {
            $temuanc14 = "badge bg-green";
        } elseif($temuan_convert_c14 >=1 ){
            $temuanc14 = "badge bg-red";
        }

        if ($temuan_convert_c15 <1 ) {
            $temuanc15 = "badge bg-green";
        } elseif($temuan_convert_c15 >=1 ){
            $temuanc15 = "badge bg-red";
        }
        
        if ($temuan_convert_c16 <1 ) {
            $temuanc16 = "badge bg-green";
        } elseif($temuan_convert_c16 >=1 ){
            $temuanc16 = "badge bg-red";
        }

        if ($temuan_convert_c17 <1 ) {
            $temuanc17 = "badge bg-green";
        } elseif($temuan_convert_c17 >=1 ){
            $temuanc17 = "badge bg-red";
        }

        if ($temuan_convert_c18 <1 ) {
            $temuanc18 = "badge bg-green";
        } elseif($temuan_convert_c18 >=1 ){
            $temuanc18 = "badge bg-red";
        }

        if ($temuan_convert_c19 <1 ) {
            $temuanc19 = "badge bg-green";
        } elseif($temuan_convert_c19 >=1 ){
            $temuanc19 = "badge bg-red";
        }

        if ($temuan_convert_c20 <1 ) {
            $temuanc20 = "badge bg-green";
        } elseif($temuan_convert_c20 >=1 ){
            $temuanc20 = "badge bg-red";
        }

        if ($temuan_convert_c21 <1 ) {
            $temuanc21 = "badge bg-green";
        } elseif($temuan_convert_c21 >=1 ){
            $temuanc21 = "badge bg-red";
        }

        if ($temuan_convert_c22 <1 ) {
            $temuanc22 = "badge bg-green";
        } elseif($temuan_convert_c22 >=1 ){
            $temuanc22 = "badge bg-red";
        }

        if ($temuan_convert_c23 <1 ) {
            $temuanc23 = "badge bg-green";
        } elseif($temuan_convert_c23 >=1 ){
            $temuanc23 = "badge bg-red";
        }

        if ($temuan_convert_c24 <1 ) {
            $temuanc24 = "badge bg-green";
        } elseif($temuan_convert_c24 >=1 ){
            $temuanc24 = "badge bg-red";
        }

        if ($temuan_convert_c25 <1 ) {
            $temuanc25 = "badge bg-green";
        } elseif($temuan_convert_c25 >=1 ){
            $temuanc25 = "badge bg-red";
        }

        if ($temuan_convert_c26 <1 ) {
            $temuanc26 = "badge bg-green";
        } elseif($temuan_convert_c26 >=1 ){
            $temuanc26 = "badge bg-red";
        }

        if ($temuan_convert_c27 <1 ) {
            $temuanc27 = "badge bg-green";
        } elseif($temuan_convert_c27 >=1 ){
            $temuanc27 = "badge bg-red";
        }

        if ($temuan_convert_c28 <1 ) {
            $temuanc28 = "badge bg-green";
        } elseif($temuan_convert_c28 >=1 ){
            $temuanc28 = "badge bg-red";
        }

        if ($temuan_convert_c29 <1 ) {
            $temuanc29 = "badge bg-green";
        } elseif($temuan_convert_c29 >=1 ){
            $temuanc29 = "badge bg-red";
        }

        if ($temuan_convert_c30 <1 ) {
            $temuanc30 = "badge bg-green";
        } elseif($temuan_convert_c30 >=1 ){
            $temuanc30 = "badge bg-red";
        }

        if ($temuan_convert_c31 <1 ) {
            $temuanc31 = "badge bg-green";
        } elseif($temuan_convert_c31 >=1 ){
            $temuanc31 = "badge bg-red";
        }

        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');
        $range = [$tanggal_awal, $tanggal_akhir];
        $ranges = date('y-m-d');

        $data_tanggal = array();
        $data_barang = array();
        $temuans = array();
        $temuans2 = array();
        $temuans3 = array();

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);

    $temuan_closeds= Temuan::where ('status','Closed')->where('id_proyek','123')->where('created_at', 'LIKE', "%$tanggal_awal%")->count();
    $temuan_opens= Temuan::where ('status','Open')->where('id_proyek','123')->where('created_at', 'LIKE', "%$tanggal_awal%")->count();

    $temuan = $temuan_opens + $temuan_closeds;
    $temuans [] += $temuan;

    $temuan2 = $temuan_closeds;
    $temuans2 [] += $temuan2;


    $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }

    $tanggal_awal = date('Y-m-01');

    if (auth()->user()->level == 1) {
            return view('admin.dashboard_oil', compact(
            'temuans',
            'temuans2',
            'temuan3',
            'temuanc1',
            'temuanc2',
            'temuanc3',
            'temuanc4',
            'temuanc5',
            'temuanc6',
            'temuanc7',
            'temuanc8',
            'temuanc9',
            'temuanc10',
            'temuanc11',
            'temuanc12',
            'temuanc13',
            'temuanc14',
            'temuanc15',
            'temuanc16',
            'temuanc17',
            'temuanc18',
            'temuanc19',
            'temuanc20',
            'temuanc21',
            'temuanc22',
            'temuanc23',
            'temuanc24',
            'temuanc25',
            'temuanc26',
            'temuanc27',
            'temuanc28',
            'temuanc29',
            'temuanc30',
            'temuanc31',            
            'temuan_all',
            'temuan_open',
            'temuan_closed',
            'temuan_open_medium',
            'temuan_closed_medium',   
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
    }

}
