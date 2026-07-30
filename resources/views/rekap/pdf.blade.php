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

<body>

<h2>Rekap Absensi Bulanan</h2>

<p>
Bulan : {{ $bulan }} <br>
Tahun : {{ $tahun }}
</p>

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

</body>
</html>