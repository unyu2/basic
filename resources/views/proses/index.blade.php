@extends('layouts.master')

@section('title')
Penerimaan Barang
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Penerimaan Barang</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
        <div class="box-header with-border">
                <button type="button" onclick="print(`'. route('proses.downloadpdf', $proses->id_pemesanan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-print"> System View Print</i></button>  
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tanggal Kirim</th>
                        <th>Token</th>
                        <th>Kode Material</th>
                        <th>Komponen</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('proses.form')
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
                url: '{{ route('proses.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'created_at'},
                {data: 'kode_pemesanan_detail'},
                {data: 'komat'},
                {data: 'nama_produk'},
                {data: 'jumlah'},
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
        $('#modal-form .modal-title').text('Tambah Data Hutang Baru');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=id_produk]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Status');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=id_produk]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=id_produk]').val(response.id_produk);
                $('#modal-form [name=jumlah]').val(response.jumlah);
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

    function cetakBaru(url) {
        if ($('input:checked').length < 1) {
            alert('Pilih data yang akan dicetak');
            return;
        } else {
            $('.form-penjualan')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }

</script>
@endpush