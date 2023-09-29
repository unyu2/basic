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

                <div class="form-group row hidden-form">
                        <label for="id_draft_tekprod" class="col-lg-1 col-lg-offset-2 control-label">ID Draft</label>
                            <div class="col-lg-6">
                                <input  name="id_draft_tekprod" id="id_draft_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="id_check_tekprod" class="col-lg-1 col-lg-offset-2 control-label">ID Check</label>
                            <div class="col-lg-6">
                                <input  name="id_check_tekprod" id="id_check_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="id_approve_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Id Approve</label>
                            <div class="col-lg-6">
                                <input name="id_approve_tekprod" id="id_approve_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="jenis_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Jenis</label>
                            <div class="col-lg-6">
                                <input name="jenis_tekprod" id="jenis_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="pemilik_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Pemilik</label>
                            <div class="col-lg-6">
                                <input name="pemilik_tekprod" id="pemilik_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="bobot_rev_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Bobot Revisi</label>
                            <div class="col-lg-6">
                                <input name="bobot_rev_tekprod" id="bobot_rev_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="bobot_design_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Bobot Design</label>
                            <div class="col-lg-6">
                                <input name="bobot_design_tekprod" id="bobot_design_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="size_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Size</label>
                            <div class="col-lg-6">
                                <input name="size_tekprod" id="size_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="lembar_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Sheet</label>
                            <div class="col-lg-6">
                                <input name="lembar_tekprod" id="lembar_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="prosentase_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Prosentase</label>
                            <div class="col-lg-6">
                                <input type="text" value="100" placeholder="100" name="prosentase_tekprod" id="prosentase_tekprod" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="time_release_rev0_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Time release Rev.0</label>
                            <div class="col-lg-6">
                                <input type="text" name="time_release_rev0_tekprod" id="time_release_rev0_tekprod" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form ">
                        <label for="duplicate_status_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Duplicate Status</label>
                            <div class="col-lg-6">
                                <input type="text" name="duplicate_status_tekprod" id="duplicate_status_tekprod" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="tipe_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Tipe</label>
                        <div class="col-lg-6"> 
                        <select name="tipe_tekprod" id="tipe_tekprod" class="form-control" required autofocus>
                            <option></option>
                                <option Value="1">New</option>
                                <option Value="0.5">Konversi</option>
                                <option Value="0.05">Konversi & Revisi</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                <div class="form-group row hidden-form">
                        <label for="id_tekprod" class="col-lg-1 col-lg-offset-2 control-label">ID Design</label>
                            <div class="col-lg-6">
                                <input type="number" name="id_tekprod" id="id_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>

<!----------------------------------------------------------Real Form For Show------------------------------------------------------------------>
                <div class="form-group row">
                        <label for="prediksi_akhir_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Prediksi Release</label>
                            <div class="col-lg-6">
                                <input type="date" name="prediksi_akhir_tekprod" id="prediksi_akhir_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                <div class="form-group row">
                        <label for="kode_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Kode Design</label>
                            <div class="col-lg-6">
                                <input type="text" name="kode_tekprod" id="kode_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Nama Design</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_tekprod" id="nama_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="revisi_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Revisi</label>
                            <div class="col-lg-6">
                                <input type="text" name="revisi_tekprod" id="revisi_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Status</label>
                            <div class="col-lg-6">
                                <input value="Release" placeholder="Release" type="text" name="status_tekprod" id="status_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Release Dokumen</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>