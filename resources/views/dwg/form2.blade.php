<div class="modal fade" id="modal-form2" tabindex="-1" role="dialog" aria-labelledby="modal-form2">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data" data-toggle="validator">
            @csrf
            @method('POST')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                <div class="form-group row">
                        <label for="revisi" class="col-lg-1 col-lg-offset-1 control-label">Revisi</label>
                        <div class="col-lg-3">
                            <input value="" type="text" name="revisi" id="revisi" class="form-control" required autofocus readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="prediksi" class="col-lg-1 col-lg-offset-1 control-label">Prediksi (satuan:hari)</label>
                        <div class="col-lg-3">
                            <input type="text" name="prediksi" id="prediksi" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                <div class="form-group row">
                        <label for="id_proyek" class="col-lg-1 col-lg-offset-1 control-label">Proyek</label>
                        <div class="col-lg-3">
                            <select type="text" name="id_proyek" id="id_proyek" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($proyek as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="id_kepala_gambar" class="col-lg-1 col-lg-offset-1 control-label">Kepala Gambar</label>
                        <div class="col-lg-3">
                            <select type="text" name="id_kepala_gambar" id="id_kepala_gambar" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($kepala as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kode_dwg" class="col-lg-1 col-lg-offset-1 control-label">Nomor Gambar</label>
                        <div class="col-lg-3">
                            <input type="text" name="kode_dwg" id="kode_dwg" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="nama_dwg" class="col-lg-1 col-lg-offset-1 control-label">Nama Gambar</label>
                        <div class="col-lg-3">
                            <input type="text" name="nama_dwg" id="nama_dwg" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <br></br>

                    <div class="form-group row">
                        <label for="bobot" class="col-lg-1 col-lg-offset-1 control-label">Bobot</label>
                        <div class="col-lg-2">
                            <select type="text" name="bobot" id="bobot" class="form-control" required autofocus>
                            <option></option>
                                <option Value="1">Low</option>
                                <option Value="2">Medium</option>
                                <option Value="3">High</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="size" class="col-lg-1 col-lg-offset-1 control-label">Size</label>
                        <div class="col-lg-2">
                            <select type="text" name="size" id="size" class="form-control" required autofocus>
                            <option></option>
                                <option Value="32">A0</option>
                                <option Value="24">A1</option>
                                <option Value="16">A2</option>
                                <option Value="8">A3</option>
                                <option Value="4">A4</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="lembar" class="col-lg-1 col-lg-offset-1 control-label">Sheet</label>
                        <div class="col-lg-2">
                            <select type="text" name="lembar" id="lembar" class="form-control" required autofocus>
                            <option></option>
                                <option Value="1">1</option>
                                <option Value="2">2</option>
                                <option Value="3">3</option>
                                <option Value="4">4</option>
                                <option Value="5">5</option>
                                <option Value="6">6</option>
                                <option Value="7">7</option>
                                <option Value="8">8</option>
                                <option Value="9">9</option>
                                <option Value="10">10</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <br></br>

                    <div class="form-group row">
                        <label for="id_draft" class="col-lg-1 col-lg-offset-1 control-label">Drafter</label>
                        <div class="col-lg-2">
                            <select type="text" name="id_draft" id="id_draft" class="form-control" required autofocus>
                                <option></option>
                            @foreach ($approver as $key => $item)
                                     <option value="{{ $key }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="id_check" class="col-lg-1 col-lg-offset-1 control-label">Checker</label>
                        <div class="col-lg-2">
                            <select type="text" name="id_check" id="id_check" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($approver as $key => $item)
                                     <option value="{{ $key }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="id_approve" class="col-lg-1 col-lg-offset-1 control-label">Approver</label>
                        <div class="col-lg-2">
                            <select type="text" name="id_approve" id="id_approve" class="form-control" required autofocus>
                            <option></option>
                            @foreach ($approver as $key => $item)
                                     <option value="{{ $key }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <br></br>

                    <div class="form-group row">
                        <label for="konf1" class="col-lg-1 col-lg-offset-1 control-label">Konf 1</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf1" id="konf1" class="form-control" autofocus>
                                <option></option>
                            @foreach ($konfigurasi as $key => $item)
                                     <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf2" class="col-lg-1 col-lg-offset-1 control-label">Konf 2</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf2" id="konf2" class="form-control" autofocus>
                            <option></option>
                            @foreach ($konfigurasi as $key => $item)
                                     <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf3" class="col-lg-1 col-lg-offset-1 control-label">Konf 3</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf3" id="konf3" class="form-control" autofocus>
                            <option></option>
                            @foreach ($konfigurasi as $key => $item)
                                     <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="konf4" class="col-lg-1 col-lg-offset-1 control-label">Konf 4</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf4" id="konf4" class="form-control" autofocus>
                                <option></option>
                            @foreach ($konfigurasi as $key => $item)
                                     <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf5" class="col-lg-1 col-lg-offset-1 control-label">Konf 5</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf5" id="konf5" class="form-control" autofocus>
                            <option></option>
                            @foreach ($konfigurasi as $key => $item)
                                     <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf6" class="col-lg-1 col-lg-offset-1 control-label">Konf 6</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf6" id="konf6" class="form-control" autofocus>
                            <option></option>
                            @foreach ($konfigurasi as $key => $item)
                                     <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="konf7" class="col-lg-1 col-lg-offset-1 control-label">Konf 7</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf7" id="konf7" class="form-control" autofocus>
                                <option></option>
                            @foreach ($konfigurasi as $key => $item)
                                     <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf8" class="col-lg-1 col-lg-offset-1 control-label">Konf 8</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf8" id="konf8" class="form-control" autofocus>
                            <option></option>
                            @foreach ($konfigurasi as $key => $item)
                                     <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf9" class="col-lg-1 col-lg-offset-1 control-label">Konf 9</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf9" id="konf6" class="form-control" autofocus>
                            <option></option>
                            @foreach ($konfigurasi as $key => $item)
                                     <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
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