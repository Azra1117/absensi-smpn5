@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@extends('layouts.admin')

@section('content')

<div class="container">

    <h3>Import Data Siswa</h3>

    <form action="{{ route('import.siswa.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label>File Excel</label>

            <input type="file"
                   name="file"
                   class="form-control"
                   accept=".xlsx,.xls"
                   required>
        </div>

        <button class="btn btn-primary">
            Import
        </button>

    </form>

</div>

@endsection