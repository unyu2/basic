<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subpengujian;
use App\Models\Dmu;
use App\Models\Proyek;
use App\Models\Sistem;
use App\Models\User;
use PDF;

class DmuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subpengujian = Subpengujian::all()->pluck('nama_subpengujian', 'id_subpengujian');
        $proyek = Proyek::all()->pluck('nama_proyek', 'id_proyek');
        $sistem = Sistem::all()->pluck('nama_sistem', 'id_sistem');

        return view('dmu.index', compact('subpengujian', 'proyek', 'sistem'));
    }

    public function data()
    {
        $dmu = Dmu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
            ->select('dmu.*', 'nama_subpengujian')
            ->get();
             $user = Dmu::leftJoin('users', 'users.id', 'dmu.id_user')
            ->select('dmu.*', 'name')
            ->get();
            $emus = Dmu::with('user')->orderBy('id_dmu', 'asc')->get();

        return datatables()
            ->of($dmu)
            ->addIndexColumn()
            ->addColumn('select_all', function ($dmu) {
                return '
                    <input type="checkbox" name="id_dmu[]" value="'. $dmu->id_dmu .'">
                ';
            })
            ->addColumn('kode_dmu', function ($dmu) {
                return '<span class="label label-success">'. $dmu->kode_dmu .'</span>';
            })
            ->editColumn('id_user', function ($emus) {
                return $emus->user->name ?? '';
            })
            ->addColumn('aksi', function ($dmu) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('dmu.update', $dmu->id_dmu) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('dmu.destroy', $dmu->id_dmu) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_dmu', 'select_all'])
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
        $dmu = Dmu::latest()->first() ?? new Dmu();
        $request['kode_dmu'] = 'MLT'. tambah_nol_didepan((int)$dmu->id_dmu +1);

        $dmu = Dmu::create($request->all());

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
        $dmu = Dmu::find($id);

        return response()->json($dmu);
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
        $dmu = Dmu::find($id);
        $dmu->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tambah(Request $request, $id)
    {
        $dmu = Dmu::find($id);
        $dmu->tambah($request->all());

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
        $dmu = Dmu::find($id);
        $dmu->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_dmu as $id) {
            $dmu = Dmu::find($id);
            $dmu->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $datadmu = array();
        foreach ($request->id_dmu as $id) {
            $dmu = Dmu::find($id);
            $datadmu[] = $dmu;
        }

        $no  = 1;
        $pdf = PDF::loadView('dmu.barcode', compact('datadmu', 'no'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('dmu.pdf');
    }
}

