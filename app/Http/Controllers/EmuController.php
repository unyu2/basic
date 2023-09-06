<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Emu;
use App\Models\EmuDetail;
use App\Models\Produk;
use App\Models\Proyek;
use App\Models\Car;
use App\Models\Dmu;
use App\Models\User;
use App\Models\Subpengujian;

class EmuController extends Controller
{
    public function index()
    {

  $emuss = Dmu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
  ->select('dmu.*', 'nama_subpengujian', 'nama_dmu')
  ->get();

  $emus = Emu::leftJoin('dmu', 'dmu.id_dmu', 'emu.id_dmu')
  ->select('emu.*', 'nama_dmu')
  ->get();

  $x1 = Proyek::all()->pluck('nama_proyek','id_proyek');
  $x2 = Produk::all()->pluck('komat','id_produk');
  $x3 = Car::all()->pluck('nama_car','id_car');

  $r1= Dmu::where('id_subpengujian','4')->get();
  $r2= Dmu::where('id_subpengujian','5')->get();
  $r3= Dmu::where('id_subpengujian','6')->get();
  $r4= Dmu::where('id_subpengujian','7')->get();
  $r5= Dmu::where('id_subpengujian','8')->get();
  $r6= Dmu::where('id_subpengujian','9')->get();
  $r7= Dmu::where('id_subpengujian','10')->get();

        return view('emu.index', compact('emuss','x1','x2','emus', 'x3', 'r1','r2','r3','r4','r5','r6','r7'));
    }



    
    public function data()
    {
        $emus = Emu::leftJoin('dmu', 'dmu.id_dmu', 'emu.id_dmu')
        ->select('emu.*', 'nama_dmu')
        ->get();
        $emuss = Dmu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
        ->select('dmu.*', 'nama_subpengujian')
        ->get();
        $emusss = Dmu::leftJoin('proyek', 'proyek.id_proyek', 'dmu.id_proyek')
        ->select('dmu.*', 'nama_proyek')
        ->get();

        $subpengujian = Subpengujian::orderBy('id_subpengujian', 'desc')->get();
        $subpengujians = Subpengujian::all()->pluck('nama_subpengujian', 'id_dmu');

        $emu = Emu::orderBy('id_emu', 'desc')->get();
        $dmu = Dmu::orderBy('id_dmu')->get();

        return datatables()
            ->of($emu)
            ->addIndexColumn()
            ->addColumn('total_item', function ($emu) {
                return format_uang($emu->total_item);
            })
            ->addColumn('total_harga', function ($emu) {
                return 'Rp. '. format_uang($emu->total_harga);
            })
            ->addColumn('bayar', function ($emu) {
                return 'Rp. '. format_uang($emu->bayar);
            })
            ->addColumn('id_proyek', function ($emusss) {
                $dmu = $emusss->proyek->nama_proyek ?? '';
                return $dmu;
            })
            ->addColumn('nama_dmu', function ($emus) {
                $dmu = $emus->dmu->nama_dmu ?? '';
                return $dmu;
            })
            ->addColumn('id_dmu', function ($emus) {
                $dmu = $emus->dmu->nama_subpengujian ?? '';
                return $dmu;
            })
            ->addColumn('id_subpengujian', function ($emuss) {
                $dmu = $emuss->subpengujian->nama_subpengujian ?? '';
                return $dmu;
            })
            ->addColumn('tanggal', function ($emu) {
                return tanggal_indonesia($emu->created_at, false);
            })
            ->editColumn('diskon', function ($emu) {
                return $emu->diskon . '%';
            })
            ->addColumn('aksi', function ($emu) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('emu.show', $emu->id_emu) .'`)" class="btn btn-info btn-xs btn-flat"><i class="fa fa-barcode"></i> Lihat Komponen Rusak</button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show($id)
    {
        $detail = EmuDetail::with('produk')->where('id_emu', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">'. $detail->produk->kode_produk .'</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_beli', function ($detail) {
                return 'Rp. '. format_uang($detail->harga_beli);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. '. format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }

    public function destroy($id)
    {
        $emu = Emu::find($id);
        $detail    = EmuDetail::where('id_emu', $emu->id_emu)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok -= $item->jumlah;
                $produk->update();
            }
            $item->delete();
        }

        $emu->delete();

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $dataemu = array();
        foreach ($request->id_emu as $id) {
            $emu = Emu::find($id);
            $dataemu[] = $emu;
        }

        $no  = 1;
        $pdf = PDF::loadView('emu.barcode', compact('dataemu', 'no'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('emu.pdf');
    }

    public function create($id)
    {
        $emu = new Emu();
        $emu->id_dmu = $id;
        $emu->id_subpengujian = Null;
        $emu->id_proyek = Null;
        $emu->total_item  = 0;
        $emu->total_harga = 0;
        $emu->nama_proyeks = 0;
        $emu->diskon      = 0;
        $emu->status = 0;
        $emu->keterangan  = 0;
        $emu->bayar = 0;
        $emu->id_users = Null;
        $emu->id_user = auth()->id();
        $emu->kode_emu = 0;
        $emu->Approved = 0;
        $emu->lanjut = 0;
        $emu->id_car = Null;
        $emu->form = 0;
        
        $emu->t_operasi = 0;

        $emu->nama_dmu1=0;
        $emu->nama_dmu2=0;
        $emu->nama_dmu3=0;
        $emu->nama_dmu4=0;
        $emu->nama_dmu5=0;
        $emu->nama_dmu6=0;
        $emu->nama_dmu7=0;
        $emu->nama_dmu8=0;
        $emu->nama_dmu9=0;
        $emu->nama_dmu10=0;
        $emu->nama_dmu11=0;
        $emu->nama_dmu12=0;
        $emu->nama_dmu13=0;
        $emu->nama_dmu14=0;

        $emu->M1_1=0;
        $emu->M2_1=0;
        $emu->Mc1_1=0;
        $emu->Mc2_1=0;
        $emu->T1_1=0;
        $emu->T2_1=0;
        $emu->T3_1=0;
        $emu->T4_1=0;
        $emu->Tc1_1=0;
        $emu->Tc2_1=0;
        $emu->Tc3_1=0;
        $emu->Tc4_1=0;
        
        $emu->M1_2=0;
        $emu->M2_2=0;
        $emu->Mc1_2=0;
        $emu->Mc2_2=0;
        $emu->T1_2=0;
        $emu->T2_2=0;
        $emu->T3_2=0;
        $emu->T4_2=0;
        $emu->Tc1_2=0;
        $emu->Tc2_2=0;
        $emu->Tc3_2=0;
        $emu->Tc4_2=0;
        
        $emu->M1_3=0;
        $emu->M2_3=0;
        $emu->Mc1_3=0;
        $emu->Mc2_3=0;
        $emu->T1_3=0;
        $emu->T2_3=0;
        $emu->T3_3=0;
        $emu->T4_3=0;
        $emu->Tc1_3=0;
        $emu->Tc2_3=0;
        $emu->Tc3_3=0;
        $emu->Tc4_3=0;
        
        $emu->M1_4=0;
        $emu->M2_4=0;
        $emu->Mc1_4=0;
        $emu->Mc2_4=0;
        $emu->T1_4=0;
        $emu->T2_4=0;
        $emu->T3_4=0;
        $emu->T4_4=0;
        $emu->Tc1_4=0;
        $emu->Tc2_4=0;
        $emu->Tc3_4=0;
        $emu->Tc4_4=0;
        
        $emu->M1_5=0;
        $emu->M2_5=0;
        $emu->Mc1_5=0;
        $emu->Mc2_5=0;
        $emu->T1_5=0;
        $emu->T2_5=0;
        $emu->T3_5=0;
        $emu->T4_5=0;
        $emu->Tc1_5=0;
        $emu->Tc2_5=0;
        $emu->Tc3_5=0;
        $emu->Tc4_5=0;
        
        $emu->M1_6=0;
        $emu->M2_6=0;
        $emu->Mc1_6=0;
        $emu->Mc2_6=0;
        $emu->T1_6=0;
        $emu->T2_6=0;
        $emu->T3_6=0;
        $emu->T4_6=0;
        $emu->Tc1_6=0;
        $emu->Tc2_6=0;
        $emu->Tc3_6=0;
        $emu->Tc4_6=0;
        
        $emu->M1_7=0;
        $emu->M2_7=0;
        $emu->Mc1_7=0;
        $emu->Mc2_7=0;
        $emu->T1_7=0;
        $emu->T2_7=0;
        $emu->T3_7=0;
        $emu->T4_7=0;
        $emu->Tc1_7=0;
        $emu->Tc2_7=0;
        $emu->Tc3_7=0;
        $emu->Tc4_7=0;
        
        $emu->M1_8=0;
        $emu->M2_8=0;
        $emu->Mc1_8=0;
        $emu->Mc2_8=0;
        $emu->T1_8=0;
        $emu->T2_8=0;
        $emu->T3_8=0;
        $emu->T4_8=0;
        $emu->Tc1_8=0;
        $emu->Tc2_8=0;
        $emu->Tc3_8=0;
        $emu->Tc4_8=0;
        
        $emu->M1_9=0;
        $emu->M2_9=0;
        $emu->Mc1_9=0;
        $emu->Mc2_9=0;
        $emu->T1_9=0;
        $emu->T2_9=0;
        $emu->T3_9=0;
        $emu->T4_9=0;
        $emu->Tc1_9=0;
        $emu->Tc2_9=0;
        $emu->Tc3_9=0;
        $emu->Tc4_9=0;
        
        $emu->M1_10=0;
        $emu->M2_10=0;
        $emu->Mc1_10=0;
        $emu->Mc2_10=0;
        $emu->T1_10=0;
        $emu->T2_10=0;
        $emu->T3_10=0;
        $emu->T4_10=0;
        $emu->Tc1_10=0;
        $emu->Tc2_10=0;
        $emu->Tc3_10=0;
        $emu->Tc4_10=0;
        
        $emu->M1_11=0;
        $emu->M2_11=0;
        $emu->Mc1_11=0;
        $emu->Mc2_11=0;
        $emu->T1_11=0;
        $emu->T2_11=0;
        $emu->T3_11=0;
        $emu->T4_11=0;
        $emu->Tc1_11=0;
        $emu->Tc2_11=0;
        $emu->Tc3_11=0;
        $emu->Tc4_11=0;
        
        $emu->M1_12=0;
        $emu->M2_12=0;
        $emu->Mc1_12=0;
        $emu->Mc2_12=0;
        $emu->T1_12=0;
        $emu->T2_12=0;
        $emu->T3_12=0;
        $emu->T4_12=0;
        $emu->Tc1_12=0;
        $emu->Tc2_12=0;
        $emu->Tc3_12=0;
        $emu->Tc4_12=0;
        
        $emu->M1_13=0;
        $emu->M2_13=0;
        $emu->Mc1_13=0;
        $emu->Mc2_13=0;
        $emu->T1_13=0;
        $emu->T2_13=0;
        $emu->T3_13=0;
        $emu->T4_13=0;
        $emu->Tc1_13=0;
        $emu->Tc2_13=0;
        $emu->Tc3_13=0;
        $emu->Tc4_13=0;
        
        $emu->M1_14=0;
        $emu->M2_14=0;
        $emu->Mc1_14=0;
        $emu->Mc2_14=0;
        $emu->T1_14=0;
        $emu->T2_14=0;
        $emu->T3_14=0;
        $emu->T4_14=0;
        $emu->Tc1_14=0;
        $emu->Tc2_14=0;
        $emu->Tc3_14=0;
        $emu->Tc4_14=0;

        $emu->p1=0;
        $emu->p2=0;
        $emu->p3=0;
        $emu->p4=0;
        $emu->p5=0;
        $emu->p6=0;
        $emu->p7=0;
        $emu->p8=0;
        $emu->p9=0;
        $emu->p10=0;
        $emu->p11=0;
        $emu->p12=0;
        $emu->p13=0;
        $emu->p14=0;
    
        $emu->save();

        session(['id_emu' => $emu->id_emu]);
        session(['id_dmu' => $emu->id_dmu]);

        return redirect()->route('emu_detail.index');
    }

    public function store(Request $request)
    {
        $emu = Emu::findOrFail($request->id_emu);
        $emu->id_subpengujian  = $request->id_subpengujian;
        $emu->id_proyek  = $request->id_proyek;
        $emu->form  = $request->form;
        $emu->kode_emu  = $request->kode_emu;
        $emu->total_item = $request->total_item;
        $emu->nama_proyeks = $request->nama_proyeks;
        $emu->status = $request->status;
        $emu->keterangan = $request->keterangan;
        $emu->id_car = $request->id_car;
        $emu->Approved = $request->Approved;
        $emu->lanjut = $request->lanjut;
        $emu->total_harga = 0;
        $emu->id_users = auth()->id();
        $emu->diskon = 0;
        $emu->bayar = 0;
        $emu->kode_emu = 'X-'. tambah_nol_didepan((int)$emu->id_emu +1, 7);
        $emu->t_operasi = $request->t_operasi;

        $emu->nama_dmu1=$request->nama_dmu1;
        $emu->nama_dmu2=$request->nama_dmu2;
        $emu->nama_dmu3=$request->nama_dmu3;
        $emu->nama_dmu4=$request->nama_dmu4;
        $emu->nama_dmu5=$request->nama_dmu5;
        $emu->nama_dmu6=$request->nama_dmu6;
        $emu->nama_dmu7=$request->nama_dmu7;
        $emu->nama_dmu8=$request->nama_dmu8;
        $emu->nama_dmu9=$request->nama_dmu9;
        $emu->nama_dmu10=$request->nama_dmu10;
        $emu->nama_dmu11=$request->nama_dmu11;
        $emu->nama_dmu12=$request->nama_dmu12;
        $emu->nama_dmu13=$request->nama_dmu13;
        $emu->nama_dmu14=$request->nama_dmu14;
        
        $emu->M1_1=$request->M1_1;
        $emu->M2_1=$request->M2_1;
        $emu->Mc1_1=$request->Mc1_1;
        $emu->Mc2_1=$request->Mc2_1;
        $emu->T1_1=$request->T1_1;
        $emu->T2_1=$request->T2_1;
        $emu->T3_1=$request->T3_1;
        $emu->T4_1=$request->T4_1;
        $emu->Tc1_1=$request->Tc1_1;
        $emu->Tc2_1=$request->Tc2_1;
        $emu->Tc3_1=$request->Tc3_1;
        $emu->Tc4_1=$request->Tc4_1;
        
        $emu->M1_2=$request->M1_2;
        $emu->M2_2=$request->M2_2;
        $emu->Mc1_2=$request->Mc1_2;
        $emu->Mc2_2=$request->Mc2_2;
        $emu->T1_2=$request->T1_2;
        $emu->T2_2=$request->T2_2;
        $emu->T3_2=$request->T3_2;
        $emu->T4_2=$request->T4_2;
        $emu->Tc1_2=$request->Tc1_2;
        $emu->Tc2_2=$request->Tc2_2;
        $emu->Tc3_2=$request->Tc3_2;
        $emu->Tc4_2=$request->Tc4_2;
        
        $emu->M1_3=$request->M1_3;
        $emu->M2_3=$request->M2_3;
        $emu->Mc1_3=$request->Mc1_3;
        $emu->Mc2_3=$request->Mc2_3;
        $emu->T1_3=$request->T1_3;
        $emu->T2_3=$request->T2_3;
        $emu->T3_3=$request->T3_3;
        $emu->T4_3=$request->T4_3;
        $emu->Tc1_3=$request->Tc1_3;
        $emu->Tc2_3=$request->Tc2_3;
        $emu->Tc3_3=$request->Tc3_3;
        $emu->Tc4_3=$request->Tc4_3;
        
        $emu->M1_4=$request->M1_4;
        $emu->M2_4=$request->M2_4;
        $emu->Mc1_4=$request->Mc1_4;
        $emu->Mc2_4=$request->Mc2_4;
        $emu->T1_4=$request->T1_4;
        $emu->T2_4=$request->T2_4;
        $emu->T3_4=$request->T3_4;
        $emu->T4_4=$request->T4_4;
        $emu->Tc1_4=$request->Tc1_4;
        $emu->Tc2_4=$request->Tc2_4;
        $emu->Tc3_4=$request->Tc3_4;
        $emu->Tc4_4=$request->Tc4_4;
        
        $emu->M1_5=$request->M1_5;
        $emu->M2_5=$request->M2_5;
        $emu->Mc1_5=$request->Mc1_5;
        $emu->Mc2_5=$request->Mc2_5;
        $emu->T1_5=$request->T1_5;
        $emu->T2_5=$request->T2_5;
        $emu->T3_5=$request->T3_5;
        $emu->T4_5=$request->T4_5;
        $emu->Tc1_5=$request->Tc1_5;
        $emu->Tc2_5=$request->Tc2_5;
        $emu->Tc3_5=$request->Tc3_5;
        $emu->Tc4_5=$request->Tc4_5;
        
        $emu->M1_6=$request->M1_6;
        $emu->M2_6=$request->M2_6;
        $emu->Mc1_6=$request->Mc1_6;
        $emu->Mc2_6=$request->Mc2_6;
        $emu->T1_6=$request->T1_6;
        $emu->T2_6=$request->T2_6;
        $emu->T3_6=$request->T3_6;
        $emu->T4_6=$request->T4_6;
        $emu->Tc1_6=$request->Tc1_6;
        $emu->Tc2_6=$request->Tc2_6;
        $emu->Tc3_6=$request->Tc3_6;
        $emu->Tc4_6=$request->Tc4_6;
        
        $emu->M1_7=$request->M1_7;
        $emu->M2_7=$request->M2_7;
        $emu->Mc1_7=$request->Mc1_7;
        $emu->Mc2_7=$request->Mc2_7;
        $emu->T1_7=$request->T1_7;
        $emu->T2_7=$request->T2_7;
        $emu->T3_7=$request->T3_7;
        $emu->T4_7=$request->T4_7;
        $emu->Tc1_7=$request->Tc1_7;
        $emu->Tc2_7=$request->Tc2_7;
        $emu->Tc3_7=$request->Tc3_7;
        $emu->Tc4_7=$request->Tc4_7;
        
        $emu->M1_8=$request->M1_8;
        $emu->M2_8=$request->M2_8;
        $emu->Mc1_8=$request->Mc1_8;
        $emu->Mc2_8=$request->Mc2_8;
        $emu->T1_8=$request->T1_8;
        $emu->T2_8=$request->T2_8;
        $emu->T3_8=$request->T3_8;
        $emu->T4_8=$request->T4_8;
        $emu->Tc1_8=$request->Tc1_8;
        $emu->Tc2_8=$request->Tc2_8;
        $emu->Tc3_8=$request->Tc3_8;
        $emu->Tc4_8=$request->Tc4_8;
        
        $emu->M1_9=$request->M1_9;
        $emu->M2_9=$request->M2_9;
        $emu->Mc1_9=$request->Mc1_9;
        $emu->Mc2_9=$request->Mc2_9;
        $emu->T1_9=$request->T1_9;
        $emu->T2_9=$request->T2_9;
        $emu->T3_9=$request->T3_9;
        $emu->T4_9=$request->T4_9;
        $emu->Tc1_9=$request->Tc1_9;
        $emu->Tc2_9=$request->Tc2_9;
        $emu->Tc3_9=$request->Tc3_9;
        $emu->Tc4_9=$request->Tc4_9;
        
        $emu->M1_10=$request->M1_10;
        $emu->M2_10=$request->M2_10;
        $emu->Mc1_10=$request->Mc1_10;
        $emu->Mc2_10=$request->Mc2_10;
        $emu->T1_10=$request->T1_10;
        $emu->T2_10=$request->T2_10;
        $emu->T3_10=$request->T3_10;
        $emu->T4_10=$request->T4_10;
        $emu->Tc1_10=$request->Tc1_10;
        $emu->Tc2_10=$request->Tc2_10;
        $emu->Tc3_10=$request->Tc3_10;
        $emu->Tc4_10=$request->Tc4_10;
        
        $emu->M1_11=$request->M1_11;
        $emu->M2_11=$request->M2_11;
        $emu->Mc1_11=$request->Mc1_11;
        $emu->Mc2_11=$request->Mc2_11;
        $emu->T1_11=$request->T1_11;
        $emu->T2_11=$request->T2_11;
        $emu->T3_11=$request->T3_11;
        $emu->T4_11=$request->T4_11;
        $emu->Tc1_11=$request->Tc1_11;
        $emu->Tc2_11=$request->Tc2_11;
        $emu->Tc3_11=$request->Tc3_11;
        $emu->Tc4_11=$request->Tc4_11;
        
        $emu->M1_12=$request->M1_12;
        $emu->M2_12=$request->M2_12;
        $emu->Mc1_12=$request->Mc1_12;
        $emu->Mc2_12=$request->Mc2_12;
        $emu->T1_12=$request->T1_12;
        $emu->T2_12=$request->T2_12;
        $emu->T3_12=$request->T3_12;
        $emu->T4_12=$request->T4_12;
        $emu->Tc1_12=$request->Tc1_12;
        $emu->Tc2_12=$request->Tc2_12;
        $emu->Tc3_12=$request->Tc3_12;
        $emu->Tc4_12=$request->Tc4_12;
        
        $emu->M1_13=$request->M1_13;
        $emu->M2_13=$request->M2_13;
        $emu->Mc1_13=$request->Mc1_13;
        $emu->Mc2_13=$request->Mc2_13;
        $emu->T1_13=$request->T1_13;
        $emu->T2_13=$request->T2_13;
        $emu->T3_13=$request->T3_13;
        $emu->T4_13=$request->T4_13;
        $emu->Tc1_13=$request->Tc1_13;
        $emu->Tc2_13=$request->Tc2_13;
        $emu->Tc3_13=$request->Tc3_13;
        $emu->Tc4_13=$request->Tc4_13;
        
        $emu->M1_14=$request->M1_14;
        $emu->M2_14=$request->M2_14;
        $emu->Mc1_14=$request->Mc1_14;
        $emu->Mc2_14=$request->Mc2_14;
        $emu->T1_14=$request->T1_14;
        $emu->T2_14=$request->T2_14;
        $emu->T3_14=$request->T3_14;
        $emu->T4_14=$request->T4_14;
        $emu->Tc1_14=$request->Tc1_14;
        $emu->Tc2_14=$request->Tc2_14;
        $emu->Tc3_14=$request->Tc3_14;
        $emu->Tc4_14=$request->Tc4_14;

        $emu->p1=$request->p1;
        $emu->p2=$request->p2;
        $emu->p3=$request->p3;
        $emu->p4=$request->p4;
        $emu->p5=$request->p5;
        $emu->p6=$request->p6;
        $emu->p7=$request->p7;
        $emu->p8=$request->p8;
        $emu->p9=$request->p9;
        $emu->p10=$request->p10;
        $emu->p11=$request->p11;
        $emu->p12=$request->p12;
        $emu->p13=$request->p13;
        $emu->p14=$request->p14;
        
        $emu->update();

        $detail = EmuDetail::where('id_emu', $emu->id_emu)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            $produk->stok += $item->jumlah;
            $produk->update();
        }

        return redirect()->route('emu.index');
    }

}
