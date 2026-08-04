<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>

        body{
            font-family: DejaVu Sans;
            font-size:11px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table,th,td{
            border:1px solid black;
        }

        th,td{
            padding:6px;
            text-align:center;
        }

        h2{
            text-align:center;
        }

    </style>

</head>




<table>

<thead>

<tr>

<th>No</th>
<th>Kelas</th>
<th>Total</th>
<th>Hari Efektif</th>
<th>Total Kehadiran</th>
<th>Hadir</th>
<th>Izin</th>
<th>Sakit</th>
<th>Alpha</th>
<th>%</th>

</tr>
<body>

<div style="text-align:center;">

    <img
        src="{{ public_path('images/logo-sekolah.jpg') }}"
        width="75">

</div>

<h2>SMP NEGERI 5 TAMBUN UTARA</h2>

<h3>Monitoring Rekap Absensi Bulanan</h3>

<hr>

<p>

<b>Bulan :</b> {{ $bulan }}<br>

<b>Tahun :</b> {{ $tahun }}<br>

<b>Tanggal Cetak :</b> {{ date('d-m-Y H:i') }}

</p>
</thead>

<tbody>

@foreach($rekapKelas as $i=>$row)

<tr>

<td>{{ $i+1 }}</td>

<td>{{ $row['kelas'] }}</td>

<td>{{ $row['total'] }}</td>

<td>{{ $row['hari_efektif'] }}</td>

<td>{{ $row['total_kehadiran'] }}</td>

<td>{{ $row['hadir'] }}</td>

<td>{{ $row['izin'] }}</td>

<td>{{ $row['sakit'] }}</td>

<td>{{ $row['alpha'] }}</td>

<td>{{ $row['persentase'] }}%</td>

</tr>

@endforeach

</tbody>

</table>

<br><br>

<h3>Ringkasan Rekap</h3>

<table>

<tr>

<td><b>Total Hadir</b></td>

<td>{{ collect($rekapKelas)->sum('hadir') }}</td>

</tr>

<tr>

<td><b>Total Izin</b></td>

<td>{{ collect($rekapKelas)->sum('izin') }}</td>

</tr>

<tr>

<td><b>Total Sakit</b></td>

<td>{{ collect($rekapKelas)->sum('sakit') }}</td>

</tr>

<tr>

<td><b>Total Alpha</b></td>

<td>{{ collect($rekapKelas)->sum('alpha') }}</td>

</tr>

</table>

<br><br><br>

<p style="text-align:right;">

Bekasi,

{{ date('d-m-Y') }}

</p>

<br><br>

<p style="text-align:right;">

Administrator

</p>

</body>
</html>