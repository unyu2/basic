@extends('layouts.master')

@section('title')
    Buat, Edit & Revisi Daftar Design Drawing 
@endsection

@section('breadcrumb')
    @parent
    <li class="active"> Buat, Edit & Revisi Daftar Design Drawing </li>
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
            <div class="box-header with-border">
            <div class="container-fluid">

            @if (auth()->user()->level == 1)
            <div class="box-header">
                <div class="input-group input-group-sm">
                    <form action="{{ route('design.import') }}" method="post" enctype="multipart/form-data">
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

            <div class="box-header">
                <div class="btn-group">
                    <button onclick="tambahBaru('{{ route('design.stores') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i>Tambah Data Baru</button>
                    <button onclick="addForm('{{ route('design.store') }}')" class="btn btn-warning btn-flat"><i class="fa fa-plus-circle"></i>Buat & Edit Schedule</button>
                    <button onclick="deleteSelected('{{ route('design.delete_selected') }}')" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus Masal</button>
                    <a href="{{ route('design.export') }}" class="btn btn bg-navy btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    <a href="{{ route('design.exportLog') }}" class="btn btn bg-navy btn-flat"><i class="fa fa-file-excel-o"></i> Excel Rev Log</a>
                    <button onclick="cetakPdf('{{ route('design.cetakPdf') }}')" class="btn btn bg-maroon btn-flat"><i class="fa fa-trash"></i> PDF</button>
                </div>          
            </div>
            @if (auth()->user()->level == 2 || auth()->user()->level == 3 || auth()->user()->level == 4 )
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-design">
                    @csrf
                    <table id="table0" class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>No Dwg</th>
                            <th>Nama</th>
                            <th>Proyek</th>
                            <th>Draft</th>
                            <th>Check</th>
                            <th>Approve</th>
                            <th>Revisi</th>
                            <th>Kesesuaian Jadwal</th>
                            <th>Status</th>

                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
            @endif

            @if (auth()->user()->level == 1)
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-design">
                    @csrf
                    <table id="tableAdmin" class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>Ref ID</th>
                            <th>No Dwg</th>
                            <th>Nama</th>
                            <th>Proyek</th>
                            <th>Revisi</th>
                            <th>Kesesuaian Jadwal</th>
                            <th>Status</th>

                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
            @endif
            
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-design hidden-form">
                    @csrf
                    <table id="table1" class="tableModal table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>No Dwg</th>
                            <th>Nama</th>
                            <th>Proyek</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>

            <div class="box-body table-responsive">
                <form action="" method="post" class="form-design hidden-form">
                    @csrf
                    <table class="tableModal2 table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>No Dwg</th>
                            <th>Nama</th>
                            <th>Proyek</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@includeIf('design.form')
@includeIf('design.form3')
@includeIf('design.form2')
@includeIf('design.form4')
@includeIf('design.detail')
@includeIf('design.dwg')
@includeIf('design.dwg2')
@endsection

