<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\PendaftaranDetail;
use App\Models\Pengujian;
use App\Models\Subpengujian;

class PendaftaranDetailController extends Controller
{
    public function index()
    {
        $id_pendaftaran = session('id_pendaftaran');
        $pengujian = Pengujian::orderBy('nama')->get();
        $subpengujian = Subpengujian::find(session('id_subpengujian'));
        $diskon = Pendaftaran::find($id_pendaftaran)->diskon ?? 0;

        if (! $subpengujian) {
            abort(404);
        }

        return view('pendaftaran_detail.index', compact('id_pendaftaran', 'pengujian', 'subpengujian', 'diskon'));
    }

    public function data($id)
    {
        $detail = PendaftaranDetail::with('pengujian')
            ->where('id_pendaftaran', $id)
            ->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['kode_pengujian'] = '<span class="label label-success">'. $item->pengujian['kode_pengujian'] .'</span';
            $row['nama'] = $item->pengujian['nama'];
            $row['harga_beli']  = 'Rp. '. format_uang($item->harga_beli);
            $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id_pendaftaran_detail .'" value="'. $item->jumlah .'">';
            $row['subtotal']    = 'Rp. '. format_uang($item->subtotal);
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('pendaftaran_detail.destroy', $item->id_pendaftaran_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->harga_beli * $item->jumlah;
            $total_item += $item->jumlah;
        }
        $data[] = [
            'kode_pengujian' => '
                <div class="total hide">'. $total .'</div>
                <div class="total_item hide">'. $total_item .'</div>',
            'nama' => '',
            'harga_beli'  => '',
            'jumlah'      => '',
            'subtotal'    => '',
            'aksi'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kode_pengujian', 'jumlah'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $pengujian = Pengujian::where('id_pengujian', $request->id_pengujian)->first();
        if (! $pengujian) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new PendaftaranDetail();
        $detail->id_pendaftaran = $request->id_pendaftaran;
        $detail->id_pengujian = $pengujian->id_pengujian;
        $detail->harga_beli = $pengujian->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $pengujian->harga_beli;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $detail = PendaftaranDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_beli * $request->jumlah;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = PendaftaranDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    public function loadForm($diskon, $total)
    {
        $bayar = $total - ($diskon / 100 * $total);
        $data  = [
            'totalrp' => format_uang($total),
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar). ' Rupiah')
        ];

        return response()->json($data);
    }
}
