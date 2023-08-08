<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sistem;
use App\Models\Subsistem;
use PDF;

class SubsistemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sistem = Sistem::all()->pluck('nama_sistem', 'id_sistem');

        return view('subsistem.index', compact('sistem'));
    }

    public function data()
    {
        $subsistem = Subsistem::leftJoin('sistem', 'sistem.id_sistem', 'subsistem.id_sistem')
            ->select('subsistem.*', 'nama_sistem')
            ->get();

        return datatables()
            ->of($subsistem)
            ->addIndexColumn()
            ->addColumn('select_all', function ($subsistem) {
                return '
                    <input type="checkbox" name="id_subsistem[]" value="'. $subsistem->id_subsistem .'">
                ';
            })
            ->addColumn('kode_subsistem', function ($subsistem) {
                return '<span class="label label-success">'. $subsistem->kode_subsistem .'</span>';
            })
            ->addColumn('aksi', function ($subsistem) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('subsistem.update', $subsistem->id_subsistem) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('subsistem.destroy', $subsistem->id_subsistem) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_subsistem', 'select_all'])
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

        $latestSubsistem = Subsistem::latest('id_subsistem')->first();
        $runningNumber = $latestSubsistem ? (int) substr($latestSubsistem->kode_subsistem, 2) + 1 : 1;
        $request['kode_subsistem'] = 'SS' . $runningNumber;

        $subsistem = Subsistem::create($request->all());

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
        $subsistem = Subsistem::find($id);

        return response()->json($subsistem);
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
        $subsistem = Subsistem::find($id);
        $subsistem->update($request->all());

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
        $subsistem = Subsistem::find($id);
        $subsistem->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_subsistem as $id) {
            $subsistem = Subsistem::find($id);
            $subsistem->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $datasubsistem = array();
        foreach ($request->id_subsistem as $id) {
            $subsistem = Subsistem::find($id);
            $datasubsistem[] = $subsistem;
        }

        $no  = 1;
        $pdf = PDF::loadView('subsistem.barcode', compact('datasubsistem', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('subsistem.pdf');
    }
}
