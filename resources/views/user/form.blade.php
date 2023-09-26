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
                        <label for="name" class="col-lg-3 col-lg-offset-1 control-label">Nama</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" id="name" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-lg-3 col-lg-offset-1 control-label">Email</label>
                        <div class="col-lg-6">
                            <input type="email" name="email" id="email" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-lg-3 col-lg-offset-1 control-label">Password</label>
                        <div class="col-lg-6">
                            <input type="password" name="password" id="password" class="form-control" 
                            required
                            minlength="6">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-lg-3 col-lg-offset-1 control-label">Konfirmasi Password</label>
                        <div class="col-lg-6">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" 
                                required
                                data-match="#password">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nip" class="col-lg-3 col-lg-offset-1 control-label">NIP</label>
                        <div class="col-lg-6">
                            <input type="text" name="nip" id="nip" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bagian" class="col-lg-3 col-lg-offset-1 control-label">Bagian</label>
                        <div class="col-lg-6">
                        <select type="text" name="bagian" id="bagian" class="form-control" required autofocus>
                            <option value=""></option>
                            @foreach ($strata as $item)
                            <option value="{{ $item->id_jabatan }}">{{ $item->nama_jabatan }}</option>
                             @endforeach  
                        </select>

                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="level" class="col-lg-3 col-lg-offset-1 control-label">Level Sistem</label>
                        <div class="col-lg-6">   
                            <select name="level" id="level" class="form-control" required>
                            <option value=""></option>
                            @foreach ($levels as $item)
                            <option value="{{ $item->id_level }}">{{ $item->nama_level }}</option>
                             @endforeach  
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_karyawan" class="col-lg-3 col-lg-offset-1 control-label">Status Karyawan</label>
                        <div class="col-lg-6">   
                            <select name="status_karyawan" id="status_karyawan" class="form-control" required>
                            <option value=""></option>
                            <option value="Organik INKA">Organik INKA</option>
                            <option value="PKWT INKA">PKWT INKA</option>
                            <option value="Organik IMS">Organik IMS</option>
                            <option value="PKWT IMS">PKWT IMS</option>
                            <option value="PKWT IMSS">PKWT IMSS</option>
                            </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kompetensi" class="col-lg-3 col-lg-offset-1 control-label">Kompetensi</label>
                        <div class="col-lg-6">
                            <textarea name="kompetensi" id="kompetensi" class="form-control" required autofocus></textarea>
                            <span class="help-block with-errors"></span>
                            <span style="color: green;">Pisahkan dengan titik koma (;). Contoh: Embeded System , RFID , Dst...</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sertifikasi" class="col-lg-3 col-lg-offset-1 control-label">Sertifikasi</label>
                        <div class="col-lg-6">
                            <textarea name="sertifikasi" id="sertifikasi" class="form-control" required autofocus></textarea>
                            <span class="help-block with-errors"></span>
                            <span style="color: green;">Pisahkan dengan koma (,). Contoh: Project Management , Auditor , Dst...</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="training" class="col-lg-3 col-lg-offset-1 control-label">Training</label>
                        <div class="col-lg-6">
                            <textarea name="training" id="training" class="form-control" required autofocus></textarea>
                            <span class="help-block with-errors"></span>
                            <span style="color: green;">Pisahkan dengan koma (,). Contoh: Autodesk Vault , Autocad , Dst...</span>
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