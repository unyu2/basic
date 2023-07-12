@extends('layouts.master')

@section('title')
    Daftar Inspeksi
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Inspeksi</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="cetakBarcode('{{ route('emu_ctrl3.cetak_barcode') }}')" class="btn btn-success btn-block btn-flat"><i class="fa fa-barcode"></i>Lihat / Cetak Detail</button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-emu_ctrl3">
                    @csrf
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>Tanggal Buat</th>
                            <th>Tanggal Perbaikan</th>
                            <th>Sub pengujian</th>
                            <th>Pengujian</th>
                            <th>Proyek</th>
                            <th>Pembuat</th>
                            <th>Token</th>
                            <th>Status Doc</th>
                            <th>Status Problem</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@includeIf('emu_ctrl3.form')
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
                url: '{{ route('emu_ctrl3.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'id_subpengujian'},
                {data: 'id_dmu'},
                {data: 'nama_proyek'},
                {data: 'id_user'},
                {data: 'kode_emu'},
                {data: 'status'},
                {data: 'Approved'},
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
        $('#modal-form .modal-title').text('Tambah Inspeksi');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=id_emu]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Lanjutkan Inspeksi');

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


$('#modal-form [name=lokasi1]').val(response.lokasi1);
$('#modal-form [name=lokasi2]').val(response.lokasi2);
$('#modal-form [name=lokasi3]').val(response.lokasi3);
$('#modal-form [name=lokasi4]').val(response.lokasi4);
$('#modal-form [name=lokasi5]').val(response.lokasi5);
$('#modal-form [name=lokasi6]').val(response.lokasi6);
$('#modal-form [name=lokasi7]').val(response.lokasi7);
$('#modal-form [name=lokasi8]').val(response.lokasi8);
$('#modal-form [name=lokasi9]').val(response.lokasi9);
$('#modal-form [name=lokasi10]').val(response.lokasi10);
$('#modal-form [name=lokasi11]').val(response.lokasi11);
$('#modal-form [name=lokasi12]').val(response.lokasi12);
$('#modal-form [name=lokasi13]').val(response.lokasi13);
$('#modal-form [name=lokasi14]').val(response.lokasi14);
$('#modal-form [name=lokasi15]').val(response.lokasi15);

$('#modal-form [name=metode1]').val(response.metode1);
$('#modal-form [name=metode2]').val(response.metode2);
$('#modal-form [name=metode3]').val(response.metode3);
$('#modal-form [name=metode4]').val(response.metode4);
$('#modal-form [name=metode5]').val(response.metode5);
$('#modal-form [name=metode6]').val(response.metode6);
$('#modal-form [name=metode7]').val(response.metode7);
$('#modal-form [name=metode8]').val(response.metode8);
$('#modal-form [name=metode9]').val(response.metode9);
$('#modal-form [name=metode10]').val(response.metode10);
$('#modal-form [name=metode11]').val(response.metode11);
$('#modal-form [name=metode12]').val(response.metode12);
$('#modal-form [name=metode13]').val(response.metode13);
$('#modal-form [name=metode14]').val(response.metode14);

$('#modal-form [name=standar1]').val(response.standar1);
$('#modal-form [name=standar2]').val(response.standar2);
$('#modal-form [name=standar3]').val(response.standar3);
$('#modal-form [name=standar4]').val(response.standar4);
$('#modal-form [name=standar5]').val(response.standar5);
$('#modal-form [name=standar6]').val(response.standar6);
$('#modal-form [name=standar7]').val(response.standar7);
$('#modal-form [name=standar8]').val(response.standar8);
$('#modal-form [name=standar9]').val(response.standar9);
$('#modal-form [name=standar10]').val(response.standar10);
$('#modal-form [name=standar11]').val(response.standar11);
$('#modal-form [name=standar12]').val(response.standar12);
$('#modal-form [name=standar13]').val(response.standar13);
$('#modal-form [name=standar14]').val(response.standar14);

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
                $.post(url, $('.form-emu_ctrl3').serialize())
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
            $('.form-emu_ctrl3')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }
</script>
@endpush