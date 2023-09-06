<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


use App\Models\Design;
use App\Models\User;
use App\Models\Proyek;
use App\Helpers\Helper;

class DinasController extends Controller
{
    
    public function index()
    {

        $design = Design::select('id_design')->orderBy('id_design', 'DESC')->get();
    
        $proyek = Proyek::where('status', 'open')->pluck('nama_proyek' , 'id_proyek');
    
        return view('dinas.index', compact('design', 'proyek'));
    }
    
        public function data()
        {
            $design = Design::leftJoin('proyek', 'proyek.id_proyek', 'design.id_proyek')
            ->leftJoin('users', 'users.id', 'design.id_draft')
            ->select('design.*', 'nama_proyek', 'name', 'tanggal_prediksi', 'prediksi_akhir')
            ->where('jenis','Dinas')
            ->orderBy('id_design', 'DESC')
            ->get();
    
            return datatables()
                ->of($design)
                ->addIndexColumn()
                ->editColumn('id_proyek', function ($design) {
                    return $design->nama_proyek ?? '';
                })
                ->editColumn('id_draft', function ($design) {
                    return $design->name ?? '';
                })
                ->addColumn('tanggal_prediksi', function ($design) {
                    return tanggal_indonesia($design->tanggal_prediksi, false);
                })
                ->addColumn('prediksi_akhir', function ($design) {
                    return tanggal_indonesia($design->prediksi_akhir, false);
                })
                ->addColumn('aksi', function ($design) {
                    return '
                    <div class="btn-group">
                        <button onclick="editForm(`'. route('design.update', $design->id_design) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                        <button onclick="deleteData(`'. route('design.destroy', $design->id_design) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                    </div>
                    ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        public function dataModal()

        {
            $design = User::leftJoin('jabatan', 'jabatan.id_jabatan', 'users.bagian')
            ->select('users.*', 'nama_jabatan')
            ->orderBy('id', 'DESC')
            ->get();

            return datatables()
                ->of($design)
                ->addIndexColumn()
                ->addColumn('select_all', function ($design) {
                    return '
                        <input type="checkbox" name="id[]" value="'. $design->id .'">
                    ';
                })
                ->editColumn('bagian', function ($design) {
                    return $design->nama_jabatan ?? '';
                })
                ->addColumn('aksi', function ($design) {
                    $buttons = '<div class="btn-group">';                   
                    $buttons .= '<button type="button" onclick="pilihUser(`'. route('design.pilihData', $design->id) .'`)" class="btn btn-xs btn-success btn-flat">Pilih</button>';
                    $buttons .= '</div>';
            
                    return $buttons;
                })
                ->rawColumns(['aksi', 'id_design', 'select_all'])
                ->make(true);
        }

        public function pilihData($id)
        {
            $design = User::find($id);
            return response()->json($design);
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
            $design = new Design($request->all());

            $design->nama_design = $request->nama_design;
            $design->status = 'Release';

            $design->id_proyek = $request->id_proyek;
            $design->tanggal_prediksi = $request->tanggal_prediksi;
            $design->prediksi_hari = $request->prediksi_hari;
            $design->prediksi_akhir = \Carbon\Carbon::parse($design->tanggal_prediksi)->addDays($design->prediksi_hari)->format('Y-m-d');
    
            list($year, $month, $day) = explode('-', $design->tanggal_prediksi);
            $design->tp_yy = $year;
            $design->tp_mm = $month;
            $design->tp_dd = $day;

            list($year, $month, $day) = explode('-', $design->prediksi_akhir);
            $design->pa_yy = $year;
            $design->pa_mm = $month;
            $design->pa_dd = $day;

            $design->prosentase = '100';
            $design->status = 'Release';
            $design->pemilik = 'Design';
            $design->lembar = '1';
            $design->size = '8';
            $design->jenis = 'Dinas';
            $design->id_draft = auth()->id();
            $design->bobot_rev = '3';

            $design->save();
    
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
            $design = Design::find($id);
            return response()->json($design);
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
            $design = Design::find($id);
            $design->update();
    
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
            $design = Design::find($id);
            $design->delete();
    
            return response(null, 204);
        }


}
