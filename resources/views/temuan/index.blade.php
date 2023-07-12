@extends('layouts.master')

@section('title')
    Daftarkan Temuan
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftarkan Temuan </li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('temuan.store') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i>Laporkan Temuan Baru</button>
                    <button onclick="deleteSelected('{{ route('temuan.delete_selected') }}')" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus Multiple</button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-temuan">
                    @csrf
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>Tanggal Buat</th>
                            <th>Tanggal Penyelesaian</th>
                            <th>Pembuat</th>
                            <th>Kode</th>
                            <th>NCR</th>
                            <th>Proyek</th>
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

@includeIf('temuan.form')
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
                url: '{{ route('temuan.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'id_user'},
                {data: 'kode_temuan'},
                {data: 'ncr'},
                {data: 'id_proyek'},
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
        $('#modal-form .modal-title').text('Laporkan Temuan Baru');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=id_temuan]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Approve Temuan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=id_temuan]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=id_proyek]').val(response.id_proyek);
                $('#modal-form [name=id_user]').val(response.id_user);
                $('#modal-form [name=kode_emu]').val(response.kode_emu);
                $('#modal-form [name=ncr]').val(response.ncr);
                $('#modal-form [name=id_produk]').val(response.id_produk);
                $('#modal-form [name=id_car]').val(response.id_car);
                $('#modal-form [name=dampak]').val(response.dampak);
                $('#modal-form [name=frekuensi]').val(response.frekuensi);
                $('#modal-form [name=pantau]').val(response.pantau);
                $('#modal-form [name=status]').val(response.status);
                $('#modal-form [name=jenis]').val(response.jenis);
                $('#modal-form [name=nama_temuan]').val(response.nama_temuan);
                $('#modal-form [name=car]').val(response.car);
                $('#modal-form [name=level]').val(response.level);
                $('#modal-form [name=subsistem]').val(response.subsistem);
                $('#modal-form [name=id_produk]').val(response.id_produk);
                $('#modal-form [name=jumlah]').val(response.jumlah);
                $('#modal-form [name=bagian]').val(response.bagian);
                $('#modal-form [name=operasi]').val(response.operasi);
                $('#modal-form [name=nama_produks]').val(response.nama_produks);
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
                $.post(url, $('.form-temuan').serialize())
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
            $('.form-temuan')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }
</script>
@endpush