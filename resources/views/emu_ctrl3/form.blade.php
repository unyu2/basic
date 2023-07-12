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
                        <label for="kode_emu" class="col-lg-2 col-lg-offset-1 control-label">Token</label>
                        <div class="col-lg-6">
                            <input type="text" value="kode_emu" name="kode_emu" id="kode_emu" class="form-control" readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>                 
                    <div class="form-group row">
                        <label for="id_emu" class="col-lg-2 col-lg-offset-1 control-label">ID Pengujian</label>
                        <div class="col-lg-6">
                            <input type="text" name="id_emu" id="id_emu" class="form-control" value="id_emu" readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="nama_proyek" class="col-lg-2 col-lg-offset-1 control-label">Proyek</label>
                                <div class="col-lg-6">
                                     <input value="nama_proyek" name="nama_proyek" id="nama_proyek" class="form-control" readonly>
                                     <span class="help-block with-errors"></span>
                                </div>
                    </div>
                    <div class="form-group row">
                            <label for="id_car" class="col-lg-2 col-lg-offset-1 control-label">Trainset</label>
                                <div class="col-lg-6">
                                     <input value="id_car" name="id_car" id="id_car" class="form-control" readonly>
                                     <span class="help-block with-errors"></span>
                                </div>
                    </div
<br>
<br>
<br>
                    <div class="form-group row">
                                <label for="nama_dmu1" class="col-lg-1 control-label">Pengujian 1</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu1" name="nama_dmu1" class="form-control" value="nama_dmu1" readonly>
                                    </textarea>
                                </div>
                                <label for="lokasi1" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="lokasi1" class="form-control" value="lokasi1" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="metode1" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="metode1" class="form-control" value="metode1" readonly>
                                    </textarea>
                                </div>
                                <label for="standar1" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="standar1" class="form-control" value="standar1" readonly>
                                    </textarea>
                                </div>
</div>
                        <br>
                        <a> <b> !!!!! KOSONGKAN BILA DATA SEBELUMNYA KOSONG !!!!! HANYA ISI YANG BERSTATUS = "BELUM" !!!!!</b></a>
                        <br>
                            <div class="form-group row">
                                <label for="M1_1" class="col-lg-1 control-label">M1</label>
                                <div class="col-lg-2">
                                    <select name="M1_1" id="M1_1" class="form-control">
                                        <option value="M1_1"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="M2_1" class="col-lg-1 control-label">M2</label>
                                <div class="col-lg-2">
                                    <select name="M2_1" id="M2_1" class="form-control">
                                        <option value=""></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>

                                <label for="Mc1_1" class="col-lg-1 control-label">Mc1</label>
                                <div class="col-lg-2">
                                    <select name="Mc1_1" id="Mc1_1" class="form-control">
                                        <option value="Mc1_1"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="Mc2_1" class="col-lg-1 control-label">Mc2</label>
                                <div class="col-lg-2">
                                    <select name="Mc2_1" id="Mc2_1" class="form-control">
                                        <option value=""></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="T1_1" class="col-lg-1 control-label">T1 </label>
                                <div class="col-lg-2">
                                    <select name="T1_1" id="T1_1" class="form-control">
                                        <option value=""></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="T2_1" class="col-lg-1 control-label">T2</label>
                                <div class="col-lg-2">
                                    <select name="T2_1" id="T2_1" class="form-control">
                                        <option value=""></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="T3_1" class="col-lg-1 control-label">T3</label>
                                <div class="col-lg-2">
                                    <select name="T3_1" id="T3_1" class="form-control">
                                        <option value="T3_1"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="T4_1" class="col-lg-1 control-label">T4</label>
                                <div class="col-lg-2">
                                    <select name="T4_1" id="T4_1" class="form-control">
                                        <option value="T4_1"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="Tc1_1" class="col-lg-1 control-label">Tc1</label>
                                <div class="col-lg-2">
                                    <select name="Tc1_1" id="Tc1_1" class="form-control">
                                        <option value="Tc1_1"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="Tc2_1" class="col-lg-1 control-label">Tc2</label>
                                <div class="col-lg-2">
                                    <select name="Tc2_1" id="Tc2_1" class="form-control">
                                        <option value="Tc2_1"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="Tc3_1" class="col-lg-1 control-label">Tc3</label>
                                <div class="col-lg-2">
                                    <select name="Tc3_1" id="Tc3_1" class="form-control">
                                        <option value="Tc3_1"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="Tc4_1" class="col-lg-1 control-label">Tc4</label>
                                <div class="col-lg-2">
                                    <select name="Tc4_1" id="Tc4_1" class="form-control">
                                        <option value="Tc4_1"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p1" class="col-lg-1 control-label">Kerusakan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p1" name="p1" class="form-control" value="">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>
                            <br>
                            <br>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="form-group row">
                                <label for="nama_dmu2" class="col-lg-1 control-label">Pengujian 2</label>
                                <div class="col-lg-7">
                                    <textarea type="text" id="nama_dmu2" name="nama_dmu2" class="form-control" value="nama_dmu2" readonly>
                                    </textarea>
                                </div>
                                <label for="lokasi2" class="col-lg-1 control-label">Lokasi</label>
                                <div class="col-lg-3">
                                    <input type="text" id="lokasi2" class="form-control" value="lokasi2" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="metode2" class="col-lg-1 control-label">Metode</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="metode2" class="form-control" value="metode2" readonly>
                                    </textarea>
                                </div>
                                <label for="standar2" class="col-lg-1 control-label">Standar</label>
                                <div class="col-lg-5">
                                    <textarea type="text" id="standar2" class="form-control" value="standar2" readonly>
                                    </textarea>
                                </div>
