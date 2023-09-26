<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Design</title>

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
        .text-center-isi {
            text-align: left;
            font-size: 13px;
            font-style:italic;
        }
        .text-right {
            text-align: right;
        }
        .text-left-isi {
            text-align: left;
            font-size: 13px;
        }
    </style>

</head>
<body>

    <table width="100%">
        <thead>
            <tr>
                <th><b> <font size=4>DRAWING LIST DATA</b></th>
            <tr>
        <tr>
                <th><b>
                <font size="1">Dicetak Oleh: {{ auth()->user()->name }} | Tanggal: {{ now()->format('d F Y') }}</font>
                </b></th>
            <tr>
        </thead>
    </table>
    <br>

    <table class="data" width="100%">
        <thead>           <tr>
<th>Proyek</th>
<th>No Dwg</th>
<th>Nama Dwg</th>
<th>Konfigurasi</th>
<th>Revisi</th>
<th>Status</th>
<th>Check</th>
<th>Draft</th>
<th>Approve</th>

            </tr>
        </thead>
        <tbody>
        @foreach ($datadesign as $index => $design)
    <tr>
        <td class="text-left">{{ $design->proyek->nama_proyek }}</td>
        <td class="text-left">{{ $design->kode_design }}</td>
        <td class="text-left">{{ $design->nama_design }}</td>
        <td class="text-center-isi">{{ $design->konfigurasi }}</td>
        <td class="text-center-isi">{{ $design->revisi }}</td>
        <td class="text-center-isi">{{ $design->status }}</td>
        <td class="text-center-isi">{{ $design->draft_user_name }}</td>
        <td class="text-center-isi">{{ $design->check_user_name }}</td>
        <td class="text-center-isi">{{ $design->approve_user_name }}</td>
    </tr>
@endforeach
</tbody>
    </table>

</body>
</html>