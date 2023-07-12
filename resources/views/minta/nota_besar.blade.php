<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Jalan PDF</title>

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
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td rowspan="3" width="50%">
                <img src="{{ public_path($setting->path_logo2) }}" alt="{{ $setting->path_logo2 }}" width="120">
                <br>
                {{ $setting->alamat }}
                <br>
                <br>
            </td>
            <td>Tanggal Terbit</td>
            <td>: {{ tanggal_indonesia(date('Y-m-d')) }}</td>
        </tr>
        <tr>
            <td>Penanggung Jawab</td>
            <td>: {{ $barang->member->bagian ?? '' }}</td>
        </tr>
    </table>

    <table width="100%">
        <thead>
            <tr>
                <th><b> <font size=5>SURAT JALAN</b></th>
            <tr>
            <tr>
                <th><b> <font size=3>No Surat: {{ $barang->surat }} </b></th>
            <tr>
        </thead>
    </table>
    <br>

    <table class="data" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Material</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $key => $item)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $item->produk->kode_material }}</td>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td class="text-center">{{ format_uang($item->jumlah) }}</td>
                    <td class="text-center">{{ $item->produk->satuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table width="100%">
        <tr>
            <td>*)Form Ini Dicetak Melalui Project Control System</td>
            <td class="text-center">
                PIC Penanggung Jawab
                <br>
                <br>
                <br>
                <br>
                {{ auth()->user()->name }}
            </td>
        </tr>
    </table>
</body>
</html>