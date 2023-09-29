@extends('layouts.master')

@section('title')
    Data Overall Doc Teknologi Produksi
@endsection

@section('breadcrumb')
    @parent
    <li class="active">  Data Overall Doc Teknologi Produksi  </li>
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
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-tekprod">
                    @csrf
                    <table class="table table-stiped table-bordered">
                        <thead>
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
                            <th width="15%">View</th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@includeIf('tekprod.detail')

@push('scripts')
<script>
    let table;
    let tableDetail;

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('tekprod.dataOverall') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
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

</script>
@endpush