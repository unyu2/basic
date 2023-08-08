<div class="modal fade" id="modal-form2" tabindex="-1" role="dialog" aria-labelledby="modal-form2">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
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
                        <label for="jumlah" class="col-lg-2 col-lg-offset-1 control-label">Jumlah Permintaan </label>
                        <div class="col-lg-6">
                            <textarea name="jumlah" id="jumlah" rows="3" class="form-control" readonly></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_proyek" class="col-lg-2 col-lg-offset-1 control-label">Cross Check Proyek</label>
                        <div class="col-lg-6">
                            <select value="id_proyek" name="id_proyek" id="id_proyek" class="form-control" required>
                            @foreach ($proyek as $key => $item)            
                            <option value="{{$key}}">{{$item}}</option>
                            @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 control-label">Status</label>
                        <div class="col-lg-6">
                            <select value="status" name="status" id="status" class="form-control" required>
                                        <option value="Diterima">Diterima</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status2" class="col-lg-1 col-lg-offset-1 control-label">Status PR</label>
                        <div class="col-lg-3">
                            <input value="PR" name="status2" id="status2" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="nopr" class="col-lg-1 col-lg-offset-1 control-label">No PR</label>
                        <div class="col-lg-3">
                            <input name="nopr" id="nopr" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status3" class="col-lg-1 col-lg-offset-1 control-label">Status PO</label>
                        <div class="col-lg-3">
                            <input value="PO" name="status3" id="status3" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="nopo" class="col-lg-1 col-lg-offset-1 control-label">No PO</label>
                        <div class="col-lg-3">
                            <input name="nopo" id="nopo" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="site" class="col-lg-2 col-lg-offset-1 control-label">ETA ON SITE</label>
                        <div class="col-lg-6">
                            <input type="date" name="site" id="site" class="form-control datepicker">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="submit" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>