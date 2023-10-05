<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check Sheet</title>

    <style>
        table td {
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 14px;
        }
        table.data td,
        table.data th {
            border: 1px solid #ccc;
            padding: 5px;
        }
        table.data {
            border-collapse: collapse;
        }
        table.datas {
            border-collapse: collapse;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-left {
            text-align: left;
            font-size: 13px;
            font-style:italic;
        }
    </style>

</head>
<body>

    <table width="100%">
        <thead>
        @foreach ($emu as $item)
            <tr>
                <th><b> <font size=4>INSPECTION SHEET - {{ $item->nama_proyek }}</b></th>
            <tr>
            @endforeach
            @foreach ($emu as $item)
            <tr>
                <th><b> <font size=3>{{ $item->metode }}  @endforeach</b>

           
            @foreach ($emu as $item)
<b>**{{ $item->nama_car }}**</b></th>
    </tr>
            @endforeach
            @foreach ($emu as $item)
            <tr>
                <th><b> <font size=2>{{ tanggal_indonesia($item->updated_at) }}</b></th>
            <tr>
            @endforeach

        </thead>
    </table>
    <br>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 1: {{ $item->metode1 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p1 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
<th>{{ $item->a1 }}</th>
<th>{{ $item->a2 }}</th>
<th>{{ $item->a3 }}</th>
<th>{{ $item->a4 }}</th>
<th>{{ $item->a5 }}</th>
<th>{{ $item->a6 }}</th>
<th>{{ $item->a7 }}</th>
<th>{{ $item->a8 }}</th>
<th>{{ $item->a9 }}</th>
<th>{{ $item->a10 }}</th>
<th>{{ $item->a11 }}</th>
<th>{{ $item->a12 }}</th>
            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
        item <td class="text-center">{{ $item->M1_1 }}</td>
                    <td class="text-center">{{ $item->M2_1 }}</td>
                    <td class="text-center">{{ $item->Mc1_1 }}</td>
                    <td class="text-center">{{ $item->Mc2_1 }}</td>
                    <td class="text-center">{{ $item->T1_1 }}</td>
                    <td class="text-center">{{ $item->T2_1 }}</td>
                    <td class="text-center">{{ $item->T3_1 }} </td>
                    <td class="text-center">{{ $item->T4_1 }}</td>
                    <td class="text-center">{{ $item->Tc1_1 }}</td>
                    <td class="text-center">{{ $item->Tc2_1 }}</td>
                    <td class="text-center">{{ $item->Tc3_1 }} </td>
                    <td class="text-center">{{ $item->Tc4_1 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 2: {{ $item->metode2 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p2 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
<th>{{ $item->b1 }}</th>
<th>{{ $item->b2 }}</th>
<th>{{ $item->b3 }}</th>
<th>{{ $item->b4 }}</th>
<th>{{ $item->b5 }}</th>
<th>{{ $item->b6 }}</th>
<th>{{ $item->b7 }}</th>
<th>{{ $item->b8 }}</th>
<th>{{ $item->b9 }}</th>
<th>{{ $item->b10 }}</th>
<th>{{ $item->b11 }}</th>
<th>{{ $item->b12 }}</th>
            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                    <td class="text-center">{{ $item->M1_2 }}</td>
                    <td class="text-center">{{ $item->M2_2 }}</td>
                    <td class="text-center">{{ $item->Mc1_2 }}</td>
                    <td class="text-center">{{ $item->Mc2_2 }}</td>
                    <td class="text-center">{{ $item->T1_2 }}</td>
                    <td class="text-center">{{ $item->T2_2 }}</td>
                    <td class="text-center">{{ $item->T3_2 }} </td>
                    <td class="text-center">{{ $item->T4_2 }}</td>
                    <td class="text-center">{{ $item->Tc1_2 }}</td>
                    <td class="text-center">{{ $item->Tc2_2 }}</td>
                    <td class="text-center">{{ $item->Tc3_2 }} </td>
                    <td class="text-center">{{ $item->Tc4_2 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 3: {{ $item->metode3 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p3 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->c1}}</th>
<th>{{ $item->c2}}</th>
<th>{{ $item->c3}}</th>
<th>{{ $item->c4}}</th>
<th>{{ $item->c5}}</th>
<th>{{ $item->c6}}</th>
<th>{{ $item->c7}}</th>
<th>{{ $item->c8}}</th>
<th>{{ $item->c9}}</th>
<th>{{ $item->c10}}</th>
<th>{{ $item->c11}}</th>
<th>{{ $item->c12}}</th>

            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_3}}</td>
<td class="text-center">{{ $item->M2_3}}</td>
<td class="text-center">{{ $item->Mc1_3}}</td>
<td class="text-center">{{ $item->Mc2_3}}</td>
<td class="text-center">{{ $item->T1_3}}</td>
<td class="text-center">{{ $item->T2_3}}</td>
<td class="text-center">{{ $item->T3_3}}</td>
<td class="text-center">{{ $item->T4_3}}</td>
<td class="text-center">{{ $item->Tc1_3}}</td>
<td class="text-center">{{ $item->Tc2_3}}</td>
<td class="text-center">{{ $item->Tc3_3}}</td>
<td class="text-center">{{ $item->Tc4_3}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 4: {{ $item->metode4 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p4 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->d1}}</th>
<th>{{ $item->d2}}</th>
<th>{{ $item->d3}}</th>
<th>{{ $item->d4}}</th>
<th>{{ $item->d5}}</th>
<th>{{ $item->d6}}</th>
<th>{{ $item->d7}}</th>
<th>{{ $item->d8}}</th>
<th>{{ $item->d9}}</th>
<th>{{ $item->d10}}</th>
<th>{{ $item->d11}}</th>
<th>{{ $item->d12}}</th>


            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_4}}</td>
<td class="text-center">{{ $item->M2_4}}</td>
<td class="text-center">{{ $item->Mc1_4}}</td>
<td class="text-center">{{ $item->Mc2_4}}</td>
<td class="text-center">{{ $item->T1_4}}</td>
<td class="text-center">{{ $item->T2_4}}</td>
<td class="text-center">{{ $item->T3_4}}</td>
<td class="text-center">{{ $item->T4_4}}</td>
<td class="text-center">{{ $item->Tc1_4}}</td>
<td class="text-center">{{ $item->Tc2_4}}</td>
<td class="text-center">{{ $item->Tc3_4}}</td>
<td class="text-center">{{ $item->Tc4_4}}</td>


                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 5: {{ $item->metode5 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p5 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->e1}}</th>
<th>{{ $item->e2}}</th>
<th>{{ $item->e3}}</th>
<th>{{ $item->e4}}</th>
<th>{{ $item->e5}}</th>
<th>{{ $item->e6}}</th>
<th>{{ $item->e7}}</th>
<th>{{ $item->e8}}</th>
<th>{{ $item->e9}}</th>
<th>{{ $item->e10}}</th>
<th>{{ $item->e11}}</th>
<th>{{ $item->e12}}</th>
            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_5}}</td>
<td class="text-center">{{ $item->M2_5}}</td>
<td class="text-center">{{ $item->Mc1_5}}</td>
<td class="text-center">{{ $item->Mc2_5}}</td>
<td class="text-center">{{ $item->T1_5}}</td>
<td class="text-center">{{ $item->T2_5}}</td>
<td class="text-center">{{ $item->T3_5}}</td>
<td class="text-center">{{ $item->T4_5}}</td>
<td class="text-center">{{ $item->Tc1_5}}</td>
<td class="text-center">{{ $item->Tc2_5}}</td>
<td class="text-center">{{ $item->Tc3_5}}</td>
<td class="text-center">{{ $item->Tc4_5}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 6: {{ $item->metode6 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p6 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->f1}}</th>
<th>{{ $item->f2}}</th>
<th>{{ $item->f3}}</th>
<th>{{ $item->f4}}</th>
<th>{{ $item->f5}}</th>
<th>{{ $item->f6}}</th>
<th>{{ $item->f7}}</th>
<th>{{ $item->f8}}</th>
<th>{{ $item->f9}}</th>
<th>{{ $item->f10}}</th>
<th>{{ $item->f11}}</th>
<th>{{ $item->f12}}</th>

            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_6}}</td>
<td class="text-center">{{ $item->M2_6}}</td>
<td class="text-center">{{ $item->Mc1_6}}</td>
<td class="text-center">{{ $item->Mc2_6}}</td>
<td class="text-center">{{ $item->T1_6}}</td>
<td class="text-center">{{ $item->T2_6}}</td>
<td class="text-center">{{ $item->T3_6}}</td>
<td class="text-center">{{ $item->T4_6}}</td>
<td class="text-center">{{ $item->Tc1_6}}</td>
<td class="text-center">{{ $item->Tc2_6}}</td>
<td class="text-center">{{ $item->Tc3_6}}</td>
<td class="text-center">{{ $item->Tc4_6}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 7: {{ $item->metode7 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p7 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->g1}}</th>
<th>{{ $item->g2}}</th>
<th>{{ $item->g3}}</th>
<th>{{ $item->g4}}</th>
<th>{{ $item->g5}}</th>
<th>{{ $item->g6}}</th>
<th>{{ $item->g7}}</th>
<th>{{ $item->g8}}</th>
<th>{{ $item->g9}}</th>
<th>{{ $item->g10}}</th>
<th>{{ $item->g11}}</th>
<th>{{ $item->g12}}</th>
            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_7}}</td>
<td class="text-center">{{ $item->M2_7}}</td>
<td class="text-center">{{ $item->Mc1_7}}</td>
<td class="text-center">{{ $item->Mc2_7}}</td>
<td class="text-center">{{ $item->T1_7}}</td>
<td class="text-center">{{ $item->T2_7}}</td>
<td class="text-center">{{ $item->T3_7}}</td>
<td class="text-center">{{ $item->T4_7}}</td>
<td class="text-center">{{ $item->Tc1_7}}</td>
<td class="text-center">{{ $item->Tc2_7}}</td>
<td class="text-center">{{ $item->Tc3_7}}</td>
<td class="text-center">{{ $item->Tc4_7}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 8: {{ $item->metode8 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p8 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->h1}}</th>
<th>{{ $item->h2}}</th>
<th>{{ $item->h3}}</th>
<th>{{ $item->h4}}</th>
<th>{{ $item->h5}}</th>
<th>{{ $item->h6}}</th>
<th>{{ $item->h7}}</th>
<th>{{ $item->h8}}</th>
<th>{{ $item->h9}}</th>
<th>{{ $item->h10}}</th>
<th>{{ $item->h11}}</th>
<th>{{ $item->h12}}</th>

            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_8}}</td>
<td class="text-center">{{ $item->M2_8}}</td>
<td class="text-center">{{ $item->Mc1_8}}</td>
<td class="text-center">{{ $item->Mc2_8}}</td>
<td class="text-center">{{ $item->T1_8}}</td>
<td class="text-center">{{ $item->T2_8}}</td>
<td class="text-center">{{ $item->T3_8}}</td>
<td class="text-center">{{ $item->T4_8}}</td>
<td class="text-center">{{ $item->Tc1_8}}</td>
<td class="text-center">{{ $item->Tc2_8}}</td>
<td class="text-center">{{ $item->Tc3_8}}</td>
<td class="text-center">{{ $item->Tc4_8}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 9: {{ $item->metode9 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p9 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->i1}}</th>
<th>{{ $item->i2}}</th>
<th>{{ $item->i3}}</th>
<th>{{ $item->i4}}</th>
<th>{{ $item->i5}}</th>
<th>{{ $item->i6}}</th>
<th>{{ $item->i7}}</th>
<th>{{ $item->i8}}</th>
<th>{{ $item->i9}}</th>
<th>{{ $item->i10}}</th>
<th>{{ $item->i11}}</th>
<th>{{ $item->i12}}</th>
            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_9}}</td>
