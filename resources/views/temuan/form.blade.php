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
                            <input type="text" name="kode_emu" id="kode_emu" class="form-control"> Cari token pada Form inspeksi | Di Isi Bila Ada
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ncr" class="col-lg-2 col-lg-offset-1 control-label">No NCR</label> 
                        <div class="col-lg-6">
                            <input type="text" name="ncr" id="ncr" class="form-control"> Cari No NCR Yang Mengandung Permasalahan
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="id_proyek" class="col-lg-2 col-lg-offset-1 control-label">Proyek</label>
                        <div class="col-lg-6">
                        <select name="id_proyek" id="id_proyek" class="form-control" required autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($proyek as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="id_car" class="col-lg-2 col-lg-offset-1 control-label">Trainset</label>
                        <div class="col-lg-6">
                        <select name="id_car" id="id_car" class="form-control" required autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($car as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="car" class="col-lg-2 col-lg-offset-1 control-label">Car</label>
                        <div class="col-lg-6">
                        <select name="car" id="car" class="form-control" required autofocus>
                                <option></option required autofocus>
                                <option>All Car</option>
                                <option>M1</option>
                                <option>M2</option>
                                <option>MC1</option>
                                <option>MC2</option>
                                <option>T1</option>
                                <option>T2</option>
                                <option>T3</option>
                                <option>T4</option>
                                <option>TC1</option>
                                <option>TC2</option>
                                <option>TC3</option>
                                <option>TC4</option>
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="level" class="col-lg-2 col-lg-offset-1 control-label">Bobot</label>
                        <div class="col-lg-6">
                        <select name="level" id="level" class="form-control" required autofocus>
                                <option></option required autofocus>
                                <option>Low</option>
                                <option>Medium</option>
                                <option>High</option>
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="bagian" class="col-lg-2 col-lg-offset-1 control-label">Bagian</label>
                        <div class="col-lg-6">
                        <select name="bagian" id="bagian" class="form-control" required autofocus>
                                <option></option>
                                <option>Electrical</option>
                                <option>Mechanical</option>
                                <option>Interior</option>
                                <option>Pneumatic</option>
                                <option>AC</option>
                                <option>System</option>
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="subsistem" class="col-lg-2 col-lg-offset-1 control-label">Sub System</label>
                        <div class="col-lg-6">
                        <select name="subsistem" id="subsistem" class="form-control" required autofocus>
                                <option value="AC">Air Conditioning</option>
                                <option value="ACC">Accessories</option>
                                <option value="AUX">Auxiliary</option>
                                <option value="BS">Board System</option>
                                <option value="DS">Door System</option>
                                <option value="MS">Mechanical System</option>
                                <option value="PIS">Passanger Information System</option>
                                <option value="PS">Propultion System</option>
                                <option value="TS">Traction System</option>
                                <option value="TCMS">TCMS</option>
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_temuan" class="col-lg-2 col-lg-offset-1 control-label">Kasus Temuan</label>
                        <div class="col-lg-6">
                            <textarea name="nama_temuan" id="nama_temuan" class="form-control" required autofocus>    
                        </textarea>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="id_produk" class="col-lg-2 col-lg-offset-1 control-label">Komponen Sesuai BOM/K</label>
                        <div class="col-lg-6">
                        <select name="id_produk" id="id_produk" class="form-control" required autofocus>
                                <option value=""></option required autofocus>
                                @foreach ($produk as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_produks" class="col-lg-2 col-lg-offset-1 control-label">Detail Komponen</label>
                        <div class="col-lg-6">
                            <input name="nama_produks" id="nama_produks" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-lg-2 col-lg-offset-1 control-label">Jumlah</label>
                        <div class="col-lg-6">
                            <input name="jumlah" id="jumlah" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_user" class="col-lg-2 col-lg-offset-1 control-label">ID User</label>
                        <div class="col-lg-6">
                            <input value="{{auth()->id()}}" name="id_user" id="id_user" class="form-control" readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="jenis" class="col-lg-2 col-lg-offset-1 control-label">Jenis Permasalahan</label>
                        <div class="col-lg-6">
                        <select name="jenis" id="jenis" class="form-control" required autofocus>
                                <option></option>
                                <option value="Tidak Berfungsi Total">Tidak Berfungsi Total</option>
                                <option value="Error (Tidak Berfungsi Sebagian)">Error (Tidak Berfungsi Sebagian)</option>
                                <option value="Lepas">Lepas</option>
                                <option value="Kendor">Kendor</option>
                                <option value="Berubah Bentuk">Berubah Bentuk</option>
                                <option value="Putus">Putus</option>
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="dampak" class="col-lg-2 col-lg-offset-1 control-label">Dampak</label>
                        <div class="col-lg-6">
                        <select name="dampak" id="dampak" class="form-control" required autofocus>
                                <option></option>
                                <option value="5">Sangat Fatal -Kereta Tidak Dapat Berjalan Total (5)</option>
                                <option value="4">Cukup Fatal - Fungsi Sistem Utama Terganggu (4)</option>
                                <option value="3">Fatal - TERHENTI nya Fungsi Sistem Pembatu (3)</option>
                                <option value="2">Sedang - TERGANGGU nya Fungsi Sistem Pembatu (2)</option>
                                <option value="1">Ringan - Menyebabkan ketidaknyamanan penumpang (1)</option>
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="frekuensi" class="col-lg-2 col-lg-offset-1 control-label">Frekuensi</label>
                        <div class="col-lg-6">
                        <select name="frekuensi" id="frekuensi" class="form-control" required autofocus>
                                <option></option>
                                <option value="5">Hampir Pasti Terjadi - 5 Kali Selama Proyek Yang Sejenis (5)</option>
                                <option value="4">Sangat Tinggi - 4 Kali Selama Proyek Yang Sejenis (4)</option>
                                <option value="3">Tinggi -  3 Kali Selama Proyek Yang Sejenis (3)</option>
                                <option value="2">Cukup Tinggi - 2 Kali Selama Proyek Yang Sejenis (2)</option>
                                <option value="1">Rendah - Terjadi Pertama kali (1)</option>
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="pantau" class="col-lg-2 col-lg-offset-1 control-label">Keterpantauan</label>
                        <div class="col-lg-6">
                        <select name="pantau" id="pantau" class="form-control" required autofocus>
                                <option></option>
                                <option value="5">Tidak Dapat Dipantau (5)</option>
                                <option value="4">Keterpantauan Rendah -  Memerlukan Tools Khusus (4)</option>
                                <option value="3">Keterpantauan Sedang -  Memerlukan SDM Khusus (3)</option>
                                <option value="2">Keterpantauan Tinggi -  Dapat dipantau tanpa perlu SDM & Tools Khusus (2)</option>
                                <option value="1">Dapat dipantau -  Teratomasi & terdapat warning sebelum kegagalan (1)</option>
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="operasi" class="col-lg-2 col-lg-offset-1 control-label">Apakah Membuat Kereta Tidak Siap Operasi ??</label>
                        <div class="col-lg-6">
                        <select name="operasi" id="operasi" class="form-control" required autofocus>
                                <option></option>
                                <option value="110">YA (TSO)</option>
                                <option value="0">TIDAK (SO)</option>
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 control-label">Status</label>
                        <div class="col-lg-6">
                            <input value="Open BO" name="status" id="status" class="form-control" readonly>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
</div>               

                        <br>
                        <br>
                            <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i>Simpan</button>
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