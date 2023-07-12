@extends('layouts.master')

@section('title')
   Start Inspeksi
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Start Inspeksi</li>
@endsection

@section('content')

<div class="row">
<div class="col-lg-3 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-yellow icon" onclick="addForm5()">
        <div class="inner">
                <h3></h3>

                <p><font size="4">DAILY CHECK</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a onclick="addForm5()" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-green" onclick="addForm6()">
            <div class="inner">
                <h3></h3>

                <p><font size="4">SARANA ON</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-battery-full"></i>
            </div>
            <a onclick="addForm6()" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-red" onclick="addForm7()">
            <div class="inner">
                <h3></h3>

                <p><font size="4">SARANA OFF</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a onclick="addForm7()" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
    <div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua" onclick="addForm2()">
            <div class="inner">
                <h3></h3>

                <p><font size="4">P1 PERAWATAN</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a onclick="addForm2()" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua" onclick="addForm1()">
            <div class="inner">
                <h3></h3>

                <p><font size="4">P3 PERAWATAN</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a onclick="addForm1()" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
    <div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua" onclick="addForm3()">
            <div class="inner">
                <h3></h3>

                <p><font size="4">P6 PERAWATAN</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a onclick="addForm3()" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua" onclick="addForm4()">
            <div class="inner">
                <h3></h3>

                <p><font size="4">P12 PERAWATAN</font></p>
            </div>
            <div class="icon">
                <i class="fa fa-train"></i>
            </div>
            <a onclick="addForm4()" class="small-box-footer"><font size="5">START</font> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
          <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered table-emu">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tgl Buat</th>
                        <th>Token</th>
                        <th>Pengujian</th>
                        <th>Proyek</th>
                        <th>Komponen Rusak</th>
                        <th>Status</th>
                        <th>Selesai ??</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('emu.dmu')
@includeIf('emu.dmu1')
@includeIf('emu.dmu2')
@includeIf('emu.dmu3')
@includeIf('emu.dmu4')
@includeIf('emu.dmu5')
@includeIf('emu.dmu6')
@includeIf('emu.dmu7')
@includeIf('emu.detail')
@endsection

@push('scripts')
<script>
    let table, table1;

    $(function () {
        table = $('.table-emu').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('emu.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'tanggal'},
                {data: 'kode_emu'},
                {data: 'nama_dmu'},
                {data: 'id_proyek'},
                {data: 'total_item'},
                {data: 'status'},
                {data: 'lanjut'},

                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

        $('.table-dmu').DataTable();
        table1 = $('.table-detail').DataTable({
            processing: true,
            bSort: false,
            dom: 'Brt',
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_produk'},
                {data: 'nama_produk'},
                {data: 'jumlah'},
                {data: 'updated_at'},
            ]
        });
    });

    function addForm() {
        $('#modal-dmu').modal('show');
    }
    function addForm1() {
        $('#modal-dmu1').modal('show');
    }
    function addForm2() {
        $('#modal-dmu2').modal('show');
    }
    function addForm3() {
        $('#modal-dmu3').modal('show');
    }
    function addForm4() {
        $('#modal-dmu4').modal('show');
    }
    function addForm5() {
        $('#modal-dmu5').modal('show');
    }
    function addForm6() {
        $('#modal-dmu6').modal('show');
    }
    function addForm7() {
        $('#modal-dmu7').modal('show');
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