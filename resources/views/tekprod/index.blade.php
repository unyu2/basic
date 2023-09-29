@extends('layouts.master')

@section('title')
    Buat, Edit & Revisi Daftar Dokumen TP
@endsection

@section('breadcrumb')
    @parent
    <li class="active"> Buat, Edit & Revisi Daftar Dokumen TP </li>
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
                    <form action="{{ route('tekprod.import') }}" method="post" enctype="multipart/form-data">
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
                    <button onclick="tambahBaru('{{ route('tekprod.stores') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i>Tambah Data Baru</button>
                    <button onclick="addForm('{{ route('tekprod.store') }}')" class="btn btn-warning btn-flat"><i class="fa fa-plus-circle"></i>Buat & Edit Schedule</button>
                    <button onclick="deleteSelected('{{ route('tekprod.delete_selected') }}')" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus Masal</button>
                    <a href="{{ route('tekprod.export') }}" class="btn btn bg-navy btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    <a href="{{ route('tekprod.exportLog') }}" class="btn btn bg-navy btn-flat"><i class="fa fa-file-excel-o"></i> Excel Rev Log</a>
                    <button onclick="cetakPdf('{{ route('tekprod.cetakPdf') }}')" class="btn btn bg-maroon btn-flat"><i class="fa fa-trash"></i> PDF</button>
                </div>          
            </div>
            @if (auth()->user()->level == 2 || auth()->user()->level == 3 || auth()->user()->level == 4 )
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-tekprod">
                    @csrf
                    <table id="table0" class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>ID Design</th>
                            <th>No Document</th>
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
                <form action="" method="post" class="form-tekprod">
                    @csrf
                    <table id="tableAdmin" class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>Ref ID</th>
                            <th>No Dokumen</th>
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
                <form action="" method="post" class="form-tekprod hidden-form">
                    @csrf
                    <table id="table1" class="tableModal table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>No Dokumen</th>
                            <th>Nama</th>
                            <th>Proyek</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>

            <div class="box-body table-responsive">
                <form action="" method="post" class="form-tekprod hidden-form">
                    @csrf
                    <table class="tableModal2 table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>No Dokumen</th>
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

@includeIf('tekprod.form')
@includeIf('tekprod.form3')
@includeIf('tekprod.form2')
@includeIf('tekprod.form4')
@includeIf('tekprod.detail')
@includeIf('tekprod.dwg')
@includeIf('tekprod.dwg2')
@endsection

