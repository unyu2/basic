@extends('layouts.master')

@section('title')
    Data Overall Doc Design & Engineering 
@endsection

@section('breadcrumb')
    @parent
    <li class="active">  Data Overall Doc Design & Engineering  </li>
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
                <form action="" method="post" class="form-design">
                    @csrf
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>No Dwg</th>
                            <th>Nama</th>
                            <th>Proyek</th>
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

@includeIf('design.detail')

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
                url: '{{ route('design.dataOverall') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_design'},
                {data: 'nama_design'},
                {data: 'id_proyek'},
                {data: 'revisi'},
                {data: 'kondisi'},
                {data: 'status'},
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
                    url: '{{ route('design.dataOverall') }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'kode_design'},
                    {data: 'revisi'},
                    {data: 'id_draft'},
                    {data: 'id_check'},
                    {data: 'id_approve'},
                    {data: 'created_at'},
                ]
            });
    });

</script>
@endpush