<style>
    .hidden-form {
        display: none;
    }
</style>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('design.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                <div class="form-group row">
                        <label for="" class="col-lg-2 col-lg-offset-1 control-label">Pilih Dokumen</label> 
                        <div class="col-lg-2">
                        <button onclick="addBaru()" type="button" class="btn btn-info">Pilih Design</button>
                        </div>
                        <div class="col-lg-4">
                        <span style="color: green;">Pilih Dokumen Yang Akan Dibuat Dan Atau Di Edit Schedule Nya</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Kode Design</label> 
                        <div class="col-lg-6">
                            <input name="kode_tekprod" id="kode_tekprod" class="form-control" required autofocus readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                <div class="form-group row">
                        <label for="nama_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Nama Design</label> 
                        <div class="col-lg-6">
                            <input name="nama_tekprod" id="nama_tekprod" class="form-control" required autofocus readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

<!-- Start hidden -->
<div class="form-group row hidden-form">
                        <label for="id_tekprod" class="col-lg-2 col-lg-offset-1 control-label">ID Design</label> 
                        <div class="col-lg-6">
                            <input name="id_tekprod" id="id_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="pemilik_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Pemilik</label> 
                        <div class="col-lg-6">
                            <input name="pemilik_tekprod" id="pemilik_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="rev_for_curva_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Rev For Curva</label> 
                        <div class="col-lg-6">
                            <input name="rev_for_curva_tekprod" id="rev_for_curva_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="duplicate_status_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Duplicate Status</label> 
                        <div class="col-lg-6">
                            <input name="duplicate_status_tekprod" id="duplicate_status_tekprod" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="tipe_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Tipe</label> 
                        <div class="col-lg-6">
                            <input name="tipe_tekprod" id="tipe_tekprod" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="time_release_rev0_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Time Release Rev 0</label> 
                        <div class="col-lg-6">
                            <input type="date" name="time_release_rev0_tekprod" id="time_release_rev0_tekprod" class="form-control datepicker">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="jenis_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Jenis</label> 
                        <div class="col-lg-6">
                            <input name="jenis_tekprod" id="jenis_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="bobot_design_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Bobot Design</label> 
                        <div class="col-lg-6">
                            <input name="bobot_design_tekprod" id="bobot_design_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="prosentase_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Prosentase</label> 
                        <div class="col-lg-6">
                            <input name="prosentase_tekprod" id="prosentase_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
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
                    <div class="form-group row hidden-form">
                        <label for="id_design" class="col-lg-2 col-lg-offset-1 control-label">Design</label> 
                        <div class="col-lg-6">
                        <select type="text" name="id_design" id="id_design" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($design as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="konfigurasi_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Dipakai Konfigurasi</label> 
                        <div class="col-lg-6">
                            <input name="konfigurasi_tekprod" id="konfigurasi_tekprod" class="form-control" required autofocus>
                            <span style="color: green;">Pisahkan dengan titik koma (;). Ex: Tec;Mc1;Mc2;dst..</span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row hidden-form">
                        <label for="bobot_rev_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Bobot Revisi</label> 
                        <div class="col-lg-6">
                        <input type="text" name="bobot_rev_tekprod" id="bobot_rev_tekprod" class="form-control" autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="status_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Status</label> 
                        <div class="col-lg-6">
                            <input name="status_tekprod" id="status_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row hidden-form">
                    <label for="revisi_tekprod" class="col-lg-1 col-lg-offset-1 control-label">Revisi</label>
                        <div class="col-lg-2">
                            <input type="text" name="revisi_tekprod" id="revisi_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>

                        <label for="size_tekprod" class="col-lg-1 control-label">Size</label>
                        <div class="col-lg-2">
                            <select type="text" name="size_tekprod" id="size_tekprod" class="form-control" required autofocus>
                            <option></option>
                                <option Value="64">A0</option>
                                <option Value="32">A1</option>
                                <option Value="16">A2</option>
                                <option Value="8">A3</option>
                                <option Value="4">A4</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="lembar_tekprod" class="col-lg-1 control-label">Sheet</label>
                        <div class="col-lg-2">
                            <input type="number" name="lembar_tekprod" id="lembar_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row hidden-form">
                        <label for="id_draft_tekprod" class="col-lg-1 col-lg-offset-1 control-label">Drafter</label>
                        <div class="col-lg-2">
                            <select type="text" name="id_draft_tekprod" id="id_draft_tekprod" class="form-control" required autofocus>
                                <option></option>
                            @foreach ($approver as $key => $item)
                                     <option value="{{ $key }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="id_check_tekprod" class="col-lg-1 control-label">Checker</label>
                        <div class="col-lg-2">
                            <select type="text" name="id_check_tekprod" id="id_check_tekprod" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($approver as $key => $item)
                                     <option value="{{ $key }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="id_approve_tekprod" class="col-lg-1 control-label">Approver</label>
                        <div class="col-lg-2">
                            <select type="text" name="id_approve_tekprod" id="id_approve_tekprod" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($drafter as $key => $item)
                                     <option value="{{ $key }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

 <!-- End hidden -->                   
                        <a> <b><center> !!!!! DATA UNTUK SCHEDULE !!!!! DATA UNTUK SCHEDULE !!!!!</center></b></a>
                        <br>
                   <div class="form-group row">
                        <label for="tanggal_prediksi_tekprod" class="col-lg-2 col-lg-offset-1 control-label datepicker">Prediksi Tanggal (Start)</label> 
                        <div class="col-lg-6 datepicker">
                            <input type="date" name="tanggal_prediksi_tekprod" id="tanggal_prediksi_tekprod" class="form-control datepicker">
                            <span style="color: green;">Dilakukan pengisian bila tidak memiliki (First Document) Refrensi Gambar Design.</span>
                            <span style="color: green;">Kosongkan Bila Telah Mengisi Refrensi.</span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="" class="col-lg-2 col-lg-offset-1 control-label">Predececors/ Refrensi Jadwal Doc (Bila Ada)</label> 
                        <div class="col-lg-2">
                        <button onclick="addRef()"  type="button" class="btn btn-info">Pilih Refrensi</button>
                        </div>
                        <div class="col-lg-4">
                            <input name="refrensi_design_tekprod" id="refrensi_design_tekprod" class="form-control" readonly>
                            <input type="date" name="tanggal_refrensi_tekprod" id="tanggal_refrensi_tekprod" class="form-control" readonly>
                            <input  name="id_refrensi_tekprod" id="id_refrensi_tekprod" class="form-control" readonly>

                            <span class="help-block with-errors"></span>
                            <span style="color: green;">Gunakan Refrensi Document (field ini) Bila Prediksi Tanggal Start Tidak Bisa Ditentukan.</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="prediksi_hari_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Prediksi (Hari)</label> 
                        <div class="col-lg-6">
                            <input type="number" name="prediksi_hari_tekprod" id="prediksi_hari_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
<!---------------------------------------------------------------------------------------------------------------------------------------- -->
                    
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>


