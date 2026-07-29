<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">

<style>

body{
    font-family: DejaVu Sans;
    font-size:12px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table,th,td{
    border:1px solid black;
}

th,td{
    padding:8px;
}

h2,h4{
    text-align:center;
}

</style>

</head>

<body>

<h2>SMP Negeri 5 Tambun Utara</h2>

<h4>Laporan Absensi</h4>

<p>

Tanggal :
{{ $request->tanggal }}

<br>

Shift :
{{ $request->shift }}

<br>

Kelas :
{{ $kelas->nama_kelas }}

</p>

<table>

<tr>

<th>No</th>
<th>NIS</th>
<th>Nama</th>
<th>Status</th>

</tr>

@foreach($absensi as $a)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $a->siswa->nis }}</td>

<td>{{ $a->siswa->nama }}</td>

<td>{{ $a->status }}</td>

</tr>

@endforeach

</table>

</body>
</html>