<td class="text-center">{{ $item->M2_9}}</td>
<td class="text-center">{{ $item->Mc1_9}}</td>
<td class="text-center">{{ $item->Mc2_9}}</td>
<td class="text-center">{{ $item->T1_9}}</td>
<td class="text-center">{{ $item->T2_9}}</td>
<td class="text-center">{{ $item->T3_9}}</td>
<td class="text-center">{{ $item->T4_9}}</td>
<td class="text-center">{{ $item->Tc1_9}}</td>
<td class="text-center">{{ $item->Tc2_9}}</td>
<td class="text-center">{{ $item->Tc3_9}}</td>
<td class="text-center">{{ $item->Tc4_9}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 10: {{ $item->metode10 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p10 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->j1}}</th>
<th>{{ $item->j2}}</th>
<th>{{ $item->j3}}</th>
<th>{{ $item->j4}}</th>
<th>{{ $item->j5}}</th>
<th>{{ $item->j6}}</th>
<th>{{ $item->j7}}</th>
<th>{{ $item->j8}}</th>
<th>{{ $item->j9}}</th>
<th>{{ $item->j10}}</th>
<th>{{ $item->j11}}</th>
<th>{{ $item->j12}}</th>

            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_10}}</td>
<td class="text-center">{{ $item->M2_10}}</td>
<td class="text-center">{{ $item->Mc1_10}}</td>
<td class="text-center">{{ $item->Mc2_10}}</td>
<td class="text-center">{{ $item->T1_10}}</td>
<td class="text-center">{{ $item->T2_10}}</td>
<td class="text-center">{{ $item->T3_10}}</td>
<td class="text-center">{{ $item->T4_10}}</td>
<td class="text-center">{{ $item->Tc1_10}}</td>
<td class="text-center">{{ $item->Tc2_10}}</td>
<td class="text-center">{{ $item->Tc3_10}}</td>
<td class="text-center">{{ $item->Tc4_10}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 11: {{ $item->metode11 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p11 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->k1}}</th>
<th>{{ $item->k2}}</th>
<th>{{ $item->k3}}</th>
<th>{{ $item->k4}}</th>
<th>{{ $item->k5}}</th>
<th>{{ $item->k6}}</th>
<th>{{ $item->k7}}</th>
<th>{{ $item->k8}}</th>
<th>{{ $item->k9}}</th>
<th>{{ $item->k10}}</th>
<th>{{ $item->k11}}</th>
<th>{{ $item->k12}}</th>


            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_11}}</td>
