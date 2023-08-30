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
                <div class="form-group row">
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