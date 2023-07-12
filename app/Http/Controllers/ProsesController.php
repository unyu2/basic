<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proses;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\Produk;
Use PDF;

class ProsesController extends Controller
{
    public function index()
    {
        $produk = Produk::all()->pluck('nama_produk', 'id_produk');
        $pemesanan = Pemesanan::all()->pluck('surat', 'id_pemesanan');

        return view('proses.index', compact('produk', 'pemesanan'));
    }

    public function data()
    {
        $proses = Proses::leftJoin('produk', 'produk.id_produk', 'pemesanan_detail.id_produk')
        ->select('pemesanan_detail.*', 'nama_produk', 'komat')
        ->get();
   //     $proseses = Proses::leftJoin('pemesanan', 'pemesanan.id_pemesanan', 'pemesanan_detail.id_pemesanan')
  //      ->select('pemesanan_detail.*', 'surat', 'eta')
  //      ->get();

        return datatables()
            ->of($proses)
            ->addIndexColumn()
            ->addColumn('select_all', function ($proses) {
                return '
                    <input type="checkbox" name="id_pemesanan_detail[]" value="'. $proses->id_pemesanan_detail .'">
                ';
            })
            ->addColumn('created_at', function ($pemesanan_detail) {
                return tanggal_indonesia($pemesanan_detail->created_at, false);
            })
            ->addColumn('jumlah', function ($proses) {
                return $proses->jumlah;
            })
            ->addColumn('aksi', function ($proses) {
                return '
                <div class="btn-group">  
                <button type="button" onclick="editForm(`'. route('proses.update', $proses->id_pemesanan_detail) .'`)" class="btn btn-block btn-success btn-xs">Process</button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'select_all', 'id_pemesanan_detail'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function downloadpdf()
    {
        $data = Pemesanan::limit(20)->get();
        $pdf = PDF::loadview('pemesanan-pdf',compact($data));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('pemesanan.pdf');
    }

    public function cek()
    {
        $print = PemesananDetail::with('pemesanan_detail')->where('id_pemesanan_detail', $id)->get();
     //   $pdf = PDF::loadview('nota_besar',['data' => $print]);
        return view('pemesanan_detail');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proses = Proses::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proses = Proses::find($id);

        return response()->json($proses);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proses = Proses::find($id)->update($request->all());
        // return redirect()->route('transaksi_hutang_edit.selesai');
        return response()->json('Data berhasil disimpan', 200);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('', compact('setting'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proses = Proses::find($id)->delete();

        return response(null, 204);
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $proses = Pemesanan::find(session('id_pemesanan_detail'));
        if (! $proses) {
            abort(404);
        }
        $detail_pemesanan = PemesananDetail::with('produk')
            ->where('id_pemesanan_detail', session('id_pemesanan_detail'))
            ->get();
        
        return view('proses.nota_kecil', compact('setting', 'pemesanan_detail', 'detail_pemesanan'));
    }

    public function notaBesar()
    {
     //   $setting = Setting::first();
        $proses = Pemesanan::find(session('id_pemesanan_detail'));
        if (! $proses) {
            abort(404);
        }
        $detail_pemesanan = PemesananDetail::with('produk')
            ->where('id_pemesanan_detail', session('id_pemesanan_detail'))
            ->get();

        $pdf = PDF::loadView('proses.nota_besar', compact('setting', 'pemesanan_detail', 'detail_pemesanan'));
        $pdf->setPaper(0,0,609,440, 'potrait');
        return $pdf->stream('Transaksi-'. date('Y-m-d-his') .'.pdf');
    }

    public function cetakBaru(Request $request)
    {
        $proses = collect(array());
        foreach ($request->id_pemesanan_detail as $id) {
            $proses = Pemesanan::find($id);
            $data_proses[] = $proses;
        }

        $data_proses = $data_proses->chunk(2);
        $setting    = Setting::first();

        $no  = 1;
        $pdf = PDF::loadView('proses.cetak_proses', compact('setting', 'pemesanan_detail', 'detail_pemesanan'));
        $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
        return $pdf->stream('proses.pdf');
    }
}
