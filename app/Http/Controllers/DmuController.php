<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Subpengujian;
use App\Models\Dmu;
use App\Models\Proyek;
use App\Models\Sistem;
use App\Models\Subsistem;
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
        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');

        $dmu = Dmu::all()->pluck('revisi', 'id_dmu');

        return view('dmu.index', compact('dmu', 'subpengujian', 'proyek', 'sistem','subsistem'));
    }

    public function data()
    {

        $userId = auth()->user()->id;
        $userBagian = auth()->user()->bagian;
    
        $dmu = Dmu::leftJoin('subpengujian', 'subpengujian.id_subpengujian', 'dmu.id_subpengujian')
            ->join('users', 'dmu.id_user', '=', 'users.id')
            ->join('proyek', 'dmu.id_proyek', '=', 'proyek.id_proyek')
            ->select('dmu.*', 'nama_subpengujian', 'nama_proyek', 'name')
            ->where('dmu.id_user', $userId)
            ->where('users.bagian', $userBagian)
            ->orderBy('dmu.created_at', 'desc')
            ->get();

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
            ->editColumn('id_user', function ($dmu) {
                return $dmu->users->name ?? '';
            })
            ->editColumn('id_proyek', function ($dmu) {
                return $dmu->proyek->nama_proyek ?? '';
            })
            ->addColumn('aksi', function ($dmu) {
                $buttons = '<div class="btn-group">';
                $buttons .= '<button type="button" onclick="editForm2(`'. route('dmu.update', $dmu->id_dmu) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-pencil">Revisi</i></button>';        
                if ($dmu->status !== 'Approved') {
                    $buttons .= '<button type="button" onclick="editForm3(`'. route('dmu.updatex', $dmu->id_dmu) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil">Edit</i></button>';
                    $buttons .= '<button type="button" onclick="deleteData(`'. route('dmu.destroy', $dmu->id_dmu) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>';
                  }
                $buttons .= '</div>';
        
                return $buttons;
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
        $subpengujian = Subpengujian::all()->pluck('nama_subpengujian', 'id_subpengujian');
        $proyek = Proyek::all()->pluck('nama_proyek', 'id_proyek');
        $sistem = Sistem::all()->pluck('nama_sistem', 'id_sistem');
        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');

        $dmu = Dmu::all('revisi', 'id_dmu');

        return view('dmu.form1', compact('dmu', 'subpengujian', 'proyek', 'sistem', 'subsistem'));

    }

    public function showFile($id)
    {
        $fileData = Dmu::find($id); // Misalnya, mengambil data file dengan ID yang sesuai
        return view('file_view', compact('fileData'));
    }

    public function storeModal(Request $request)
    {
        // Generate kode_dmu berdasarkan data terbaru
        $latestDmu = Dmu::latest('id_dmu')->first();
        $runningNumber = $latestDmu ? (int) substr($latestDmu->kode_dmu, 2) + 1 : 1;
        $request['kode_dmu'] = 'IS' . $runningNumber;
    
        // Simpan data ke database
        $dmu = Dmu::create($request->all());
    
        // Menghandle proses unggah foto
        $fotoFields = ['foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'foto6', 'foto7', 'foto8', 'foto9', 'foto10', 'foto11', 'foto12', 'foto13', 'foto14'];
    
        foreach ($fotoFields as $fotoField) {
            if ($request->hasFile($fotoField)) {
                $file = $request->file($fotoField);
                $nama = $fotoField . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('img', $nama, 'public'); // Simpan foto ke direktori /public/img
                $dmu[$fotoField] = "/img/$nama";
            }
        }
    
        // Simpan perubahan pada model Dmu setelah foto diisi
        $dmu->save();
    
        return redirect()->route('dmu.index');
    }
    
 

    public function storexxxxxxxx(Request $request)
    {


        $path = '/img';
        
        $foto1Name = 'foto1_' . time() . '.' . $request->foto1->getClientOriginalExtension();
        $request->foto1->storeAs($path, $foto1Name);

        $foto2Name = 'foto2_' . time() . '.' . $request->foto2->getClientOriginalExtension();
        $request->foto2->storeAs($path, $foto2Name);

        $foto3Name = 'foto3_' . time() . '.' . $request->foto3->getClientOriginalExtension();
        $request->foto3->storeAs($path, $foto3Name);

        $foto4Name = 'foto4_' . time() . '.' . $request->foto4->getClientOriginalExtension();
        $request->foto4->storeAs($path, $foto4Name);

        $foto5Name = 'foto5_' . time() . '.' . $request->foto5->getClientOriginalExtension();
        $request->foto5->storeAs($path, $foto5Name);

        $foto6Name = 'foto6_' . time() . '.' . $request->foto6_->getClientOriginalExtension();
        $request->foto6->storeAs($path, $foto6Name);

        $foto7Name = 'foto7_' . time() . '.' . $request->foto7_->getClientOriginalExtension();
        $request->foto7->storeAs($path, $foto7Name);

        $foto8Name = 'foto8_' . time() . '.' . $request->foto8_->getClientOriginalExtension();
        $request->foto8->storeAs($path, $foto8Name);

        $foto9Name = 'foto9_' . time() . '.' . $request->foto9_->getClientOriginalExtension();
        $request->foto9->storeAs($path, $foto9Name);

        $foto10Name = 'foto10_' . time() . '.' . $request->foto10_->getClientOriginalExtension();
        $request->foto10->storeAs($path, $foto10Name);

        $foto11Name = 'foto11_' . time() . '.' . $request->foto11_->getClientOriginalExtension();
        $request->foto11->storeAs($path, $foto11Name);

        $foto12Name = 'foto12_' . time() . '.' . $request->foto12_->getClientOriginalExtension();
        $request->foto12->storeAs($path, $foto12Name);

        $foto13Name = 'foto13_' . time() . '.' . $request->foto13_->getClientOriginalExtension();
        $request->foto13->storeAs($path, $foto13Name);

        $foto14Name = 'foto14_' . time() . '.' . $request->foto14_->getClientOriginalExtension();
        $request->foto14->storeAs($path, $foto14Name);


        $dmu = new Dmu();
        $dmu = Dmu::latest('id_dmu')->first();
    
        if ($dmu) {
            $runningNumber = (int)substr($dmu->kode_dmu, 2) + 1;
        } else {
            $runningNumber = 1;
        }
        $request['kode_dmu'] = 'IS' . $runningNumber;

        $dmu->id_dmu =$request->id_dmu ;
        $dmu->id_subpengujian=$request->id_subpengujian;
        $dmu->id_user =$request->id_user ;
        $dmu->id_proyek =$request->id_proyek ;
        $dmu->revisi =$request->revisi ;
        $dmu->nama_dmu=$request->nama_dmu;
        $dmu->status=$request->status;

        $dmu->nama_dmu1=$request->nama_dmu1;
        $dmu->metode1=$request->metode1;
        $dmu->standar1=$request->standar1;
        $dmu->lokasi1=$request->lokasi1;
        $dmu->a1=$request->a1;
        $dmu->a2=$request->a2;
        $dmu->a3=$request->a3;
        $dmu->a4=$request->a4;
        $dmu->a5=$request->a5;
        $dmu->a6=$request->a6;
        $dmu->a7=$request->a7;
        $dmu->a8=$request->a8;
        $dmu->a9=$request->a9;
        $dmu->a10=$request->a10;
        $dmu->a11=$request->a11;
        $dmu->a12=$request->a12;

        $dmu->nama_dmu2=$request->nama_dmu2;
        $dmu->metode2=$request->metode2;
        $dmu->standar2=$request->standar2;
        $dmu->lokasi2=$request->lokasi2;
        $dmu->b1=$request->b1;
        $dmu->b2=$request->b2;
        $dmu->b3=$request->b3;
        $dmu->b4=$request->b4;
        $dmu->b5=$request->b5;
        $dmu->b6=$request->b6;
        $dmu->b7=$request->b7;
        $dmu->b8=$request->b8;
        $dmu->b9=$request->b9;
        $dmu->b10=$request->b10;
        $dmu->b11=$request->b11;
        $dmu->b12=$request->b12;

        $dmu->nama_dmu3=$request->nama_dmu3;
        $dmu->metode3=$request->metode3;
        $dmu->standar3=$request->standar3;
        $dmu->lokasi3=$request->lokasi3;
        $dmu->c1=$request->c1;
        $dmu->c2=$request->c2;
        $dmu->c3=$request->c3;
        $dmu->c4=$request->c4;
        $dmu->c5=$request->c5;
        $dmu->c6=$request->c6;
        $dmu->c7=$request->c7;
        $dmu->c8=$request->c8;
        $dmu->c9=$request->c9;
        $dmu->c10=$request->c10;
        $dmu->c11=$request->c11;
        $dmu->c12=$request->c12;

        $dmu->nama_dmu4=$request->nama_dmu4;
        $dmu->metode4=$request->metode4;
        $dmu->standar4=$request->standar4;
        $dmu->lokasi4=$request->lokasi4;
        $dmu->d1=$request->d1;
        $dmu->d2=$request->d2;
        $dmu->d3=$request->d3;
        $dmu->d4=$request->d4;
        $dmu->d5=$request->d5;
        $dmu->d6=$request->d6;
        $dmu->d7=$request->d7;
        $dmu->d8=$request->d8;
        $dmu->d9=$request->d9;
        $dmu->d10=$request->d10;
        $dmu->d11=$request->d11;
        $dmu->d12=$request->d12;

        $dmu->nama_dmu5=$request->nama_dmu5;
        $dmu->metode5=$request->metode5;
        $dmu->standar5=$request->standar5;
        $dmu->lokasi5=$request->lokasi5;
        $dmu->e1=$request->e1;
        $dmu->e2=$request->e2;
        $dmu->e3=$request->e3;
        $dmu->e4=$request->e4;
        $dmu->e5=$request->e5;
        $dmu->e6=$request->e6;
        $dmu->e7=$request->e7;
        $dmu->e8=$request->e8;
        $dmu->e9=$request->e9;
        $dmu->e10=$request->e10;
        $dmu->e11=$request->e11;
        $dmu->e12=$request->e12;

        $dmu->nama_dmu6=$request->nama_dmu6;
        $dmu->metode6=$request->metode6;
        $dmu->standar6=$request->standar6;
        $dmu->lokasi6=$request->lokasi6;
        $dmu->f1=$request->f1;
        $dmu->f2=$request->f2;
        $dmu->f3=$request->f3;
        $dmu->f4=$request->f4;
        $dmu->f5=$request->f5;
        $dmu->f6=$request->f6;
        $dmu->f7=$request->f7;
        $dmu->f8=$request->f8;
        $dmu->f9=$request->f9;
        $dmu->f10=$request->f10;
        $dmu->f11=$request->f11;
        $dmu->f12=$request->f12;

        $dmu->nama_dmu7=$request->nama_dmu7;
        $dmu->metode7=$request->metode7;
        $dmu->standar7=$request->standar7;
        $dmu->lokasi7=$request->lokasi7;
        $dmu->g1=$request->g1;
        $dmu->g2=$request->g2;
        $dmu->g3=$request->g3;
        $dmu->g4=$request->g4;
        $dmu->g5=$request->g5;
        $dmu->g6=$request->g6;
        $dmu->g7=$request->g7;
        $dmu->g8=$request->g8;
        $dmu->g9=$request->g9;
        $dmu->g10=$request->g10;
        $dmu->g11=$request->g11;
        $dmu->g12=$request->g12;

        $dmu->nama_dmu8=$request->nama_dmu8;
        $dmu->metode8=$request->metode8;
        $dmu->standar8=$request->standar8;
        $dmu->lokasi8=$request->lokasi8;
        $dmu->h1=$request->h1;
        $dmu->h2=$request->h2;
        $dmu->h3=$request->h3;
        $dmu->h4=$request->h4;
        $dmu->h5=$request->h5;
        $dmu->h6=$request->h6;
        $dmu->h7=$request->h7;
        $dmu->h8=$request->h8;
        $dmu->h9=$request->h9;
        $dmu->h10=$request->h10;
        $dmu->h11=$request->h11;
        $dmu->h12=$request->h12;

        $dmu->nama_dmu9=$request->nama_dmu9;
        $dmu->metode9=$request->metode9;
        $dmu->standar9=$request->standar9;
        $dmu->lokasi9=$request->lokasi9;
        $dmu->i1=$request->i1;
        $dmu->i2=$request->i2;
        $dmu->i3=$request->i3;
        $dmu->i4=$request->i4;
        $dmu->i5=$request->i5;
        $dmu->i6=$request->i6;
        $dmu->i7=$request->i7;
        $dmu->i8=$request->i8;
        $dmu->i9=$request->i9;
        $dmu->i10=$request->i10;
        $dmu->i11=$request->i11;
        $dmu->i12=$request->i12;

        $dmu->nama_dmu10=$request->nama_dmu10;
        $dmu->metode10=$request->metode10;
        $dmu->standar10=$request->standar10;
        $dmu->lokasi10=$request->lokasi10;
        $dmu->j1=$request->j1;
        $dmu->j2=$request->j2;
        $dmu->j3=$request->j3;
        $dmu->j4=$request->j4;
        $dmu->j5=$request->j5;
        $dmu->j6=$request->j6;
        $dmu->j7=$request->j7;
        $dmu->j8=$request->j8;
        $dmu->j9=$request->j9;
        $dmu->j10=$request->j10;
        $dmu->j11=$request->j11;
        $dmu->j12=$request->j12;

        $dmu->nama_dmu11=$request->nama_dmu11;
        $dmu->metode11=$request->metode11;
        $dmu->standar11=$request->standar11;
        $dmu->lokasi11=$request->lokasi11;
        $dmu->k1=$request->k1;
        $dmu->k2=$request->k2;
        $dmu->k3=$request->k3;
        $dmu->k4=$request->k4;
        $dmu->k5=$request->k5;
        $dmu->k6=$request->k6;
        $dmu->k7=$request->k7;
        $dmu->k8=$request->k8;
        $dmu->k9=$request->k9;
        $dmu->k10=$request->k10;
        $dmu->k11=$request->k11;
        $dmu->k12=$request->k12;

        $dmu->nama_dmu12=$request->nama_dmu12;
        $dmu->metode12=$request->metode12;
        $dmu->standar12=$request->standar12;
        $dmu->lokasi12=$request->lokasi12;
        $dmu->l1=$request->l1;
        $dmu->l2=$request->l2;
        $dmu->l3=$request->l3;
        $dmu->l4=$request->l4;
        $dmu->l5=$request->l5;
        $dmu->l6=$request->l6;
        $dmu->l7=$request->l7;
        $dmu->l8=$request->l8;
        $dmu->l9=$request->l9;
        $dmu->l10=$request->l10;
        $dmu->l11=$request->l11;
        $dmu->l12=$request->l12;

        $dmu->nama_dmu13=$request->nama_dmu13;
        $dmu->metode13=$request->metode13;
        $dmu->standar13=$request->standar13;
        $dmu->lokasi13=$request->lokasi13;
        $dmu->m1=$request->m1;
        $dmu->m2=$request->m2;
        $dmu->m3=$request->m3;
        $dmu->m4=$request->m4;
        $dmu->m5=$request->m5;
        $dmu->m6=$request->m6;
        $dmu->m7=$request->m7;
        $dmu->m8=$request->m8;
        $dmu->m9=$request->m9;
        $dmu->m10=$request->m10;
        $dmu->m11=$request->m11;
        $dmu->m12=$request->m12;

        $dmu->nama_dmu14=$request->nama_dmu14;
        $dmu->metode14=$request->metode14;
        $dmu->standar14=$request->standar14;
        $dmu->lokasi14=$request->lokasi14;
        $dmu->n1=$request->n1;
        $dmu->n2=$request->n2;
        $dmu->n3=$request->n3;
        $dmu->n4=$request->n4;
        $dmu->n5=$request->n5;
        $dmu->n6=$request->n6;
        $dmu->n7=$request->n7;
        $dmu->n8=$request->n8;
        $dmu->n9=$request->n9;
        $dmu->n10=$request->n10;
        $dmu->n11=$request->n11;
        $dmu->n12=$request->n12;


        $dmu->foto1=$foto1Name;
        $dmu->foto2=$foto2Name;
        $dmu->foto3=$foto3Name;
        $dmu->foto4=$foto4Name;
        $dmu->foto5=$foto5Name;
        $dmu->foto6=$foto6Name;
        $dmu->foto7=$foto7Name;
        $dmu->foto8=$foto8Name;
        $dmu->foto9=$foto9Name;
        $dmu->foto10=$foto10Name;
        $dmu->foto11=$foto11Name;
        $dmu->foto12=$foto12Name;
        $dmu->foto13=$foto13Name;
        $dmu->foto14=$foto14Name;
 
        $dmu->save();
//[--------------------------------------------------------------------------------------------------------------]
  //      $dmu = Dmu::create($request->all());
        return redirect()->route('dmu.index');
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

   
    public function storess(Request $request)
    {
        $dmu = new Dmu();

        $dmu = Dmu::latest('id_dmu')->first();
    
        if ($dmu) {
            $runningNumber = (int)substr($dmu->kode_dmu, 2) + 1;
        } else {
            $runningNumber = 1;
        }
        $request['kode_dmu'] = 'IS' . $runningNumber;

        $dmu->id_dmu =$request->id_dmu ;
        $dmu->id_subpengujian=$request->id_subpengujian;
        $dmu->id_user =$request->id_user ;
        $dmu->id_proyek =$request->id_proyek ;
        $dmu->revisi=$request->revisi;
        $dmu->nama_dmu=$request->nama_dmu;
        $dmu->nama_dmu1=$request->nama_dmu1;
        $dmu->metode1=$request->metode1;
        $dmu->standar1=$request->standar1;
        $dmu->lokasi1=$request->lokasi1;
        $dmu->a1=$request->a1;
        $dmu->a2=$request->a2;
        $dmu->a3=$request->a3;
        $dmu->a4=$request->a4;
        $dmu->a5=$request->a5;
        $dmu->a6=$request->a6;
        $dmu->a7=$request->a7;
        $dmu->a8=$request->a8;
        $dmu->a9=$request->a9;
        $dmu->a10=$request->a10;
        $dmu->a11=$request->a11;
        $dmu->a12=$request->a12;
        $dmu->nama_dmu2=$request->nama_dmu2;
        $dmu->metode2=$request->metode2;
        $dmu->standar2=$request->standar2;
        $dmu->lokasi2=$request->lokasi2;
        $dmu->b1=$request->b1;
        $dmu->b2=$request->b2;
        $dmu->b3=$request->b3;
        $dmu->b4=$request->b4;
        $dmu->b5=$request->b5;
        $dmu->b6=$request->b6;
        $dmu->b7=$request->b7;
        $dmu->b8=$request->b8;
        $dmu->b9=$request->b9;
        $dmu->b10=$request->b10;
        $dmu->b11=$request->b11;
        $dmu->b12=$request->b12;
        $dmu->nama_dmu3=$request->nama_dmu3;
        $dmu->metode3=$request->metode3;
        $dmu->standar3=$request->standar3;
        $dmu->lokasi3=$request->lokasi3;
        $dmu->c1=$request->c1;
        $dmu->c2=$request->c2;
        $dmu->c3=$request->c3;
        $dmu->c4=$request->c4;
        $dmu->c5=$request->c5;
        $dmu->c6=$request->c6;
        $dmu->c7=$request->c7;
        $dmu->c8=$request->c8;
        $dmu->c9=$request->c9;
        $dmu->c10=$request->c10;
        $dmu->c11=$request->c11;
        $dmu->c12=$request->c12;
        $dmu->nama_dmu4=$request->nama_dmu4;
        $dmu->metode4=$request->metode4;
        $dmu->standar4=$request->standar4;
        $dmu->lokasi4=$request->lokasi4;
        $dmu->d1=$request->d1;
        $dmu->d2=$request->d2;
        $dmu->d3=$request->d3;
        $dmu->d4=$request->d4;
        $dmu->d5=$request->d5;
        $dmu->d6=$request->d6;
        $dmu->d7=$request->d7;
        $dmu->d8=$request->d8;
        $dmu->d9=$request->d9;
        $dmu->d10=$request->d10;
        $dmu->d11=$request->d11;
        $dmu->d12=$request->d12;
        $dmu->nama_dmu5=$request->nama_dmu5;
        $dmu->metode5=$request->metode5;
        $dmu->standar5=$request->standar5;
        $dmu->lokasi5=$request->lokasi5;
        $dmu->e1=$request->e1;
        $dmu->e2=$request->e2;
        $dmu->e3=$request->e3;
        $dmu->e4=$request->e4;
        $dmu->e5=$request->e5;
        $dmu->e6=$request->e6;
        $dmu->e7=$request->e7;
        $dmu->e8=$request->e8;
        $dmu->e9=$request->e9;
        $dmu->e10=$request->e10;
        $dmu->e11=$request->e11;
        $dmu->e12=$request->e12;
        $dmu->nama_dmu6=$request->nama_dmu6;
        $dmu->metode6=$request->metode6;
        $dmu->standar6=$request->standar6;
        $dmu->lokasi6=$request->lokasi6;
        $dmu->f1=$request->f1;
        $dmu->f2=$request->f2;
        $dmu->f3=$request->f3;
        $dmu->f4=$request->f4;
        $dmu->f5=$request->f5;
        $dmu->f6=$request->f6;
        $dmu->f7=$request->f7;
        $dmu->f8=$request->f8;
        $dmu->f9=$request->f9;
        $dmu->f10=$request->f10;
        $dmu->f11=$request->f11;
        $dmu->f12=$request->f12;
        $dmu->nama_dmu7=$request->nama_dmu7;
        $dmu->metode7=$request->metode7;
        $dmu->standar7=$request->standar7;
        $dmu->lokasi7=$request->lokasi7;
        $dmu->g1=$request->g1;
        $dmu->g2=$request->g2;
        $dmu->g3=$request->g3;
        $dmu->g4=$request->g4;
        $dmu->g5=$request->g5;
        $dmu->g6=$request->g6;
        $dmu->g7=$request->g7;
        $dmu->g8=$request->g8;
        $dmu->g9=$request->g9;
        $dmu->g10=$request->g10;
        $dmu->g11=$request->g11;
        $dmu->g12=$request->g12;
        $dmu->nama_dmu8=$request->nama_dmu8;
        $dmu->metode8=$request->metode8;
        $dmu->standar8=$request->standar8;
        $dmu->lokasi8=$request->lokasi8;
        $dmu->h1=$request->h1;
        $dmu->h2=$request->h2;
        $dmu->h3=$request->h3;
        $dmu->h4=$request->h4;
        $dmu->h5=$request->h5;
        $dmu->h6=$request->h6;
        $dmu->h7=$request->h7;
        $dmu->h8=$request->h8;
        $dmu->h9=$request->h9;
        $dmu->h10=$request->h10;
        $dmu->h11=$request->h11;
        $dmu->h12=$request->h12;
        $dmu->nama_dmu9=$request->nama_dmu9;
        $dmu->metode9=$request->metode9;
        $dmu->standar9=$request->standar9;
        $dmu->lokasi9=$request->lokasi9;
        $dmu->i1=$request->i1;
        $dmu->i2=$request->i2;
        $dmu->i3=$request->i3;
        $dmu->i4=$request->i4;
        $dmu->i5=$request->i5;
        $dmu->i6=$request->i6;
        $dmu->i7=$request->i7;
        $dmu->i8=$request->i8;
        $dmu->i9=$request->i9;
        $dmu->i10=$request->i10;
        $dmu->i11=$request->i11;
        $dmu->i12=$request->i12;
        $dmu->nama_dmu10=$request->nama_dmu10;
        $dmu->metode10=$request->metode10;
        $dmu->standar10=$request->standar10;
        $dmu->lokasi10=$request->lokasi10;
        $dmu->j1=$request->j1;
        $dmu->j2=$request->j2;
        $dmu->j3=$request->j3;
        $dmu->j4=$request->j4;
        $dmu->j5=$request->j5;
        $dmu->j6=$request->j6;
        $dmu->j7=$request->j7;
        $dmu->j8=$request->j8;
        $dmu->j9=$request->j9;
        $dmu->j10=$request->j10;
        $dmu->j11=$request->j11;
        $dmu->j12=$request->j12;
        $dmu->nama_dmu11=$request->nama_dmu11;
        $dmu->metode11=$request->metode11;
        $dmu->standar11=$request->standar11;
        $dmu->lokasi11=$request->lokasi11;
        $dmu->k1=$request->k1;
        $dmu->k2=$request->k2;
        $dmu->k3=$request->k3;
        $dmu->k4=$request->k4;
        $dmu->k5=$request->k5;
        $dmu->k6=$request->k6;
        $dmu->k7=$request->k7;
        $dmu->k8=$request->k8;
        $dmu->k9=$request->k9;
        $dmu->k10=$request->k10;
        $dmu->k11=$request->k11;
        $dmu->k12=$request->k12;
        $dmu->nama_dmu12=$request->nama_dmu12;
        $dmu->metode12=$request->metode12;
        $dmu->standar12=$request->standar12;
        $dmu->lokasi12=$request->lokasi12;
        $dmu->l1=$request->l1;
        $dmu->l2=$request->l2;
        $dmu->l3=$request->l3;
        $dmu->l4=$request->l4;
        $dmu->l5=$request->l5;
        $dmu->l6=$request->l6;
        $dmu->l7=$request->l7;
        $dmu->l8=$request->l8;
        $dmu->l9=$request->l9;
        $dmu->l10=$request->l10;
        $dmu->l11=$request->l11;
        $dmu->l12=$request->l12;
        $dmu->nama_dmu13=$request->nama_dmu13;
        $dmu->metode13=$request->metode13;
        $dmu->standar13=$request->standar13;
        $dmu->lokasi13=$request->lokasi13;
        $dmu->m1=$request->m1;
        $dmu->m2=$request->m2;
        $dmu->m3=$request->m3;
        $dmu->m4=$request->m4;
        $dmu->m5=$request->m5;
        $dmu->m6=$request->m6;
        $dmu->m7=$request->m7;
        $dmu->m8=$request->m8;
        $dmu->m9=$request->m9;
        $dmu->m10=$request->m10;
        $dmu->m11=$request->m11;
        $dmu->m12=$request->m12;
        $dmu->nama_dmu14=$request->nama_dmu14;
        $dmu->metode14=$request->metode14;
        $dmu->standar14=$request->standar14;
        $dmu->lokasi14=$request->lokasi14;
        $dmu->n1=$request->n1;
        $dmu->n2=$request->n2;
        $dmu->n3=$request->n3;
        $dmu->n4=$request->n4;
        $dmu->n5=$request->n5;
        $dmu->n6=$request->n6;
        $dmu->n7=$request->n7;
        $dmu->n8=$request->n8;
        $dmu->n9=$request->n9;
        $dmu->n10=$request->n10;
        $dmu->n11=$request->n11;
        $dmu->n12=$request->n12;
        $dmu->harga_beli=$request->harga_beli;
        $dmu->jumlah=$request->jumlah;
        $dmu->stock=$request->stock;
        $dmu->created_at=$request->created_at;
        $dmu->updated_at=$request->updated_at;


        if ($request->hasFile('foto1')) {
            $file = $request->file('foto1');
            $nama = 'f1-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $nama);
            $request['foto1'] = "/img/$nama";


        }

        if ($request->hasFile('foto2')) {
            $file = $request->file('foto2');
            $nama = 'f2-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $request['foto2'] = "/img/$nama";
        }

        if ($request->hasFile('foto3')) {
            $file = $request->file('foto3');
            $nama = 'f3-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto3'] = "/img/$nama";
        }

        if ($request->hasFile('foto4')) {
            $file = $request->file('foto4');
            $nama = 'f4-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto4'] = "/img/$nama";
        }

        if ($request->hasFile('foto5')) {
            $file = $request->file('foto5');
            $nama = 'f5-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto5'] = "/img/$nama";
        }

        if ($request->hasFile('foto6')) {
            $file = $request->file('foto6');
            $nama = 'f6-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto6'] = "/img/$nama";
        }

        if ($request->hasFile('foto7')) {
            $file = $request->file('foto7');
            $nama = 'f7-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto7'] = "/img/$nama";
        }

        if ($request->hasFile('foto8')) {
            $file = $request->file('foto8');
            $nama = 'f8-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto8'] = "/img/$nama";
        }

        if ($request->hasFile('foto9')) {
            $file = $request->file('foto9');
            $nama = 'f9-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto9'] = "/img/$nama";
        }

        if ($request->hasFile('foto10')) {
            $file = $request->file('foto10');
            $nama = 'f10-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto10'] = "/img/$nama";
        }

        if ($request->hasFile('foto11')) {
            $file = $request->file('foto11');
            $nama = 'f11-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto11'] = "/img/$nama";
        }

        if ($request->hasFile('foto12')) {
            $file = $request->file('foto12');
            $nama = 'f12-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto12'] = "/img/$nama";
        }

        if ($request->hasFile('foto13')) {
            $file = $request->file('foto13');
            $nama = 'f13-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto13'] = "/img/$nama";
        }

        if ($request->hasFile('foto14')) {
            $file = $request->file('foto14');
            $nama = 'f14-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);
        
            $request['foto14'] = "/img/$nama";
        }

        $dmu = Dmu::create($request->all());
        $dmu->save();

        return redirect()->route('dmu.index');
    }
    
    public function showNew()
    {
      
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request, $id)
    {
        $dmu = Dmu::find($id);

        if (!$dmu) {
            return response()->json('Data DMU tidak ditemukan', 404);
        }

        $nilairev = $dmu->revisi;

        // Definisikan urutan revisi
        $urutanRevisi = ['Rev.0', 'Rev.A', 'Rev.B', 'Rev.C', 'Rev.D', 'Rev.E', 'Rev.F', 'Rev.G', 'Rev.H', 'Rev.I', 'Rev.J'];

        // Cari indeks revisi saat ini
        $indeksRevisi = array_search($nilairev, $urutanRevisi);

        // Perbarui revisi sesuai dengan indeks berikutnya
        $indeksRevisi++;

        // Jika sudah melebihi jumlah revisi yang didefinisikan, kembalikan ke 'Rev.0'
        if ($indeksRevisi >= count($urutanRevisi)) {
            $indeksRevisi = 0;
        }

        // Tentukan revisi yang baru
        $inputrev = $urutanRevisi[$indeksRevisi];

        // Perbarui revisi di dalam database
        $dmu->revisi = $inputrev;
        $dmu->save();

        return view('dmu.index', compact('dmu'));
    }

    public function timpaFoto($fotoLamaPath, $fileBaru)
    {
        // Hapus foto lama jika ada (opsional)
        if ($fotoLamaPath && Storage::exists($fotoLamaPath)) {
            Storage::delete($fotoLamaPath);
        }

        // Simpan foto baru dan dapatkan path barunya
        $pathBaru = $fileBaru->store('/img'); // Ganti 'direktori_tujuan' dengan direktori penyimpanan foto yang diinginkan

        return $pathBaru;
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

        if ($request->hasFile('foto1')) {
            $fileBaru = $request->file('foto1');
            $request['foto1'] = $this->timpaFoto($dmu->foto1, $fileBaru); // Ganti 'foto1' dengan nama field yang menyimpan path foto1 pada entitas Anda
        }

        if ($request->hasFile('foto1')) {
            $file = $request->file('foto1');
            $nama = 'f1-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $nama); // Move the file to the public/img directory
            $dmu->foto1 = "/img/$nama"; // Save the path in the databas
            $dmu->save();
        }

        if ($request->hasFile('foto3')) {
            $file = $request->file('foto3');
            $nama = 'f3-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $nama); // Move the file to the public/img directory
            $dmu->foto3 = "/img/$nama"; // Save the path in the databas
            $dmu->save();
        }


        $dmu->save();
        $dmu->update($request->all());
        return redirect()->route('dmu.index')->with('Data berhasil disimpan');
    }
    
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatex(Request $request, $id)
    {

        $dmu = Dmu::find($id);

        $subsistem = Subsistem::all()->pluck('nama_subsistem', 'id_subsistem');
        
        // Cek apakah data Dmu dengan id yang diberikan ditemukan
        if ($dmu) {
            $nilairev = $dmu->revisi;
        
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
                $inputrev = 'Rev.H';
            } elseif ($nilairev === 'Rev.H') {
                $inputrev = 'Rev.I';
            } elseif ($nilairev === 'Rev.I') {
                $inputrev = 'Rev.J';
            } else {
                $inputrev = '0';
            }

            $dmu->revisi = $inputrev;
            $dmu->update($request->all());
        
        return redirect()->route('dmu.index',compact('subsistem'))->with('success', 'Data berhasil disimpan');
        } 
    }

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

    public function excel()
        {
            $dmu = Dmu::all();
            return Excel::download(new DmuExport($dmu), 'nama_file_excel.xlsx');
        }
}

