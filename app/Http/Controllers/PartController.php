<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Part;
use PDF;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all()->pluck('nama_produk', 'id_produk');

        return view('part.index', compact('produk'));
    }

    public function data()
    {
        $part = Part::leftJoin('produk', 'produk.id_produk', 'part.id_produk')
            ->select('part.*', 'nama_produk')
            ->orderBy('nama_part', 'DESC')
            ->get();

        return datatables()
            ->of($part)
            ->addIndexColumn()
            ->addColumn('select_all', function ($part) {
                return '
                    <input type="checkbox" name="id_part[]" value="'. $part->id_part .'">
                ';
            })
            ->addColumn('kode_part', function ($part) {
                return '<span class="label label-success">'. $part->kode_part .'</span>';
            })
            ->addColumn('aksi', function ($part) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('part.update', $part->id_part) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('part.destroy', $part->id_part) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_part', 'select_all'])
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
        $part = Part::latest()->first() ?? new part();
        $request['kode_part'] = 'SP'. tambah_nol_didepan((int)$part->id_part +1, 5);

        $part = Part::create($request->all());

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
        $part = Part::find($id);

        return response()->json($part);
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
        $part = Part::find($id);
        $part->update($request->all());

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
        $part = Part::find($id);
        $part->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_part as $id) {
            $part = Part::find($id);
            $part->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $datapart = array();
        foreach ($request->id_part as $id) {
            $part = Part::find($id);
            $datapart[] = $part;
        }

        $no  = 1;
        $pdf = PDF::loadView('part.barcode', compact('datapart', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('part.pdf');
    }
}