<div class="modal fade" id="modal-dwg" tabindex="-1" role="dialog" aria-labelledby="modal-dwg">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Refrensi Drawing</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-dwg">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($dwg as $key => $item)
                            <tr>
                                <td width="5%">{{ $key+1 }}</td>
                                <td><span>{{ $item->nama_dwg }}</span></td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs btn-flat"
                                        onclick="pilihDwg('{{ $item->id_dwg }}', '{{ $item->id_dwg }}')">
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