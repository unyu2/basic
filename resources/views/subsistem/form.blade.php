<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
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
                        <label for="id_sistem" class="col-lg-2 col-lg-offset-1 control-label">Sistem</label>
                        <div class="col-lg-6">
                            <select type="text" name="id_sistem" id="id_sistem" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($sistem as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_subsistem" class="col-lg-2 col-lg-offset-1 control-label">Nama Sub Sistem</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_subsistem" id="nama_subsistem" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="bobot" class="col-lg-2 col-lg-offset-1 control-label">Bobot</label>
                        <div class="col-lg-6">
                            <select type="text" name="bobot" id="bobot" class="form-control" required autofocus>
                                <option Value="1">Low</option>
                                <option Value="2">Medium</option>
                                <option Value="3">High</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>