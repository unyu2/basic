@extends('layouts.master')

@section('title')
   Start Inspeksi Emu
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Start Inspeksi Emu</li>
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
@includeIf('emu.form')
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

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Approve Inspeksi');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=id_emu]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_proyek]').val(response.nama_proyek);
                $('#modal-form [name=id_emu]').val(response.id_emu);
                $('#modal-form [name=kode_emu]').val(response.kode_emu);
                $('#modal-form [name=status]').val(response.status);
                $('#modal-form [name=keterangan]').val(response.keterangan);
                $('#modal-form [name=id_user]').val(response.id_user);
                $('#modal-form [name=id_car]').val(response.id_car);


                $('#modal-form [name=nama_dmu1]').val(response.nama_dmu1);
                $('#modal-form [name=M1_1]').val(response.M1_1);
$('#modal-form [name=M2_1]').val(response.M2_1);
$('#modal-form [name=Mc1_1]').val(response.Mc1_1);
$('#modal-form [name=Mc2_1]').val(response.Mc2_1);
$('#modal-form [name=T1_1]').val(response.T1_1);
$('#modal-form [name=T2_1]').val(response.T2_1);
$('#modal-form [name=T3_1]').val(response.T3_1);
$('#modal-form [name=T4_1]').val(response.T4_1);
$('#modal-form [name=Tc1_1]').val(response.Tc1_1);
$('#modal-form [name=Tc2_1]').val(response.Tc2_1);
$('#modal-form [name=Tc3_1]').val(response.Tc3_1);
$('#modal-form [name=Tc4_1]').val(response.Tc4_1);


                $('#modal-form [name=nama_dmu2]').val(response.nama_dmu2);
                $('#modal-form [name=M1_2]').val(response.M1_2);
$('#modal-form [name=M2_2]').val(response.M2_2);
$('#modal-form [name=Mc1_2]').val(response.Mc1_2);
$('#modal-form [name=Mc2_2]').val(response.Mc2_2);
$('#modal-form [name=T1_2]').val(response.T1_2);
$('#modal-form [name=T2_2]').val(response.T2_2);
$('#modal-form [name=T3_2]').val(response.T3_2);
$('#modal-form [name=T4_2]').val(response.T4_2);
$('#modal-form [name=Tc1_2]').val(response.Tc1_2);
$('#modal-form [name=Tc2_2]').val(response.Tc2_2);
$('#modal-form [name=Tc3_2]').val(response.Tc3_2);
$('#modal-form [name=Tc4_2]').val(response.Tc4_2);


                $('#modal-form [name=nama_dmu3]').val(response.nama_dmu3);
                $('#modal-form [name=M1_3]').val(response.M1_3);
$('#modal-form [name=M2_3]').val(response.M2_3);
$('#modal-form [name=Mc1_3]').val(response.Mc1_3);
$('#modal-form [name=Mc2_3]').val(response.Mc2_3);
$('#modal-form [name=T1_3]').val(response.T1_3);
$('#modal-form [name=T2_3]').val(response.T2_3);
$('#modal-form [name=T3_3]').val(response.T3_3);
$('#modal-form [name=T4_3]').val(response.T4_3);
$('#modal-form [name=Tc1_3]').val(response.Tc1_3);
$('#modal-form [name=Tc2_3]').val(response.Tc2_3);
$('#modal-form [name=Tc3_3]').val(response.Tc3_3);
$('#modal-form [name=Tc4_3]').val(response.Tc4_3);


                $('#modal-form [name=nama_dmu4]').val(response.nama_dmu4);
                $('#modal-form [name=M1_4]').val(response.M1_4);
$('#modal-form [name=M2_4]').val(response.M2_4);
$('#modal-form [name=Mc1_4]').val(response.Mc1_4);
$('#modal-form [name=Mc2_4]').val(response.Mc2_4);
$('#modal-form [name=T1_4]').val(response.T1_4);
$('#modal-form [name=T2_4]').val(response.T2_4);
$('#modal-form [name=T3_4]').val(response.T3_4);
$('#modal-form [name=T4_4]').val(response.T4_4);
$('#modal-form [name=Tc1_4]').val(response.Tc1_4);
$('#modal-form [name=Tc2_4]').val(response.Tc2_4);
$('#modal-form [name=Tc3_4]').val(response.Tc3_4);
$('#modal-form [name=Tc4_4]').val(response.Tc4_4);


                $('#modal-form [name=nama_dmu5]').val(response.nama_dmu5);
                $('#modal-form [name=M1_5]').val(response.M1_5);
$('#modal-form [name=M2_5]').val(response.M2_5);
$('#modal-form [name=Mc1_5]').val(response.Mc1_5);
$('#modal-form [name=Mc2_5]').val(response.Mc2_5);
$('#modal-form [name=T1_5]').val(response.T1_5);
$('#modal-form [name=T2_5]').val(response.T2_5);
$('#modal-form [name=T3_5]').val(response.T3_5);
$('#modal-form [name=T4_5]').val(response.T4_5);
$('#modal-form [name=Tc1_5]').val(response.Tc1_5);
$('#modal-form [name=Tc2_5]').val(response.Tc2_5);
$('#modal-form [name=Tc3_5]').val(response.Tc3_5);
$('#modal-form [name=Tc4_5]').val(response.Tc4_5);


                $('#modal-form [name=nama_dmu6]').val(response.nama_dmu6);
                $('#modal-form [name=M1_6]').val(response.M1_6);
