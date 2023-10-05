@extends('layouts.master')

@section('title')
    Daftar Kepala Gambar
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Kepala Gambar</li>
@endsection

<style>
    .hidden-form {
        display: none;
    }
</style>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">

        @if (auth()->user()->level == 1)
        <div class="box-header">
                <div class="input-group input-group-sm">
                    <form action="{{ route('kepala_gambar.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="file">Pilih file Excel untuk diunggah:</label>
                        <input type="file" name="file" id="file" class="form-control" aria-label="File input">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success btn-flat">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
            <div class="box-header with-border">
                <button onclick="addForm('{{ route('kepala_gambar.store') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i> Tambah Data Kepala Gambar</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Refrensi ID</th>
                        <th>Nama Kepala Gambar</th>
                        <th>Bagian</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('kepala_gambar.form')
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
                url: '{{ route('kepala_gambar.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'id_kepala_gambar'},
                {data: 'nama'},
                {data: 'id_jabatan'},
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
        $('#modal-form .modal-title').text('Tambah Kepala Gambar');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Kepala Gambar');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama]').val(response.nama);
                $('#modal-form [name=id_jabatan]').val(response.id_jabatan);
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