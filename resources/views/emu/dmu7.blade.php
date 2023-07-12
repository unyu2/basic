<div class="modal fade" id="modal-dmu7" tabindex="-1" role="dialog" aria-labelledby="modal-dmu7">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Sub Sistem Pengujian SARANA OFF</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-dmu">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama Sub System</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($r7 as $key => $item)
                            <tr>

                                <td width="5%">{{ $key+1 }}</td>
                                <td>{{ $item->kode_dmu }}</td>
                                <td>{{ $item->nama_dmu }}</td>

                                <td>
                                    <a href="{{ route('emu.create', $item->id_dmu) }}" target="_blank" class="btn btn-primary btn-flat">
                                        <i class="fa fa-check-circle"></i>
                                        Pilih
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>