@push('scripts')
<script>
    let table;
    let tableAdmin;
    let table1;
    let table0;
    let tableModal;
    let tableModal2;
    let tableDetail;

    $(function () {
        table = $('#table0').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('tekprod.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'id_design'},
                {data: 'kode_tekprod'},
                {data: 'nama_tekprod'},
                {data: 'id_proyek'},
                {data: 'id_draft_tekprod'},
                {data: 'id_check_tekprod'},
                {data: 'id_approve_tekprod'},
                {data: 'revisi_tekprod'},
                {data: 'kondisi'},
                {data: 'status_tekprod'},
                {data: 'aksi', searchable: false, sortable: false},
                ]
            });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function redirectTo(url) {
    window.location = "{{ route('tekprod.index') }}";
    }

    $(function () {
        tableAdmin = $('#tableAdmin').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('tekprod.dataAdmin') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'id_tekprod'},
                {data: 'kode_tekprod'},
                {data: 'nama_tekprod'},
                {data: 'id_proyek'},
                {data: 'revisi_tekprod'},
                {data: 'kondisi'},
                {data: 'status_tekprod'},
                {data: 'aksi', searchable: false, sortable: false},
                ]
            });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });


    $(function () {
            tableModal = $('.tableModal').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('tekprod.dataModal') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'id_design'},
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
                    url: '{{ route('tekprod.dataModal2') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_tekprod'},
                    {data: 'nama_tekprod'},
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
                $('#refrensi_design_tekprod').val(data.kode_design);
                $('#tanggal_refrensi_tekprod').val(data.prediksi_akhir);
                $('#id_refrensi_tekprod').val(data.id_design);


                if (data.prediksi_akhir !== $('#tanggal_refrensi_tekprod').val()) {
                $('#tanggal_refrensi_tekprod').val(data.prediksi_akhir);
            }

                $('#modal-dwg').modal('hide');
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Terjadi kesalahan saat mengambil data dokumen:', textStatus, errorThrown);
            }
        });
    }

    function tambahBaru(url) {
        $('#modal-form3').modal('show');
        $('#modal-form3 .modal-title').text('Buat Data Dokumen Baru');

        $('#modal-form3 form')[0].reset();
        $('#modal-form3 form').attr('action', url);
        $('#modal-form3 [name=_method]').val('post');
        $('#modal-form3 [name=nama_tekprod]').focus();
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
            $('#id_tekprod').val(data.id_tekprod);
            $('#nama_tekprod').val(data.nama_tekprod);
            $('#kode_tekprod').val(data.kode_tekprod);
            $('#id_design').val(data.id_design);
            $('#id_proyek').val(data.id_proyek);
            $('#revisi_tekprod').val(data.revisi_tekprod);
            $('#bobot_rev_tekprod').val(data.bobot_rev_tekprod);
            $('#bobot_design_tekprod').val(data.bobot_design_tekprod);
            $('#status_tekprod').val(data.status_tekprod);
            $('#size_tekprod').val(data.size_tekprod);
            $('#lembar_tekprod').val(data.lembar_tekprod);
            $('#konfigurasi_tekprod').val(data.konfigurasi_tekprod);
            $('#id_draft_tekprod').val(data.id_draft_tekprod);
            $('#id_check_tekprod').val(data.id_check_tekprod);
            $('#id_approve_tekprod').val(data.id_approve_tekprod);
            $('#prosentase_tekprod').val(data.prosentase_tekprod);
            $('#pemilik_tekprod').val(data.pemilik_tekprod);
            $('#jenis_tekprod').val(data.jenis_tekprod);
            $('#rev_for_curva_tekprod').val(data.rev_for_curva_tekprod);
            $('#duplicate_status_tekprod').val(data.duplicate_status_tekprod);
            $('#time_release_rev0_tekprod').val(data.time_release_rev0_tekprod);
            $('#tipe_tekprod').val(data.tipe_tekprod);

            $('#id_refrensi_tekprod').val(data.id_refrensi_tekprod);
            $('#refrensi_design_tekprod').val(data.refrensi_design_tekprod);
            $('#tanggal_refrensi_tekprod').val(data.tanggal_refrensi_tekprod);
            $('#tanggal_prediksi_tekprod').val(data.tanggal_prediksi_tekprod);
            $('#prediksi_hari_tekprod').val(data.prediksi_hari_tekprod);
            
            $('#modal-dwg2').modal('hide');
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error('Terjadi kesalahan saat mengambil data dokumen:', textStatus, errorThrown);
        }
    });
}

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Buat & Edit Schedule Dokumen');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_tekprod]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Release Your Document');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_tekprod]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_tekprod]').val(response.nama_tekprod);
                $('#modal-form [name=kode_tekprod]').val(response.kode_tekprod);
                $('#modal-form [name=id_proyek]').val(response.id_proyek);
                $('#modal-form [name=id_design]').val(response.id_design);
                $('#modal-form [name=id_draft_tekprod]').val(response.id_draft_tekprod);
                $('#modal-form [name=id_check_tekprod]').val(response.id_check_tekprod);
                $('#modal-form [name=id_approve_tekprod]').val(response.id_approve_tekprod);
                $('#modal-form [name=revisi_tekprod]').val(response.revisi_tekprod);
                $('#modal-form [name=size_tekprod]').val(response.size_tekprod);
                $('#modal-form [name=lembar_tekprod]').val(response.lembar_tekprod);
                $('#modal-form [name=konfigurasiv]').val(response.konfigurasi_tekprod);
                $('#modal-form [name=tipe_tekprod]').val(response.tipe_tekprod);
                $('#modal-form [name=prosentase_tekprod]').val(response.prosentase_tekprod);
                $('#modal-form [name=pemilik_tekprod]').val(response.pemilik_tekprod);

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
        $('#modal-form2 [name=nama_tekprod]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form2 [name=nama_tekprod]').val(response.nama_tekprod);
                $('#modal-form2 [name=kode_tekprod]').val(response.kode_tekprod);
                $('#modal-form2 [name=revisi_tekprod]').val(response.revisi_tekprod);
                $('#modal-form2 [name=bobot_rev_tekprod]').val(response.bobot_rev_tekprod);
                $('#modal-form2 [name=tipe_tekprod]').val(response.tipe_tekprod);

 
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
                        tableAdmin.ajax.reload();
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
                    tableAdmin.ajax.reload();
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
                $.post(url, $('.form-tekprod').serialize())
                    .done((response) => {
                        table.ajax.reload();
                        tableAdmin.ajax.reload();
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
            $('.form-tekprod')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }

    function editForm4(url) {
    $('#modal-form4').modal('show');
    $('#modal-form4 .modal-title').text('Edit Dokumen');

    $('#modal-form4 form')[0].reset();
    $('#modal-form4 form').attr('action', url);
    $('#modal-form4 [name=_method]').val('put');
    $('#modal-form4 [name=nama_tekprod]').focus();

    $.get(url)
        .done((response) => {
            $('#modal-form4 [name=nama_tekprod]').val(response.nama_tekprod);
            $('#modal-form4 [name=kode_tekprod]').val(response.kode_tekprod);
            $('#modal-form4 [name=id_proyek]').val(response.id_proyek);
            $('#modal-form4 [name=id_draft_tekprod]').val(response.id_draft_tekprod);
            $('#modal-form4 [name=id_check_tekprod]').val(response.id_check_tekprod);
            $('#modal-form4 [name=id_approve_tekprod]').val(response.id_approve_tekprod);
            $('#modal-form4 [name=revisi_tekprod]').val(response.revisi_tekprod);
            $('#modal-form4 [name=size_tekprod]').val(response.size_tekprod);
            $('#modal-form4 [name=lembar_tekprod]').val(response.lembar_tekprod);
            $('#modal-form4 [name=konfigurasi_tekprod]').val(response.konfigurasi_tekprod);
            $('#modal-form4 [name=tipe_tekprod]').val(response.tipe_tekprod);
            $('#modal-form4 [name=bobot_rev_tekprod]').val(response.bobot_rev_tekprod);
            $('#modal-form4 [name=bobot_design_tekprod]').val(response.bobot_design_tekprod);
            $('#modal-form4 [name=pemilik_tekprod]').val(response.pemilik_tekprod);

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
                    url: '{{ route('tekprod.dataDetail') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_tekprod'},
                    {data: 'revisi_tekprod'},
                    {data: 'created_at'},
                ]
            });
    });

    
//-------------------------------------------------------------------------------------


</script>
@endpush