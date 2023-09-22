@extends('layouts.master')

@section('title')
    Release Data Design Drawing 
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Release Data Design Drawing </li>
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

@if(auth()->user()->level == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
            <div class="container-fluid">
                <div class="input-group input-group-sm">
                    <form action="{{ route('design_detail.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="file">Pilih file Excel untuk diunggah:</label>
                        <input type="file" name="file" id="file" class="form-control" aria-label="File input">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success btn-flat">Import</button>
                        </div>
                    </form>
                </div>
            </div>

            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-design">
                    @csrf
                    <table id="table2" class="table table-stiped table-bordered">
                        <thead>
                        <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>Id Design Detail</th>
                            <th>Nama Design</th>
                            <th>Id Design</th>
                            <th>Kode Design</th>
                            <th>Revisi</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>

            <div class="box-body table-responsive">
                <form action="" method="post" class="form-design">
                    @csrf
                    <table id="table3" class="table table-stiped table-bordered">
                        <thead>
                        <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>No Dwg</th>
                            <th>Nama</th>
                            <th>Proyek</th>
                            <th>Revisi</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@if (auth()->user()->level == 2  || auth()->user()->level == 3 || auth()->user()->level == 4 ||
     auth()->user()->level == 5  || auth()->user()->level == 6 || auth()->user()->level == 7 ||
     auth()->user()->level == 8  || auth()->user()->level == 9 || auth()->user()->level == 10 ||
     auth()->user()->level == 11  || auth()->user()->level == 12 || auth()->user()->level == 13 ||
     auth()->user()->level == 14  || auth()->user()->level == 15 || auth()->user()->level == 16)
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-design">
                    @csrf
                    <table id="table1" class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>No Dwg</th>
                            <th>Nama</th>
                            <th>Proyek</th>
                            <th>Revisi</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@includeIf('design_detail.form')
@includeIf('design_detail.form3')
@includeIf('design_detail.form4')
@includeIf('design_detail.dwg')
@endsection

@push('scripts')
<script>
    let table;
    let tableModal;

    $(function () {
        table = $('#table1').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('design_detail.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_design'},
                {data: 'nama_design'},
                {data: 'id_proyek'},
                {data: 'revisi'},
                {data: 'status'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        $('[name=select_all]').on('click', function () {
        $(':checkbox').prop('checked', this.checked);
         });
        });


    $(function () {
            table = $('#table3').DataTable({
                responsive: true,
                processing: true, 
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('design_detail.dataAdmin') }}',
                },
                columns: [
                    {data: 'select_all', searchable: false, sortable: false},
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_design'},
                    {data: 'nama_design'},
                    {data: 'id_proyek'},
                    {data: 'revisi'},
                    {data: 'status'},
                    {data: 'aksi', searchable: false, sortable: false},
                ]
            });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });
        


    $(function () {
            table = $('#table2').DataTable({
                responsive: true,
                processing: true, 
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('design_detail.dataModal') }}',
                },
                columns: [
                    {data: 'select_all', searchable: false, sortable: false},
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'id_design_detail'},
                    {data: 'id_design'},
                    {data: 'id_design'},
                    {data: 'kode_design'},
                    {data: 'revisi'},
                    {data: 'status'},
                    {data: 'aksi', searchable: false, sortable: false},
                ]
            });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=kode_design]').focus();
    }

    $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data | Periksa kembali :)');
                        return;
                    });
            }
        });

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
                    alert('Tidak dapat menghapus data | Mengandung detail Data');
                    return;
                });
        }
    }


    function editForm3(url) {
    $('#modal-form3').modal('show');
    $('#modal-form3 .modal-title').text('Release Design Drawing');

    $('#modal-form3 form')[0].reset();
    $('#modal-form3 form').attr('action', url);
    $('#modal-form3 [name=_method]').val('put');
    $('#modal-form3 [name=nama_design]').focus();

    console.log('Mengirim permintaan GET ke URL: ' + url);


    $.get(url)
        .done((response) => {
            console.log('Response dari permintaan GET:', response);
            $('#modal-form3 [name=id_design]').val(response.id_design);
            $('#modal-form3 [name=nama_design]').val(response.nama_design);
            $('#modal-form3 [name=kode_design]').val(response.kode_design);
            $('#modal-form3 [name=revisi]').val(response.revisi);
            $('#modal-form3 [name=prediksi_akhir]').val(response.prediksi_akhir);

            $('#modal-form3 [name=id_draft]').val(response.id_draft);
            $('#modal-form3 [name=id_check]').val(response.id_check);
            $('#modal-form3 [name=id_approve]').val(response.id_approve);
            $('#modal-form3 [name=jenis]').val(response.jenis);
            $('#modal-form3 [name=pemilik]').val(response.pemilik);
            $('#modal-form3 [name=bobot_rev]').val(response.bobot_rev);
            $('#modal-form3 [name=bobot_design]').val(response.bobot_design);
            $('#modal-form3 [name=size]').val(response.size);
            $('#modal-form3 [name=lembar]').val(response.lembar);
            $('#modal-form3 [name=tipe]').val(response.tipe);

        })
        .fail((errors) => {
            console.error('Gagal mengambil data:', errors);

            alert('Tidak dapat menampilkan data');
            return;
        });
    }