@push('scripts')
<script>
    let table;
    let tableAdmin;
    let table1;
    let table0;
    let tableModal2;
    let tableModal3;
    let tableDetail;

    $(function () {
        table = $('#table0').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('design.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_design'},
                {data: 'nama_design'},
                {data: 'id_proyek'},
                {data: 'id_draft'},
                {data: 'id_check'},
                {data: 'id_approve'},
                {data: 'revisi'},
                {data: 'kondisi'},
                {data: 'status'},
                {data: 'aksi', searchable: false, sortable: false},
                ]
            });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function redirectTo(url) {
    window.location = "{{ route('design.index') }}";
    }

    $(function () {
        table = $('#tableAdmin').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('design.dataAdmin') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'id_design'},
                {data: 'kode_design'},
                {data: 'nama_design'},
                {data: 'id_proyek'},
                {data: 'revisi'},
                {data: 'kondisi'},
                {data: 'status'},
                {data: 'aksi', searchable: false, sortable: false},
                ]
            });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });


    $(function () {
            table = $('.tableModal').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('design.dataModal') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_design'},
                    {data: 'nama_design'},
                    {data: 'id_proyek'},
                    {data: 'aksi', searchable: false, sortable: false},
                ]
            });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    $(function () {
            tableModal2 = $('.tableModal2').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('design.dataModal2') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_design'},
                    {data: 'nama_design'},
                    {data: 'id_proyek'},
                    {data: 'aksi', searchable: false, sortable: false},
                ]
            });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function addRef() {
        $('#modal-dwg').modal('show');
    }

    function pilihDesign(url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#refrensi_design').val(data.kode_design);
                $('#tanggal_refrensi').val(data.prediksi_akhir);
                $('#id_refrensi').val(data.id_design);


                if (data.prediksi_akhir !== $('#tanggal_refrensi').val()) {
                $('#tanggal_refrensi').val(data.prediksi_akhir);
            }

                $('#modal-dwg').modal('hide');
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Terjadi kesalahan saat mengambil data design:', textStatus, errorThrown);
            }
        });
    }


    function tambahBaru(url) {
        $('#modal-form3').modal('show');
        $('#modal-form3 .modal-title').text('Buat Data Dokumen Baru');

        $('#modal-form3 form')[0].reset();
        $('#modal-form3 form').attr('action', url);
        $('#modal-form3 [name=_method]').val('post');
        $('#modal-form3 [name=nama_design]').focus();
    }

        $(document).ready(function() {
        $('#modal-form3').validator().on('submit', function(e) {
            e.preventDefault(); 
            console.log('Mengirim permintaan AJAX...');
            $.post($('#modal-form3 form').attr('action'), $('#modal-form3 form').serialize())
                .done(function(response) {
                    $('#modal-form3').modal('hide');
                    table.ajax.reload();
                })
                .fail(function(errors) {
                    console.log('Permintaan AJAX gagal:', errors);
                    alert('Tidak dapat menyimpan data | Periksa kembali :)');
                });
        });
    });


    function addBaru() {
        $('#modal-dwg2').modal('show');
    }

    function pilihBaru(url) {
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log('Data dari server:', data);
            $('#id_design').val(data.id_design);
            $('#nama_design').val(data.nama_design);
            $('#kode_design').val(data.kode_design);
            $('#id_kepala_gambar').val(data.id_kepala_gambar);
            $('#id_proyek').val(data.id_proyek);
            $('#revisi').val(data.revisi);
            $('#bobot_rev').val(data.bobot_rev);
            $('#bobot_design').val(data.bobot_design);
            $('#status').val(data.status);
            $('#size').val(data.size);
            $('#lembar').val(data.lembar);
            $('#konfigurasi').val(data.konfigurasi);
            $('#id_draft').val(data.id_draft);
            $('#id_check').val(data.id_check);
            $('#id_approve').val(data.id_approve);
            $('#prosentase').val(data.prosentase);

            $('#id_refrensi').val(data.id_refrensi);
            $('#refrensi_design').val(data.refrensi_design);
            $('#tanggal_refrensi').val(data.tanggal_refrensi);
            $('#tanggal_prediksi').val(data.tanggal_prediksi);
            $('#prediksi_hari').val(data.prediksi_hari);
            
            $('#modal-dwg2').modal('hide');
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error('Terjadi kesalahan saat mengambil data design:', textStatus, errorThrown);
        }
    });
}

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Buat & Edit Schedule Dokumen');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_design]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Release Your Design Drawing');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_design]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_design]').val(response.nama_design);
                $('#modal-form [name=kode_design]').val(response.kode_design);
                $('#modal-form [name=id_proyek]').val(response.id_proyek);
                $('#modal-form [name=id_kepala_gambar]').val(response.id_kepala_gambar);
                $('#modal-form [name=id_draft]').val(response.id_draft);
                $('#modal-form [name=id_check]').val(response.id_check);
                $('#modal-form [name=id_approve]').val(response.id_approve);
                $('#modal-form [name=revisi]').val(response.revisi);
                $('#modal-form [name=size]').val(response.size);
                $('#modal-form [name=lembar]').val(response.lembar);
                $('#modal-form [name=konfigurasi]').val(response.konfigurasi);
                $('#modal-form [name=tipe]').val(response.tipe);
                $('#modal-form [name=prosentase]').val(response.prosentase);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
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


    function editForm2(url) {
        $('#modal-form2').modal('show');
        $('#modal-form2 .modal-title').text('Tingkatkan Revisi Doc');

        $('#modal-form2 form')[0].reset();
        $('#modal-form2 form').attr('action', url);
        $('#modal-form2 [name=_method]').val('put');
        $('#modal-form2 [name=nama_design]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form2 [name=nama_design]').val(response.nama_design);
                $('#modal-form2 [name=kode_design]').val(response.kode_design);
                $('#modal-form2 [name=revisi]').val(response.revisi);
                $('#modal-form2 [name=bobot_rev]').val(response.bobot_rev);
                $('#modal-form2 [name=tipe]').val(response.tipe);

 
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    $('#modal-form2').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form2 form').attr('action'), $('#modal-form2 form').serialize())
                    .done((response) => {
                        $('#modal-form2').modal('hide');
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

    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, $('.form-design').serialize())
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

    function cetakPdf(url) {
        if ($('input:checked').length < 1) {
            alert('Pilih data yang akan dicetak');
            return;
        } else if ($('input:checked').length < 3) {
            alert('Pilih minimal 3 data untuk dicetak');
            return;
        } else {
            $('.form-design')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }

    function editForm4(url) {
    $('#modal-form4').modal('show');
    $('#modal-form4 .modal-title').text('Edit Design Drawing');

    $('#modal-form4 form')[0].reset();
    $('#modal-form4 form').attr('action', url);
    $('#modal-form4 [name=_method]').val('put');
    $('#modal-form4 [name=nama_design]').focus();

    $.get(url)
        .done((response) => {
            $('#modal-form4 [name=nama_design]').val(response.nama_design);
            $('#modal-form4 [name=kode_design]').val(response.kode_design);
            $('#modal-form4 [name=id_proyek]').val(response.id_proyek);
            $('#modal-form4 [name=id_kepala_gambar]').val(response.id_kepala_gambar);
            $('#modal-form4 [name=id_draft]').val(response.id_draft);
            $('#modal-form4 [name=id_check]').val(response.id_check);
            $('#modal-form4 [name=id_approve]').val(response.id_approve);
            $('#modal-form4 [name=revisi]').val(response.revisi);
            $('#modal-form4 [name=size]').val(response.size);
            $('#modal-form4 [name=lembar]').val(response.lembar);
            $('#modal-form4 [name=konfigurasi]').val(response.konfigurasi);
            $('#modal-form4 [name=tipe]').val(response.tipe);
            $('#modal-form4 [name=bobot_rev]').val(response.bobot_rev);
            $('#modal-form4 [name=bobot_design]').val(response.bobot_design);

        })
        .fail((errors) => {
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
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data | Periksa kembali :)');
                        return;
                    });
            }
        });

//-------------------------------------------------------------------------------------
    function showDetail(url) {
        $('#modal-detail').modal('show');
        tableDetail.ajax.url(url);
        tableDetail.ajax.reload();
    }
        $(function () {
            tableDetail = $('.tableDetail').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('design.dataDetail') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_design'},
                    {data: 'revisi'},
                    {data: 'created_at'},
                ]
            });
    });

    
//-------------------------------------------------------------------------------------


</script>
@endpush