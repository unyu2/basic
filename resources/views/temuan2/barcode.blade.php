<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DAFTAR TEMUAN</title>

    <style>
        table td {
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 13px;
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
        }
    </style>

</head>
<body>

    <table width="100%">
        <thead>
            <tr>
                <th><b> <font size=4>Daftar Temuan</b></th>
            <tr>
        </thead>
    </table>

    <br> 
    <br>
@foreach ($datatemuan as $item)
    <table class="data" width="100%">
        <thead>            <tr> 
<th class="text-left">Proyek : {{$item->proyek->nama_proyek }} </th>
<th class="text-left">Status : {{ $item->status }} </th>
<th class="text-left">Tanggal Temuan : {{ $item->created_at }} </th>
<th class="text-left">Kode : {{ $item->kode_temuan }} </th>
            </tr>
    </table>
    <table class="data" width="100%">
        <thead>           <tr>
<th>Temuan</th>
<th>Penyelesaian</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td class="text-left">{{ $item->nama_temuan }}</td>
                    <td class="text-left">{{ $item->penyelesaian }}</td>
                </tr>
        </tbody>
    </table>
    @endforeach

    <table width="100%">
        <tr>
            <td>*)Form Ini Dicetak Melalui PMO System</td>
            <td class="text-center">
                Manager
                <br>
                <br>
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item->id_users, 'C39') }}" 
                        alt="{{ $item->id_users }}"
                        width="120"
                        height="40">
                <br>
                <br>
                 {{ auth()->user()->name }}
                <br>
                

            </td>
        </tr>
    </table>
</body>
</html>