<style>
    .hidden-form {
        display: none;
    }
</style>

<div class="modal fade" id="modal-form4" tabindex="-1" role="dialog" aria-labelledby="modal-form4">
    <div class="modal-dialog modal-lg" role="document">
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" data-toggle="validator">
            @csrf
            @method('put')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                    <label for="id_proyek" class="col-lg-2 col-lg-offset-1 control-label">Proyek</label>
                        <div class="col-lg-6">
                            <select type="text" name="id_proyek" id="id_proyek" class="form-control" required autofocus>
                                <option></option>
                                @foreach ($proyek as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_kepala_gambar" class="col-lg-2 col-lg-offset-1 control-label">Kepala Gambar</label> 
                        <div class="col-lg-6">
                        <select type="text" name="id_kepala_gambar" id="id_kepala_gambar" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($kepala as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                <div class="form-group row">
                        <label for="nama_design" class="col-lg-2 col-lg-offset-1 control-label">Nama Design</label> 
                        <div class="col-lg-6">
                            <input name="nama_design" id="nama_design" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kode_design" class="col-lg-2 col-lg-offset-1 control-label">Kode Design</label> 
                        <div class="col-lg-6">
                            <input name="kode_design" id="kode_design" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bobot_design" class="col-lg-2 col-lg-offset-1 control-label">Bobot Design</label> 
                        <div class="col-lg-6">
                        <select type="text" name="bobot_design" id="bobot_design" class="form-control" required autofocus>
                            <option value="1">Low</option>
                            <option value="2">Medium</option>
                            <option value="3">High</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bobot_rev" class="col-lg-2 col-lg-offset-1 control-label">Bobot Rev</label> 
                        <div class="col-lg-6">
                        <select type="text" name="bobot_rev" id="bobot_rev" class="form-control" required autofocus>
                            <option></option>
                            <option value="3">Berubah Total</option>
                            <option value="2">Berubah Sebagian</option>
                            <option value="1">Sedikit Penyesuaian</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipe" class="col-lg-2 col-lg-offset-1 control-label">Tipe</label> 
                        <div class="col-lg-6">
                        <select name="tipe" id="tipe" class="form-control" required autofocus>
                                <option></option>
                                <option Value="1">New</option>
                                <option Value="0.5">Konversi</option>
                                <option Value="0.05">Konversi & Revisi</option>
                         </select>
                         </div>
                            <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group row">
                        <label for="konfigurasi" class="col-lg-2 col-lg-offset-1 control-label">Dipakai Konfigurasi</label> 
                        <div class="col-lg-6">
                            <input name="konfigurasi" id="konfigurasi" class="form-control" required autofocus>
                            <span style="color: green;">Pisahkan dengan titik koma (;). Ex: Tec;Mc;dst..</span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 control-label">Status</label> 
                        <div class="col-lg-6">
                            <input name="status" id="status" class="form-control" required autofocus readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="revisi" class="col-lg-1 col-lg-offset-1 control-label">Revisi</label>
                        <div class="col-lg-2">
                            <input value="Rev.0" type="text" name="revisi" id="revisi" class="form-control" required autofocus readonly>
                            <span class="help-block with-errors"></span>
                        </div>

                        <label for="size" class="col-lg-1 control-label">Size</label>
                        <div class="col-lg-2">
                            <select type="text" name="size" id="size" class="form-control" required autofocus>
                            <option></option>
                            <option Value="64">A0</option>
                                <option Value="32">A1</option>
                                <option Value="16">A2</option>
                                <option Value="8">A3</option>
                                <option Value="4">A4</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="lembar" class="col-lg-1 control-label">Sheet</label>
                        <div class="col-lg-2">
                            <input name="lembar" id="lembar" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <br>
                    <a> <b><center>-- Pilih Pembuat Dokumen --</center></b></a>
                    </br>

                    <div class="form-group row">
                        <label for="id_draft" class="col-lg-1 col-lg-offset-1 control-label">Drafter</label>
                        <div class="col-lg-2">
                            <select type="text" name="id_draft" id="id_draft" class="form-control" required autofocus>
                                <option></option>
                            @foreach ($approver as $key => $item)
                                     <option value="{{ $key }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="id_check" class="col-lg-1 control-label">Checker</label>
                        <div class="col-lg-2">
                            <select type="text" name="id_check" id="id_check" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($approver as $key => $item)
                                     <option value="{{ $key }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="id_approve" class="col-lg-1 control-label">Approver</label>
                        <div class="col-lg-2">
                            <select type="text" name="id_approve" id="id_approve" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($drafter as $key => $item)
                                     <option value="{{ $key }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

         <!--           <br>
                    <a> <b><center>-- Pilih Konfigurasi Kereta Yang Digunakan Dalam Drawing --</center></b></a>
                    </br>
                   <div class="form-group row">
                        <label for="konf_emu" class="col-lg-1 col-lg-offset-1 control-label">EMU</label>
                        <div class="col-lg-2">
                            @foreach ($konfigurasi_emu as $key => $item)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="konf_emu[]" value="{{ $item }}" autofocus>{{ $item }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <label for="konf_dmu" class="col-lg-1 control-label">DMU</label>
                        <div class="col-lg-2">
                            @foreach ($konfigurasi_dmu as $key => $item)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="konf_dmu[]" value="{{ $item }}" autofocus>{{ $item }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <label for="konf_light" class="col-lg-1 control-label">Light / Tram</label>
                        <div class="col-lg-2">
                            @foreach ($konfigurasi_light as $key => $item)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="konf_light[]" value="{{ $item }}" autofocus>{{ $item }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="konf_coach" class="col-lg-1 col-lg-offset-1 control-label">Coach</label>
                        <div class="col-lg-2">
                            @foreach ($konfigurasi_coach as $key => $item)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="konf_coach[]" value="{{ $item }}" autofocus>{{ $item }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <label for="konf_wagon" class="col-lg-1 control-label">Wagon</label>
                        <div class="col-lg-2">
                            @foreach ($konfigurasi_wagon as $key => $item)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="konf_wagon[]" value="{{ $item }}" autofocus>{{ $item }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <label for="konf_other" class="col-lg-1 control-label">Other</label>
                        <div class="col-lg-2">
                            @foreach ($konfigurasi_other as $key => $item)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="konf_other[]" value="{{ $item }}" autofocus>{{ $item }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div> -->

<!---------------------------------------------------------------------------------------------------------------------------------------- -->
                    
                </div>
                <div class="modal-footer">
                    <button onclick="redirectTo" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>