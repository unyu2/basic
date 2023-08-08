<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Minta;
use App\Models\Permintaan;
use App\Models\PermintaanDetail;
use App\Models\Produk;
use App\Models\Proyek;
Use PDF;


class MintaController extends Controller
{
    public function index()
    {
        // return view('minta.index');
        $produks = Produk::orderby('id_produk', 'asc');
        $produk = Produk::all()->pluck('nama_produk', 'id_produk');
        $proyek = Proyek::all()->pluck('nama_proyek', 'id_proyek');

        return view('minta.index', compact('produk', 'produks', 'proyek'));
    }

    public function data()
    {
        $minta = Minta::leftJoin('produk', 'produk.id_produk', 'permintaan_detail.id_produk')
        ->leftjoin('permintaan', 'permintaan.id_permintaan', 'permintaan_detail.id_permintaan')
        ->select('permintaan_detail.*', 'nama_produk', 'komat', 'satuan', 'memo')
        ->orderby('updated_at', 'ASC')
        ->get();

        return datatables()
            ->of($minta)
            ->addIndexColumn()
            ->addColumn('created_at', function ($permintaan_detail) {
                return tanggal_indonesia($permintaan_detail->created_at, false);
            })
            ->editColumn('id_permintaan', function ($minta) {
                return $minta->permintaan->memo ?? '';
            })
            ->editColumn('proyek', function ($minta) {
                return $minta->permintaan->nama_proyeks ?? '';
            })
            ->addColumn('aksi', function ($minta) {
                $buttons = '<div class="btn-group">';
                $buttons .= '<button type="button" onclick="editForm2(`'. route('minta.update', $minta->id_permintaan_detail) .'`)" class="btn btn-block btn-success btn-xs">Process PO</button>';
                if ($minta->status2 !== 'PR') {
                    $buttons .= '<button type="button" onclick="editForm(`'. route('minta.update', $minta->id_permintaan_detail) .'`)" class="btn btn-block btn-success btn-xs">Process PR</button>';
                }
                $buttons .= '</div>';
        
                return $buttons;
            })
            ->rawColumns(['aksi', 'id_permintaan_detail'])
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
        $data = Permintaan::limit(20)->get();
        $pdf = PDF::loadview('permintaan-pdf',compact($data));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('permintaan.pdf');
    }

    public function cek()
    {
        $print = PemesananDetail::with('permintaan_detail')->where('id_permintaan_detail', $id)->get();
     //   $pdf = PDF::loadview('nota_besar',['data' => $print]);
        return view('permintaan_detail');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $minta = Minta::create($request->all());

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
        $minta = Minta::find($id);

        return response()->json($minta);
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
        $minta = Minta::find($id)->update($request->all());
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
        $minta = Minta::find($id)->delete();

        return response(null, 204);
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $minta = Permintaan::find(session('id_permintaan_detail'));
        if (! $minta) {
            abort(404);
        }
        $detail_permintaan = PemesananDetail::with('produk')
            ->where('id_permintaan_detail', session('id_permintaan_detail'))
            ->get();
        
        return view('minta.nota_kecil', compact('setting', 'permintaan_detail', 'detail_permintaan'));
    }

    public function notaBesar()
    {
     //   $setting = Setting::first();
        $minta = Permintaan::find(session('id_permintaan_detail'));
        if (! $minta) {
            abort(404);
        }
        $detail_permintaan = PemesananDetail::with('produk')
            ->where('id_permintaan_detail', session('id_permintaan_detail'))
            ->get();

        $pdf = PDF::loadView('minta.nota_besar', compact('setting', 'permintaan_detail', 'detail_permintaan'));
        $pdf->setPaper(0,0,609,440, 'potrait');
        return $pdf->stream('Transaksi-'. date('Y-m-d-his') .'.pdf');
    }

    public function cetakBaru(Request $request)
    {
        $minta = collect(array());
        foreach ($request->id_permintaan_detail as $id) {
            $minta = Permintaan::find($id);
            $data_minta[] = $minta;
        }

        $data_minta = $data_minta->chunk(2);
        $setting    = Setting::first();

        $no  = 1;
        $pdf = PDF::loadView('minta.cetak_proses', compact('setting', 'permintaan_detail', 'detail_permintaan'));
        $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
        return $pdf->stream('minta.pdf');
    }
}
