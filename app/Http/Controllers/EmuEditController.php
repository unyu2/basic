<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emu;
use App\Models\EmuDetail;
use App\Models\Produk;
use App\Models\Proyek;
use App\Models\Car;
use App\Models\Dmu;
use App\Models\Subpengujian;

class EmuEditController extends Controller
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

        $nilairev='Rev.0';
        if ($nilairev === 'Rev.0') {
            $inputrev = 'Rev.A';
        } elseif ($nilairev === 'Rev.A') {
            $inputrev = 'Rev.B';
        } elseif ($nilairev === 'Rev.B') {
            $inputrev = 'Rev.C';
        } elseif ($nilairev === 'Rev.C') {
            $inputrev = 'Rev.D';
        } elseif ($nilairev === 'Rev.D') {
            $inputrev = 'Rev.E';
        } elseif ($nilairev === 'Rev.E') {
            $inputrev = 'Rev.F';
        } elseif ($nilairev === 'Rev.F') {
            $inputrev = 'Rev.G';
        } elseif ($nilairev === 'Rev.G') {
            $inputrev = 'rev.H';
        } elseif ($nilairev === 'Rev.H') {
            $inputrev = 'Rev.I';
        } elseif ($nilairev === 'Rev.I') {
            $inputrev = 'Rev.J';
        } else {
            $inputrev = '0';
        }
        $nilairev = $inputrev;

        $nilaiapv ='waiting';
        if ($nilaiapv === 'waiting') {
            $inputapv = 'Approved';
        } elseif ($nilaiapv === 'Approved') {
            $inputapv = 'waiting';
        } else {
            $inputapv = '0';
        }
        $nilaiapv = $inputapv;

        return view('emu.index', compact('emuss','x1','x2','emus', 'x3', 'r1','r2','r3','r4','r5','r6','r7', 'nilairev', 'nilaiapv'));
    }


    public function data()
    {
        $emu = Emu::leftJoin('dmu', 'dmu.id_dmu', 'emu.id_dmu')
        ->leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
        ->leftJoin('proyek', 'proyek.id_proyek', 'dmu.id_proyek')
        ->select('emu.*', 'nama_dmu', 'nama_subpengujian', 'nama_proyek')
        ->orderBy('created_at', 'desc')
        ->get();

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
            ->addColumn('id_proyek', function ($emu) {
                return $emu->proyek->nama_proyek ?? '';
            })
            ->addColumn('nama_dmu', function ($emu) {
                return $emu->dmu->nama_dmu ?? '';
            })
            ->addColumn('id_dmu', function ($emu) {
                return $emu->subpengujian->nama_subpengujian ?? '';
            })
            ->addColumn('id_subpengujian', function ($emuss) {
                return $emu->subpengujian->nama_subpengujian ?? '';
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
        $emu->id_subpengujian = 0;
        $emu->id_proyek = 0;
        $emu->total_item  = 0;
        $emu->total_harga = 0;
        $emu->nama_proyeks = 0;
        $emu->diskon      = 0;
        $emu->status = 0;
        $emu->keterangan  = 0;
        $emu->bayar = 0;
        $emu->id_users = 0;
        $emu->id_user = auth()->id();
        $emu->kode_emu = 0;
        $emu->Approved = 0;
        $emu->lanjut = 0;
        $emu->id_car = 0;
        $emu->form = 0;
        $emu->revisi= 0;
    
        $emu->save();

        session(['id_emu' => $emu->id_emu]);
        session(['id_dmu' => $emu->id_dmu]);
        session(['id_subpengujian' => $emu->id_subpengujian]);

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
        $emu->revisi= 'Rev.0';
        
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
