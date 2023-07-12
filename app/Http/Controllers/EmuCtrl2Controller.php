<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dmu;
use App\Models\Emu;
use App\Models\Car;
use App\Models\Proyek;
use App\Models\Subpengujian;
use App\Models\Setting;
use App\Models\User;
use PDF;

class EmuCtrl2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $dmu = Dmu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
       ->select('dmu.*', 'nama_subpengujian', 'nama_dmu')
      ->get();

      $emu = Emu::orderBy('id_emu', 'asc')->get();

        return view('emu_ctrl2.index', compact('dmu', 'emu'));
    }

    public function data()
    {
        $emu = Emu::leftJoin('dmu', 'dmu.id_dmu', 'emu.id_dmu')
            ->select('emu.*', 'nama_dmu')
            ->get();
            $emuss = Dmu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
            ->select('dmu.*', 'nama_subpengujian')
            ->get();
            $emusss = Dmu::leftJoin('proyek', 'proyek.id_proyek', 'dmu.id_proyek')
            ->select('dmu.*', 'nama_proyek')
            ->get();
            $emus = Emu::with('user')->orderBy('id_emu', 'asc')->get();

        return datatables()
            ->of($emu)
            ->addIndexColumn()
            ->addColumn('select_all', function ($emu) {
                return '
                    <input type="checkbox" name="id_emu[]" value="'. $emu->id_emu .'">
                ';
            })
            ->addColumn('created_at', function ($emu) {
                return tanggal_indonesia($emu->created_at, false);
            })
            ->addColumn('updated_at', function ($emu) {
                return tanggal_indonesia($emu->updated_at, false);
            })
            ->addColumn('id_proyek', function ($emusss) {
                $dmu = $emusss->proyek->nama_proyek ?? '';
                return $dmu;
            })
            ->addColumn('id_subpengujian', function ($emuss) {
                $emu = $emuss->subpengujian->nama_subpengujian ?? '';
                return $emu;
            })
            ->editColumn('id_user', function ($emus) {
                return $emus->user->name ?? '';
            })
            ->addColumn('id_dmu', function ($emu) {
                return  $emu->nama_dmu;
            })
            

            ->addColumn('aksi', function ($emu) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="deleteData(`'. route('emu_ctrl2.destroy', $emu->id_emu) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                    <button type="button" onclick="editForm(`'. route('emu_ctrl2.update', $emu->id_emu) .'`)" class="btn btn-success btn-xs">Follow Up</button>
                    </div>
                ';
            })
            ->rawColumns(['aksi', 'nama_proyek', 'select_all'])
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
        $emu = Emu::latest()->first() ?? new Emu();
        $emu = Emu::create($request->all());

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
        
        $dmu = Dmu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
        ->select('dmu.*', 'nama_subpengujian', 'nama_dmu')
       ->get();
        $emu = Emu::with('dmu')->where('id_emu', $id)->find($id);


 

      return response()->json($emu);
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
        $emu = Emu::find($id);
        $emu->update($request->all());
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
        $emu = Emu::find($id);
        $emu->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_emu as $id) {
            $emu = Emu::find($id);
            $emu->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
       
        $dataemu = array();

        foreach ($request->id_emu as $id) {

            $emuss = Emu::with('setting')
            ->orderBy('id_emu', 'desc')
            ->where('id_emu', $id)
            ->get();

            $x1 = Setting::all()->pluck('path_logo2','id_setting');
            
            
            $dmu = Emu::leftJoin('dmu', 'dmu.id_dmu', 'emu.id_dmu')
            ->select('dmu.*', 'nama_dmu')
            ->where('id_emu', $id)
            ->get();

            $users = Emu::leftJoin('users', 'users.id', 'emu.id_users')
            ->select('users.*', 'name')
            ->where('id_emu', $id)
            ->get();

            $subpengujian = Emu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'emu.id_subpengujian')
            ->select('subpengujian.*', 'nama_subpengujian')
            ->where('id_emu', $id)
            ->get();

            $emu = Emu::with('dmu')->where('id_emu', $id)->find($id);
            $dataemu[] = $emu;
        }

        $no  = 1;
        $pdf = PDF::loadView('emu_ctrl2.barcode', compact('dataemu','users', 'no','dmu','x1','subpengujian'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('emu.pdf');
    }
}
