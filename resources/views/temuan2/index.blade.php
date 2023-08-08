@extends('layouts.master')

@section('title')
    Daftar Penyelesaian Temuan
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

@section('breadcrumb')
    @parent
    <li class="active">Daftar Penyelesaian Temuan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
        <div class="box-header">
                <div class="input-group input-group-sm">
                    <form action="{{ route('temuan2.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="file">Pilih file Excel untuk diunggah:</label>
                        <input type="file" name="file" id="file" class="form-control" aria-label="File input">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success btn-flat">Import</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="deleteSelected('{{ route('temuan2.delete_selected') }}')" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus Multiple</button>
                    <button onclick="cetakBarcode('{{ route('temuan2.cetak_barcode') }}')" class="btn btn-success btn-flat"><i class="fa fa-barcode"></i>Lihat / Cetak Detail</button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-temuan2">
                    @csrf
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>Tanggal Buat</th>
                            <th>Tanggal Penyelesaian</th>
                            <th>Kode</th>
                            <th>NCR</th>
                            <th>Proyek</th>
                            <th>TS</th>
                            <th>Produk</th>
                            <th>Kasus</th>
                            <th>Level</th>
                            <th>status</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@includeIf('temuan2.form')
@includeIf('temuan2.form2')
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
                url: '{{ route('temuan2.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'kode_temuan'},
                {data: 'ncr'},
                {data: 'id_proyek'},
                {data: 'id_car'},
                {data: 'id_produk'},
                {data: 'nama_temuan'},
                {data: 'level'},
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

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Buat Temuan Baru');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=id_temuan]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tindak Lanjut Temuan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=id_temuan]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=id_proyek]').val(response.id_proyek);
                $('#modal-form [name=id_user]').val(response.id_user);
                $('#modal-form [name=nama_proyeks]').val(response.nama_proyeks);
                $('#modal-form [name=kode_emu]').val(response.kode_emu);
                $('#modal-form [name=ncr]').val(response.ncr);
                $('#modal-form [name=id_produk]').val(response.id_produk);
                $('#modal-form [name=id_car]').val(response.id_car);
                $('#modal-form [name=nama_temuan]').val(response.nama_temuan);
                $('#modal-form [name=jenis]').val(response.jenis);
                $('#modal-form [name=level]').val(response.level);
                $('#modal-form [name=bobot]').val(response.bobot);

                $('#modal-form [name=dampak]').val(response.dampak);
                $('#modal-form [name=frekuensi]').val(response.frekuensi);
                $('#modal-form [name=pantau]').val(response.pantau);
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
                $.post(url, $('.form-temuan2').serialize())
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
        } else if ($('input:checked').length < 1) {
            alert('Pilih minimal 1 data untuk dicetak');
            return;
        } else {
            $('.form-temuan2')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }

    function editForm2(url) {
        $('#modal-form2').modal('show');
        $('#modal-form2 .modal-title').text('Detail Temuan');

        $('#modal-form2 form')[0].reset();
        $('#modal-form2 form').attr('action', url);
        $('#modal-form2 [name=_method]').val('put');
        $('#modal-form2 [name=id_temuan]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form2 [name=id_proyek]').val(response.id_proyek);
                $('#modal-form2 [name=id_user]').val(response.id_user);
                $('#modal-form2 [name=kode_emu]').val(response.kode_emu);
                $('#modal-form2 [name=ncr]').val(response.ncr);
                $('#modal-form2 [name=id_produk]').val(response.id_produk);
                $('#modal-form2 [name=id_car]').val(response.id_car);
                $('#modal-form2 [name=dampak]').val(response.dampak);
                $('#modal-form2 [name=frekuensi]').val(response.frekuensi);
                $('#modal-form2 [name=pantau]').val(response.pantau);
                $('#modal-form2 [name=status]').val(response.status);
                $('#modal-form2 [name=jenis]').val(response.jenis);
                $('#modal-form2 [name=nama_temuan]').val(response.nama_temuan);
                $('#modal-form2 [name=car]').val(response.car);
                $('#modal-form2 [name=level]').val(response.level);
                $('#modal-form2 [name=subsistem]').val(response.subsistem);
                $('#modal-form2 [name=id_produk]').val(response.id_produk);
                $('#modal-form2 [name=jumlah]').val(response.jumlah);
                $('#modal-form2 [name=bagian]').val(response.bagian);
                $('#modal-form2 [name=operasi]').val(response.operasi);
                $('#modal-form2 [name=aksi]').val(response.aksi);
                $('#modal-form2 [name=penyelesaian]').val(response.aksi);
                $('#modal-form2 [name=penyebab]').val(response.penyebab);
                $('#modal-form2 [name=akibat1]').val(response.akibat1);
                $('#modal-form2 [name=akibat2]').val(response.akibat2);
                $('#modal-form2 [name=akibat3]').val(response.akibat3);
                $('#modal-form2 [name=saran]').val(response.saran);
                $('#modal-form2 [name=nama_produks]').val(response.nama_produks);

            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }
</script>
@endpush