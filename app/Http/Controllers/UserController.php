<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Level;
use App\Exports\userExport;
use App\Exports\userImports;


class UserController extends Controller
{
    public function index()
    {

        $strata = Jabatan::leftJoin('users', 'users.id', 'jabatan.id_jabatan')
        ->select('jabatan.*', 'bagian', 'jabatan.nama_jabatan as nama_jabatan')
        ->get();

        $levels = Level::leftJoin('users', 'users.id', 'level.id_level')
        ->select('level.*', 'level', 'nama_level')
        ->get();
        $level = User::all();

        return view('user.index', compact('strata','level','levels'));
    }

    public function data()
    {
        $user = User::isNotAdmin()->orderBy('id', 'desc')->get();

        return datatables()
            ->of($user)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('user.update', $user->id) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('user.destroy', $user->id) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = $request->level;
        $user->nip = $request->nip;
        $user->bagian = $request->bagian;
        $user->status_karyawan = $request->status_karyawan;
        $user->foto = '/img/user.jpg';
        $user->save();

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
        $user = User::find($id);

        return response()->json($user);
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bagian = $request->bagian;
        $user->level = $request->level;
        $user->nip = $request->nip;
        if ($request->has('password') && $request->password != "") 
            $user->password = bcrypt($request->password);
        $user->update();

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
        $user = User::find($id)->delete();

        return response(null, 204);
    }

    public function profil()
    {
        $profil = auth()->user();
        return view('user.profil', compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();
        
        $user->name = $request->name;
        if ($request->has('password') && $request->password != "") {
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->password == $request->password_confirmation) {
                    $user->password = bcrypt($request->password);
                } else {
                    return response()->json('Konfirmasi password tidak sesuai', 422);
                }
            } else {
                return response()->json('Password lama tidak sesuai', 422);
            }
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $user->foto = "/img/$nama";
        }

        $user->update();

        return response()->json($user, 200);
    }

    public function importExcel(Request $request)
    {
        try {
            $file = $request->file('file'); // Ambil file Excel dari request
    
            // Pastikan Anda sudah membuat class Import yang sesuai dengan skema impor Anda
            Excel::import(new userImports, $file);
    
            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('design.index')->with('success', 'Import data berhasil.');
        } catch (\Exception $e) {
            // Tampilkan pesan error yang lebih rinci
            return redirect()->route('design.index')->with('error', 'Import data gagal: ' . $e->getMessage() . ' Line: ' . $e->getLine());
        }
    }

    public function exportExcel()
    {
        $user = User::leftJoin('jabatan', 'jabatan.id_jabatan', '=', 'users.bagian')
        ->leftjoin('level', 'level.id_level', '=', 'users.level')
        ->select('users.*', 'jabatan.nama_jabatan', 'level.nama_level')
        ->get();
        return Excel::download(new userExport($user), 'Data_User.xlsx');
    }

}
