<style>
    .hidden-form {
        display: none;
    }
</style>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('tekprod.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                        <label for="nama_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Nama Design</label> 
                        <div class="col-lg-6">
                            <input name="nama_tekprod" id="nama_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kode_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Kode Design</label> 
                        <div class="col-lg-6">
                            <input name="kode_tekprod" id="kode_tekprod" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
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
                    <div class="form-group row hidden-form ">
                        <label for="bobot_rev_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Bobot Revisi</label> 
                        <div class="col-lg-6">
                        <input type="text" name="bobot_rev_tekprod" id="bobot_rev_tekprod" class="form-control" autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="konfigurasi_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Dipakai Konfigurasi</label> 
                        <div class="col-lg-6">
                            <input name="konfigurasi_tekprod" id="konfigurasi_tekprod" class="form-control" required autofocus>
                            <span style="color: green;">Pisahkan dengan titik koma (;). Ex: Tec;Mc;dst..</span>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Status</label> 
                        <div class="col-lg-6">
                            <input value="Open" name="status_tekprod" id="status_tekprod" class="form-control" required autofocus readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="revisi_tekprod" class="col-lg-1 col-lg-offset-1 control-label">Revisi</label>
                        <div class="col-lg-2">
                            <input value="Rev.0" type="text" name="revisi_tekprod" id="revisi_tekprod" class="form-control" required autofocus readonly>
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

                    <br>
                    <a> <b><center>-- Pilih Pembuat Dokumen --</center></b></a>
                    </br>

                    <div class="form-group row">
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
                            @foreach ($approver as $key => $item)
                                     <option value="{{ $key }}" >{{ $item }}</option>
                                @endforeach
                            </select>
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