$('#modal-form [name=M2_6]').val(response.M2_6);
$('#modal-form [name=Mc1_6]').val(response.Mc1_6);
$('#modal-form [name=Mc2_6]').val(response.Mc2_6);
$('#modal-form [name=T1_6]').val(response.T1_6);
$('#modal-form [name=T2_6]').val(response.T2_6);
$('#modal-form [name=T3_6]').val(response.T3_6);
$('#modal-form [name=T4_6]').val(response.T4_6);
$('#modal-form [name=Tc1_6]').val(response.Tc1_6);
$('#modal-form [name=Tc2_6]').val(response.Tc2_6);
$('#modal-form [name=Tc3_6]').val(response.Tc3_6);
$('#modal-form [name=Tc4_6]').val(response.Tc4_6);


                $('#modal-form [name=nama_dmu7]').val(response.nama_dmu7);
                $('#modal-form [name=M1_7]').val(response.M1_7);
$('#modal-form [name=M2_7]').val(response.M2_7);
$('#modal-form [name=Mc1_7]').val(response.Mc1_7);
$('#modal-form [name=Mc2_7]').val(response.Mc2_7);
$('#modal-form [name=T1_7]').val(response.T1_7);
$('#modal-form [name=T2_7]').val(response.T2_7);
$('#modal-form [name=T3_7]').val(response.T3_7);
$('#modal-form [name=T4_7]').val(response.T4_7);
$('#modal-form [name=Tc1_7]').val(response.Tc1_7);
$('#modal-form [name=Tc2_7]').val(response.Tc2_7);
$('#modal-form [name=Tc3_7]').val(response.Tc3_7);
$('#modal-form [name=Tc4_7]').val(response.Tc4_7);


                $('#modal-form [name=nama_dmu8]').val(response.nama_dmu8);
                $('#modal-form [name=M1_8]').val(response.M1_8);
$('#modal-form [name=M2_8]').val(response.M2_8);
$('#modal-form [name=Mc1_8]').val(response.Mc1_8);
$('#modal-form [name=Mc2_8]').val(response.Mc2_8);
$('#modal-form [name=T1_8]').val(response.T1_8);
$('#modal-form [name=T2_8]').val(response.T2_8);
$('#modal-form [name=T3_8]').val(response.T3_8);
$('#modal-form [name=T4_8]').val(response.T4_8);
$('#modal-form [name=Tc1_8]').val(response.Tc1_8);
$('#modal-form [name=Tc2_8]').val(response.Tc2_8);
$('#modal-form [name=Tc3_8]').val(response.Tc3_8);
$('#modal-form [name=Tc4_8]').val(response.Tc4_8);


                $('#modal-form [name=nama_dmu9]').val(response.nama_dmu9);
                $('#modal-form [name=M1_9]').val(response.M1_9);
$('#modal-form [name=M2_9]').val(response.M2_9);
$('#modal-form [name=Mc1_9]').val(response.Mc1_9);
$('#modal-form [name=Mc2_9]').val(response.Mc2_9);
$('#modal-form [name=T1_9]').val(response.T1_9);
$('#modal-form [name=T2_9]').val(response.T2_9);
$('#modal-form [name=T3_9]').val(response.T3_9);
$('#modal-form [name=T4_9]').val(response.T4_9);
$('#modal-form [name=Tc1_9]').val(response.Tc1_9);
$('#modal-form [name=Tc2_9]').val(response.Tc2_9);
$('#modal-form [name=Tc3_9]').val(response.Tc3_9);
$('#modal-form [name=Tc4_9]').val(response.Tc4_9);


                $('#modal-form [name=nama_dmu10]').val(response.nama_dmu10);
                $('#modal-form [name=M1_10]').val(response.M1_10);
$('#modal-form [name=M2_10]').val(response.M2_10);
$('#modal-form [name=Mc1_10]').val(response.Mc1_10);
$('#modal-form [name=Mc2_10]').val(response.Mc2_10);
$('#modal-form [name=T1_10]').val(response.T1_10);
$('#modal-form [name=T2_10]').val(response.T2_10);
$('#modal-form [name=T3_10]').val(response.T3_10);
$('#modal-form [name=T4_10]').val(response.T4_10);
$('#modal-form [name=Tc1_10]').val(response.Tc1_10);
$('#modal-form [name=Tc2_10]').val(response.Tc2_10);
$('#modal-form [name=Tc3_10]').val(response.Tc3_10);
$('#modal-form [name=Tc4_10]').val(response.Tc4_10);


                $('#modal-form [name=nama_dmu11]').val(response.nama_dmu11);
                $('#modal-form [name=M1_11]').val(response.M1_11);
