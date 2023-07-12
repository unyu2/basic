<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Temuan;
use App\Models\Emu;
use App\Models\Produk;
use App\Models\Car;
use App\Models\Setting;
use App\Models\User;
use PDF;

class TemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temuan = Temuan::orderBy('id_temuan', 'desc')->get();
        $proyek = Proyek::all()->pluck('nama_proyek','id_proyek');
        $produk = Produk::all()->pluck('nama_produk','id_produk');
        $car = Car::all()->pluck('nama_car','id_car');

        return view('temuan.index', compact('proyek', 'produk', 'temuan','car'));
    }

    public function data()
    {
        $coba = Temuan::orderBy('id_temuan', 'desc')->get();
        $temuan = Temuan::leftJoin('proyek', 'proyek.id_proyek', 'temuan.id_proyek')
            ->select('temuan.*', 'nama_proyek');
        $temuanss = Temuan::leftJoin('users', 'users.id', 'temuan.id_user')
            ->select('temuan.*', 'name');
        $produk = Produk::leftJoin('produk', 'produk.id_produk', 'temuan.id_produk')
        ->select('temuan.*', 'nama_produk');
        $emus = Temuan::with('user')->orderBy('id_temuan');
        $temuans = Temuan::orderBy('kode_temuan');

        return datatables()
            ->of($temuan)
            ->addIndexColumn()
            ->addColumn('select_all', function ($temuan) {
                return '
                    <input type="checkbox" name="id_temuan[]" value="'. $temuan->id_temuan .'">
                ';
            })
            ->addColumn('created_at', function ($temuans) {
                return tanggal_indonesia($temuans->created_at, false);
            })
            ->addColumn('updated_at', function ($temuans) {
                return tanggal_indonesia($temuans->updated_at, false);
            })
            ->editColumn('id_proyek', function ($temuan) {
                return $temuan->proyek->nama_proyek ?? '';
            })
            ->editColumn('id_produk', function ($produk) {
                return $produk->produk->nama_produk ?? '';
            })
            ->editColumn('id_user', function ($emus) {
                return $emus->user->name ?? '';
            })
            ->addColumn('aksi', function ($temuan) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('temuan.update', $temuan->id_temuan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('temuan.destroy', $temuan->id_temuan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_temuan', 'select_all'])
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
        $temuan = Temuan::latest()->first() ?? new Temuan();
        $request['kode_temuan'] = 'PRB'. tambah_nol_didepan((int)$temuan->id_temuan +1, 6);

        $temuan = Temuan::create($request->all());

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
        $temuan = Temuan::find($id);

        return response()->json($temuan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $temuan = Temuan::find($id);
        $temuan->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
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
        $temuan = Temuan::find($id);
        $temuan->update($request->all());

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
        $temuan = Temuan::find($id);
        $temuan->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_temuan as $id) {
            $temuan = Temuan::find($id);
            $temuan->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {

        $datatemuan = array();

        foreach ($request->id_temuan as $id) {

            $temuan = Temuan::with('user')->where('id_temuan', $id)->find($id);
            $datatemuan[] = $temuan;
        }

        $no  = 1;
        $pdf = PDF::loadView('temuan.barcode', compact('datatemuan', 'no', 'user'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('temuan.pdf');
    }
}
