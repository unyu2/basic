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
                        <label for="nama_part" class="col-lg-2 col-lg-offset-1 control-label">Nama</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_part" id="nama_part" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_produk" class="col-lg-2 col-lg-offset-1 control-label">Part</label>
                        <div class="col-lg-6">
                            <select name="id_produk" id="id_produk" class="form-control" required autofocus>
                                <option value="">Pilih Part</option>
                                @foreach ($produk as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-lg-2 col-lg-offset-1 control-label">Jumlah</label>
                        <div class="col-lg-6">
                            <input type="text" name="jumlah" id="jumlah" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan" class="col-lg-2 col-lg-offset-1 control-label">satuan</label>
                        <div class="col-lg-6">   
                            <select value="satuan" name="satuan" id="satuan" class="form-control" required autofocus>
                                        <option value=""></option>
                                        <option value="pcs">PCS</option>
                                        <option value="set">SET</option>
                                        <option value="box">UNIT</option>
                                        <option value="m">m</option>
                                        <option value="m2">m2</option>
                                        <option value="m3">m3</option>
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