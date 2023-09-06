@extends('layouts.master')

@section('title')
    Daftar Data Dinas
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Data Dinas</li>
@endsection

<style>
    .hidden-form {
        display: none;
    }
</style>

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="addForm('{{ route('dinas.store') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i> Tambah Data Dinas</button>
            </div>
            <div class="box-body table-responsive hidden-form">
                <table class="tableUser table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>NIP</th>
                        <th>Nama Pejalan Dinas</th>
                        <th>Bagian</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tujuan Dinas</th>
                        <th>Proyek</th>
                        <th>Pejalan Dinas</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('dinas.form')
@includeIf('dinas.user')


@endsection

@push('scripts')
<script>
    let table;
    let tableUser;

    $(function () {
        tableUser = $('.tableUser').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('dinas.dataModal') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'nip'},
                {data: 'name'},
                {data: 'bagian'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });
    });

    function addRef() {
    $('#modal-user').modal('show');
}

    function pilihUser(url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#id_draft').val(data.id_user);
                $('#modal-user').modal('hide');
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Terjadi kesalahan saat mengambil data design:', textStatus, errorThrown);
            }
        });
    }  

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('dinas.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'nama_design'},
                {data: 'id_proyek'},
                {data: 'id_draft'},
                {data: 'tanggal_prediksi'},
                {data: 'prediksi_akhir'},
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
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Data Dinas');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_design]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Data Dinas');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_design]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_design]').val(response.nama_design);
                $('#modal-form [name=id_proyek]').val(response.id_proyek);
                $('#modal-form [name=id_draft]').val(response.id_draft);
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

</script>
@endpush