@extends('layouts.master')

@section('title')
Buat Form Check Sheet Final EMU / DMU Baru
@endsection

@section('breadcrumb')
    @parent
    <li class="active">uat Form Check Sheet Final EMU / DMU Baru</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <form action="{{ route('dmu.store') }}" method="post" class="form-form1" data-toggle="validator" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="alert alert-info alert-dismissible" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-check"></i> Perubahan berhasil disimpan
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 control-label">Status</label> 
                        <div class="col-lg-6">
                            <input value="Waiting" name="status" id="status" class="form-control" required autofocus readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="revisi" class="col-lg-2 col-lg-offset-1 control-label">Revisi</label> 
                        <div class="col-lg-6">
                            <input value="Rev.0" name="revisi" id="revisi" class="form-control" required autofocus readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_subpengujian" class="col-lg-2 col-lg-offset-1 control-label">Pengujian</label>
                        <div class="col-lg-6">
                            <select name="id_subpengujian" id="id_subpengujian" class="form-control" required autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subpengujian as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_proyek" class="col-lg-2 col-lg-offset-1 control-label">Proyek</label>
                        <div class="col-lg-6">
                            <select name="id_proyek" id="id_proyek" class="form-control" required autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($proyek as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu" class="col-lg-2 col-lg-offset-1 control-label">Nama Sistem</label> 
                        <div class="col-lg-6">
                        <select name="nama_dmu" id="nama_dmu" class="form-control" required autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($sistem as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                <span class="help-block with-errors"></span>
                                @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_user" class="col-lg-2 col-lg-offset-1 control-label">ID Pembuat</label>
                        <div class="col-lg-6">
                            <input type="text" name="id_user" id="id_user" value="{{auth()->id()}}" class="form-control" readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <br>
                    </div>

                    <div class="form-group row">
                        <label for="nama_dmu1" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 1</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu1" id="nama_dmu1" class="form-control" required autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                <span class="help-block with-errors"></span>
                                @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto1" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 1</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto1" class="form-control" id="foto1" onchange="previewImage('.tampil-ft1', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft1"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode1" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode1" id="metode1" class="form-control" required autofocus>
                            </textarea>  Maximum : 200 Karakter                        
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar1" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar1" id="standar1" class="form-control" required autofocus>
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi1" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi1" id="lokasi1" class="form-control" required autofocus>Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="a1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="a1" id="a1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="a2" id="a2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="a3" id="a3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="a4" id="a4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="a5" id="a5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="a6" id="a6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="a7" id="a7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="a8" id="a8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="a9" id="a9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="a10" id="a10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="a11" id="a11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="a12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="a12" id="a12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_1">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu2" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 2</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu2" id="nama_dmu2" class="form-control" autofocus>
                                <option value=""></option autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                                <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto2" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 2</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto2" class="form-control" id="foto2" onchange="previewImage('.tampil-ft2', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft2"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode2" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode2" id="metode2" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar2" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar2" id="standar2" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi2" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi2" id="lokasi2" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="b1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="b1" id="b1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="b2" id="b2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="b3" id="b3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="b4" id="b4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="b5" id="b5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="b6" id="b6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="b7" id="b7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="b8" id="b8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="b9" id="b9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="b10" id="b10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="b11" id="b11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="b12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="b12" id="b12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_2">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu3" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 3</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu3" id="nama_dmu3" class="form-control" autofocus>
                                <option value=""></option  autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                                <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto3" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 3</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto3" class="form-control" id="foto3" onchange="previewImage('.tampil-ft3', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft3"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode3" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode3" id="metode3" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar3" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar3" id="standar3" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi3" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi3" id="lokasi3" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="c1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="c1" id="c1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="c2" id="c2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="c3" id="c3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="c4" id="c4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="c5" id="c5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="c6" id="c6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="c7" id="c7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="c8" id="c8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="c9" id="c9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="c10" id="c10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="c11" id="c11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="c12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="c12" id="c12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_3">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>


<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu4" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 4</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu4" id="nama_dmu4" class="form-control"  autofocus>
                                <option value=""></option  autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                                <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto4" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 4</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto4" class="form-control" id="foto4" onchange="previewImage('.tampil-ft4', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft4"></div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="metode4" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode4" id="metode4" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar4" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar4" id="standar4" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi4" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi4" id="lokasi4" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="d1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="d1" id="d1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="d2" id="d2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="d3" id="d3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="d4" id="d4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="d5" id="d5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="d6" id="d6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="d7" id="d7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="d8" id="d8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="d9" id="d9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="d10" id="d10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="d11" id="d11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="d12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="d12" id="d12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_4">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu5" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 5</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu5" id="nama_dmu5" class="form-control" autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                        <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto5" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 5</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto5" class="form-control" id="foto5" onchange="previewImage('.tampil-ft5', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft5"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode5" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode5" id="metode5" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar5" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar5" id="standar5" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi5" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi5" id="lokasi5" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="e1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="e1" id="e1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="e2" id="e2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="e3" id="e3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="e4" id="e4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="e5" id="e5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="e6" id="e6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="e7" id="e7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="e8" id="e8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="e9" id="e9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="e10" id="e10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="e11" id="e11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="e12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="e12" id="e12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_5">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu6" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 6</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu6" id="nama_dmu6" class="form-control" autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                        <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="6" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 6</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto6" class="form-control" id="foto6" onchange="previewImage('.tampil-ft6', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft6"></div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="metode6" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode6" id="metode6" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar6" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar6" id="standar6" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi6" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi6" id="lokasi6" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="f1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="f1" id="f1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="f2" id="f2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="f3" id="f3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="f4" id="f4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="f5" id="f5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="f6" id="f6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="f7" id="f7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="f8" id="f8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="f9" id="f9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="f10" id="f10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="f11" id="f11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="f12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="f12" id="f12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_6">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu7" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 7</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu7" id="nama_dmu7" class="form-control" autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                        <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto7" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 7</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto7" class="form-control" id="foto7" onchange="previewImage('.tampil-ft7', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft7"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode7" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode7" id="metode7" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar7" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar7" id="standar7" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi7" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi7" id="lokasi7" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="g1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="g1" id="g1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="g2" id="g2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="g3" id="g3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="g4" id="g4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="g5" id="g5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="g6" id="g6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="g7" id="g7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="g8" id="g8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="g9" id="g9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="g10" id="g10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="g11" id="g11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="g12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="g12" id="g12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_7">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu8" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 8</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu8" id="nama_dmu8" class="form-control" autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                        <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto8" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 8</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto8" class="form-control" id="foto8" onchange="previewImage('.tampil-ft8', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft8"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode8" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode8" id="metode8" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar8" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar8" id="standar8" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi8" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi8" id="lokasi8" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="h1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="h1" id="h1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="h2" id="h2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="h3" id="h3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="h4" id="h4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="h5" id="h5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="h6" id="h6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="h7" id="h7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="h8" id="h8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="h9" id="h9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="h10" id="h10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="h11" id="h11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="h12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="h12" id="h12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_8">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu9" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 9</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu9" id="nama_dmu9" class="form-control" autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                        <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto9" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 9</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto9" class="form-control" id="foto9" onchange="previewImage('.tampil-ft9', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft9"></div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="metode9" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode9" id="metode9" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar9" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar9" id="standar9" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi9" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi9" id="lokasi9" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="i1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="i1" id="i1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="i2" id="i2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="i3" id="i3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="i4" id="i4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="i5" id="i5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="i6" id="i6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="i7" id="i7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="i8" id="i8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="i9" id="i9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="i10" id="i10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="i11" id="i11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="i12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="i12" id="i12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_9">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu10" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 10</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu10" id="nama_dmu10" class="form-control" autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                        <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto10" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 10</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto10" class="form-control" id="foto10" onchange="previewImage('.tampil-ft10', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft10"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode10" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode10" id="metode10" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar10" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar10" id="standar10" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi10" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi10" id="lokasi10" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="j1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="j1" id="j1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="j2" id="j2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="j3" id="j3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="j4" id="j4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="j5" id="j5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="j6" id="j6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="j7" id="j7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="j8" id="j8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="j9" id="j9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="j10" id="j10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="j11" id="j11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="j12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="j12" id="j12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_10">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu11" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 11</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu11" id="nama_dmu11" class="form-control" autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                        <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto11" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 11</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto11" class="form-control" id="foto11" onchange="previewImage('.tampil-ft11', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft11"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode11" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode11" id="metode11" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar11" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar11" id="standar11" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi11" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi11" id="lokasi11" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="k1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="k1" id="k1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="k2" id="k2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="k3" id="k3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="k4" id="k4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="k5" id="k5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="k6" id="k6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="k7" id="k7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="k8" id="k8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="k9" id="k9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="k10" id="k10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="k11" id="k11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="k12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="k12" id="k12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_11">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu12" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 12</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu12" id="nama_dmu12" class="form-control" autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                        <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto12" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 12</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto12" class="form-control" id="foto12" onchange="previewImage('.tampil-ft12', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft12"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode12" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode12" id="metode12" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar12" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar12" id="standar12" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi12" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi12" id="lokasi12" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="l1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="l1" id="l1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="l2" id="l2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="l3" id="l3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="l4" id="l4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="l5" id="l5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="l6" id="l6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="l7" id="l7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="l8" id="l8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="l9" id="l9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="l10" id="l10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="l11" id="l11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="l12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="l12" id="l12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_12">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu13" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 13</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu13" id="nama_dmu13" class="form-control" autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                        <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto13" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 13</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto13" class="form-control" id="foto13" onchange="previewImage('.tampil-ft13', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft13"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode13" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode13" id="metode13" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar13" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar13" id="standar13" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi13" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi13" id="lokasi13" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="m1" id="m1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="m2" id="m2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="m3" id="m3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="m4" id="m4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="m5" id="m5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="m6" id="m6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="m7" id="m7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="m8" id="m8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="m9" id="m9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="m10" id="m10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="m11" id="m11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="m12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="m12" id="m12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_13">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>


<!---------------------------------------------------------------------------------------------------------------------------------------- -->

<div class="form-group row">
                        <br>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dmu14" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 14</label>
                        <div class="col-lg-6">
                        <select name="nama_dmu14" id="nama_dmu14" class="form-control" autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($subsistem as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                        <span class="help-block with-errors"></span>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto14" class="col-lg-2 col-lg-offset-1 control-label">Gambar Sub Sistem 14</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto14" class="form-control" id="foto14" onchange="previewImage('.tampil-ft14', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-ft14"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="metode14" class="col-lg-2 col-lg-offset-1 control-label">Detail Pengujian</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="metode14" id="metode14" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="standar14" class="col-lg-2 col-lg-offset-1 control-label">Standard</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="standar14" id="standar14" class="form-control">
                            </textarea> Maximum : 200 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi14" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" name="lokasi14" id="lokasi14" class="form-control">Maximum : 60 Karakter
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="n1" class="col-lg-1 control-label">M1</label>
                        <div class="col-lg-2">   
                            <select name="n1" id="n1" class="form-control">
                                        <option value=""></option>
                                        <option value="M1_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n2" class="col-lg-1 control-label">M2</label>
                        <div class="col-lg-2">   
                            <select name="n2" id="n2" class="form-control">
                                        <option value=""></option>
                                        <option value="M2_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n3" class="col-lg-1 control-label">Mc1</label>
                        <div class="col-lg-2">   
                            <select name="n3" id="n3" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc1_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n4" class="col-lg-1 control-label">Mc2</label>
                        <div class="col-lg-2">   
                            <select name="n4" id="n4" class="form-control">
                                        <option value=""></option>
                                        <option value="Mc2_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n5" class="col-lg-1 control-label">T1</label>
                        <div class="col-lg-2">   
                            <select name="n5" id="n5" class="form-control">
                                        <option value=""></option>
                                        <option value="T1_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n6" class="col-lg-1 control-label">T2</label>
                        <div class="col-lg-2">   
                            <select name="n6" id="n6" class="form-control">
                                        <option value=""></option>
                                        <option value="T2_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n7" class="col-lg-1 control-label">T3</label>
                        <div class="col-lg-2">   
                            <select name="n7" id="n7" class="form-control">
                                        <option value=""></option>
                                        <option value="T3_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n8" class="col-lg-1 control-label">T4</label>
                        <div class="col-lg-2">   
                            <select name="n8" id="n8" class="form-control">
                                        <option value=""></option>
                                        <option value="T4_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n9" class="col-lg-1 control-label">Tc1</label>
                        <div class="col-lg-2">   
                            <select name="n9" id="n9" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc1_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n10" class="col-lg-1 control-label">Tc2</label>
                        <div class="col-lg-2">   
                            <select name="n10" id="n10" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc2_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n11" class="col-lg-1 control-label">Tc3</label>
                        <div class="col-lg-2">   
                            <select name="n11" id="n11" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc3_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="n12" class="col-lg-1 control-label">Tc4</label>
                        <div class="col-lg-2">   
                            <select name="n12" id="n12" class="form-control">
                                        <option value=""></option>
                                        <option value="Tc4_14">ADA</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="box-footer text-right">
                    <button class="btn btn-sm btn-flat btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
<!---------------------------------------------------------------------------------------------------------------------------------------- -->
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        showData();

        $('.form-form1').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.ajax({
                    url: $('.form-form1').attr('action'),
                    type: $('.form-form1').attr('method'),
                    data: new FormData($('.form-form1')[0]),
                    async: false,
                    processData: false,
                    contentType: false
                })
                .done(response => {
                    showData();
                    $('.alert').fadeIn();

                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 3000);
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
            }
        });
    });


    $(document).ready(function () {
        // Saat halaman dimuat, sembunyikan semua elemen tampil-foto kecuali yang pertama
        $('[id^="tampil-foto"]').hide();
        
        // Tampilkan preview foto saat pengguna memilih gambar pada input file
        $('.foto-input').change(function () {
            var id = $(this).attr('id');
            var targetElement = '#tampil-' + id;
            previewImage(targetElement, this.files[0], 300);
        });
    });

    function previewImage(targetElement, file, maxFileSize) {
        if (file && file.type.match('image.*')) {
            var reader = new FileReader();

            reader.onload = function (event) {
                if (file.size > maxFileSize * 1024) {
                    alert('Ukuran gambar terlalu besar. Maksimal ukuran gambar adalah ' + maxFileSize + ' KB.');
                } else {
                    $(targetElement).html('<img src="' + event.target.result + '" class="img-thumbnail" width="200" alt="Preview Gambar">');
                    $(targetElement).show();
                }
            };

            reader.readAsDataURL(file);
        } else {
            $(targetElement).html('');
            $(targetElement).hide();
        }
    }


    function preview(selector, file, maxWidth) {
    if (file) {
        let reader = new FileReader();

        reader.onload = function(e) {
            let img = new Image();

            img.onload = function() {
                let canvas = document.createElement("canvas");
                let ctx = canvas.getContext("2d");

                let width = img.width;
                let height = img.height;

                if (width > maxWidth) {
                    height *= maxWidth / width;
                    width = maxWidth;
                }

                canvas.width = width;
                canvas.height = height;

                ctx.drawImage(img, 0, 0, width, height);

                let previewDiv = document.querySelector(selector);
                previewDiv.innerHTML = "";
                previewDiv.appendChild(canvas);
            };

            img.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
}


    
    function showData() {
        $.get('{{ route('dmu.showNew') }}')
            .done(response => {
                $('[name=nama_perusahaan]').val(response.nama_perusahaan);
                $('[name=telepon]').val(response.telepon);
                $('[name=alamat]').val(response.alamat);
                $('[name=diskon]').val(response.diskon);
                $('[name=tipe_nota]').val(response.tipe_nota);
                $('title').text('Check Sheet Commisioning');
                
                let words = response.nama_perusahaan.split(' ');
                let word  = '';
                words.forEach(w => {
                    word += w.charAt(0);
                });
                $('.logo-mini').text(word);
                $('.logo-lg').text(response.nama_perusahaan);

                $('.tampil-logo').html(`<img src="{{ url('/') }}${response.path_logo}" width="200">`);
                $('.tampil-logo2').html(`<img src="{{ url('/') }}${response.path_logo}" width="200">`);
                $('.tampil-kartu-member').html(`<img src="{{ url('/') }}${response.path_kartu_member}" width="300">`);
                $('[rel=icon]').attr('href', `{{ url('/') }}/${response.path_logo}`);
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }



</script>
@endpush