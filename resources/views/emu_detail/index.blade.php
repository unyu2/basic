@extends('layouts.master')

@section('title')
    Transaksi Pengujian
@endsection

@push('css')
<style>
    .tampil-bayar {
        font-size: 5em;
        text-align: center;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }

    .table-emu tbody tr:last-child {
        display: none;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
</style>
@endpush

@section('breadcrumb')
    @parent
    <li class="active">Transaksi Pengujian</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
      <!--          <table>
                    <tr>
                        <td>Kode</td>
                        <td>: {{ $dmu->kode_dmu }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $dmu->nama_dmu }}</td>
                    </tr>
                    <tr>
                        <td>proyek</td>
                        <td>: {{ $dmu->id_proyek }}</td>
                    </tr>
                </table> -->


            </div>
            <div class="box-body">
                    
                <form class="form-produk">
                    @csrf
                    <div class="form-group row">
                        <label for="kode_produk" class="col-lg-2">Pilih Komponen Rusak</label>
                        <div class="col-lg-5"> <a>Hanya di isi apabila terdapat komponen rusak </a>
                            <div class="input-group">
                                <input type="hidden" name="id_emu" id="id_emu" value="{{ $id_emu }}">
                                <input type="hidden" name="id_produk" id="id_produk">
                                <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                                <span class="input-group-btn">
                                    <button onclick="tampilProduk()" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button> 
                                </span>
                            </div>
                        </div>
                    </div>
                </form>

                <table class="table table-stiped table-bordered table-emu">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th width="15%">Jumlah</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>

                <div class="row">
                    <div class="col-lg-10">
                        <form action="{{ route('emu.store') }}" class="form-emu" method="post">
                            @csrf
                            <input type="hidden" name="id_emu" value="{{ $id_emu }}">
                            <input type="hidden" name="total" id="total">
                            <input type="hidden" name="total_item" id="total_item">
                            <input type="hidden" name="bayar" id="bayar">

                            <br>
                            <br>

                            <div class="form-group row">
                            <label for="id_car" class="col-lg-1 control-label">Trainset</label>
                                <div class="col-lg-5">
                                     <select  name="id_car" id="id_car" class="form-control" required autofocus>
                                     @foreach ($x3 as $key => $item)
                                     <option value="" ></option>
                                     <option>{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                                </div>
                         <!--   <label for="id_proyek" class="col-lg-1 control-label">Proyek</label> -->
                                <div type="hidden" class="col-lg-1">
                                     <input type="hidden" value="{{ $dmu->id_proyek }}"  name="id_proyek" id="id_proyek" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                                </div>
                        <!--        <label type="hidden" for="id_subpengujian" class="col-lg-1 control-label">pengujian</label> -->
                                <div class="col-lg-1">
                                    <input type="hidden" id="id_subpengujian" name="id_subpengujian" class="form-control" value="{{ $dmu->id_subpengujian }}" readonly>
                                </div>
                        <!--        <label for="status" class="col-lg-1 control-label">Status</label> -->
                                <div class="col-lg-1">
                                <input type="hidden" value="waiting" name="status" id="status" class="form-control" readonly>
                                </div>
                            </div>
                            <br>
                            
                            <div class="form-group row">
                                <label for="nama_dmu1" class="col-lg-1 control-label">Pengujian 1</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu1" name="nama_dmu1" class="form-control" value="{{ $dmu->nama_dmu1 }}" readonly> {{ $dmu->nama_dmu1 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi1 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode1 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar1 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->a1 }}" class="col-lg-1 control-label">{{ $dmu->a1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a1 }}" id="{{ $dmu->a1 }}" class="form-control">
                                        <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->a2 }}" class="col-lg-1 control-label">{{ $dmu->a2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a2 }}" id="{{ $dmu->a2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->a3 }}" class="col-lg-1 control-label">{{ $dmu->a3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a3 }}" id="{{ $dmu->a3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->a4 }}" class="col-lg-1 control-label">{{ $dmu->a4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a4 }}" id="{{ $dmu->a4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->a5 }}" class="col-lg-1 control-label">{{ $dmu->a5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a5 }}" id="{{ $dmu->a5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->a6 }}" class="col-lg-1 control-label">{{ $dmu->a6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a6 }}" id="{{ $dmu->a6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->a7 }}" class="col-lg-1 control-label">{{ $dmu->a7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a7 }}" id="{{ $dmu->a7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->a8 }}" class="col-lg-1 control-label">{{ $dmu->a8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a8 }}" id="{{ $dmu->a8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->a9 }}" class="col-lg-1 control-label">{{ $dmu->a9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a9 }}" id="{{ $dmu->a9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->a10 }}" class="col-lg-1 control-label">{{ $dmu->a10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a10 }}" id="{{ $dmu->a10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->a11 }}" class="col-lg-1 control-label">{{ $dmu->a11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a11 }}" id="{{ $dmu->a11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->a12 }}" class="col-lg-1 control-label">{{ $dmu->a12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->a12 }}" id="{{ $dmu->a12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p1" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p1" name="p1" class="form-control" value="">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu2" class="col-lg-1 control-label">Pengujian 2</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu2" name="nama_dmu2" class="form-control" value="{{ $dmu->nama_dmu2 }}" readonly>{{ $dmu->nama_dmu2 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi2 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode2 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar2 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->b1 }}" class="col-lg-1 control-label">{{ $dmu->b1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b1 }}" id="{{ $dmu->b1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->b2 }}" class="col-lg-1 control-label">{{ $dmu->b2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b2 }}" id="{{ $dmu->b2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->b3 }}" class="col-lg-1 control-label">{{ $dmu->b3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b3 }}" id="{{ $dmu->b3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->b4 }}" class="col-lg-1 control-label">{{ $dmu->b4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b4 }}" id="{{ $dmu->b4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->b5 }}" class="col-lg-1 control-label">{{ $dmu->b5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b5 }}" id="{{ $dmu->b5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->b6 }}" class="col-lg-1 control-label">{{ $dmu->b6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b6 }}" id="{{ $dmu->b6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->b7 }}" class="col-lg-1 control-label">{{ $dmu->b7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b7 }}" id="{{ $dmu->b7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->b8 }}" class="col-lg-1 control-label">{{ $dmu->b8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b8 }}" id="{{ $dmu->b8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->b9 }}" class="col-lg-1 control-label">{{ $dmu->b9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b9 }}" id="{{ $dmu->b9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->b10 }}" class="col-lg-1 control-label">{{ $dmu->b10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b10 }}" id="{{ $dmu->b10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->b11 }}" class="col-lg-1 control-label">{{ $dmu->b11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b11 }}" id="{{ $dmu->b11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->b12 }}" class="col-lg-1 control-label">{{ $dmu->b12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->b12 }}" id="{{ $dmu->b12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p2" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p2" name="p2" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>


                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu3" class="col-lg-1 control-label">Pengujian 3</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu3" name="nama_dmu3" class="form-control" value="{{ $dmu->nama_dmu3 }}" readonly>{{ $dmu->nama_dmu3 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi3 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode3 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar3 }}  
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->c1 }}" class="col-lg-1 control-label">{{ $dmu->c1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c1 }}" id="{{ $dmu->c1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->c2 }}" class="col-lg-1 control-label">{{ $dmu->c2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c2 }}" id="{{ $dmu->c2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->c3 }}" class="col-lg-1 control-label">{{ $dmu->c3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c3 }}" id="{{ $dmu->c3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->c4 }}" class="col-lg-1 control-label">{{ $dmu->c4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c4 }}" id="{{ $dmu->c4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->c5 }}" class="col-lg-1 control-label">{{ $dmu->c5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c5 }}" id="{{ $dmu->c5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->c6 }}" class="col-lg-1 control-label">{{ $dmu->c6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c6 }}" id="{{ $dmu->c6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->c7 }}" class="col-lg-1 control-label">{{ $dmu->c7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c7 }}" id="{{ $dmu->c7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->c8 }}" class="col-lg-1 control-label">{{ $dmu->c8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c8 }}" id="{{ $dmu->c8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->c9 }}" class="col-lg-1 control-label">{{ $dmu->c9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c9 }}" id="{{ $dmu->c9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->c10 }}" class="col-lg-1 control-label">{{ $dmu->c10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c10 }}" id="{{ $dmu->c10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->c11 }}" class="col-lg-1 control-label">{{ $dmu->c11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c11 }}" id="{{ $dmu->c11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->c12 }}" class="col-lg-1 control-label">{{ $dmu->c12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->c12 }}" id="{{ $dmu->c12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p3" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p3" name="p3" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu4" class="col-lg-1 control-label">Pengujian 4</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu4" name="nama_dmu4" class="form-control" value="{{ $dmu->nama_dmu4 }}" readonly>{{ $dmu->nama_dmu4 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi4 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode4 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar4 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->d1 }}" class="col-lg-1 control-label">{{ $dmu->d1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d1 }}" id="{{ $dmu->d1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->d2 }}" class="col-lg-1 control-label">{{ $dmu->d2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d2 }}" id="{{ $dmu->d2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->d3 }}" class="col-lg-1 control-label">{{ $dmu->d3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d3 }}" id="{{ $dmu->d3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->d4 }}" class="col-lg-1 control-label">{{ $dmu->d4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d4 }}" id="{{ $dmu->d4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->d5 }}" class="col-lg-1 control-label">{{ $dmu->d5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d5 }}" id="{{ $dmu->d5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->d6 }}" class="col-lg-1 control-label">{{ $dmu->d6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d6 }}" id="{{ $dmu->d6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->d7 }}" class="col-lg-1 control-label">{{ $dmu->d7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d7 }}" id="{{ $dmu->d7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->d8 }}" class="col-lg-1 control-label">{{ $dmu->d8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d8 }}" id="{{ $dmu->d8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->d9 }}" class="col-lg-1 control-label">{{ $dmu->d9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d9 }}" id="{{ $dmu->d9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->d10 }}" class="col-lg-1 control-label">{{ $dmu->d10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d10 }}" id="{{ $dmu->d10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->d11 }}" class="col-lg-1 control-label">{{ $dmu->d11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d11 }}" id="{{ $dmu->d11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->d12 }}" class="col-lg-1 control-label">{{ $dmu->d12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->d12 }}" id="{{ $dmu->d12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p4" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p4" name="p4" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>


                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu5" class="col-lg-1 control-label">Pengujian 5</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu5" name="nama_dmu5" class="form-control" value="{{ $dmu->nama_dmu5 }}" readonly>{{ $dmu->nama_dmu5 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi5 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode5 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar5 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->e1 }}" class="col-lg-1 control-label">{{ $dmu->e1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e1 }}" id="{{ $dmu->e1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->e2 }}" class="col-lg-1 control-label">{{ $dmu->e2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e2 }}" id="{{ $dmu->e2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->e3 }}" class="col-lg-1 control-label">{{ $dmu->e3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e3 }}" id="{{ $dmu->e3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->e4 }}" class="col-lg-1 control-label">{{ $dmu->e4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e4 }}" id="{{ $dmu->e4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->e5 }}" class="col-lg-1 control-label">{{ $dmu->e5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e5 }}" id="{{ $dmu->e5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->e6 }}" class="col-lg-1 control-label">{{ $dmu->e6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e6 }}" id="{{ $dmu->e6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->e7 }}" class="col-lg-1 control-label">{{ $dmu->e7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e7 }}" id="{{ $dmu->e7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->e8 }}" class="col-lg-1 control-label">{{ $dmu->e8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e8 }}" id="{{ $dmu->e8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->e9 }}" class="col-lg-1 control-label">{{ $dmu->e9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e9 }}" id="{{ $dmu->e9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->e10 }}" class="col-lg-1 control-label">{{ $dmu->e10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e10 }}" id="{{ $dmu->e10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->e11 }}" class="col-lg-1 control-label">{{ $dmu->e11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e11 }}" id="{{ $dmu->e11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->e12 }}" class="col-lg-1 control-label">{{ $dmu->e12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->e12 }}" id="{{ $dmu->e12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p5" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p5" name="p5" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu6" class="col-lg-1 control-label">Pengujian 6</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu6" name="nama_dmu6" class="form-control" value="{{ $dmu->nama_dmu6 }}" readonly>{{ $dmu->nama_dmu6 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi6 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode6 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar6 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->f1 }}" class="col-lg-1 control-label">{{ $dmu->f1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f1 }}" id="{{ $dmu->f1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->f2 }}" class="col-lg-1 control-label">{{ $dmu->f2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f2 }}" id="{{ $dmu->f2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->f3 }}" class="col-lg-1 control-label">{{ $dmu->f3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f3 }}" id="{{ $dmu->f3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->f4 }}" class="col-lg-1 control-label">{{ $dmu->f4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f4 }}" id="{{ $dmu->f4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->f5 }}" class="col-lg-1 control-label">{{ $dmu->f5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f5 }}" id="{{ $dmu->f5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->f6 }}" class="col-lg-1 control-label">{{ $dmu->f6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f6 }}" id="{{ $dmu->f6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->f7 }}" class="col-lg-1 control-label">{{ $dmu->f7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f7 }}" id="{{ $dmu->f7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->f8 }}" class="col-lg-1 control-label">{{ $dmu->f8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f8 }}" id="{{ $dmu->f8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->f9 }}" class="col-lg-1 control-label">{{ $dmu->f9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f9 }}" id="{{ $dmu->f9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->f10 }}" class="col-lg-1 control-label">{{ $dmu->f10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f10 }}" id="{{ $dmu->f10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->f11 }}" class="col-lg-1 control-label">{{ $dmu->f11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f11 }}" id="{{ $dmu->f11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->f12 }}" class="col-lg-1 control-label">{{ $dmu->f12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->f12 }}" id="{{ $dmu->f12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p6" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p6" name="p6" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>


                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu7" class="col-lg-1 control-label">Pengujian 7</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu7" name="nama_dmu7" class="form-control" value="{{ $dmu->nama_dmu7 }}" readonly>{{ $dmu->nama_dmu7 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi7 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode7 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar7 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->g1 }}" class="col-lg-1 control-label">{{ $dmu->g1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g1 }}" id="{{ $dmu->g1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->g2 }}" class="col-lg-1 control-label">{{ $dmu->g2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g2 }}" id="{{ $dmu->g2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->g3 }}" class="col-lg-1 control-label">{{ $dmu->g3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g3 }}" id="{{ $dmu->g3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->g4 }}" class="col-lg-1 control-label">{{ $dmu->g4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g4 }}" id="{{ $dmu->g4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->g5 }}" class="col-lg-1 control-label">{{ $dmu->g5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g5 }}" id="{{ $dmu->g5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->g6 }}" class="col-lg-1 control-label">{{ $dmu->g6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g6 }}" id="{{ $dmu->g6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->g7 }}" class="col-lg-1 control-label">{{ $dmu->g7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g7 }}" id="{{ $dmu->g7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->g8 }}" class="col-lg-1 control-label">{{ $dmu->g8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g8 }}" id="{{ $dmu->g8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->g9 }}" class="col-lg-1 control-label">{{ $dmu->g9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g9 }}" id="{{ $dmu->g9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->g10 }}" class="col-lg-1 control-label">{{ $dmu->g10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g10 }}" id="{{ $dmu->g10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->g11 }}" class="col-lg-1 control-label">{{ $dmu->g11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g11 }}" id="{{ $dmu->g11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->g12 }}" class="col-lg-1 control-label">{{ $dmu->g12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->g12 }}" id="{{ $dmu->g12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p7" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p7" name="p7" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>


                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu8" class="col-lg-1 control-label">Pengujian 8</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu8" name="nama_dmu8" class="form-control" value="{{ $dmu->nama_dmu8 }}" readonly>{{ $dmu->nama_dmu8 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi8 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode8 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar8 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->h1 }}" class="col-lg-1 control-label">{{ $dmu->h1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h1 }}" id="{{ $dmu->h1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->h2 }}" class="col-lg-1 control-label">{{ $dmu->h2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h2 }}" id="{{ $dmu->h2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->h3 }}" class="col-lg-1 control-label">{{ $dmu->h3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h3 }}" id="{{ $dmu->h3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->h4 }}" class="col-lg-1 control-label">{{ $dmu->h4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h4 }}" id="{{ $dmu->h4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->h5 }}" class="col-lg-1 control-label">{{ $dmu->h5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h5 }}" id="{{ $dmu->h5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->h6 }}" class="col-lg-1 control-label">{{ $dmu->h6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h6 }}" id="{{ $dmu->h6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->h7 }}" class="col-lg-1 control-label">{{ $dmu->h7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h7 }}" id="{{ $dmu->h7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->h8 }}" class="col-lg-1 control-label">{{ $dmu->h8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h8 }}" id="{{ $dmu->h8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->h9 }}" class="col-lg-1 control-label">{{ $dmu->h9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h9 }}" id="{{ $dmu->h9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->h10 }}" class="col-lg-1 control-label">{{ $dmu->h10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h10 }}" id="{{ $dmu->h10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->h11 }}" class="col-lg-1 control-label">{{ $dmu->h11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h11 }}" id="{{ $dmu->h11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->h12 }}" class="col-lg-1 control-label">{{ $dmu->h12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->h12 }}" id="{{ $dmu->h12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p8" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p8" name="p8" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu9" class="col-lg-1 control-label">Pengujian 9</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu9" name="nama_dmu9" class="form-control" value="" readonly>{{ $dmu->nama_dmu9 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi9 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode9 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar9 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->i1 }}" class="col-lg-1 control-label">{{ $dmu->i1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i1 }}" id="{{ $dmu->i1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->i2 }}" class="col-lg-1 control-label">{{ $dmu->i2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i2 }}" id="{{ $dmu->i2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->i3 }}" class="col-lg-1 control-label">{{ $dmu->i3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i3 }}" id="{{ $dmu->i3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->i4 }}" class="col-lg-1 control-label">{{ $dmu->i4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i4 }}" id="{{ $dmu->i4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->i5 }}" class="col-lg-1 control-label">{{ $dmu->i5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i5 }}" id="{{ $dmu->i5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->i6 }}" class="col-lg-1 control-label">{{ $dmu->i6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i6 }}" id="{{ $dmu->i6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->i7 }}" class="col-lg-1 control-label">{{ $dmu->i7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i7 }}" id="{{ $dmu->i7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->i8 }}" class="col-lg-1 control-label">{{ $dmu->i8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i8 }}" id="{{ $dmu->i8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->i9 }}" class="col-lg-1 control-label">{{ $dmu->i9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i9 }}" id="{{ $dmu->i9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->i10 }}" class="col-lg-1 control-label">{{ $dmu->i10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i10 }}" id="{{ $dmu->i10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->i11 }}" class="col-lg-1 control-label">{{ $dmu->i11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i11 }}" id="{{ $dmu->i11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->i12 }}" class="col-lg-1 control-label">{{ $dmu->i12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->i12 }}" id="{{ $dmu->i12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p9" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p9" name="p9" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu10" class="col-lg-1 control-label">Pengujian 10 </label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu10" name="nama_dmu10" class="form-control" value="{{ $dmu->nama_dmu10 }}" readonly>{{ $dmu->nama_dmu10 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi10 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode10 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar10 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->j1 }}" class="col-lg-1 control-label">{{ $dmu->j1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j1 }}" id="{{ $dmu->j1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->j2 }}" class="col-lg-1 control-label">{{ $dmu->j2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j2 }}" id="{{ $dmu->j2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->j3 }}" class="col-lg-1 control-label">{{ $dmu->j3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j3 }}" id="{{ $dmu->j3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->j4 }}" class="col-lg-1 control-label">{{ $dmu->j4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j4 }}" id="{{ $dmu->j4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->j5 }}" class="col-lg-1 control-label">{{ $dmu->j5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j5 }}" id="{{ $dmu->j5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->j6 }}" class="col-lg-1 control-label">{{ $dmu->j6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j6 }}" id="{{ $dmu->j6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->j7 }}" class="col-lg-1 control-label">{{ $dmu->j7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j7 }}" id="{{ $dmu->j7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->j8 }}" class="col-lg-1 control-label">{{ $dmu->j8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j8 }}" id="{{ $dmu->j8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->j9 }}" class="col-lg-1 control-label">{{ $dmu->j9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j9 }}" id="{{ $dmu->j9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->j10 }}" class="col-lg-1 control-label">{{ $dmu->j10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j10 }}" id="{{ $dmu->j10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->j11 }}" class="col-lg-1 control-label">{{ $dmu->j11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j11 }}" id="{{ $dmu->j11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->j12 }}" class="col-lg-1 control-label">{{ $dmu->j12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->j12 }}" id="{{ $dmu->j12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p10" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p10" name="p10" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu11" class="col-lg-1 control-label">Pengujian 11 </label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu11" name="nama_dmu11" class="form-control" value="{{ $dmu->nama_dmu11 }}" readonly>{{ $dmu->nama_dmu11 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi11 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode11 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar11 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->k1 }}" class="col-lg-1 control-label">{{ $dmu->k1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k1 }}" id="{{ $dmu->k1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->k2 }}" class="col-lg-1 control-label">{{ $dmu->k2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k2 }}" id="{{ $dmu->k2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->k3 }}" class="col-lg-1 control-label">{{ $dmu->k3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k3 }}" id="{{ $dmu->k3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->k4 }}" class="col-lg-1 control-label">{{ $dmu->k4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k4 }}" id="{{ $dmu->k4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->k5 }}" class="col-lg-1 control-label">{{ $dmu->k5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k5 }}" id="{{ $dmu->k5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->k6 }}" class="col-lg-1 control-label">{{ $dmu->k6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k6 }}" id="{{ $dmu->k6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->k7 }}" class="col-lg-1 control-label">{{ $dmu->k7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k7 }}" id="{{ $dmu->k7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->k8 }}" class="col-lg-1 control-label">{{ $dmu->k8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k8 }}" id="{{ $dmu->k8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->k9 }}" class="col-lg-1 control-label">{{ $dmu->k9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k9 }}" id="{{ $dmu->k9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->k10 }}" class="col-lg-1 control-label">{{ $dmu->k10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k10 }}" id="{{ $dmu->k10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->k11 }}" class="col-lg-1 control-label">{{ $dmu->k11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k11 }}" id="{{ $dmu->k11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->k12 }}" class="col-lg-1 control-label">{{ $dmu->k12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->k12 }}" id="{{ $dmu->k12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p11" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p11" name="p11" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>


                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu12" class="col-lg-1 control-label">Pengujian 12 </label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu12" name="nama_dmu12" class="form-control" value="{{ $dmu->nama_dmu12 }}" readonly>{{ $dmu->nama_dmu12 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi12 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode12 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar12 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->l1 }}" class="col-lg-1 control-label">{{ $dmu->l1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l1 }}" id="{{ $dmu->l1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->l2 }}" class="col-lg-1 control-label">{{ $dmu->l2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l2 }}" id="{{ $dmu->l2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->l3 }}" class="col-lg-1 control-label">{{ $dmu->l3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l3 }}" id="{{ $dmu->l3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->l4 }}" class="col-lg-1 control-label">{{ $dmu->l4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l4 }}" id="{{ $dmu->l4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->l5 }}" class="col-lg-1 control-label">{{ $dmu->l5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l5 }}" id="{{ $dmu->l5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->l6 }}" class="col-lg-1 control-label">{{ $dmu->l6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l6 }}" id="{{ $dmu->l6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->l7 }}" class="col-lg-1 control-label">{{ $dmu->l7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l7 }}" id="{{ $dmu->l7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->l8 }}" class="col-lg-1 control-label">{{ $dmu->l8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l8 }}" id="{{ $dmu->l8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->l9 }}" class="col-lg-1 control-label">{{ $dmu->l9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l9 }}" id="{{ $dmu->l9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->l10 }}" class="col-lg-1 control-label">{{ $dmu->l10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l10 }}" id="{{ $dmu->l10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->l11 }}" class="col-lg-1 control-label">{{ $dmu->l11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l11 }}" id="{{ $dmu->l11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->l12 }}" class="col-lg-1 control-label">{{ $dmu->l12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->l12 }}" id="{{ $dmu->l12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p12" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p12" name="p12" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>


                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu13" class="col-lg-1 control-label">Pengujian 13 </label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu13" name="nama_dmu13" class="form-control" value="{{ $dmu->nama_dmu13 }}" readonly>{{ $dmu->nama_dmu13 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi13 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode13 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar13 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->m1 }}" class="col-lg-1 control-label">{{ $dmu->m1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m1 }}" id="{{ $dmu->m1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->m2 }}" class="col-lg-1 control-label">{{ $dmu->m2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m2 }}" id="{{ $dmu->m2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->m3 }}" class="col-lg-1 control-label">{{ $dmu->m3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m3 }}" id="{{ $dmu->m3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->m4 }}" class="col-lg-1 control-label">{{ $dmu->m4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m4 }}" id="{{ $dmu->m4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->m5 }}" class="col-lg-1 control-label">{{ $dmu->m5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m5 }}" id="{{ $dmu->m5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->m6 }}" class="col-lg-1 control-label">{{ $dmu->m6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m6 }}" id="{{ $dmu->m6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->m7 }}" class="col-lg-1 control-label">{{ $dmu->m7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m7 }}" id="{{ $dmu->m7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->m8 }}" class="col-lg-1 control-label">{{ $dmu->m8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m8 }}" id="{{ $dmu->m8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->m9 }}" class="col-lg-1 control-label">{{ $dmu->m9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m9 }}" id="{{ $dmu->m9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->m10 }}" class="col-lg-1 control-label">{{ $dmu->m10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m10 }}" id="{{ $dmu->m10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->m11 }}" class="col-lg-1 control-label">{{ $dmu->m11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m11 }}" id="{{ $dmu->m11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->m12 }}" class="col-lg-1 control-label">{{ $dmu->m12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->m12 }}" id="{{ $dmu->m12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p13" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p13" name="p13" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <div class="form-group row">
                                <label for="nama_dmu14" class="col-lg-1 control-label">Pengujian 14 </label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu14" name="nama_dmu14" class="form-control" value="{{ $dmu->nama_dmu14 }}" readonly>{{ $dmu->nama_dmu14 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="#" class="form-control" value="{{ $dmu->lokasi14 }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="#" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->metode14 }}
                                    </textarea>
                                </div>
                                <label for="#" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="#" class="form-control" value="" readonly>{{ $dmu->standar14 }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="{{ $dmu->n1 }}" class="col-lg-1 control-label">{{ $dmu->n1 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n1 }}" id="{{ $dmu->n1 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->n2 }}" class="col-lg-1 control-label">{{ $dmu->n2 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n2 }}" id="{{ $dmu->n2 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->n3 }}" class="col-lg-1 control-label">{{ $dmu->n3 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n3 }}" id="{{ $dmu->n3 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->n4 }}" class="col-lg-1 control-label">{{ $dmu->n4 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n4 }}" id="{{ $dmu->n4 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="{{ $dmu->n5 }}" class="col-lg-1 control-label">{{ $dmu->n5 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n5 }}" id="{{ $dmu->n5 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->n6 }}" class="col-lg-1 control-label">{{ $dmu->n6 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n6 }}" id="{{ $dmu->n6 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->n7 }}" class="col-lg-1 control-label">{{ $dmu->n7 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n7 }}" id="{{ $dmu->n7 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->n8 }}" class="col-lg-1 control-label">{{ $dmu->n8 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n8 }}" id="{{ $dmu->n8 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="{{ $dmu->n9 }}" class="col-lg-1 control-label">{{ $dmu->n9 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n9 }}" id="{{ $dmu->n9 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->n10 }}" class="col-lg-1 control-label">{{ $dmu->n10 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n10 }}" id="{{ $dmu->n10 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->n11 }}" class="col-lg-1 control-label">{{ $dmu->n11 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n11 }}" id="{{ $dmu->n11 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                                <label for="{{ $dmu->n12 }}" class="col-lg-1 control-label">{{ $dmu->n12 }}</label>
                                <div class="col-lg-2">
                                    <select name="{{ $dmu->n12 }}" id="{{ $dmu->n12 }}" class="form-control">
                                    <option value=""></option>
                                        <option value="OK">OK</option>
                                        <option value="NOK">NOK</option>
                                        <option value="BELUM">BELUM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p14" class="col-lg-1 control-label">Keterangan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p14" name="p14" class="form-control">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>

                            <br>
                                <br>

                            <div class="form-group row">
                            <label for="lanjut" class="col-lg-6 control-label"><font color="" size="3">Apakah Terdapat pengujian yang "BELUM" dilakukan ??</font></label>
                                <div class="col-lg-3">
                                     <select name="lanjut" id="lanjut" class="form-control" required autofocus>
                                     <option Value=""></option>
                                     <option Value="BELUM">Ya</option>
                                     <option Value="">Tidak</option>
                            </select>
                            <span class="help-block with-errors"></span>
                                </div>
                            </div>

                                <br>
                                <br>
                                <br>
</div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg pull-right btn-simpan"><i class="fa fa-floppy-o"></i>Simpan Transaksi</button>
            </div>
        </div>
    </div>
</div>

@includeIf('emu_detail.produk')
@endsection

@push('scripts')
<script>
    let table, table2;

    $(function () {
        $('body').addClass('sidebar-collapse');

        table = $('.table-emu').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('emu_detail.data', $id_emu) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_produk'},
                {data: 'nama_produk'},
                {data: 'jumlah'},
                {data: 'aksi', searchable: false, sortable: false},
            ],
            dom: 'Brt',
            bSort: false,
            paginate: false
        })
        .on('draw.dt', function () {
            loadForm($('#diskon').val());
        });
        table2 = $('.table-produk').DataTable();

        $(document).on('input', '.quantity', function () {
            let id = $(this).data('id');
            let jumlah = parseInt($(this).val());

            if (jumlah < 1) {
                $(this).val(1);
                alert('Jumlah tidak boleh kurang dari 1');
                return;
            }
            if (jumlah > 10000) {
                $(this).val(10000);
                alert('Jumlah tidak boleh lebih dari 10000');
                return;
            }

            $.post(`{{ url('/emu_detail') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'jumlah': jumlah
                })
                .done(response => {
                    $(this).on('mouseout', function () {
                        table.ajax.reload(() => loadForm($('#diskon').val()));
                    });
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        });

        $(document).on('input', '#diskon', function () {
            if ($(this).val() == "") {
                $(this).val(0).select();
            }

            loadForm($(this).val());
        });

        $('.btn-simpan').on('click', function () {
            $('.form-emu').submit();
        });
    });

    function tampilProduk() {
        $('#modal-produk').modal('show');
    }

    function hideProduk() {
        $('#modal-produk').modal('hide');
    }

    function pilihProduk(id, kode) {
        $('#id_produk').val(id);
        $('#kode_produk').val(kode);
        hideProduk();
        tambahProduk();
    }

    function tambahProduk() {
        $.post('{{ route('emu_detail.store') }}', $('.form-produk').serialize())
            .done(response => {
                $('#kode_produk').focus();
                table.ajax.reload(() => loadForm($('#diskon').val()));
            })
            .fail(errors => {
                alert('Tidak dapat menyimpan data');
                return;
            });
    }

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload(() => loadForm($('#diskon').val()));
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }

    function loadForm(diskon = 0) {
        $('#total').val($('.total').text());
        $('#total_item').val($('.total_item').text());

        $.get(`{{ url('/emu_detail/loadform') }}/${diskon}/${$('.total').text()}`)
            .done(response => {
                $('#totalrp').val('Rp. '+ response.totalrp);
                $('#bayarrp').val('Rp. '+ response.bayarrp);
                $('#bayar').val(response.bayar);
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            })
    }

    function cetakBarcode(url) {
        if ($('input:checked').length < 1) {
            alert('Pilih data yang akan dicetak');
            return;
        } else if ($('input:checked').length < 1) {
            alert('Pilih minimal 1 data untuk dicetak');
            return;
        } else {
            $('.form-emu')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }
</script>
@endpush