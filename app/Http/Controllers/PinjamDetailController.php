<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjam;
use App\Models\PinjamDetail;
use App\Models\Barang;
use App\Models\Setting;

class PinjamDetailController extends Controller
{
    public function index()
    {
        $barang = Barang::orderBy('nama_barang')->get();

        if ($id_pinjam = session('id_pinjam')) {
            $pinjam = Pinjam::find($id_pinjam);

            return view('pinjam_detail.index', compact('barang','id_pinjam', 'pinjam'));
        } else {
            if (auth()->user()->level == 1) {
                return redirect()->route('transaksi.baru');
            } else {
                return redirect()->route('transaksi.baru');
            }
        }
    }

    public function data($id)
    {
        $detail = PinjamDetail::with('barang')
            ->where('id_pinjam', $id)
            ->get();

        $data = array();
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['kode_barang'] = '<span class="label label-success">'. $item->barang['kode_barang'];
            $row['nama_barang'] = $item->barang['nama_barang'];
            $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id_pinjam_detail .'" value="'. $item->jumlah .'">';
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('transaksi.destroy', $item->id_pinjam_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;
            $total_item += $item->jumlah;
        }
        $data[] = [
            'kode_barang' => '
                <div class="total_item hide">'. $total_item .'</div>',
            'nama_barang' => '',
            'jumlah'      => '',
            'aksi'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kode_barang', 'jumlah'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $barang = Barang::where('id_barang', $request->id_barang)->first();
        if (! $barang) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new PinjamDetail();
        $detail->id_pinjam = $request->id_pinjam;
        $detail->id_barang = $barang->id_barang;
        $detail->jumlah = 1;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $detail = PinjamDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = PinjamDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

}
