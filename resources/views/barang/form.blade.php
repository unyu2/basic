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
                        <label for="nama_barang" class="col-lg-2 col-lg-offset-1 control-label">Nama Barang</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-lg-2 col-lg-offset-1 control-label">Jumlah</label>
                        <div class="col-lg-6">
                            <input type="number" name="jumlah" id="jumlah" class="form-control" required autofocus>
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
                        <label for="merk" class="col-lg-2 col-lg-offset-1 control-label">Merk</label>
                        <div class="col-lg-6">
                            <input type="text" name="merk" id="merk" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="asal" class="col-lg-2 col-lg-offset-1 control-label">Asal</label>
                        <div class="col-lg-6">
                            <input type="text" name="asal" id="asal" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 control-label">Status</label>
                        <div class="col-lg-6">   
                            <select value="status" name="status" id="status" class="form-control" required autofocus>
                                        <option value=""></option>
                                        <option>Pinjam</option>
                                        <option>Beli</option>
                                        <option>Sudah Ada</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pj" class="col-lg-2 col-lg-offset-1 control-label">Kategori</label>
                        <div class="col-lg-6">
                            <select name="pj" id="pj" class="form-control" required autofocus>
                                <option value=""></option>
                                @foreach ($user as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-lg-2 col-lg-offset-1 control-label">Lokasi</label>
                        <div class="col-lg-6">   
                            <select value="lokasi" name="lokasi" id="lokasi" class="form-control" required autofocus>
                                        <option value=""></option>
                                        <option>Office</option>
                                        <option>Kontrakan</option>
                                        <option>Home Base</option>
                                        <option>Dibawa PJ</option>
                            <span class="help-block with-errors"></span>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
          <!--              <label for="jumlah" class="col-lg-2 col-lg-offset-1 control-label">Jumlah</label> -->
                        <div class="col-lg-6">
                            <input type="hidden" name="stok" id="stok" class="form-control" required autofocus>
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