@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Parfum</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Parfum Baru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('parfumes.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>No</label>
                    <input type="text" name="number" class="form-control" placeholder="Isi dengan nomor parfum" required>
                </div>
                <div class="form-group">
                    <label>Merk / Jenis</label>
                    <input type="text" name="name" class="form-control" placeholder="Isi dengan merk atau jenis parfum" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('parfumes.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
