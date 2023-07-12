<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
        $user = User::all()->pluck('name', 'id');

        return view('barang.index', compact('kategori','user'));
    }

    public function data()
    {
        $barang = Barang::leftJoin('kategori', 'kategori.id_kategori', 'barang.id_kategori')
            ->select('barang.*', 'nama_kategori')
            ->get();

        return datatables()
            ->of($barang)
            ->addIndexColumn()
            ->addColumn('select_all', function ($barang) {
                return '
                    <input type="checkbox" name="id_barang[]" value="'. $barang->id_barang .'">
                ';
            })
            ->addColumn('kode_barang', function ($barang) {
                return '<span class="label label-success">'. $barang->kode_barang .'</span>';
            })
            ->addColumn('harga_beli', function ($barang) {
                return format_uang($barang->harga_beli);
            })
            ->addColumn('harga_jual', function ($barang) {
                return format_uang($barang->harga_jual);
            })
            ->addColumn('stok', function ($barang) {
                return format_uang($barang->stok);
            })
            ->addColumn('aksi', function ($barang) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('barang.update', $barang->id_barang) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('barang.destroy', $barang->id_barang) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_barang', 'select_all'])
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = Barang::latest()->first() ?? new Barang();
        $request['kode_barang'] = 'INV'. tambah_nol_didepan((int)$barang->id_barang +1);
        $request['stok'] = $barang->jumlah;

        $barang = Barang::create($request->all());

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
        $barang = Barang::find($id);

        return response()->json($barang);
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
        $barang = Barang::find($id);
        $barang->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_barang as $id) {
            $barang = Barang::find($id);
            $barang->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $databarang = array();
        foreach ($request->id_barang as $id) {
            $barang = Barang::find($id);
            $databarang[] = $barang;
        }

        $no  = 1;
        $pdf = PDF::loadView('barang.barcode', compact('databarang', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('barang.pdf');
    }
}

