@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-4">Input Ketidakhadiran Siswa</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="stat-card">
        <div class="card-body">

            <form action="{{ route('absensi.store') }}" method="POST">

                @csrf

                <input type="hidden" name="kelas_id" id="kelas_id">

                <div class="row mb-4">

                    <div class="col-md-4">

                        <label>Tanggal</label>

                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            class="form-control"
                            value="{{ date('Y-m-d') }}">

                    </div>

                    <div class="col-md-4">

                        <label>Shift</label>

                        <select
                            name="shift"
                            id="shift"
                            class="form-control">

                            <option value="Pagi">Pagi</option>
                            <option value="Siang">Siang</option>

                        </select>

                    </div>

                    <div class="col-md-4">

                        <label>Kelas</label>

                        <select
                            id="kelas"
                            class="form-control">

                            <option value="">-- Pilih Kelas --</option>

                            @foreach($kelas as $k)

                                <option value="{{ $k->id }}">
                                    {{ $k->nama_kelas }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th width="60">No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th width="200">Status</th>

                        </tr>

                    </thead>

                    <tbody id="dataSiswa">

                        <tr>

                            <td colspan="4" class="text-center">

                                Pilih kelas terlebih dahulu

                            </td>

                        </tr>

                    </tbody>

                </table>

                <button class="btn btn-primary">
                    Simpan Absensi
                </button>

            </form>

        </div>
    </div>

</div>

<script>

function loadData(){

    let tanggal = document.getElementById('tanggal').value;
    let shift = document.getElementById('shift').value;
    let kelas = document.getElementById('kelas').value;

    document.getElementById('kelas_id').value = kelas;

    if(kelas==""){

        document.getElementById('dataSiswa').innerHTML=
        '<tr><td colspan="4" align="center">Pilih kelas terlebih dahulu</td></tr>';

        return;
    }

    Promise.all([

        fetch('/absensi/siswa/'+kelas).then(res=>res.json()),

        fetch('/absensi/data/'+tanggal+'/'+shift+'/'+kelas).then(res=>res.json())

    ])

    .then(([siswa,absensi])=>{

        let html="";
        let no=1;

        siswa.forEach(function(item){

            let status="Hadir";

            if(absensi[item.id]){

                status=absensi[item.id].status;

            }

            html+=`

            <tr>

                <td>${no++}</td>

                <td>${item.nis}</td>

                <td>${item.nama}</td>

                <td>

                    <select
                        name="status[${item.id}]"
                        class="form-control">

                        <option value="Hadir" ${status=="Hadir"?"selected":""}>Hadir</option>

                        <option value="Sakit" ${status=="Sakit"?"selected":""}>Sakit</option>

                        <option value="Izin" ${status=="Izin"?"selected":""}>Izin</option>

                        <option value="Alpha" ${status=="Alpha"?"selected":""}>Alpha</option>

                    </select>

                </td>

            </tr>

            `;

        });

        document.getElementById('dataSiswa').innerHTML=html;

    });

}

document.getElementById('kelas').addEventListener('change',loadData);

document.getElementById('tanggal').addEventListener('change',loadData);

document.getElementById('shift').addEventListener('change',loadData);

</script>

@endsection