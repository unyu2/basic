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
                            <label for="id_car" class="col-lg-2 col-lg-offset-1 control-label">Trainset</label>
                                <div class="col-lg-6">
                                     <input value="id_car" name="id_car" id="id_car" class="form-control" readonly>
                                     <span class="help-block with-errors"></span>
                                </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 control-label">Status IS</label>
                        <div class="col-lg-6">
                            <input name="status" id="status"  class="form-control" readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Approved" class="col-lg-2 col-lg-offset-1 control-label">Status Masalah</label>
                        <div class="col-lg-6">
                            <input value="Followed Up" name="Approved" id="Approved" class="form-control" readonly> 
                            <span class="help-block with-errors"></span>
                        </div>
</div>
<br>
<br>
                    @foreach ($emu as $item)
                       @if(!empty($item->p1))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 1</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu1" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p1" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 1</label>
                        <div class="col-lg-6">
                            <textarea value="p1" type="text" name="p1" id="p1" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p2))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 2</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu2" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p2" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 2</label>
                        <div class="col-lg-6">
                            <textarea value="p2" type="text" name="p2" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p3))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 3</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu3" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p3" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 3</label>
                        <div class="col-lg-6">
                            <textarea value="p3" type="text" name="p3" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p4))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 4</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu4" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p4" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 4</label>
                        <div class="col-lg-6">
                            <textarea value="p4" type="text" name="p4" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p5))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 5</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu5" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p5" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 5</label>
                        <div class="col-lg-6">
                            <textarea value="p5" type="text" name="p5" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p6))
                    <div class="form-group row">
                        <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 6</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu6" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p6" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 6</label>
                        <div class="col-lg-6">
                            <textarea value="p6" type="text" name="p6" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p7))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 7</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu7" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p7" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 7</label>
                        <div class="col-lg-6">
                            <textarea value="p7" type="text" name="p7" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p8))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 8</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu8" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p8" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 8</label>
                        <div class="col-lg-6">
                            <textarea value="p8" type="text" name="p8" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p9))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 9</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu9" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p9" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 9</label>
                        <div class="col-lg-6">
                            <textarea value="p9" type="text" name="p9" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p10))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 10</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu10" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p10" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 10</label>
                        <div class="col-lg-6">
                            <textarea value="p10" type="text" name="p10" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p11))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 11</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu11" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p11" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 11</label>
                        <div class="col-lg-6">
                            <textarea value="p11" type="text" name="p11" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p12))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 12</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu12" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p12" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 12</label>
                        <div class="col-lg-6">
                            <textarea value="p12" type="text" name="p12" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p13))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 13</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu13" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p13" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 13</label>
                        <div class="col-lg-6">
                            <textarea value="p13" type="text" name="p13" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <br>
<br>
@foreach ($emu as $item)
                       @if(!empty($item->p14))
                    <div class="form-group row">
                    <label for="" class="col-lg-2 col-lg-offset-1 control-label">Sub Sistem 14</label>
                        <div class="col-lg-3">
                            <textarea value="" type="text" name="nama_dmu14" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        <label for="p14" class="col-lg-2 col-lg-offset-1 control-label">Keterangan 14</label>
                        <div class="col-lg-6">
                            <textarea value="p14" type="text" name="p14" id="" class="form-control" readonly>
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                        @endif
                    @endforeach              

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