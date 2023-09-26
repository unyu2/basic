<style>
    .hidden-form {
        display: none;
    }
</style>

<div class="modal fade" id="modal-form2" tabindex="-1" role="dialog" aria-labelledby="modal-form2">
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
                        <label for="kode_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Kode Design</label>
                            <div class="col-lg-6">
                                <input type="text" name="kode_tekprod" id="" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Nama Design</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_tekprod" id="" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_tekprod" class="col-lg-1 col-lg-offset-2 control-label">Status</label>
                            <div class="col-lg-6">
                                <input value="Proses Revisi" placeholder="Proses Revisi" type="text" name="status_tekprod" id="status_tekprod" class="form-control" required autofocus readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                    </div>
                    <div class="form-group row hidden-form">
                        <label for="tipe_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Tipe</label> 
                        <div class="col-lg-6">
                        <select name="tipe_tekprod" id="tipe_tekprod" class="form-control" required autofocus readonly>
                                <option></option>
                                <option Value="1">New</option>
                                <option Value="0.5">Konversi</option>
                                <option Value="0.05">Konversi & Revisi</option>
                         </select>
                         </div>
                            <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group row">
                        <label for="bobot_rev_tekprod" class="col-lg-2 col-lg-offset-1 control-label">Bobot Rev</label> 
                        <div class="col-lg-6">
                        <select type="text" name="bobot_rev_tekprod" id="bobot_rev_tekprod" class="form-control" required autofocus>
                            <option></option>
                            <option value="3">Berubah Total</option>
                            <option value="2">Berubah Sebagian</option>
                            <option value="1">Sedikit Penyesuaian</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                </div>

<!---------------------------------------------------------------------------------------------------------------------------------------- -->

                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Tingkatkan Revisi</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>