$('#modal-form [name=M2_11]').val(response.M2_11);
$('#modal-form [name=Mc1_11]').val(response.Mc1_11);
$('#modal-form [name=Mc2_11]').val(response.Mc2_11);
$('#modal-form [name=T1_11]').val(response.T1_11);
$('#modal-form [name=T2_11]').val(response.T2_11);
$('#modal-form [name=T3_11]').val(response.T3_11);
$('#modal-form [name=T4_11]').val(response.T4_11);
$('#modal-form [name=Tc1_11]').val(response.Tc1_11);
$('#modal-form [name=Tc2_11]').val(response.Tc2_11);
$('#modal-form [name=Tc3_11]').val(response.Tc3_11);
$('#modal-form [name=Tc4_11]').val(response.Tc4_11);


                $('#modal-form [name=nama_dmu12]').val(response.nama_dmu12);
                $('#modal-form [name=M1_12]').val(response.M1_12);
$('#modal-form [name=M2_12]').val(response.M2_12);
$('#modal-form [name=Mc1_12]').val(response.Mc1_12);
$('#modal-form [name=Mc2_12]').val(response.Mc2_12);
$('#modal-form [name=T1_12]').val(response.T1_12);
$('#modal-form [name=T2_12]').val(response.T2_12);
$('#modal-form [name=T3_12]').val(response.T3_12);
$('#modal-form [name=T4_12]').val(response.T4_12);
$('#modal-form [name=Tc1_12]').val(response.Tc1_12);
$('#modal-form [name=Tc2_12]').val(response.Tc2_12);
$('#modal-form [name=Tc3_12]').val(response.Tc3_12);
$('#modal-form [name=Tc4_12]').val(response.Tc4_12);


                $('#modal-form [name=nama_dmu13]').val(response.nama_dmu13);
                $('#modal-form [name=M1_13]').val(response.M1_13);
$('#modal-form [name=M2_13]').val(response.M2_13);
$('#modal-form [name=Mc1_13]').val(response.Mc1_13);
$('#modal-form [name=Mc2_13]').val(response.Mc2_13);
$('#modal-form [name=T1_13]').val(response.T1_13);
$('#modal-form [name=T2_13]').val(response.T2_13);
$('#modal-form [name=T3_13]').val(response.T3_13);
$('#modal-form [name=T4_13]').val(response.T4_13);
$('#modal-form [name=Tc1_13]').val(response.Tc1_13);
$('#modal-form [name=Tc2_13]').val(response.Tc2_13);
$('#modal-form [name=Tc3_13]').val(response.Tc3_13);
$('#modal-form [name=Tc4_13]').val(response.Tc4_13);


                $('#modal-form [name=nama_dmu14]').val(response.nama_dmu14);
                $('#modal-form [name=M1_14]').val(response.M1_14);
$('#modal-form [name=M2_14]').val(response.M2_14);
$('#modal-form [name=Mc1_14]').val(response.Mc1_14);
$('#modal-form [name=Mc2_14]').val(response.Mc2_14);
$('#modal-form [name=T1_14]').val(response.T1_14);
$('#modal-form [name=T2_14]').val(response.T2_14);
$('#modal-form [name=T3_14]').val(response.T3_14);
$('#modal-form [name=T4_14]').val(response.T4_14);
$('#modal-form [name=Tc1_14]').val(response.Tc1_14);
$('#modal-form [name=Tc2_14]').val(response.Tc2_14);
$('#modal-form [name=Tc3_14]').val(response.Tc3_14);
$('#modal-form [name=Tc4_14]').val(response.Tc4_14);


                $('#modal-form [name=nama_dmu15]').val(response.nama_dmu15);
                $('#modal-form [name=M1_15]').val(response.M1_15);
$('#modal-form [name=M2_15]').val(response.M2_15);
$('#modal-form [name=Mc1_15]').val(response.Mc1_15);
$('#modal-form [name=Mc2_15]').val(response.Mc2_15);
$('#modal-form [name=T1_15]').val(response.T1_15);
$('#modal-form [name=T2_15]').val(response.T2_15);
$('#modal-form [name=T3_15]').val(response.T3_15);
$('#modal-form [name=T4_15]').val(response.T4_15);
$('#modal-form [name=Tc1_15]').val(response.Tc1_15);
$('#modal-form [name=Tc2_15]').val(response.Tc2_15);
$('#modal-form [name=Tc3_15]').val(response.Tc3_15);
$('#modal-form [name=Tc4_15]').val(response.Tc4_15);

$('#modal-form [name=p1]').val(response.p1);
$('#modal-form [name=p2]').val(response.p2);
$('#modal-form [name=p3]').val(response.p3);
$('#modal-form [name=p4]').val(response.p4);
$('#modal-form [name=p5]').val(response.p5);
$('#modal-form [name=p6]').val(response.p6);
$('#modal-form [name=p7]').val(response.p7);
$('#modal-form [name=p8]').val(response.p8);
$('#modal-form [name=p9]').val(response.p9);
$('#modal-form [name=p10]').val(response.p10);
$('#modal-form [name=p11]').val(response.p11);
$('#modal-form [name=p12]').val(response.p12);
$('#modal-form [name=p13]').val(response.p13);
$('#modal-form [name=p14]').val(response.p14);

            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }


</script>
@endpush