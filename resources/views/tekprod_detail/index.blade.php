@extends('layouts.master')

@section('title')
    Release Dokumen Teknologi Produksi
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Release Dokumen Teknologi Produksi </li>
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
                    <form action="{{ route('tekprod_detail.import') }}" method="post" enctype="multipart/form-data">
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
                <form action="" method="post" class="form-tekprod">
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
                <form action="" method="post" class="form-tekprod">
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
                <form action="" method="post" class="form-tekprod">
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

@includeIf('tekprod_detail.form')
@includeIf('tekprod_detail.form3')
@includeIf('tekprod_detail.form4')
@includeIf('tekprod_detail.dwg')
@endsection

@push('scripts')
<script>
    let table;
    let table2;
    let table3;

    $(function () {
        table = $('#table1').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('tekprod_detail.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_tekprod'},
                {data: 'nama_tekprod'},
                {data: 'id_proyek'},
                {data: 'revisi_tekprod'},
                {data: 'status_tekprod'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        $('[name=select_all]').on('click', function () {
        $(':checkbox').prop('checked', this.checked);
         });
        });


    $(function () {
            table3 = $('#table3').DataTable({
                responsive: true,
                processing: true, 
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('tekprod_detail.dataAdmin') }}',
                },
                columns: [
                    {data: 'select_all', searchable: false, sortable: false},
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_tekprod'},
                    {data: 'nama_tekprod'},
                    {data: 'id_proyek'},
                    {data: 'revisi_tekprod'},
                    {data: 'status_tekprod'},
                    {data: 'aksi', searchable: false, sortable: false},
                ]
            });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });
        
    $(function () {
            table2 = $('#table2').DataTable({
                responsive: true,
                processing: true, 
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('tekprod_detail.dataModal') }}',
                },
                columns: [
                    {data: 'select_all', searchable: false, sortable: false},
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'id_tekprod_detail'},
                    {data: 'id_tekprod'},
                    {data: 'id_tekprod'},
                    {data: 'kode_tekprod'},
                    {data: 'revisi_tekprod'},
                    {data: 'status_tekprod'},
                    {data: 'aksi', searchable: false, sortable: false},
                ]
            });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table2.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data | Mengandung detail Data');
                    return;
                });
        }
    }

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=kode_tekprod]').focus();
    }

    $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table3.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data | Periksa kembali :)');
                        return;
                    });
            }
        });


    function editForm3(url) {
    $('#modal-form3').modal('show');
    $('#modal-form3 .modal-title').text('Release Dokumen');

    $('#modal-form3 form')[0].reset();
    $('#modal-form3 form').attr('action', url);
    $('#modal-form3 [name=_method]').val('put');
    $('#modal-form3 [name=nama_tekprod]').focus();

    console.log('Mengirim permintaan GET ke URL: ' + url);


    $.get(url)
        .done((response) => {
            console.log('Response dari permintaan GET:', response);
            $('#modal-form3 [name=id_tekprod]').val(response.id_tekprod);
            $('#modal-form3 [name=nama_tekprod]').val(response.nama_tekprod);
            $('#modal-form3 [name=kode_tekprod]').val(response.kode_tekprod);
            $('#modal-form3 [name=revisi_tekprod]').val(response.revisi_tekprod);
            $('#modal-form3 [name=prediksi_akhir_tekprod]').val(response.prediksi_akhir_tekprod);

            $('#modal-form3 [name=id_draft_tekprod]').val(response.id_draft_tekprod);
            $('#modal-form3 [name=id_check_tekprod]').val(response.id_check_tekprod);
            $('#modal-form3 [name=id_approve_tekprod]').val(response.id_approve_tekprod);
            $('#modal-form3 [name=jenis_tekprod]').val(response.jenis_tekprod);
            $('#modal-form3 [name=pemilik_tekprod]').val(response.pemilik_tekprod);
            $('#modal-form3 [name=bobot_rev_tekprod]').val(response.bobot_rev_tekprod);
            $('#modal-form3 [name=bobot_design_tekprod]').val(response.bobot_design_tekprod);
            $('#modal-form3 [name=size_tekprod]').val(response.size_tekprod);
            $('#modal-form3 [name=lembar_tekprod]').val(response.lembar_tekprod);
            $('#modal-form3 [name=tipe_tekprod]').val(response.tipe_tekprod);
            $('#modal-form3 [name=id_design]').val(response.id_design);


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
                table3.ajax.reload();
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
    $('#modal-form4 .modal-title').text('Release Dokumen');

    $('#modal-form4 form')[0].reset();
    $('#modal-form4 form').attr('action', url);
    $('#modal-form4 [name=_method]').val('put');
    $('#modal-form4 [name=nama_tekprod]').focus();

    console.log('Mengirim permintaan GET ke URL: ' + url);


    $.get(url)
        .done((response) => {
            console.log('Response dari permintaan GET:', response);
            $('#modal-form4 [name=id_tekprod]').val(response.id_tekprod);
            $('#modal-form4 [name=nama_tekprod]').val(response.nama_tekprod);
            $('#modal-form4 [name=kode_tekprod]').val(response.kode_tekprod);
            $('#modal-form4 [name=revisi_tekprod]').val(response.revisi_tekprod);
            $('#modal-form4 [name=prediksi_akhir_tekprod]').val(response.prediksi_akhir_tekprod);

            $('#modal-form4 [name=id_draft_tekprod]').val(response.id_draft_tekprod);
            $('#modal-form4 [name=id_check_tekprod]').val(response.id_check_tekprod);
            $('#modal-form4 [name=id_approve_tekprod]').val(response.id_approve_tekprod);
            $('#modal-form4 [name=jenis_tekprod]').val(response.jenis_tekprod);
            $('#modal-form4 [name=pemilik_tekprod]').val(response.pemilik_tekprod);
            $('#modal-form4 [name=bobot_rev_tekprod]').val(response.bobot_rev_tekprod);
            $('#modal-form4 [name=bobot_design_tekprod]').val(response.bobot_design_tekprod);
            $('#modal-form4 [name=size_tekprod]').val(response.size_tekprod);
            $('#modal-form4 [name=lembar_tekprod]').val(response.lembar_tekprod);

            $('#modal-form4 [name=duplicate_status_tekprod]').val(response.duplicate_status_tekprod);
            $('#modal-form4 [name=time_release_rev0_tekprod]').val(response.time_release_rev0_tekprod);
            $('#modal-form4 [name=tipe_tekprod]').val(response.tipe_tekprod);
            $('#modal-form4 [name=id_design]').val(response.id_design);

        })
        .fail((errors) => {
            console.error('Gagal mengambil data:', errors);

            alert('Tidak dapat menampilkan data');
            return;
        });
    }

    $('#modal-form4').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form4 form').attr('action'), $('#modal-form4 form').serialize())
                    .done((response) => {
                        $('#modal-form4').modal('hide');
                        table.ajax.reload();
                        table3.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data | Periksa kembali :)');
                        return;
                    });
            }
        });


</script>
@endpush