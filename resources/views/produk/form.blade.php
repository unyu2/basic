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
                        <label for="nama_produk" class="col-lg-2 col-lg-offset-1 control-label">Nama</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan" class="col-lg-2 col-lg-offset-1 control-label">satuan</label>
                        <div class="col-lg-6">   
                            <select value="satuan" name="satuan" id="satuan" class="form-control" required autofocus>
                                        <option value=""></option>
                                        <option value="pcs">Pcs</option>
                                        <option value="set">Set</option>
                                        <option value="unit">Unit</option>
                                        <option value="box">Box</option>
                                        <option value="m">m</option>
                                        <option value="m2">m2</option>
                                        <option value="m3">m3</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_kategori" class="col-lg-2 col-lg-offset-1 control-label">Kategori</label>
                        <div class="col-lg-6">
                            <select name="id_kategori" id="id_kategori" class="form-control" required autofocus>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="komat" class="col-lg-2 col-lg-offset-1 control-label">Kode Material</label>
                        <div class="col-lg-6">
                            <input type="text" name="komat" id="komat" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <!--
                    <div class="form-group row">
                        <label for="id_supplier" class="col-lg-2 col-lg-offset-1 control-label">Supplier</label>
                        <div class="col-lg-6">
                            <select name="id_supplier" id="id_supplier" class="form-control" required autofocus>
                                <option value="">Pilih Supplier</option>
                                @foreach ($supplier as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="id_supplier" class="col-lg-2 col-lg-offset-1 control-label"></label> 
                        <div class="col-lg-2">
                            <button onclick="addSupplier()" type="button" class="btn btn-info">Pilih Supplier</button>
                        </div>
                        <div class="col-lg-4">
                            <input name="id_supplier" id="id_supplier" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="spesifikasi" class="col-lg-2 col-lg-offset-1 control-label">Spesifikasi</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="spesifikasi" id="spesifikasi" class="form-control" required autofocus placeholder="Masukkan Spesifikasi"></textarea>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-lg-2 col-lg-offset-1 control-label">Keterangan</label>
                        <div class="col-lg-6">
                            <textarea type="text" name="keterangan" id="keterangan" class="form-control">
                            </textarea>
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