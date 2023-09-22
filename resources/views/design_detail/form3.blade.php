<style>
    .hidden-form {
        display: none;
    }
</style>

<div class="modal fade" id="modal-form3" tabindex="-1" role="dialog" aria-labelledby="modal-form3">
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
                        <label for="id_draft" class="col-lg-1 col-lg-offset-2 control-label">ID Draft</label>
                            <div class="col-lg-6">
                                <input  name="id_draft" id="id_draft" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="id_check" class="col-lg-1 col-lg-offset-2 control-label">ID Check</label>
                            <div class="col-lg-6">
                                <input  name="id_check" id="id_check" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="id_approve" class="col-lg-1 col-lg-offset-2 control-label">Id Approve</label>
                            <div class="col-lg-6">
                                <input name="id_approve" id="id_approve" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="jenis" class="col-lg-1 col-lg-offset-2 control-label">Jenis</label>
                            <div class="col-lg-6">
                                <input name="jenis" id="jenis" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="pemilik" class="col-lg-1 col-lg-offset-2 control-label">Pemilik</label>
                            <div class="col-lg-6">
                                <input name="pemilik" id="pemilik" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="bobot_rev" class="col-lg-1 col-lg-offset-2 control-label">Bobot Revisi</label>
                            <div class="col-lg-6">
                                <input name="bobot_rev" id="bobot_rev" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="bobot_design" class="col-lg-1 col-lg-offset-2 control-label">Bobot Design</label>
                            <div class="col-lg-6">
                                <input name="bobot_design" id="bobot_design" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="size" class="col-lg-1 col-lg-offset-2 control-label">Size</label>
                            <div class="col-lg-6">
                                <input name="size" id="size" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="lembar" class="col-lg-1 col-lg-offset-2 control-label">Sheet</label>
                            <div class="col-lg-6">
                                <input name="lembar" id="lembar" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="duplicate_status" class="col-lg-1 col-lg-offset-2 control-label">Duplicate Status</label>
                            <div class="col-lg-6">
                                <input type="text" value="Release" placeholder="Release" name="duplicate_status" id="duplicate_status" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="time_release_rev0" class="col-lg-1 col-lg-offset-2 control-label">Time release Rev.0</label>
                            <div class="col-lg-6">
                                <input type="text" value="<?php echo date('Y-m-d'); ?>" placeholder="yyyy-mm-dd" name="time_release_rev0" id="time_release_rev0" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row hidden-form">
                        <label for="prosentase" class="col-lg-1 col-lg-offset-2 control-label">Prosentase</label>
                            <div class="col-lg-6">
                                <input type="text" value="100" placeholder="100" name="prosentase" id="prosentase" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                </div>
                <div class="form-group row  hidden-form">
                        <label for="tipe" class="col-lg-2 col-lg-offset-1 control-label">Tipe</label> 
                        <select name="tipe" id="tipe" class="form-control" required autofocus>
                            <option></option>
                                <option Value="1">New</option>
                                <option Value="0.5">Konversi</option>
                                <option Value="0.05">Konversi & Revisi</option>
                            </select>
                            <span class="help-block with-errors"></span>
                    </div>


<!----------------------------------------------------------Real Form For Show------------------------------------------------------------------>
                <div class="form-group row hidden-form">
                        <label for="id_design" class="col-lg-1 col-lg-offset-2 control-label">ID Design</label>
                            <div class="col-lg-6">
                                <input type="number" name="id_design" id="id_design" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                <div class="form-group row">
                        <label for="prediksi_akhir" class="col-lg-1 col-lg-offset-2 control-label">Prediksi Release</label>
                            <div class="col-lg-6">
                                <input type="date" name="prediksi_akhir" id="prediksi_akhir" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                <div class="form-group row">
                        <label for="kode_design" class="col-lg-1 col-lg-offset-2 control-label">Kode Design</label>
                            <div class="col-lg-6">
                                <input type="text" name="kode_design" id="kode_design" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_design" class="col-lg-1 col-lg-offset-2 control-label">Nama Design</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_design" id="nama_design" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="revisi" class="col-lg-1 col-lg-offset-2 control-label">Revisi</label>
                            <div class="col-lg-6">
                                <input type="text" name="revisi" id="revisi" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-lg-1 col-lg-offset-2 control-label">Status</label>
                            <div class="col-lg-6">
                                <input value="Release" placeholder="Release" type="text" name="status" id="status" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->
                    
                </div>
                <div class="modal-footer">
                    <button onclick="redirectTo" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Release Dokumen</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>