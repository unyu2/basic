@extends('layouts.master')

@section('title')
    Daftar Formulir Check Sheet Untuk DMU / EMU
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Daftar Formulir Check Sheet Untuk DMU / EMU</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('dmu.store') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i> Buat Form Inspeksi</button>
                    <button onclick="deleteSelected('{{ route('dmu.delete_selected') }}')" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-dmu">
                    @csrf
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Formulir For</th>
                            <th>Proyek</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@includeIf('dmu.form')
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
                url: '{{ route('dmu.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_dmu'},
                {data: 'nama_dmu'},
                {data: 'nama_subpengujian'},
                {data: 'id_proyek'},
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
                        alert('Tidak dapat menyimpan data - Pastikan Jumlah Karakter Sesuai ;)');
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
        $('#modal-form .modal-title').text('Tambah Formulir Check Sheet Untuk DMU / EMU');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_dmu]').focus();
    }


    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Formulir Check Sheet Untuk DMU / EMU');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_dmu]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_dmu]').val(response.nama_dmu);
                $('#modal-form [name=id_subpengujian]').val(response.id_subpengujian);
                $('#modal-form [name=id_proyek]').val(response.id_proyek);
                $('#modal-form [name=nama_dmu1]').val(response.nama_dmu1);
                $('#modal-form [name=metode1]').val(response.metode1);
                $('#modal-form [name=standar1]').val(response.standar1);
                $('#modal-form [name=lokasi1]').val(response.lokasi1);
                $('#modal-form [name=a1]').val(response.a1);
                $('#modal-form [name=a2]').val(response.a2);
                $('#modal-form [name=a3]').val(response.a3);
                $('#modal-form [name=a4]').val(response.a4);
                $('#modal-form [name=a5]').val(response.a5);
                $('#modal-form [name=a6]').val(response.a6);
                $('#modal-form [name=a7]').val(response.a7);
                $('#modal-form [name=a8]').val(response.a8);
                $('#modal-form [name=a9]').val(response.a9);
                $('#modal-form [name=a10]').val(response.a10);
                $('#modal-form [name=a11]').val(response.a11);
                $('#modal-form [name=a12]').val(response.a12);

                $('#modal-form [name=nama_dmu2]').val(response.nama_dmu2);
                $('#modal-form [name=metode2]').val(response.metode2);
                $('#modal-form [name=standar2]').val(response.standar2);
                $('#modal-form [name=lokasi2]').val(response.lokasi2);
                $('#modal-form [name=b1]').val(response.b1);
                $('#modal-form [name=b2]').val(response.b2);
                $('#modal-form [name=b3]').val(response.b3);
                $('#modal-form [name=b4]').val(response.b4);
                $('#modal-form [name=b5]').val(response.b5);
                $('#modal-form [name=b6]').val(response.b6);
                $('#modal-form [name=b7]').val(response.b7);
                $('#modal-form [name=b8]').val(response.b8);
                $('#modal-form [name=b9]').val(response.b9);
                $('#modal-form [name=b10]').val(response.b10);
                $('#modal-form [name=b11]').val(response.b11);
                $('#modal-form [name=b12]').val(response.b12);

                $('#modal-form [name=nama_dmu3]').val(response.nama_dmu3);
                $('#modal-form [name=metode3]').val(response.metode3);
                $('#modal-form [name=standar3]').val(response.standar3);
                $('#modal-form [name=lokasi3]').val(response.lokasi3);
                $('#modal-form [name=c1]').val(response.c1);
                $('#modal-form [name=c2]').val(response.c2);
                $('#modal-form [name=c3]').val(response.c3);
                $('#modal-form [name=c4]').val(response.c4);
                $('#modal-form [name=c5]').val(response.c5);
                $('#modal-form [name=c6]').val(response.c6);
                $('#modal-form [name=c7]').val(response.c7);
                $('#modal-form [name=c8]').val(response.c8);
                $('#modal-form [name=c9]').val(response.c9);
                $('#modal-form [name=c10]').val(response.c10);
                $('#modal-form [name=c11]').val(response.c11);
                $('#modal-form [name=c12]').val(response.c12);

                $('#modal-form [name=nama_dmu4]').val(response.nama_dmu4);
                $('#modal-form [name=metode4]').val(response.metode4);
                $('#modal-form [name=standar4]').val(response.standar4);
                $('#modal-form [name=lokasi4]').val(response.lokasi4);
                $('#modal-form [name=d1]').val(response.d1);
                $('#modal-form [name=d2]').val(response.d2);
                $('#modal-form [name=d3]').val(response.d3);
                $('#modal-form [name=d4]').val(response.d4);
                $('#modal-form [name=d5]').val(response.d5);
                $('#modal-form [name=d6]').val(response.d6);
                $('#modal-form [name=d7]').val(response.d7);
                $('#modal-form [name=d8]').val(response.d8);
                $('#modal-form [name=d9]').val(response.d9);
                $('#modal-form [name=d10]').val(response.d10);
                $('#modal-form [name=d11]').val(response.d11);
                $('#modal-form [name=d12]').val(response.d12);

                $('#modal-form [name=nama_dmu5]').val(response.nama_dmu5);
                $('#modal-form [name=metode5]').val(response.metode5);
                $('#modal-form [name=standar5]').val(response.standar5);
                $('#modal-form [name=lokasi5]').val(response.lokasi5);
                $('#modal-form [name=e1]').val(response.e1);
                $('#modal-form [name=e2]').val(response.e2);
                $('#modal-form [name=e3]').val(response.e3);
                $('#modal-form [name=e4]').val(response.e4);
                $('#modal-form [name=e5]').val(response.e5);
                $('#modal-form [name=e6]').val(response.e6);
                $('#modal-form [name=e7]').val(response.e7);
                $('#modal-form [name=e8]').val(response.e8);
               $('#modal-form [name=e9]').val(response.e9);
                $('#modal-form [name=e10]').val(response.e10);
                $('#modal-form [name=e11]').val(response.e11);
                $('#modal-form [name=e12]').val(response.e12);

                $('#modal-form [name=nama_dmu6]').val(response.nama_dmu6);
                $('#modal-form [name=metode6]').val(response.metode6);
                $('#modal-form [name=standar6]').val(response.standar6);
                $('#modal-form [name=lokasi6]').val(response.lokasi6);
                $('#modal-form [name=f1]').val(response.f1);
                $('#modal-form [name=f2]').val(response.f2);
                $('#modal-form [name=f3]').val(response.f3);
                $('#modal-form [name=f4]').val(response.f4);
                $('#modal-form [name=f5]').val(response.f5);
                $('#modal-form [name=f6]').val(response.f6);
                $('#modal-form [name=f7]').val(response.f7);
                $('#modal-form [name=f8]').val(response.f8);
                $('#modal-form [name=f9]').val(response.f9);
                $('#modal-form [name=f10]').val(response.f10);
                $('#modal-form [name=f11]').val(response.f11);
                $('#modal-form [name=f12]').val(response.f12);

                $('#modal-form [name=nama_dmu7]').val(response.nama_dmu7);
                $('#modal-form [name=metode7]').val(response.metode7);
                $('#modal-form [name=standar7]').val(response.standar7);
                $('#modal-form [name=lokasi7]').val(response.lokasi7);
                $('#modal-form [name=g1]').val(response.g1);
                $('#modal-form [name=g2]').val(response.g2);
                $('#modal-form [name=g3]').val(response.g3);
                $('#modal-form [name=g4]').val(response.g4);
                $('#modal-form [name=g5]').val(response.g5);
                $('#modal-form [name=g6]').val(response.g6);
                $('#modal-form [name=g7]').val(response.g7);
                $('#modal-form [name=g8]').val(response.g8);
                $('#modal-form [name=g9]').val(response.g9);
                $('#modal-form [name=g10]').val(response.g10);
                $('#modal-form [name=g11]').val(response.g11);
                $('#modal-form [name=g12]').val(response.g12);

                $('#modal-form [name=nama_dmu8]').val(response.nama_dmu8);
                $('#modal-form [name=metode8]').val(response.metode8);
                $('#modal-form [name=standar8]').val(response.standar8);
                $('#modal-form [name=lokasi8]').val(response.lokasi8);
                $('#modal-form [name=h1]').val(response.h1);
                $('#modal-form [name=h2]').val(response.h2);
                $('#modal-form [name=h3]').val(response.h3);
                $('#modal-form [name=h4]').val(response.h4);
                $('#modal-form [name=h5]').val(response.h5);
                $('#modal-form [name=h6]').val(response.h6);
                $('#modal-form [name=h7]').val(response.h7);
                $('#modal-form [name=h8]').val(response.h8);
                $('#modal-form [name=h9]').val(response.h9);
                $('#modal-form [name=h10]').val(response.h10);
                $('#modal-form [name=h11]').val(response.h11);
                $('#modal-form [name=h12]').val(response.h12);

                $('#modal-form [name=nama_dmu9]').val(response.nama_dmu9);
                $('#modal-form [name=metode9]').val(response.metode9);
                $('#modal-form [name=standar9]').val(response.standar9);
                $('#modal-form [name=lokasi9]').val(response.lokasi9);
                $('#modal-form [name=i1]').val(response.i1);
                $('#modal-form [name=i2]').val(response.i2);
                $('#modal-form [name=i3]').val(response.i3);
                $('#modal-form [name=i4]').val(response.i4);
                $('#modal-form [name=i5]').val(response.i5);
                $('#modal-form [name=i6]').val(response.i6);
                $('#modal-form [name=i7]').val(response.i7);
                $('#modal-form [name=i8]').val(response.i8);
                $('#modal-form [name=i9]').val(response.i9);
                $('#modal-form [name=i10]').val(response.i10);
                $('#modal-form [name=i11]').val(response.i11);
                $('#modal-form [name=i12]').val(response.i12);

                $('#modal-form [name=nama_dmu10]').val(response.nama_dmu10);
                $('#modal-form [name=metode10]').val(response.metode10);
                $('#modal-form [name=standar10]').val(response.standar10);
                $('#modal-form [name=lokasi10]').val(response.lokasi10);
                $('#modal-form [name=j1]').val(response.j1);
                $('#modal-form [name=j2]').val(response.j2);
                $('#modal-form [name=j3]').val(response.j3);
                $('#modal-form [name=j4]').val(response.j4);
                $('#modal-form [name=j5]').val(response.j5);
                $('#modal-form [name=j6]').val(response.j6);
                $('#modal-form [name=j7]').val(response.j7);
                $('#modal-form [name=j8]').val(response.j8);
                $('#modal-form [name=j9]').val(response.j9);
                $('#modal-form [name=j10]').val(response.j10);
                $('#modal-form [name=j11]').val(response.j11);
                $('#modal-form [name=j12]').val(response.j12);

                $('#modal-form [name=nama_dmu11]').val(response.nama_dmu11);
                $('#modal-form [name=metode11]').val(response.metode11);
                $('#modal-form [name=standar11]').val(response.standar11);
                $('#modal-form [name=lokasi11]').val(response.lokasi11);
                $('#modal-form [name=k1]').val(response.k1);
                $('#modal-form [name=k2]').val(response.k2);
                $('#modal-form [name=k3]').val(response.k3);
                $('#modal-form [name=k4]').val(response.k4);
                $('#modal-form [name=k5]').val(response.k5);
                $('#modal-form [name=k6]').val(response.k6);
                $('#modal-form [name=k7]').val(response.k7);
                $('#modal-form [name=k8]').val(response.k8);
                $('#modal-form [name=k9]').val(response.k9);
                $('#modal-form [name=k10]').val(response.k10);
                $('#modal-form [name=k11]').val(response.k11);
                $('#modal-form [name=k12]').val(response.k12);

                $('#modal-form [name=nama_dmu12]').val(response.nama_dmu12);
                $('#modal-form [name=metode12]').val(response.metode12);
                $('#modal-form [name=standar12]').val(response.standar12);
                $('#modal-form [name=lokasi12]').val(response.lokasi12);
                $('#modal-form [name=l1]').val(response.l1);
                $('#modal-form [name=l2]').val(response.l2);
                $('#modal-form [name=l3]').val(response.l3);
                $('#modal-form [name=l4]').val(response.l4);
                $('#modal-form [name=l5]').val(response.l5);
                $('#modal-form [name=l6]').val(response.l6);
                $('#modal-form [name=l7]').val(response.l7);
                $('#modal-form [name=l8]').val(response.l8);
                $('#modal-form [name=l9]').val(response.l9);
                $('#modal-form [name=l10]').val(response.l10);
                $('#modal-form [name=l11]').val(response.l11);
                $('#modal-form [name=l12]').val(response.l12);

                $('#modal-form [name=nama_dmu13]').val(response.nama_dmu13);
                $('#modal-form [name=metode13]').val(response.metode13);
                $('#modal-form [name=standar13]').val(response.standar13);
                $('#modal-form [name=lokasi13]').val(response.lokasi13);
                $('#modal-form [name=m1]').val(response.m1);
                $('#modal-form [name=m2]').val(response.m2);
                $('#modal-form [name=m3]').val(response.m3);
                $('#modal-form [name=m4]').val(response.m4);
                $('#modal-form [name=m5]').val(response.m5);
                $('#modal-form [name=m6]').val(response.m6);
                $('#modal-form [name=m7]').val(response.m7);
                $('#modal-form [name=m8]').val(response.m8);
                $('#modal-form [name=m9]').val(response.m9);
                $('#modal-form [name=m10]').val(response.m10);
                $('#modal-form [name=m11]').val(response.m11);
                $('#modal-form [name=m12]').val(response.m12);

                $('#modal-form [name=nama_dmu14]').val(response.nama_dmu14);
                $('#modal-form [name=metode14]').val(response.metode14);
                $('#modal-form [name=standar14]').val(response.standar14);
                $('#modal-form [name=lokasi14]').val(response.lokasi14);
                $('#modal-form [name=n1]').val(response.n1);
                $('#modal-form [name=n2]').val(response.n2);
                $('#modal-form [name=n3]').val(response.n3);
                $('#modal-form [name=n4]').val(response.n4);
                $('#modal-form [name=n5]').val(response.n5);
                $('#modal-form [name=n6]').val(response.n6);
                $('#modal-form [name=n7]').val(response.n7);
                $('#modal-form [name=n8]').val(response.n8);
                $('#modal-form [name=n9]').val(response.n9);
                $('#modal-form [name=n10]').val(response.n10);
                $('#modal-form [name=n11]').val(response.n11);
                $('#modal-form [name=n12]').val(response.n12);

                $('#modal-form [name=nama_dmu15]').val(response.nama_dmu15);
                $('#modal-form [name=metode15]').val(response.metode15);
                $('#modal-form [name=standar15]').val(response.standar15);
                $('#modal-form [name=lokasi15]').val(response.lokasi15);
                $('#modal-form [name=o1]').val(response.o1);
                $('#modal-form [name=o2]').val(response.o2);
                $('#modal-form [name=o3]').val(response.o3);
                $('#modal-form [name=o4]').val(response.o4);
                $('#modal-form [name=o5]').val(response.o5);
                $('#modal-form [name=o6]').val(response.o6);
                $('#modal-form [name=o7]').val(response.o7);
                $('#modal-form [name=o8]').val(response.o8);
                $('#modal-form [name=o9]').val(response.o9);
                $('#modal-form [name=o10]').val(response.o10);
                $('#modal-form [name=o11]').val(response.o11);
                $('#modal-form [name=o12]').val(response.o12);
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
                $.post(url, $('.form-dmu').serialize())
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
        } else if ($('input:checked').length < 3) {
            alert('Pilih minimal 3 data untuk dicetak');
            return;
        } else {
            $('.form-dmu')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }
</script>
@endpush