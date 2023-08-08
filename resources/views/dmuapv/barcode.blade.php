<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            @foreach ($datadmu as $dmu)
                <td class="text-center" style="border: 1px solid #333;">
                    <p>{{ $dmu->nama_dmu }} - Rp. {{ format_uang($dmu->harga_jual) }}</p>
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($dmu->kode_dmu, 'C39') }}" 
                        alt="{{ $dmu->kode_dmu }}"
                        width="180"
                        height="60">
                    <br>
                    {{ $dmu->kode_dmu }}
                </td>
                @if ($no++ % 3 == 0)
                    </tr><tr>
                @endif
            @endforeach
        </tr>
    </table>
</body>
</html>


function editForm2(url) {
    $('#modal-form2').modal('show');
    $('#modal-form2 .modal-title').text('Edit Formulir Check Sheet Untuk DMU / EMU');

    $('#modal-form2 form')[0].reset();
    $('#modal-form2 form').attr('action', url);
    $('#modal-form2 [name=_method]').val('put');
    $('#modal-form2 [name=nama_dmu]').focus();

        $.get(url)
            .done((response) => {

            $('#foto1-preview').attr('src', response.foto1 ? response.foto1 : '');
            $('#foto2-preview').attr('src', response.foto2 ? response.foto2 : '');
            $('#foto3-preview').attr('src', response.foto3 ? response.foto3 : '');
            $('#foto4-preview').attr('src', response.foto4 ? response.foto4 : '');
            $('#foto5-preview').attr('src', response.foto5 ? response.foto5 : '');

            $('#foto6-preview').attr('src', response.foto6 ? response.foto6 : '');
            $('#foto7-preview').attr('src', response.foto7 ? response.foto7 : '');
            $('#foto8-preview').attr('src', response.foto8 ? response.foto8 : '');
            $('#foto9-preview').attr('src', response.foto9 ? response.foto9 : '');
            $('#foto10-preview').attr('src', response.foto10 ? response.foto10 : '');

            $('#foto11-preview').attr('src', response.foto11 ? response.foto11 : '');
            $('#foto12-preview').attr('src', response.foto12 ? response.foto12 : '');
            $('#foto13-preview').attr('src', response.foto13 ? response.foto13 : '');
            $('#foto14-preview').attr('src', response.foto14 ? response.foto14 : '');

                $('#modal-form2 [name=status]').val(response.status);
                $('#modal-form2 [name=revisi]').val(response.revisi);
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