</div>
                        <br>
                        <a> <b> !!!!! KOSONGKAN BILA DATA SEBELUMNYA KOSONG !!!!! HANYA ISI YANG BERSTATUS = "BELUM" !!!!!</b></a>
                        <br>
                            <div class="form-group row">
                                <label for="M1_2" class="col-lg-1 control-label">M1</label>
                                <div class="col-lg-2">
                                    <select name="M1_2" id="M1_2" class="form-control">
                                        <option value="M1_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="M2_2" class="col-lg-1 control-label">M2</label>
                                <div class="col-lg-2">
                                    <select name="M2_2" id="M2_2" class="form-control">
                                        <option value="M2_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>

                                <label for="Mc1_1" class="col-lg-1 control-label">Mc1</label>
                                <div class="col-lg-2">
                                    <select name="Mc1_1" id="Mc1_1" class="form-control">
                                        <option value="Mc1_1"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="Mc2_2" class="col-lg-1 control-label">Mc2</label>
                                <div class="col-lg-2">
                                    <select name="Mc2_2" id="Mc2_2" class="form-control">
                                        <option value="Mc2_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="T1_2" class="col-lg-1 control-label">T1 </label>
                                <div class="col-lg-2">
                                    <select name="T1_2" id="T1_2" class="form-control">
                                        <option value="T1_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="T2_2" class="col-lg-1 control-label">T2</label>
                                <div class="col-lg-2">
                                    <select name="T2_2" id="T2_2" class="form-control">
                                        <option value="T2_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="T3_2" class="col-lg-1 control-label">T3</label>
                                <div class="col-lg-2">
                                    <select name="T3_2" id="T3_2" class="form-control">
                                        <option value="T3_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="T4_2" class="col-lg-1 control-label">T4</label>
                                <div class="col-lg-2">
                                    <select name="T4_2" id="T4_2" class="form-control">
                                        <option value="T4_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                <label for="Tc1_2" class="col-lg-1 control-label">Tc1</label>
                                <div class="col-lg-2">
                                    <select name="Tc1_2" id="Tc1_2" class="form-control">
                                        <option value="Tc1_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="Tc2_2" class="col-lg-1 control-label">Tc2</label>
                                <div class="col-lg-2">
                                    <select name="Tc2_2" id="Tc2_2" class="form-control">
                                        <option value="Tc2_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="Tc3_2" class="col-lg-1 control-label">Tc3</label>
                                <div class="col-lg-2">
                                    <select name="Tc3_2" id="Tc3_2" class="form-control">
                                        <option value="Tc3_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                                <label for="Tc4_2" class="col-lg-1 control-label">Tc4</label>
                                <div class="col-lg-2">
                                    <select name="Tc4_2" id="Tc4_2" class="form-control">
                                        <option value="Tc4_2"></option>
                                        <option value="ok">OK</option>
                                        <option value="nok">NOK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="p2" class="col-lg-1 control-label">Kerusakan</label>
                                <div class="col-lg-11">
                                    <textarea type="text" id="p2" name="p2" class="form-control" value="">
                                </textarea> <a><b>Hanya Di isi Bila Terdapat NOK. | Format: Nama car -> problem. | Example: M1 -> Lampu Rusak, dst.</b> </a>
                                </div>
                            </div>
                            <br>
                            <br>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
                            <br>            

                        <br>
                        <br>
                            <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i>Followed Up</button>
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