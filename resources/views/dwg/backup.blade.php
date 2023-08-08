@extends('layouts.master')

@section('title')
    Daftar Design Drawing
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Design Drawing</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
            <a href="{{ route('dwg.create') }}" class="btn btn-success btn-xs btn-flat"> <i class="fa fa-plus-circle"></i> Buat</a>
            <button onclick="addForm('{{ route('dwg.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Buat Dengan Modal</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Proyek</th>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Last Rev</th>

                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('dwg.form')
@include('dwg.dwg')
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
                url: '{{ route('dwg.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'id_proyek'},
                {data: 'kode_dwg'},
                {data: 'nama_dwg'},
                {data: 'status'},
                {data: 'revisi'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        $('#modal-form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
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
        $('#modal-form .modal-title').text('Tambah Drawing');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_dwg]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Design Drawing');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_dwg]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=kode_dwg]').val(response.kode_dwg);
                $('#modal-form [name=nama_dwg]').val(response.nama_dwg);
                $('#modal-form [name=id_kepala_gambar]').val(response.id_kepala_gambar);
                $('#modal-form [name=id_proyek]').val(response.id_proyek);
                $('#modal-form [name=bobot]').val(response.bobot);
                $('#modal-form [name=prediksi]').val(response.prediksi);
                $('#modal-form [name=size]').val(response.size);
                $('#modal-form [name=id_draft]').val(response.id_draft);
                $('#modal-form [name=id_check]').val(response.id_check);
                $('#modal-form [name=id_approve]').val(response.id_approve);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    function closedForm(url) {
        $('#modal-form2').modal('show');
        $('#modal-form2 .modal-title').text('Release Design Drawing');

        $('#modal-form2 form')[0].reset();
        $('#modal-form2 form').attr('action', url);
        $('#modal-form2 [name=_method]').val('put');
        $('#modal-form2 [name=nama_dwg]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form2 [name=kode_dwg]').val(response.kode_dwg);
                $('#modal-form2 [name=nama_dwg]').val(response.nama_dwg);
                $('#modal-form2 [name=id_kepala_gambar]').val(response.id_kepala_gambar);
                $('#modal-form2 [name=id_proyek]').val(response.id_proyek);
                $('#modal-form2 [name=bobot]').val(response.bobot);
                $('#modal-form2 [name=prediksi]').val(response.prediksi);
                $('#modal-form2 [name=size]').val(response.size);
                $('#modal-form2 [name=id_draft]').val(response.id_draft);
                $('#modal-form2 [name=id_check]').val(response.id_check);
                $('#modal-form2 [name=id_approve]').val(response.id_approve);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    function revisiForm(url) {
        $('#modal-form3').modal('show');
        $('#modal-form3 .modal-title').text('Revisi Design Drawing');

        $('#modal-form3 form')[0].reset();
        $('#modal-form3 form').attr('action', url);
        $('#modal-form3 [name=_method]').val('put');
        $('#modal-form3 [name=nama_dwg]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form3 [name=kode_dwg]').val(response.kode_dwg);
                $('#modal-form3 [name=nama_dwg]').val(response.nama_dwg);
                $('#modal-form3 [name=id_kepala_gambar]').val(response.id_kepala_gambar);
                $('#modal-form3 [name=id_proyek]').val(response.id_proyek);
                $('#modal-form3 [name=bobot]').val(response.bobot);
                $('#modal-form3 [name=prediksi]').val(response.prediksi);
                $('#modal-form3 [name=size]').val(response.size);
                $('#modal-form3 [name=id_draft]').val(response.id_draft);
                $('#modal-form3 [name=id_check]').val(response.id_check);
                $('#modal-form3 [name=id_approve]').val(response.id_approve);
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