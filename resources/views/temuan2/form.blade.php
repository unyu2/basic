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
                        <label for="kode_emu" class="col-lg-2 col-lg-offset-1 control-label">Token Inspeksi</label> 
                        <div class="col-lg-6">
                            <input type="text" name="kode_emu" id="#" class="form-control" readonly> Cari token pada Form inspeksi | Di Isi Bila Ada
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ncr" class="col-lg-2 col-lg-offset-1 control-label">No NCR</label> 
                        <div class="col-lg-6">
                            <input type="text" name="ncr" id="#" class="form-control" readonly> Cari No NCR Yang Mengandung Permasalahan
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_temuan" class="col-lg-2 col-lg-offset-1 control-label">Kasus Temuan</label>
                        <div class="col-lg-6">
                            <textarea name="nama_temuan" id="#" class="form-control" readonly>    
                        </textarea>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="id_produk" class="col-lg-2 col-lg-offset-1 control-label">Komponen</label>
                        <div class="col-lg-6">
                        <select name="id_produk" id="#" class="form-control" readonly>
                        @foreach ($produk as $key => $item)
                                <option value=""></option required autofocus>
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>

                            <input type="hidden" value="{{auth()->id()}}" name="id_users" id="#" class="form-control" readonly>
                            <span class="help-block with-errors"></span>

                    <div class="form-group row">
                    <label for="jenis" class="col-lg-2 col-lg-offset-1 control-label">Jenis Permasalahan</label>
                        <div class="col-lg-6">
                        <input name="jenis" id="jenis" class="form-control" readonly>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="level" class="col-lg-2 col-lg-offset-1 control-label">Bobot</label>
                        <div class="col-lg-6">
                        <input name="level" id="level" class="form-control" readonly>               
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 control-label">Status</label>
                        <div class="col-lg-6">
                        <input value="Closed" name="status" id="status" class="form-control" readonly>                      
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="aksi" class="col-lg-2 col-lg-offset-1 control-label">Penyelesaian</label>
                        <div class="col-lg-6">
                        <select name="aksi" id="aksi" class="form-control" required autofocus>
                        <option></option>
                        <option>Pengadaan</option>
                        <option>Perbaikan</option>
                        <option>Pengadaan & Perbaikan</option>
                        </select>                        
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penyelesaian" class="col-lg-2 col-lg-offset-1 control-label">Detail Penyelesaian</label>
                        <div class="col-lg-6">
                            <textarea name="penyelesaian" id="penyelesaian" class="form-control" required autofocus>    
                        </textarea>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penyebab" class="col-lg-2 col-lg-offset-1 control-label">Penyebab</label>
                        <div class="col-lg-6">
                            <textarea name="penyebab" id="penyebab" class="form-control">    
                        </textarea>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="akibat1" class="col-lg-2 col-lg-offset-1 control-label">Akibat Lokal (Sistem Lokal)</label>
                        <div class="col-lg-6">
                            <textarea name="akibat1" id="akibat1" class="form-control" >    
                        </textarea>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="akibat2" class="col-lg-2 col-lg-offset-1 control-label">Akibat Level 1 (Sistem Integrasi)</label>
                        <div class="col-lg-6">
                            <textarea name="akibat2" id="akibat2" class="form-control" >    
                        </textarea>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="akibat3" class="col-lg-2 col-lg-offset-1 control-label">Akibat Level 2 (Kereta)</label>
                        <div class="col-lg-6">
                            <textarea name="akibat3" id="akibat3" class="form-control" >    
                        </textarea>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="saran" class="col-lg-2 col-lg-offset-1 control-label">Saran</label>
                        <div class="col-lg-6">
                            <textarea name="saran" id="saran" class="form-control" >    
                        </textarea>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
</div>               

                        <br>
                        <br>
                            <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i>Close Item</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

            </div>
        </form>
    </div>
</div>