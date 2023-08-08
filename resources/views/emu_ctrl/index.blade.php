@extends('layouts.master')

@section('title')
    Daftar Inspeksi
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Inspeksi</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="cetakBarcode('{{ route('emu_ctrl.cetak_barcode') }}')" class="btn btn-success btn-block btn-flat"><i class="fa fa-barcode"></i>Lihat / Cetak Detail</button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-emu_ctrl">
                    @csrf
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>Tanggal Buat</th>
                            <th>Tanggal Perbaikan</th>
                            <th>Sub pengujian</th>
                            <th>Pengujian</th>
                            <th>Proyek</th>
                            <th>Pembuat</th>
                            <th>Token</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@includeIf('emu_ctrl.form')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('emu_ctrl.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'id_subpengujian'},
                {data: 'id_dmu'},
                {data: 'id_proyek'},
                {data: 'id_user'},
                {data: 'kode_emu'},
                {data: 'status'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Inspeksi');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=id_emu]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Approve Inspeksi');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=id_emu]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_proyek]').val(response.nama_proyek);
                $('#modal-form [name=id_emu]').val(response.id_emu);
           //     $('#modal-form [name=status]').val(response.status);
                $('#modal-form [name=keterangan]').val(response.keterangan);
                $('#modal-form [name=id_car]').val(response.id_car);
                $('#modal-form [name=id_proyek]').val(response.id_proyek);

                $('#modal-form [name=nama_dmu1]').val(response.nama_dmu1);
                $('#modal-form [name=M1_1]').val(response.M1_1);
$('#modal-form [name=M2_1]').val(response.M2_1);
$('#modal-form [name=Mc1_1]').val(response.Mc1_1);
$('#modal-form [name=Mc2_1]').val(response.Mc2_1);
$('#modal-form [name=T1_1]').val(response.T1_1);
$('#modal-form [name=T2_1]').val(response.T2_1);
$('#modal-form [name=T3_1]').val(response.T3_1);
$('#modal-form [name=T4_1]').val(response.T4_1);
$('#modal-form [name=Tc1_1]').val(response.Tc1_1);
$('#modal-form [name=Tc2_1]').val(response.Tc2_1);
$('#modal-form [name=Tc3_1]').val(response.Tc3_1);
$('#modal-form [name=Tc4_1]').val(response.Tc4_1);

            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }

    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, $('.form-emu_ctrl').serialize())
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        } else {
            alert('Pilih data yang akan dihapus');
            return;
        }
    }

    function cetakBarcode(url) {
        if ($('input:checked').length < 1) {
            alert('Pilih data yang akan dicetak');
            return;
        } else if ($('input:checked').length < 1) {
            alert('Pilih minimal 1 data untuk dicetak');
            return;
        } else {
            $('.form-emu_ctrl')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }
</script>
@endpush