$('#modal-form3').validator().on('submit', function (e) {
    if (!e.preventDefault()) {
        console.log('Mengirim permintaan POST ke URL: ' + $('#modal-form3 form').attr('action'));

        $.post($('#modal-form3 form').attr('action'), $('#modal-form3 form').serialize())
            .done((response) => {
                console.log('Response dari permintaan POST:', response);

                $('#modal-form3').modal('hide');
                table.ajax.reload();
            })
            .fail((errors) => {
                console.error('Gagal menyimpan data:', errors);

                alert('Tidak dapat menyimpan data | Periksa kembali :)');
                return;
            });
    }
});

    
//-------------------------------------------------------------------------------------


function editForm4(url) {
    $('#modal-form4').modal('show');
    $('#modal-form4 .modal-title').text('Release Design Drawing');

    $('#modal-form4 form')[0].reset();
    $('#modal-form4 form').attr('action', url);
    $('#modal-form4 [name=_method]').val('put');
    $('#modal-form4 [name=nama_design]').focus();

    console.log('Mengirim permintaan GET ke URL: ' + url);


    $.get(url)
        .done((response) => {
            console.log('Response dari permintaan GET:', response);
            $('#modal-form4 [name=id_design]').val(response.id_design);
            $('#modal-form4 [name=nama_design]').val(response.nama_design);
            $('#modal-form4 [name=kode_design]').val(response.kode_design);
            $('#modal-form4 [name=revisi]').val(response.revisi);
            $('#modal-form4 [name=prediksi_akhir]').val(response.prediksi_akhir);

            $('#modal-form4 [name=id_draft]').val(response.id_draft);
            $('#modal-form4 [name=id_check]').val(response.id_check);
            $('#modal-form4 [name=id_approve]').val(response.id_approve);
            $('#modal-form4 [name=jenis]').val(response.jenis);
            $('#modal-form4 [name=pemilik]').val(response.pemilik);
            $('#modal-form4 [name=bobot_rev]').val(response.bobot_rev);
            $('#modal-form4 [name=bobot_design]').val(response.bobot_design);
            $('#modal-form4 [name=size]').val(response.size);
            $('#modal-form4 [name=lembar]').val(response.lembar);

            $('#modal-form4 [name=duplicate_status]').val(response.duplicate_status);
            $('#modal-form4 [name=time_release_rev0]').val(response.time_release_rev0);
            $('#modal-form4 [name=tipe]').val(response.tipe);
        })
        .fail((errors) => {
            console.error('Gagal mengambil data:', errors);

            alert('Tidak dapat menampilkan data');
            return;
        });
    }


$('#modal-form4').validator().on('submit', function (e) {
    if (!e.preventDefault()) {
        console.log('Mengirim permintaan POST ke URL: ' + $('#modal-form4 form').attr('action'));

        $.post($('#modal-form4 form').attr('action'), $('#modal-form4 form').serialize())
            .done((response) => {
                console.log('Response dari permintaan POST:', response);

                $('#modal-form4').modal('hide');
                table.ajax.reload();
            })
            .fail((errors) => {
                console.error('Gagal menyimpan data:', errors);

                alert('Tidak dapat menyimpan data | Periksa kembali :)');
                return;
            });
    }
});


</script>
@endpush