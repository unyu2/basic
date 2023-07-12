@extends('layouts.master')

@section('title')
    Daftar Permintaan
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Permintaan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="addForm()" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Transaksi Baru</button>
                @empty(! session('id_permintaan'))
                @endempty
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered table-permintaan">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No Memo</th>
                        <th>Proyek</th>
                        <th>Jumlah Jenis Item</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('permintaan.proyek')
@includeIf('permintaan.detail')
@endsection

@push('scripts')
<script>
    let table, table1;

    $(function () {
        table = $('.table-permintaan').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('permintaan.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'tanggal'},
                {data: 'memo'},
                {data: 'nama_proyek'},
                {data: 'total_item'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        $('.table-proyek').DataTable();
        table1 = $('.table-detail').DataTable({
            processing: true,
            bSort: false,
            dom: 'Brt',
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_produk'},
                {data: 'nama_produk'},
                {data: 'jumlah'},
                {data: 'status'},
                {data: 'status2'},
                {data: 'nopr'},
                {data: 'status3'},
                {data: 'nopo'},
                {data: 'site'},
            ]
        })
    });

    function addForm() {
        $('#modal-proyek').modal('show');
    }

    function showDetail(url) {
        $('#modal-detail').modal('show');

        table1.ajax.url(url);
        table1.ajax.reload();
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