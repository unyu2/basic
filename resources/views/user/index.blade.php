@extends('layouts.master')

@section('title')
    Daftar User
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar User</li>
@endsection

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
            <div class="box-header with-border">
            <div class="container-fluid">

            @if (auth()->user()->level == 1)
            <div class="box-header">
                <div class="input-group input-group-sm">
                    <form action="{{ route('user.import') }}" method="post" enctype="multipart/form-data">
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
                <button onclick="addForm('{{ route('user.store') }}')" class="btn btn-success btn btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
                <a href="{{ route('user.export') }}" class="btn btn-primary btn btn-flat"><i class="fa fa-file-excel"></i> Export Excel</a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Refrensi ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Bagian</th>
                        <th>Kompetensi</th>
                        <th>Sertifikasi</th>
                        <th>Training</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('user.form')
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
                url: '{{ route('user.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'bagian'},
                {data: 'kompetensi'},
                {data: 'sertifikasi'},
                {data: 'training'},
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
        $('#modal-form .modal-title').text('Tambah User');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=name]').focus();

        $('#password, #password_confirmation').attr('required', true);
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit User');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=name]').focus();

        $('#password, #password_confirmation').attr('required', false);

        $.get(url)
            .done((response) => {
                $('#modal-form [name=name]').val(response.name);
                $('#modal-form [name=email]').val(response.email);
                $('#modal-form [name=nip]').val(response.nip);
                $('#modal-form [name=bagian]').val(response.bagian);
                $('#modal-form [name=level]').val(response.level);
                $('#modal-form [name=kompetensi]').val(response.kompetensi);
                $('#modal-form [name=sertifikasi]').val(response.sertifikasi);
                $('#modal-form [name=training]').val(response.training);
                $('#modal-form [name=status_karyawan]').val(response.status_karyawan);

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