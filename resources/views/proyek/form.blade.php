@push('css')
<link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush
 
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
                        <label for="kode_proyek" class="col-lg-2 col-lg-offset-1 control-label">Kode Proyek</label>
                        <div class="col-lg-6">
                            <input type="text" name="kode_proyek" id="kode_proyek" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_proyek" class="col-lg-2 col-lg-offset-1 control-label">Proyek</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_proyek" id="nama_proyek" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                    <a #PILIH TIPE KERETA YANG ADA PADA PROYEK#>  </a>
                    </div>
                    
                    <div class="form-group row">
                        <label for="konf1" class="col-lg-1 control-label">Tipe Kereta 1</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf1" id="konf1" class="form-control"  autofocus>
                                <option></option>
                                @foreach ($konfigurasi as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf2" class="col-lg-1 control-label">Tipe Kereta 2</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf2" id="konf2" class="form-control"  autofocus>
                                <option></option>
                                @foreach ($konfigurasi as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf3" class="col-lg-1 control-label">Tipe Kereta 3</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf3" id="konf3" class="form-control"  autofocus>
                                <option></option>
                                @foreach ($konfigurasi as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf4" class="col-lg-1 control-label">Tipe Kereta 4</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf4" id="konf4" class="form-control"  autofocus>
                                <option></option>
                                @foreach ($konfigurasi as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="konf5" class="col-lg-1 control-label">Tipe Kereta 5</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf5" id="konf5" class="form-control"  autofocus>
                                <option></option>
                                @foreach ($konfigurasi as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf6" class="col-lg-1 control-label">Tipe Kereta 6</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf6" id="konf6" class="form-control"  autofocus>
                                <option></option>
                                @foreach ($konfigurasi as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf7" class="col-lg-1 control-label">Tipe Kereta 7</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf7" id="konf7" class="form-control"  autofocus>
                                <option></option>
                                @foreach ($konfigurasi as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="konf8" class="col-lg-1 control-label">Tipe Kereta 8</label>
                        <div class="col-lg-2">
                            <select type="text" name="konf8" id="konf8" class="form-control"  autofocus>
                                <option></option>
                                @foreach ($konfigurasi as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start_date" class="col-lg-2 col-lg-offset-1 control-label">Tanggal Mulai</label>
                        <div class="col-lg-6">
                            <input type="date" name="start_date" id="start_date" class="form-control datepicker" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="finish_date" class="col-lg-2 col-lg-offset-1 control-label">Tanggal Finish</label>
                    <div class="col-lg-6">
                        <input type="date" name="finish_date" id="finish_date" class="form-control datepicker" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 control-label">Status</label>
                        <div class="col-lg-6">
                            <select type="text" name="status" id="status" class="form-control" required autofocus>
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
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


<script src="/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>

jQuery(document).ready(function ($) {
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        });
    });

    </script>