<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\temuanImports; 

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Temuan;
use App\Models\Emu;
use App\Models\Produk;
use App\Models\Car;
use App\Models\Setting;
use App\Models\User;
use PDF;

class Temuan2Controller extends Controller
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

        return view('temuan2.index', compact('proyek', 'produk', 'temuan', 'car'));
    }

    public function data()
    {
        $temuan = Temuan::leftJoin('proyek', 'proyek.id_proyek', 'temuan.id_proyek')
        ->leftJoin('users', 'users.id', 'temuan.id_user')
        ->leftJoin('produk', 'produk.id_produk', 'temuan.id_produk')
        ->leftJoin('car', 'car.id_car', 'temuan.id_car')
        ->select('temuan.*', 'nama_proyek', 'name', 'nama_produk', 'nama_car')
        ->orderBy('id_temuan', 'DESC')
        ->get();
    
        return datatables()
            ->of($temuan)
            ->addIndexColumn()
            ->addColumn('select_all', function ($temuan) {
                return '<input type="checkbox" name="id_temuan[]" value="'. $temuan->id_temuan .'">';
            })
            ->addColumn('created_at', function ($temuan) {
                return tanggal_indonesia($temuan->created_at, false);
            })
            ->addColumn('updated_at', function ($temuan) {
                return tanggal_indonesia($temuan->updated_at, false);
            })
            ->editColumn('id_proyek', function ($temuan) {
                return $temuan->nama_proyek ?? '';
            })
            ->editColumn('id_produk', function ($temuan) {
                return $temuan->nama_produk ?? '';
            })
            ->editColumn('id_car', function ($temuan) {
                return $temuan->nama_car ?? '';
            })
            ->editColumn('id_user', function ($temuan) {
                return $temuan->nama_user_temuan ?? '';
            })
            ->editColumn('id_user_proyek', function ($temuan) {
                return $temuan->nama_user_proyek ?? '';
            })
            ->addColumn('aksi', function ($temuan) {
                $buttons = '<div class="btn-group">';
                $buttons .= '<button type="button" onclick="editForm2(`'. route('temuan.update', $temuan->id_temuan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>';        
                if ($temuan->status !== 'Closed') {
                    $buttons .= '<button type="button" onclick="editForm(`'. route('temuan.update', $temuan->id_temuan) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-pencil">Closing</i></button>';        
                    $buttons .= '<button type="button" onclick="deleteData(`'. route('temuan.destroy', $temuan->id_temuan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
                  }
                $buttons .= '</div>';
        
                return $buttons;
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
        $request['kode_temuan'] = 'OIL'. tambah_nol_didepan((int)$temuan->id_temuan +1, 6);

        $temuan->frekuensi = $request->frekuensi;
        $temuan->pantau = $request->pantau;
        $temuan->dampak = $request->dampak;
        
        $request['nilai'] = $temuan->frekuensi * $temuan->pantau * $temuan->dampak;

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

        $temuan->frekuensi = $request->frekuensi;
        $temuan->pantau = $request->pantau;
        $temuan->dampak = $request->dampak;
        
        $request['nilai'] = $temuan->frekuensi * $temuan->pantau * $temuan->dampak;

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

            $temuan = Temuan::with('proyek')->where('id_temuan', $id)->find($id);
            $datatemuan[] = $temuan;
            $temuans = Proyek::with('temuan')->where('id_proyek', $id)->find($id);
            $datatemuans[] = $temuans;
            $x1 = Proyek::all()->pluck('nama_proyek','id_temuan');
            $datatemuanss[] = $x1;
        }
        $no  = 1;
        $pdf = PDF::loadView('temuan2.barcode', compact('datatemuan', 'no', 'datatemuans','datatemuanss'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('temuan.pdf');
    }

    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file'); // Ambil file Excel dari request
    
            // Pastikan Anda sudah membuat class Import yang sesuai dengan skema impor Anda
            Excel::import(new temuanImports, $file);
    
            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('temuan2.index')->with('success', 'Import data berhasil.');
        } catch (\Exception $e) {
            // Tampilkan pesan error yang lebih rinci
            return redirect()->route('temuan2.index')->with('error', 'Import data gagal: ' . $e->getMessage() . ' Line: ' . $e->getLine());
        }
    }
}

