@extends('layouts.master')

@section('breadcrumb')
    @parent
    <li class="active">Data Peminjaman & Pengembalian</li>
@endsection

<style>
li.font {
  font-size: 27px; 
}
</style>

@section('content')
<li class="font">Data Peminjaman</li>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="table" class="table table-stiped table-bordered tabel-pinjam">
                    <thead>
                        <th width="5%">No</th>
                        <th>Peminjam</th>
                        <th>Fungsi</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<li class="font">Data Pengembalian</li>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="table1"class="table table-stiped table-bordered tabel-kembali">
                    <thead>
                    <th width="5%">No</th>
                        <th>Peminjam</th>
                        <th>Kondisi</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@includeIf('data_pinjam_kembali.detail')

@push('scripts')
<script>
let table;
let table1;
let tableDetail;

$(function () {
    table = $('#table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('data_pinjam_kembali.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'id_peminjam'},
            {data: 'fungsi'},
            {data: 'aksi', searchable: false, sortable: false},
        ]
    });
});

function deleteData(url) {
    if (confirm('Yakin ingin menghapus data terpilih?')) {
        $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response) => {
                table.ajax.reload();
                tableDetail.ajax.reload();
                table1.ajax.reload();
            })
            .fail((errors) => {
                alert('Tidak dapat menghapus data');
                return;
            });
    }
}

function showDetail(url) {
    $('#modal-detail').modal('show');
    
    // Hancurkan DataTable jika sudah diinisialisasi sebelumnya
    if ($.fn.DataTable.isDataTable('.tableDetail')) {
        $('.tableDetail').DataTable().destroy();
    }
    
    tableDetail = $('.tableDetail').DataTable({
        processing: true,
        bSort: false,
        dom: 'Brt',
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'id_barang'},
            {data: 'jumlah'},
        ]
    });
    
    tableDetail.ajax.url(url);
    tableDetail.ajax.reload();
}



//----------------------------------------------------------------------------------------------------//

$(function () {
        table1 = $('#table1').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('data_pinjam_kembali.dataKembali') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'id_peminjam'},
                {data: 'kondisi'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });
    });
</script>
@endpush