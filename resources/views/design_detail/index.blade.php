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

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('design_detail.store') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i> Tambah Data Design Drawing</button>
                    <button onclick="deleteSelected('{{ route('design_detail.delete_selected') }}')" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus Masal</button>
                    <a href="{{ route('design_detail.export') }}" class="btn btn-primary btn-flat"><i class="fa fa-file-excel"></i> Export Excel</a>

                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-design">
                    @csrf
                    <table class="table table-stiped table-bordered">
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
            
            <div class="box-body table-responsive">
    <form action="" method="post" class="form-design hidden-form">
        @csrf
        <table class="tableModal table-stiped table-bordered">
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
        table = $('.table').DataTable({
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

        $('[name=select_all]').on('click', function () {
        $(':checkbox').prop('checked', this.checked);
         });
        });


    function redirectTo(url) {
    window.location = "{{ route('design_detail.index') }}";
    }


$(function () {
        tableModal = $('.tableModal').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('design_detail.dataModal') }}',
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


    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Data Design Drawing');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_design]').focus();
    }



    function editForm3(url) {
    $('#modal-form3').modal('show');
    $('#modal-form3 .modal-title').text('Release Design Drawing');

    $('#modal-form3 form')[0].reset();
    $('#modal-form3 form').attr('action', url);
    $('#modal-form3 [name=_method]').val('put');
    $('#modal-form3 [name=nama_design]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form3 [name=nama_design]').val(response.nama_design);
                $('#modal-form3 [name=kode_design]').val(response.kode_design);
                $('#modal-form3 [name=revisi]').val(response.revisi);


            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }


    $('#modal-form3').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form3 form').attr('action'), $('#modal-form3 form').serialize())
                    .done((response) => {
                        $('#modal-form3').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data | Periksa kembali :)');
                        return;
                    });
            }
        });


    function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit Your Design Drawing Data');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('put');
    $('#modal-form [name=nama_design]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=id_kepala_gambar]').val(response.id_kepala_gambar);
                $('#modal-form [name=id_proyek]').val(response.id_proyek);
                $('#modal-form [name=nama_design]').val(response.nama_design);
                $('#modal-form [name=kode_design]').val(response.kode_design);
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

    function cetakBarcode(url) {
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
                $('#modal-form4 [name=prediksi_hari]').val(response.prediksi_hari);
                $('#modal-form4 [name=tanggal_prediksi]').val(response.tanggal_prediksi);
                $('#modal-form4 [name=konfigurasi]').val(response.konfigurasi);
                $('#modal-form4 [name=refrensi_design]').val(response.refrensi_design);

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
                $('#tanggal_refrensi').val(data.tanggal_prediksi);

                if (data.tanggal_prediksi !== $('#tanggal_refrensi').val()) {
                $('#tanggal_refrensi').val(data.tanggal_prediksi);
            }

                $('#modal-dwg').modal('hide');
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Terjadi kesalahan saat mengambil data design:', textStatus, errorThrown);
            }
        });
    }

//-------------------------------------------------------------------------------------


</script>
@endpush