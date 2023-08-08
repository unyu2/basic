<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Subpengujian;
use App\Models\Dmu;
use App\Models\Proyek;
use App\Models\Sistem;
use App\Models\Subsistem;
use App\Models\User;
use PDF;

class DmuapvController extends Controller
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
        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');

        $dmu = Dmu::all('revisi', 'id_dmu');

        return view('dmuapv.index', compact('dmu', 'subpengujian', 'proyek', 'sistem', 'subsistem'));
    }

    public function data()
    {
    
        $userId = auth()->user()->id;
        $userBagian = auth()->user()->bagian;
    
        $dmu = Dmu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
            ->join('users', 'dmu.id_user', '=', 'users.id')
            ->select('dmu.*', 'nama_subpengujian')
            ->where('dmu.id_user', $userId)
            ->where('users.bagian', $userBagian)
            ->orderBy('dmu.created_at', 'desc') // Mengurutkan data berdasarkan kolom 'created_at' secara descending
            ->get();

             $user = Dmu::leftJoin('users', 'users.id', 'dmu.id_user')
            ->select('dmu.*', 'name')
            ->get();
            $proyek = Dmu::leftJoin('proyek', 'proyek.id_proyek', 'dmu.id_proyek')
            ->select('dmu.*', 'nama_proyek')
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
            ->addColumn('created_at', function ($dmu) {
                return tanggal_indonesia($dmu->created_at, false);
            })
            ->editColumn('id_user', function ($emus) {
                return $emus->users->name ?? '';
            })
            ->editColumn('id_proyek', function ($proyek) {
                return $proyek->proyek->nama_proyek ?? '';
            })
            ->addColumn('aksi', function ($dmu) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm3(`'. route('dmuapv.update', $dmu->id_dmu) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-pencil">Approve</i></button>
                    <button type="button" onclick="deleteData(`'. route('dmuapv.destroy', $dmu->id_dmu) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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

    public function storeModal(Request $request)
    {
        $latestDmu = Dmu::latest('id_dmu')->first();
        $runningNumber = $latestDmu ? (int) substr($latestDmu->kode_dmu, 2) + 1 : 1;
        $request['kode_dmu'] = 'IS' . $runningNumber;
    
        $dmu = Dmu::create($request->all());
    
        $fotoFields = ['foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'foto6', 'foto7', 'foto8', 'foto9', 'foto10', 'foto11', 'foto12', 'foto13', 'foto14'];
    
        foreach ($fotoFields as $fotoField) {
            if ($request->hasFile($fotoField)) {
                $file = $request->file($fotoField);
                $nama = $fotoField . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('img', $nama, 'public');
                $dmu[$fotoField] = "/img/$nama";
            }
        }
        $dmu->save();
    
        return redirect()->route('dmuapv.index');
    }

    
    public function update(Request $request, $id)
    {
        // Find the existing DMU record by its ID
        $dmu = Dmu::findOrFail($id);
        $dmu->status = 'Approved';
    
        // Handle foto fields update
        $fotoFields = ['foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'foto6', 'foto7', 'foto8', 'foto9', 'foto10', 'foto11', 'foto12', 'foto13', 'foto14'];
    
        foreach ($fotoFields as $fotoField) {
            if ($request->hasFile($fotoField)) {
                // Delete the existing photo file (if exists) before uploading the new one
                $this->deletePhotoFile($dmu->$fotoField);
    
                // Upload the new photo file
                $file = $request->file($fotoField);
                $nama = $fotoField . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('img', $nama, 'public');
                $request[$fotoField] = "/img/$nama";
            }
        }
    
        // Update other fields in the request
        $dmu->update($request->all());
    
        return redirect()->route('dmu.index')->with('success', 'Data berhasil diperbarui');
    }

    
    // Function to delete the photo file from storage
    private function deletePhotoFile($filePath)
    {
        if ($filePath) {
            $fullPath = public_path($filePath);
    
            // Check if the file exists and then delete it
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }
    

    public function store(Request $request)
    {
        // Generate kode_dmu berdasarkan data terbaru
        $latestDmu = Dmu::latest('id_dmu')->first();
        $runningNumber = $latestDmu ? (int) substr($latestDmu->kode_dmu, 2) + 1 : 1;
        $request['kode_dmu'] = 'IS' . $runningNumber;
    
        // Menghandle proses unggah foto
        $fotoFields = ['foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'foto6', 'foto7', 'foto8', 'foto9', 'foto10', 'foto11', 'foto12', 'foto13', 'foto14'];
    
        foreach ($fotoFields as $fotoField) {
            if ($request->hasFile($fotoField)) {
                $file = $request->file($fotoField);
                $nama = $fotoField . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('img', $nama, 'public'); // Simpan foto ke direktori /public/img
                $request[$fotoField] = "/img/$nama";
            }
        }
    
        // Simpan data ke database
        Dmu::create($request->all());
    
        return redirect()->route('dmu.index');
    }
    
    public function showNew()
    {
        // return Setting::first();
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

