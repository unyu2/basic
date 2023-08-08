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
                   <a href="{{ route('dmu.create') }}" class="btn btn-success btn-flat"> <i class="fa fa-plus-circle"></i> Buat Form Inspeksi</a>
                    <button onclick="addForm('{{ route('dmu.storeModal') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i> Buat Form Inspeksi Modal</button>
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
                            <th>Revisi</th>
                            <th>Status</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@includeIf('dmu.form')
@includeIf('dmu.form2')
@includeIf('dmu.form3')
@includeIf('dmu.form4')
@includeIf('dmu.form5')
@includeIf('dmu.form6')
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
                {data: 'revisi'},
                {data: 'status'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });


/** 

        $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('CAN NOT SAVE - Pastikan Jumlah Karakter Sesuai)');
                        return;
                    });
            }
        });

        // AJAX untuk mengirimkan data form
$(document).ready(function() {
    $('#modal-form form').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-form').modal('hide');
                alert(data.message);
                // Refresh halaman atau lakukan tindakan lain setelah berhasil menyimpan
                location.reload();
            },
            error: function(xhr, status, error) {
                let err = xhr.responseJSON;
                // Tampilkan pesan error jika diperlukan
                console.log(err);
            }
        });
    });
});

*/

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



    $(document).ready(function() {
    $('#modal-form form').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#modal-form').modal('hide');
                alert(data.message);
                // Refresh halaman atau lakukan tindakan lain setelah berhasil menyimpan
                location.reload();
            },
            error: function(xhr, status, error) {
                let err = xhr.responseJSON;
                // Tampilkan pesan error jika diperlukan
                if (err.errors) {
                    let errorMessage = '';
                    Object.values(err.errors).forEach((errorMessages) => {
                        errorMessage += errorMessages.join('\n') + '\n';
                    });
                    alert(errorMessage);
                } else {
                    alert('CAN NOT SAVE - Pastikan Jumlah Karakter Sesuai - Pastikan Ukuran Gambar Max 100Kb');
                }
            }
        });
    });
});


    // Fungsi untuk menampilkan pratinjau gambar
    function preview(selector, file, maxWidth) {
    if (file) {
        let reader = new FileReader();

        reader.onload = function(e) {
            let img = new Image();

            img.onload = function() {
                let canvas = document.createElement("canvas");
                let ctx = canvas.getContext("2d");

                let width = img.width;
                let height = img.height;

                if (width > maxWidth) {
                    height *= maxWidth / width;
                    width = maxWidth;
                }

                canvas.width = width;
                canvas.height = height;

                ctx.drawImage(img, 0, 0, width, height);

                let previewDiv = document.querySelector(selector);
                previewDiv.innerHTML = "";
                previewDiv.appendChild(canvas);
            };

            img.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
}

    function redirectTo(url) {
    window.location = "{{ route('dmu.index') }}";
    }



    function editForm3(url) {
    $('#modal-form3').modal('show');
    $('#modal-form3 .modal-title').text('Edit Formulir Check Sheet Untuk DMU / EMU');

    $('#modal-form3 form')[0].reset();
    $('#modal-form3 form').attr('action', url);
    $('#modal-form3 [name=_method]').val('put');
    $('#modal-form3 [name=nama_dmu]').focus();

        $.get(url)
            .done((response) => {

            $('#foto1-preview').attr('src', response.foto1 ? response.foto1 : '');
            $('#foto2-preview').attr('src', response.foto2 ? response.foto2 : '');
            $('#foto3-preview').attr('src', response.foto3 ? response.foto3 : '');

                $('#modal-form3 [name=revisi]').val(response.revisi);
                $('#modal-form3 [name=nama_dmu]').val(response.nama_dmu);
                $('#modal-form3 [name=id_subpengujian]').val(response.id_subpengujian);
                $('#modal-form3 [name=id_proyek]').val(response.id_proyek);
                $('#modal-form3 [name=nama_dmu1]').val(response.nama_dmu1);
                $('#modal-form3 [name=metode1]').val(response.metode1);
                $('#modal-form3 [name=standar1]').val(response.standar1);
                $('#modal-form3 [name=lokasi1]').val(response.lokasi1);

                $('#modal-form3 [name=a1]').val(response.a1);
                $('#modal-form3 [name=a2]').val(response.a2);
                $('#modal-form3 [name=a3]').val(response.a3);
                $('#modal-form3 [name=a4]').val(response.a4);
                $('#modal-form3 [name=a5]').val(response.a5);
                $('#modal-form3 [name=a6]').val(response.a6);
                $('#modal-form3 [name=a7]').val(response.a7);
                $('#modal-form3 [name=a8]').val(response.a8);
                $('#modal-form3 [name=a9]').val(response.a9);
                $('#modal-form3 [name=a10]').val(response.a10);
                $('#modal-form3 [name=a11]').val(response.a11);
                $('#modal-form3 [name=a12]').val(response.a12);

                $('#modal-form3 [name=nama_dmu2]').val(response.nama_dmu2);
                $('#modal-form3 [name=metode2]').val(response.metode2);
                $('#modal-form3 [name=standar2]').val(response.standar2);
                $('#modal-form3 [name=lokasi2]').val(response.lokasi2);
                $('#modal-form3 [name=b1]').val(response.b1);
                $('#modal-form3 [name=b2]').val(response.b2);
                $('#modal-form3 [name=b3]').val(response.b3);
                $('#modal-form3 [name=b4]').val(response.b4);
                $('#modal-form3 [name=b5]').val(response.b5);
                $('#modal-form3 [name=b6]').val(response.b6);
                $('#modal-form3 [name=b7]').val(response.b7);
                $('#modal-form3 [name=b8]').val(response.b8);
                $('#modal-form3 [name=b9]').val(response.b9);
                $('#modal-form3 [name=b10]').val(response.b10);
                $('#modal-form3 [name=b11]').val(response.b11);
                $('#modal-form3 [name=b12]').val(response.b12);

                $('#modal-form3 [name=nama_dmu3]').val(response.nama_dmu3);
                $('#modal-form3 [name=metode3]').val(response.metode3);
                $('#modal-form3 [name=standar3]').val(response.standar3);
                $('#modal-form3 [name=lokasi3]').val(response.lokasi3);
                $('#modal-form3 [name=c1]').val(response.c1);
                $('#modal-form3 [name=c2]').val(response.c2);
                $('#modal-form3 [name=c3]').val(response.c3);
                $('#modal-form3 [name=c4]').val(response.c4);
                $('#modal-form3 [name=c5]').val(response.c5);
                $('#modal-form3 [name=c6]').val(response.c6);
                $('#modal-form3 [name=c7]').val(response.c7);
                $('#modal-form3 [name=c8]').val(response.c8);
                $('#modal-form3 [name=c9]').val(response.c9);
                $('#modal-form3 [name=c10]').val(response.c10);
                $('#modal-form3 [name=c11]').val(response.c11);
                $('#modal-form3 [name=c12]').val(response.c12);

                $('#modal-form3 [name=nama_dmu4]').val(response.nama_dmu4);
                $('#modal-form3 [name=metode4]').val(response.metode4);
                $('#modal-form3 [name=standar4]').val(response.standar4);
                $('#modal-form3 [name=lokasi4]').val(response.lokasi4);
                $('#modal-form3 [name=d1]').val(response.d1);
                $('#modal-form3 [name=d2]').val(response.d2);
                $('#modal-form3 [name=d3]').val(response.d3);
                $('#modal-form3 [name=d4]').val(response.d4);
                $('#modal-form3 [name=d5]').val(response.d5);
                $('#modal-form3 [name=d6]').val(response.d6);
                $('#modal-form3 [name=d7]').val(response.d7);
                $('#modal-form3 [name=d8]').val(response.d8);
                $('#modal-form3 [name=d9]').val(response.d9);
                $('#modal-form3 [name=d10]').val(response.d10);
                $('#modal-form3 [name=d11]').val(response.d11);
                $('#modal-form3 [name=d12]').val(response.d12);

                $('#modal-form3 [name=nama_dmu5]').val(response.nama_dmu5);
                $('#modal-form3 [name=metode5]').val(response.metode5);
                $('#modal-form3 [name=standar5]').val(response.standar5);
                $('#modal-form3 [name=lokasi5]').val(response.lokasi5);
                $('#modal-form3 [name=e1]').val(response.e1);
                $('#modal-form3 [name=e2]').val(response.e2);
                $('#modal-form3 [name=e3]').val(response.e3);
                $('#modal-form3 [name=e4]').val(response.e4);
                $('#modal-form3 [name=e5]').val(response.e5);
                $('#modal-form3 [name=e6]').val(response.e6);
                $('#modal-form3 [name=e7]').val(response.e7);
                $('#modal-form3 [name=e8]').val(response.e8);
                $('#modal-form3 [name=e9]').val(response.e9);
                $('#modal-form3 [name=e10]').val(response.e10);
                $('#modal-form3 [name=e11]').val(response.e11);
                $('#modal-form3 [name=e12]').val(response.e12);

                $('#modal-form3 [name=nama_dmu6]').val(response.nama_dmu6);
                $('#modal-form3 [name=metode6]').val(response.metode6);
                $('#modal-form3 [name=standar6]').val(response.standar6);
                $('#modal-form3 [name=lokasi6]').val(response.lokasi6);
                $('#modal-form3 [name=f1]').val(response.f1);
                $('#modal-form3 [name=f2]').val(response.f2);
                $('#modal-form3 [name=f3]').val(response.f3);
                $('#modal-form3 [name=f4]').val(response.f4);
                $('#modal-form3 [name=f5]').val(response.f5);
                $('#modal-form3 [name=f6]').val(response.f6);
                $('#modal-form3 [name=f7]').val(response.f7);
                $('#modal-form3 [name=f8]').val(response.f8);
                $('#modal-form3 [name=f9]').val(response.f9);
                $('#modal-form3 [name=f10]').val(response.f10);
                $('#modal-form3 [name=f11]').val(response.f11);
                $('#modal-form3 [name=f12]').val(response.f12);

                $('#modal-form3 [name=nama_dmu7]').val(response.nama_dmu7);
                $('#modal-form3 [name=metode7]').val(response.metode7);
                $('#modal-form3 [name=standar7]').val(response.standar7);
                $('#modal-form3 [name=lokasi7]').val(response.lokasi7);
                $('#modal-form3 [name=g1]').val(response.g1);
                $('#modal-form3 [name=g2]').val(response.g2);
                $('#modal-form3 [name=g3]').val(response.g3);
                $('#modal-form3 [name=g4]').val(response.g4);
                $('#modal-form3 [name=g5]').val(response.g5);
                $('#modal-form3 [name=g6]').val(response.g6);
                $('#modal-form3 [name=g7]').val(response.g7);
                $('#modal-form3 [name=g8]').val(response.g8);
                $('#modal-form3 [name=g9]').val(response.g9);
                $('#modal-form3 [name=g10]').val(response.g10);
                $('#modal-form3 [name=g11]').val(response.g11);
                $('#modal-form3 [name=g12]').val(response.g12);

                $('#modal-form3 [name=nama_dmu8]').val(response.nama_dmu8);
                $('#modal-form3 [name=metode8]').val(response.metode8);
                $('#modal-form3 [name=standar8]').val(response.standar8);
                $('#modal-form3 [name=lokasi8]').val(response.lokasi8);
                $('#modal-form3 [name=h1]').val(response.h1);
                $('#modal-form3 [name=h2]').val(response.h2);
                $('#modal-form3 [name=h3]').val(response.h3);
                $('#modal-form3 [name=h4]').val(response.h4);
                $('#modal-form3 [name=h5]').val(response.h5);
                $('#modal-form3 [name=h6]').val(response.h6);
                $('#modal-form3 [name=h7]').val(response.h7);
                $('#modal-form3 [name=h8]').val(response.h8);
                $('#modal-form3 [name=h9]').val(response.h9);
                $('#modal-form3 [name=h10]').val(response.h10);
                $('#modal-form3 [name=h11]').val(response.h11);
                $('#modal-form3 [name=h12]').val(response.h12);

                $('#modal-form3 [name=nama_dmu9]').val(response.nama_dmu9);
                $('#modal-form3 [name=metode9]').val(response.metode9);
                $('#modal-form3 [name=standar9]').val(response.standar9);
                $('#modal-form3 [name=lokasi9]').val(response.lokasi9);
                $('#modal-form3 [name=i1]').val(response.i1);
                $('#modal-form3 [name=i2]').val(response.i2);
                $('#modal-form3 [name=i3]').val(response.i3);
                $('#modal-form3 [name=i4]').val(response.i4);
                $('#modal-form3 [name=i5]').val(response.i5);
                $('#modal-form3 [name=i6]').val(response.i6);
                $('#modal-form3 [name=i7]').val(response.i7);
                $('#modal-form3 [name=i8]').val(response.i8);
                $('#modal-form3 [name=i9]').val(response.i9);
                $('#modal-form3 [name=i10]').val(response.i10);
                $('#modal-form3 [name=i11]').val(response.i11);
                $('#modal-form3 [name=i12]').val(response.i12);

                $('#modal-form3 [name=nama_dmu10]').val(response.nama_dmu10);
                $('#modal-form3 [name=metode10]').val(response.metode10);
                $('#modal-form3 [name=standar10]').val(response.standar10);
                $('#modal-form3 [name=lokasi10]').val(response.lokasi10);
                $('#modal-form3 [name=j1]').val(response.j1);
                $('#modal-form3 [name=j2]').val(response.j2);
                $('#modal-form3 [name=j3]').val(response.j3);
                $('#modal-form3 [name=j4]').val(response.j4);
                $('#modal-form3 [name=j5]').val(response.j5);
                $('#modal-form3 [name=j6]').val(response.j6);
                $('#modal-form3 [name=j7]').val(response.j7);
                $('#modal-form3 [name=j8]').val(response.j8);
                $('#modal-form3 [name=j9]').val(response.j9);
                $('#modal-form3 [name=j10]').val(response.j10);
                $('#modal-form3 [name=j11]').val(response.j11);
                $('#modal-form3 [name=j12]').val(response.j12);

                $('#modal-form3 [name=nama_dmu11]').val(response.nama_dmu11);
                $('#modal-form3 [name=metode11]').val(response.metode11);
                $('#modal-form3 [name=standar11]').val(response.standar11);
                $('#modal-form3 [name=lokasi11]').val(response.lokasi11);
                $('#modal-form3 [name=k1]').val(response.k1);
                $('#modal-form3 [name=k2]').val(response.k2);
                $('#modal-form3 [name=k3]').val(response.k3);
                $('#modal-form3 [name=k4]').val(response.k4);
                $('#modal-form3 [name=k5]').val(response.k5);
                $('#modal-form3 [name=k6]').val(response.k6);
                $('#modal-form3 [name=k7]').val(response.k7);
                $('#modal-form3 [name=k8]').val(response.k8);
                $('#modal-form3 [name=k9]').val(response.k9);
                $('#modal-form3 [name=k10]').val(response.k10);
                $('#modal-form3 [name=k11]').val(response.k11);
                $('#modal-form3 [name=k12]').val(response.k12);

                $('#modal-form3 [name=nama_dmu12]').val(response.nama_dmu12);
                $('#modal-form3 [name=metode12]').val(response.metode12);
                $('#modal-form3 [name=standar12]').val(response.standar12);
                $('#modal-form3 [name=lokasi12]').val(response.lokasi12);
                $('#modal-form3 [name=l1]').val(response.l1);
                $('#modal-form3 [name=l2]').val(response.l2);
                $('#modal-form3 [name=l3]').val(response.l3);
                $('#modal-form3 [name=l4]').val(response.l4);
                $('#modal-form3 [name=l5]').val(response.l5);
                $('#modal-form3 [name=l6]').val(response.l6);
                $('#modal-form3 [name=l7]').val(response.l7);
                $('#modal-form3 [name=l8]').val(response.l8);
                $('#modal-form3 [name=l9]').val(response.l9);
                $('#modal-form3 [name=l10]').val(response.l10);
                $('#modal-form3 [name=l11]').val(response.l11);
                $('#modal-form3 [name=l12]').val(response.l12);

                $('#modal-form3 [name=nama_dmu13]').val(response.nama_dmu13);
                $('#modal-form3 [name=metode13]').val(response.metode13);
                $('#modal-form3 [name=standar13]').val(response.standar13);
                $('#modal-form3 [name=lokasi13]').val(response.lokasi13);
                $('#modal-form3 [name=m1]').val(response.m1);
                $('#modal-form3 [name=m2]').val(response.m2);
                $('#modal-form3 [name=m3]').val(response.m3);
                $('#modal-form3 [name=m4]').val(response.m4);
                $('#modal-form3 [name=m5]').val(response.m5);
                $('#modal-form3 [name=m6]').val(response.m6);
                $('#modal-form3 [name=m7]').val(response.m7);
                $('#modal-form3 [name=m8]').val(response.m8);
                $('#modal-form3 [name=m9]').val(response.m9);
                $('#modal-form3 [name=m10]').val(response.m10);
                $('#modal-form3 [name=m11]').val(response.m11);
                $('#modal-form3 [name=m12]').val(response.m12);

                $('#modal-form3 [name=nama_dmu14]').val(response.nama_dmu14);
                $('#modal-form3 [name=metode14]').val(response.metode14);
                $('#modal-form3 [name=standar14]').val(response.standar14);
                $('#modal-form3 [name=lokasi14]').val(response.lokasi14);
                $('#modal-form3 [name=n1]').val(response.n1);
                $('#modal-form3 [name=n2]').val(response.n2);
                $('#modal-form3 [name=n3]').val(response.n3);
                $('#modal-form3 [name=n4]').val(response.n4);
                $('#modal-form3 [name=n5]').val(response.n5);
                $('#modal-form3 [name=n6]').val(response.n6);
                $('#modal-form3 [name=n7]').val(response.n7);
                $('#modal-form3 [name=n8]').val(response.n8);
                $('#modal-form3 [name=n9]').val(response.n9);
                $('#modal-form3 [name=n10]').val(response.n10);
                $('#modal-form3 [name=n11]').val(response.n11);
                $('#modal-form3 [name=n12]').val(response.n12);

                $('#modal-form3 [name=nama_dmu15]').val(response.nama_dmu15);
                $('#modal-form3 [name=metode15]').val(response.metode15);
                $('#modal-form3 [name=standar15]').val(response.standar15);
                $('#modal-form3 [name=lokasi15]').val(response.lokasi15);
                $('#modal-form3 [name=o1]').val(response.o1);
                $('#modal-form3 [name=o2]').val(response.o2);
                $('#modal-form3 [name=o3]').val(response.o3);
                $('#modal-form3 [name=o4]').val(response.o4);
                $('#modal-form3 [name=o5]').val(response.o5);
                $('#modal-form3 [name=o6]').val(response.o6);
                $('#modal-form3 [name=o7]').val(response.o7);
                $('#modal-form3 [name=o8]').val(response.o8);
                $('#modal-form3 [name=o9]').val(response.o9);
                $('#modal-form3 [name=o10]').val(response.o10);
                $('#modal-form3 [name=o11]').val(response.o11);
                $('#modal-form3 [name=o12]').val(response.o12);

                // Menampilkan pratinjau gambar pertama (foto1) jika ada
                if (response.foto1) {
                $('.tampil-foto1').html(`<img src="{{ url('/') }}${response.foto1}" width="200">`);
                } else {
                // Jika gambar pertama tidak ada, tampilkan placeholder atau pesan kosong
                $('.tampil-foto1').html('Tidak ada gambar.');
                }

                // Menampilkan pratinjau gambar kedua (foto2) jika ada
                if (response.foto2) {
                $('.tampil-foto2').html(`<img src="{{ url('/') }}${response.foto2}" width="200">`);
                } else {
                // Jika gambar kedua tidak ada, tampilkan placeholder atau pesan kosong
                $('.tampil-foto2').html('Tidak ada gambar.');
                }

            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    function editForm2(url) {
        $('#modal-form2').modal('show');
        $('#modal-form2 .modal-title').text('Revisi Formulir Check Sheet Untuk DMU / EMU');

        $('#modal-form2 form')[0].reset();
        $('#modal-form2 form').attr('action', url);
        $('#modal-form2 [name=_method]').val('put');
        $('#modal-form2 [name=nama_dmu]').focus();

        $.get(url)
            .done((response) => {
       //         $('#modal-form2 [name=revisi]').val(response.revisi);
                $('#modal-form2 [name=lokasi1]').val(response.lokasi1);
                $('#modal-form2 [name=nama_dmu]').val(response.nama_dmu);
                $('#modal-form2 [name=id_subpengujian]').val(response.id_subpengujian);
                $('#modal-form2 [name=id_proyek]').val(response.id_proyek);
                $('#modal-form2 [name=nama_dmu1]').val(response.nama_dmu1);
                $('#modal-form2 [name=metode1]').val(response.metode1);
                $('#modal-form2 [name=standar1]').val(response.standar1);
                $('#modal-form2 [name=lokasi1]').val(response.lokasi1);
                $('#modal-form2 [name=a1]').val(response.a1);
                $('#modal-form2 [name=a2]').val(response.a2);
                $('#modal-form2 [name=a3]').val(response.a3);
                $('#modal-form2 [name=a4]').val(response.a4);
                $('#modal-form2 [name=a5]').val(response.a5);
                $('#modal-form2 [name=a6]').val(response.a6);
                $('#modal-form2 [name=a7]').val(response.a7);
                $('#modal-form2 [name=a8]').val(response.a8);
                $('#modal-form2 [name=a9]').val(response.a9);
                $('#modal-form2 [name=a10]').val(response.a10);
                $('#modal-form2 [name=a11]').val(response.a11);
                $('#modal-form2 [name=a12]').val(response.a12);

                $('#modal-form2 [name=nama_dmu2]').val(response.nama_dmu2);
                $('#modal-form2 [name=metode2]').val(response.metode2);
                $('#modal-form2 [name=standar2]').val(response.standar2);
                $('#modal-form2 [name=lokasi2]').val(response.lokasi2);
                $('#modal-form2 [name=b1]').val(response.b1);
                $('#modal-form2 [name=b2]').val(response.b2);
                $('#modal-form2 [name=b3]').val(response.b3);
                $('#modal-form2 [name=b4]').val(response.b4);
                $('#modal-form2 [name=b5]').val(response.b5);
                $('#modal-form2 [name=b6]').val(response.b6);
                $('#modal-form2 [name=b7]').val(response.b7);
                $('#modal-form2 [name=b8]').val(response.b8);
                $('#modal-form2 [name=b9]').val(response.b9);
                $('#modal-form2 [name=b10]').val(response.b10);
                $('#modal-form2 [name=b11]').val(response.b11);
                $('#modal-form2 [name=b12]').val(response.b12);

                $('#modal-form2 [name=nama_dmu3]').val(response.nama_dmu3);
                $('#modal-form2 [name=metode3]').val(response.metode3);
                $('#modal-form2 [name=standar3]').val(response.standar3);
                $('#modal-form2 [name=lokasi3]').val(response.lokasi3);
                $('#modal-form2 [name=c1]').val(response.c1);
                $('#modal-form2 [name=c2]').val(response.c2);
                $('#modal-form2 [name=c3]').val(response.c3);
                $('#modal-form2 [name=c4]').val(response.c4);
                $('#modal-form2 [name=c5]').val(response.c5);
                $('#modal-form2 [name=c6]').val(response.c6);
                $('#modal-form2 [name=c7]').val(response.c7);
                $('#modal-form2 [name=c8]').val(response.c8);
                $('#modal-form2 [name=c9]').val(response.c9);
                $('#modal-form2 [name=c10]').val(response.c10);
                $('#modal-form2 [name=c11]').val(response.c11);
                $('#modal-form2 [name=c12]').val(response.c12);

                $('#modal-form2 [name=nama_dmu4]').val(response.nama_dmu4);
                $('#modal-form2 [name=metode4]').val(response.metode4);
                $('#modal-form2 [name=standar4]').val(response.standar4);
                $('#modal-form2 [name=lokasi4]').val(response.lokasi4);
                $('#modal-form2 [name=d1]').val(response.d1);
                $('#modal-form2 [name=d2]').val(response.d2);
                $('#modal-form2 [name=d3]').val(response.d3);
                $('#modal-form2 [name=d4]').val(response.d4);
                $('#modal-form2 [name=d5]').val(response.d5);
                $('#modal-form2 [name=d6]').val(response.d6);
                $('#modal-form2 [name=d7]').val(response.d7);
                $('#modal-form2 [name=d8]').val(response.d8);
                $('#modal-form2 [name=d9]').val(response.d9);
                $('#modal-form2 [name=d10]').val(response.d10);
                $('#modal-form2 [name=d11]').val(response.d11);
                $('#modal-form2 [name=d12]').val(response.d12);

                $('#modal-form2 [name=nama_dmu5]').val(response.nama_dmu5);
                $('#modal-form2 [name=metode5]').val(response.metode5);
                $('#modal-form2 [name=standar5]').val(response.standar5);
                $('#modal-form2 [name=lokasi5]').val(response.lokasi5);
                $('#modal-form2 [name=e1]').val(response.e1);
                $('#modal-form2 [name=e2]').val(response.e2);
                $('#modal-form2 [name=e3]').val(response.e3);
                $('#modal-form2 [name=e4]').val(response.e4);
                $('#modal-form2 [name=e5]').val(response.e5);
                $('#modal-form2 [name=e6]').val(response.e6);
                $('#modal-form2 [name=e7]').val(response.e7);
                $('#modal-form2 [name=e8]').val(response.e8);
               $('#modal-form2 [name=e9]').val(response.e9);
                $('#modal-form2 [name=e10]').val(response.e10);
                $('#modal-form2 [name=e11]').val(response.e11);
                $('#modal-form2 [name=e12]').val(response.e12);

                $('#modal-form2 [name=nama_dmu6]').val(response.nama_dmu6);
                $('#modal-form2 [name=metode6]').val(response.metode6);
                $('#modal-form2 [name=standar6]').val(response.standar6);
                $('#modal-form2 [name=lokasi6]').val(response.lokasi6);
                $('#modal-form2 [name=f1]').val(response.f1);
                $('#modal-form2 [name=f2]').val(response.f2);
                $('#modal-form2 [name=f3]').val(response.f3);
                $('#modal-form2 [name=f4]').val(response.f4);
                $('#modal-form2 [name=f5]').val(response.f5);
                $('#modal-form2 [name=f6]').val(response.f6);
                $('#modal-form2 [name=f7]').val(response.f7);
                $('#modal-form2 [name=f8]').val(response.f8);
                $('#modal-form2 [name=f9]').val(response.f9);
                $('#modal-form2 [name=f10]').val(response.f10);
                $('#modal-form2 [name=f11]').val(response.f11);
                $('#modal-form2 [name=f12]').val(response.f12);

                $('#modal-form2 [name=nama_dmu7]').val(response.nama_dmu7);
                $('#modal-form2 [name=metode7]').val(response.metode7);
                $('#modal-form2 [name=standar7]').val(response.standar7);
                $('#modal-form2 [name=lokasi7]').val(response.lokasi7);
                $('#modal-form2 [name=g1]').val(response.g1);
                $('#modal-form2 [name=g2]').val(response.g2);
                $('#modal-form2 [name=g3]').val(response.g3);
                $('#modal-form2 [name=g4]').val(response.g4);
                $('#modal-form2 [name=g5]').val(response.g5);
                $('#modal-form2 [name=g6]').val(response.g6);
                $('#modal-form2 [name=g7]').val(response.g7);
                $('#modal-form2 [name=g8]').val(response.g8);
                $('#modal-form2 [name=g9]').val(response.g9);
                $('#modal-form2 [name=g10]').val(response.g10);
                $('#modal-form2 [name=g11]').val(response.g11);
                $('#modal-form2 [name=g12]').val(response.g12);

                $('#modal-form2 [name=nama_dmu8]').val(response.nama_dmu8);
                $('#modal-form2 [name=metode8]').val(response.metode8);
                $('#modal-form2 [name=standar8]').val(response.standar8);
                $('#modal-form2 [name=lokasi8]').val(response.lokasi8);
                $('#modal-form2 [name=h1]').val(response.h1);
                $('#modal-form2 [name=h2]').val(response.h2);
                $('#modal-form2 [name=h3]').val(response.h3);
                $('#modal-form2 [name=h4]').val(response.h4);
                $('#modal-form2 [name=h5]').val(response.h5);
                $('#modal-form2 [name=h6]').val(response.h6);
                $('#modal-form2 [name=h7]').val(response.h7);
                $('#modal-form2 [name=h8]').val(response.h8);
                $('#modal-form2 [name=h9]').val(response.h9);
                $('#modal-form2 [name=h10]').val(response.h10);
                $('#modal-form2 [name=h11]').val(response.h11);
                $('#modal-form2 [name=h12]').val(response.h12);

                $('#modal-form2 [name=nama_dmu9]').val(response.nama_dmu9);
                $('#modal-form2 [name=metode9]').val(response.metode9);
                $('#modal-form2 [name=standar9]').val(response.standar9);
                $('#modal-form2 [name=lokasi9]').val(response.lokasi9);
                $('#modal-form2 [name=i1]').val(response.i1);
                $('#modal-form2 [name=i2]').val(response.i2);
                $('#modal-form2 [name=i3]').val(response.i3);
                $('#modal-form2 [name=i4]').val(response.i4);
                $('#modal-form2 [name=i5]').val(response.i5);
                $('#modal-form2 [name=i6]').val(response.i6);
                $('#modal-form2 [name=i7]').val(response.i7);
                $('#modal-form2 [name=i8]').val(response.i8);
                $('#modal-form2 [name=i9]').val(response.i9);
                $('#modal-form2 [name=i10]').val(response.i10);
                $('#modal-form2 [name=i11]').val(response.i11);
                $('#modal-form2 [name=i12]').val(response.i12);

                $('#modal-form2 [name=nama_dmu10]').val(response.nama_dmu10);
                $('#modal-form2 [name=metode10]').val(response.metode10);
                $('#modal-form2 [name=standar10]').val(response.standar10);
                $('#modal-form2 [name=lokasi10]').val(response.lokasi10);
                $('#modal-form2 [name=j1]').val(response.j1);
                $('#modal-form2 [name=j2]').val(response.j2);
                $('#modal-form2 [name=j3]').val(response.j3);
                $('#modal-form2 [name=j4]').val(response.j4);
                $('#modal-form2 [name=j5]').val(response.j5);
                $('#modal-form2 [name=j6]').val(response.j6);
                $('#modal-form2 [name=j7]').val(response.j7);
                $('#modal-form2 [name=j8]').val(response.j8);
                $('#modal-form2 [name=j9]').val(response.j9);
                $('#modal-form2 [name=j10]').val(response.j10);
                $('#modal-form2 [name=j11]').val(response.j11);
                $('#modal-form2 [name=j12]').val(response.j12);

                $('#modal-form2 [name=nama_dmu11]').val(response.nama_dmu11);
                $('#modal-form2 [name=metode11]').val(response.metode11);
                $('#modal-form2 [name=standar11]').val(response.standar11);
                $('#modal-form2 [name=lokasi11]').val(response.lokasi11);
                $('#modal-form2 [name=k1]').val(response.k1);
                $('#modal-form2 [name=k2]').val(response.k2);
                $('#modal-form2 [name=k3]').val(response.k3);
                $('#modal-form2 [name=k4]').val(response.k4);
                $('#modal-form2 [name=k5]').val(response.k5);
                $('#modal-form2 [name=k6]').val(response.k6);
                $('#modal-form2 [name=k7]').val(response.k7);
                $('#modal-form2 [name=k8]').val(response.k8);
                $('#modal-form2 [name=k9]').val(response.k9);
                $('#modal-form2 [name=k10]').val(response.k10);
                $('#modal-form2 [name=k11]').val(response.k11);
                $('#modal-form2 [name=k12]').val(response.k12);

                $('#modal-form2 [name=nama_dmu12]').val(response.nama_dmu12);
                $('#modal-form2 [name=metode12]').val(response.metode12);
                $('#modal-form2 [name=standar12]').val(response.standar12);
                $('#modal-form2 [name=lokasi12]').val(response.lokasi12);
                $('#modal-form2 [name=l1]').val(response.l1);
                $('#modal-form2 [name=l2]').val(response.l2);
                $('#modal-form2 [name=l3]').val(response.l3);
                $('#modal-form2 [name=l4]').val(response.l4);
                $('#modal-form2 [name=l5]').val(response.l5);
                $('#modal-form2 [name=l6]').val(response.l6);
                $('#modal-form2 [name=l7]').val(response.l7);
                $('#modal-form2 [name=l8]').val(response.l8);
                $('#modal-form2 [name=l9]').val(response.l9);
                $('#modal-form2 [name=l10]').val(response.l10);
                $('#modal-form2 [name=l11]').val(response.l11);
                $('#modal-form2 [name=l12]').val(response.l12);

                $('#modal-form2 [name=nama_dmu13]').val(response.nama_dmu13);
                $('#modal-form2 [name=metode13]').val(response.metode13);
                $('#modal-form2 [name=standar13]').val(response.standar13);
                $('#modal-form2 [name=lokasi13]').val(response.lokasi13);
                $('#modal-form2 [name=m1]').val(response.m1);
                $('#modal-form2 [name=m2]').val(response.m2);
                $('#modal-form2 [name=m3]').val(response.m3);
                $('#modal-form2 [name=m4]').val(response.m4);
                $('#modal-form2 [name=m5]').val(response.m5);
                $('#modal-form2 [name=m6]').val(response.m6);
                $('#modal-form2 [name=m7]').val(response.m7);
                $('#modal-form2 [name=m8]').val(response.m8);
                $('#modal-form2 [name=m9]').val(response.m9);
                $('#modal-form2 [name=m10]').val(response.m10);
                $('#modal-form2 [name=m11]').val(response.m11);
                $('#modal-form2 [name=m12]').val(response.m12);

                $('#modal-form2 [name=nama_dmu14]').val(response.nama_dmu14);
                $('#modal-form2 [name=metode14]').val(response.metode14);
                $('#modal-form2 [name=standar14]').val(response.standar14);
                $('#modal-form2 [name=lokasi14]').val(response.lokasi14);
                $('#modal-form2 [name=n1]').val(response.n1);
                $('#modal-form2 [name=n2]').val(response.n2);
                $('#modal-form2 [name=n3]').val(response.n3);
                $('#modal-form2 [name=n4]').val(response.n4);
                $('#modal-form2 [name=n5]').val(response.n5);
                $('#modal-form2 [name=n6]').val(response.n6);
                $('#modal-form2 [name=n7]').val(response.n7);
                $('#modal-form2 [name=n8]').val(response.n8);
                $('#modal-form2 [name=n9]').val(response.n9);
                $('#modal-form2 [name=n10]').val(response.n10);
                $('#modal-form2 [name=n11]').val(response.n11);
                $('#modal-form2 [name=n12]').val(response.n12);

                $('#modal-form2 [name=nama_dmu15]').val(response.nama_dmu15);
                $('#modal-form2 [name=metode15]').val(response.metode15);
                $('#modal-form2 [name=standar15]').val(response.standar15);
                $('#modal-form2 [name=lokasi15]').val(response.lokasi15);
                $('#modal-form2 [name=o1]').val(response.o1);
                $('#modal-form2 [name=o2]').val(response.o2);
                $('#modal-form2 [name=o3]').val(response.o3);
                $('#modal-form2 [name=o4]').val(response.o4);
                $('#modal-form2 [name=o5]').val(response.o5);
                $('#modal-form2 [name=o6]').val(response.o6);
                $('#modal-form2 [name=o7]').val(response.o7);
                $('#modal-form2 [name=o8]').val(response.o8);
                $('#modal-form2 [name=o9]').val(response.o9);
                $('#modal-form2 [name=o10]').val(response.o10);
                $('#modal-form2 [name=o11]').val(response.o11);
                $('#modal-form2 [name=o12]').val(response.o12);
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

//-------------------------------------------------------------------------------------


</script>
@endpush