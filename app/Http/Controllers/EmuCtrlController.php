<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Dmu;
use App\Models\Emu;
use App\Models\Proyek;
use App\Models\Subpengujian;
use App\Models\Setting;
use App\Models\User;
use PDF;

class EmuCtrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $userlog = Auth::id();
       $emu = Emu::orderBy('id_emu', 'asc')->where('id_user', $userlog)->get();

       $dmus = Dmu::find(session('id_dmu'));
       $emus = Dmu::find(session('id_emu'));

       $dmu = Dmu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
       ->select('dmu.*', 'nama_subpengujian', 'nama_dmu')
       ->get();

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

        return view('emu_ctrl.index', compact('dmu', 'emu', 'nilairev', 'nilaiapv', 'dmus', 'emus'));
    }

    public function data()
    {
        $emu = Emu::leftJoin('dmu', 'dmu.id_dmu', 'emu.id_dmu')
            ->leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
            ->leftJoin('proyek', 'proyek.id_proyek', 'dmu.id_proyek')
            ->leftJoin('users', 'users.id', 'emu.id_user')
            ->select('emu.*', 'nama_dmu', 'nama_subpengujian', 'nama_proyek', 'name')
            ->orderBy('created_at', 'desc')
            ->get();

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
            ->addColumn('nama_proyek', function ($emu) {
                return  $emu->nama_proyek ;
            })
            ->addColumn('id_proyek', function ($emu) {
                return  $emu->proyek->nama_proyek ?? '';
            })
            ->addColumn('id_subpengujian', function ($emu) {
                return $emu->subpengujian->nama_subpengujian ?? '';
            })
            ->editColumn('id_user', function ($emu) {
                return $emu->user->name ?? '';
            })
            ->addColumn('id_dmu', function ($emu) {
                return  $emu->nama_dmu;
            })
            ->addColumn('aksi', function ($emu) {
                $buttons = '<div class="btn-group">';
                if ($emu->status !== 'Approved') {
                    $buttons .= '<button type="button" onclick="deleteData(`'. route('emu_ctrl.destroy', $emu->id_emu) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';        
                    $buttons .= '<button type="button" onclick="editForm(`'. route('emu_ctrl.update', $emu->id_emu) .'`)" class="btn btn-success btn-xs">Approve</button>';
                  }
                $buttons .= '</div>';
        
                return $buttons;
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

            $emusss = Emu::leftJoin('proyek', 'proyek.id_proyek', 'emu.id_proyek')
            ->select('emu.*', 'nama_proyek')
            ->where('id_emu', $id)
            ->get();

            $emu = Emu::with('dmu')->where('id_emu', $id)->find($id);
            $dataemu[] = $emu;
        }

        $no  = 1;
        $pdf = PDF::loadView('emu_ctrl.barcode', compact('dataemu','users', 'no','dmu','x1','subpengujian','emusss'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('emu.pdf');
    }
}