<td class="text-center">{{ $item->M2_11}}</td>
<td class="text-center">{{ $item->Mc1_11}}</td>
<td class="text-center">{{ $item->Mc2_11}}</td>
<td class="text-center">{{ $item->T1_11}}</td>
<td class="text-center">{{ $item->T2_11}}</td>
<td class="text-center">{{ $item->T3_11}}</td>
<td class="text-center">{{ $item->T4_11}}</td>
<td class="text-center">{{ $item->Tc1_11}}</td>
<td class="text-center">{{ $item->Tc2_11}}</td>
<td class="text-center">{{ $item->Tc3_11}}</td>
<td class="text-center">{{ $item->Tc4_11}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 12: {{ $item->metode12 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p12 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->l1}}</th>
<th>{{ $item->l2}}</th>
<th>{{ $item->l3}}</th>
<th>{{ $item->l4}}</th>
<th>{{ $item->l5}}</th>
<th>{{ $item->l6}}</th>
<th>{{ $item->l7}}</th>
<th>{{ $item->l8}}</th>
<th>{{ $item->l9}}</th>
<th>{{ $item->l10}}</th>
<th>{{ $item->l11}}</th>
<th>{{ $item->l12}}</th>
            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_12}}</td>
<td class="text-center">{{ $item->M2_12}}</td>
<td class="text-center">{{ $item->Mc1_12}}</td>
<td class="text-center">{{ $item->Mc2_12}}</td>
<td class="text-center">{{ $item->T1_12}}</td>
<td class="text-center">{{ $item->T2_12}}</td>
<td class="text-center">{{ $item->T3_12}}</td>
<td class="text-center">{{ $item->T4_12}}</td>
<td class="text-center">{{ $item->Tc1_12}}</td>
<td class="text-center">{{ $item->Tc2_12}}</td>
<td class="text-center">{{ $item->Tc3_12}}</td>
<td class="text-center">{{ $item->Tc4_12}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 13: {{ $item->metode13 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p13 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->m1}}</th>
<th>{{ $item->m2}}</th>
<th>{{ $item->m3}}</th>
<th>{{ $item->m4}}</th>
<th>{{ $item->m5}}</th>
<th>{{ $item->m6}}</th>
<th>{{ $item->m7}}</th>
<th>{{ $item->m8}}</th>
<th>{{ $item->m9}}</th>
<th>{{ $item->m10}}</th>
<th>{{ $item->m11}}</th>
<th>{{ $item->m12}}</th>

            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_13}}</td>
