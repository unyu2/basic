<style>
    .hidden-form {
        display: none;
    }
</style>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('design.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                        <label for="nama_design" class="col-lg-2 col-lg-offset-1 control-label">Nama Dinas</label> 
                        <div class="col-lg-6">
                            <input name="nama_design" id="nama_design" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="id_proyek" class="col-lg-2 col-lg-offset-1 control-label">Proyek</label>
                        <div class="col-lg-6">
                            <select type="text" name="id_proyek" id="id_proyek" class="form-control" required autofocus>
                                <option></option>
                                <option value="Normal">Tidak Terkait Proyek</option>
                                @foreach ($proyek as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_prediksi" class="col-lg-2 col-lg-offset-1 control-label datepicker">Prediksi Tanggal (Start)</label> 
                        <div class="col-lg-6 datepicker">
                            <input type="date" name="tanggal_prediksi" id="tanggal_prediksi" class="form-control datepicker">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="prediksi_hari" class="col-lg-2 col-lg-offset-1 control-label">Prediksi (Hari)</label> 
                        <div class="col-lg-6">
                            <input type="number" name="prediksi_hari" id="prediksi_hari" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
<!---------------------------------------------------------------------------------------------------------------------------------------- -->
                    
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>