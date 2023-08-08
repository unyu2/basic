@extends('layouts.master')

@section('title')
    Data Design Drawing
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Design</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('dwg.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
                    <button onclick="deleteSelected('{{ route('dwg.delete_selected') }}')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i> Hapus</button>
                    <button onclick="cetakBarcode('{{ route('dwg.cetak_barcode') }}')" class="btn btn-info btn-xs btn-flat"><i class="fa fa-barcode"></i> Cetak Barcode</button>
                    <button onclick="addRef()" class="btn btn-info btn-xs btn-flat"><i class="fa fa-barcode"></i> Test Modal</button>

                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-dwg">
                    @csrf
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>No Drawing</th>
                            <th>Nama</th>
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

@includeIf('dwg.form')
@includeIf('dwg.form2')
@includeIf('dwg.dwg')
@endsection

@push('scripts')
<script>
    let table;
    let table2;

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
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_dwg'},
                {data: 'nama_dwg'},
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
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function addRef() {
        $('#modal-dwg').modal('show');
    }
    
    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Design Drawing Baru');

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
                $('#modal-form [name=id_kepala_gambar]').val(response.id_kepala_gambar);
                $('#modal-form [name=kode_dwg]').val(response.kode_dwg);
                $('#modal-form [name=nama_dwg]').val(response.nama_dwg);
                $('#modal-form [name=id_proyek]').val(response.id_proyek);
                $('#modal-form [name=bobot]').val(response.bobot);
                $('#modal-form [name=prediksi]').val(response.prediksi);
                $('#modal-form [name=size]').val(response.size);
                $('#modal-form [name=lembar]').val(response.lembar);
                $('#modal-form [name=revisi]').val(response.revisi);
                $('#modal-form [name=id_draft]').val(response.id_draft);
                $('#modal-form [name=id_check]').val(response.id_check);
                $('#modal-form [name=id_approve]').val(response.id_approve);

                $('#modal-form [name=konf1]').val(response.konf1);
                $('#modal-form [name=konf2]').val(response.konf2);
                $('#modal-form [name=konf3]').val(response.konf3);
                $('#modal-form [name=konf4]').val(response.konf4);
                $('#modal-form [name=konf5]').val(response.konf5);
                $('#modal-form [name=konf6]').val(response.konf6);
                $('#modal-form [name=konf7]').val(response.konf7);
                $('#modal-form [name=konf8]').val(response.konf8);
                $('#modal-form [name=konf9]').val(response.konf9);
                $('#modal-form [name=konf10]').val(response.konf10);

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
                $.post(url, $('.form-dwg').serialize())
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
            $('.form-dwg')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }


function tampilModalInputData() {
        // Menggunakan ajax untuk memuat konten tabel dalam modal
        $.ajax({
            url: "{{ route('dwg.datas') }}", // Ubah URL ini sesuai dengan URL untuk memuat data dari server
            method: "GET",
            success: function (response) {
                // Memuat data dari response ke dalam tbody tabel
                $('#modal-dwg .modal-body tbody').html(response);
                // Menampilkan modal
                $('#modal-dwg').modal('show');
            },
            error: function () {
                alert('Gagal memuat data');
            }
        });
    }

    // Fungsi untuk menangani pemilihan DWG
    function pilihDwg(id, no_dwg) {
        // Lakukan tindakan yang Anda inginkan ketika DWG dipilih
        alert('Anda memilih DWG dengan ID: ' + id + ' dan Nomor: ' + no_dwg);
        // Tutup modal setelah pemilihan DWG
        $('#modal-dwg').modal('hide');
    }

    function tampilDesain() {
        $('#modal-dwg').modal('show');
    }

    function hideDesain() {
        $('#modal-dwg').modal('hide');
    }

    function pilihDesain(id, kode) {
        $('#id_dwg').val(id);
        $('#kode_dwg').val(kode);
        hideDesain();
    }

/*------------------------------------------------------------------------------------------------------------*/

</script>

<script>
    let table2;

    $(function () {
        table2 = $('.table2').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('dwg.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_dwg'},
                {data: 'nama_dwg'},
                {data: 'revisi'},
                {data: 'status'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        $('#modal-form2').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form2 form').attr('action'), $('#modal-form2 form').serialize())
                    .done((response) => {
                        $('#modal-form2').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data | Terdapat Data Nama Komponen / Kode Material Yang Sama | Periksa kembali :)');
                        return;
                    });
            }
        });
    });

    function closedForm(url) {
        $('#modal-form2').modal('show');
        $('#modal-form2 .modal-title').text('Release Drawing');

        $('#modal-form2 form').attr('action', url);
        $('#modal-form2 [name=_method]').val('get');
        $('#modal-form2 [name=nama_dwg]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form2 [name=id_kepala_gambar]').val(response.id_kepala_gambar);
                $('#modal-form2 [name=kode_dwg]').val(response.kode_dwg);
                $('#modal-form2 [name=nama_dwg]').val(response.nama_dwg);
                $('#modal-form2 [name=id_proyek]').val(response.id_proyek);
                $('#modal-form2 [name=bobot]').val(response.bobot);
                $('#modal-form2 [name=prediksi]').val(response.prediksi);
                $('#modal-form2 [name=size]').val(response.size);
                $('#modal-form2 [name=lembar]').val(response.lembar);
                $('#modal-form2 [name=revisi]').val(response.revisi);
                $('#modal-form2 [name=id_draft]').val(response.id_draft);
                $('#modal-form2 [name=id_check]').val(response.id_check);
                $('#modal-form2 [name=id_approve]').val(response.id_approve);

                $('#modal-form2 [name=konf1]').val(response.konf1);
                $('#modal-form2 [name=konf2]').val(response.konf2);
                $('#modal-form2 [name=konf3]').val(response.konf3);
                $('#modal-form2 [name=konf4]').val(response.konf4);
                $('#modal-form2 [name=konf5]').val(response.konf5);
                $('#modal-form2 [name=konf6]').val(response.konf6);
                $('#modal-form2 [name=konf7]').val(response.konf7);
                $('#modal-form2 [name=konf8]').val(response.konf8);
                $('#modal-form2 [name=konf9]').val(response.konf9);
                $('#modal-form2 [name=konf10]').val(response.konf10);

            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }
</script>



@endpush