<td class="text-center">{{ $item->M2_13}}</td>
<td class="text-center">{{ $item->Mc1_13}}</td>
<td class="text-center">{{ $item->Mc2_13}}</td>
<td class="text-center">{{ $item->T1_13}}</td>
<td class="text-center">{{ $item->T2_13}}</td>
<td class="text-center">{{ $item->T3_13}}</td>
<td class="text-center">{{ $item->T4_13}}</td>
<td class="text-center">{{ $item->Tc1_13}}</td>
<td class="text-center">{{ $item->Tc2_13}}</td>
<td class="text-center">{{ $item->Tc3_13}}</td>
<td class="text-center">{{ $item->Tc4_13}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="data" width="100%">
        <thead>
        @foreach ($emu as $item)
        <tr> <th>Inspeksi 14: {{ $item->metode14 }} </th> </tr>
        @endforeach 
        
        @foreach ($emu as $item)
        <tr> <th class="text-left">{{ $item->p14 }} </th> </tr>
        @endforeach
    </thead>
    </table>

    <table class="data" width="100%">
        <thead>           <tr>
@foreach ($emu as $item)
        <th>{{ $item->n1}}</th>
<th>{{ $item->n2}}</th>
<th>{{ $item->n3}}</th>
<th>{{ $item->n4}}</th>
<th>{{ $item->n5}}</th>
<th>{{ $item->n6}}</th>
<th>{{ $item->n7}}</th>
<th>{{ $item->n8}}</th>
<th>{{ $item->n9}}</th>
<th>{{ $item->n10}}</th>
<th>{{ $item->n11}}</th>
<th>{{ $item->n12}}</th>
            </tr>
            @endforeach
        </thead>
        <tbody>
            @foreach ($emu as $item)
                <tr>
                <td class="text-center">{{ $item->M1_14}}</td>
<td class="text-center">{{ $item->M2_14}}</td>
<td class="text-center">{{ $item->Mc1_14}}</td>
<td class="text-center">{{ $item->Mc2_14}}</td>
<td class="text-center">{{ $item->T1_14}}</td>
<td class="text-center">{{ $item->T2_14}}</td>
<td class="text-center">{{ $item->T3_14}}</td>
<td class="text-center">{{ $item->T4_14}}</td>
<td class="text-center">{{ $item->Tc1_14}}</td>
<td class="text-center">{{ $item->Tc2_14}}</td>
<td class="text-center">{{ $item->Tc3_14}}</td>
<td class="text-center">{{ $item->Tc4_14}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table width="100%">
    <tr>
        <td>*)Form Ini Dicetak Melalui PMO System</td>
        <td class="text-center">
            Inspector
            <br>
            <br>
            @foreach ($emu as $item)
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item->id_user, 'C39') }}" 
                    alt="{{ $item->id_user }}"
                    width="120"
                    height="40">
            @endforeach
            <br>
            <br>
            {{ auth()->user()->name }}
        </td>
        <td class="text-center">
            Manager
            <br>
            <br>
            @foreach ($emu as $item)
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item->id_users, 'C39') }}" 
                    alt="{{ $item->id_users }}"
                    width="120"
                    height="40">
            <br>
            <br>
            {{ $item->id_users }} {{ auth()->user()->name }}
            @endforeach
            <br>
        </td>
    </tr>
</table>

</body>
</html>