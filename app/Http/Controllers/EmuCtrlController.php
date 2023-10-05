<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Dmu;
use App\Models\Emu;
use App\Models\Car;
use App\Models\EmuDetail;
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

       $emuLeft = Emu::leftjoin('car', 'car.id_car', 'emu.id_car')
       ->select('emu.*', 'nama_car' )
       ->get();

       $dmu = Dmu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
       ->select('dmu.*', 'nama_subpengujian', 'nama_dmu')
       ->get();

        return view('emu_ctrl.index', compact('dmu', 'emu', 'dmus', 'emus'));
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
                if ($emu->status === 'waiting') {
                    $buttons .= '<button type="button" onclick="editForm(`'. route('emu_ctrl.update', $emu->id_emu) .'`)" class="btn btn-success btn-xs">Approve</button>';
                    $buttons .= '<button type="button" onclick="editForm2(`'. route('emu_ctrl.update', $emu->id_emu) .'`)" class="btn btn-info btn-xs">Edit</button>';
                } else {
                    $buttons .= '<button type="button" onclick="deleteData(`'. route('emu_ctrl.destroy', $emu->id_emu) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
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
    
        if (!$emu) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
            EmuDetail::where('id_emu', $id)->delete();
            $emu->delete();
    
        return response()->json(['message' => 'Data berhasil dihapus'], 204);
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

            $emu = Emu::with('setting')
            ->leftJoin('dmu', 'dmu.id_dmu', 'emu.id_dmu')
            ->leftJoin('car', 'car.id_car', 'emu.id_car')
            ->leftJoin('users', 'users.id', 'emu.id_users')
            ->leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'emu.id_subpengujian')
            ->leftJoin('proyek', 'proyek.id_proyek', 'emu.id_proyek')
            ->orderBy('emu.id_emu', 'desc')
            ->where('emu.id_emu', $id)
            ->get();
        
        $dataemu[] = $emu;
        
        }

        $no  = 1;
        $pdf = PDF::loadView('emu_ctrl.barcode', compact('dataemu', 'emu'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('emu.pdf');
    }
}
