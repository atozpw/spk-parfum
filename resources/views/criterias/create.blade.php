@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kriteria</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Kriteria Baru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('criterias.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Kode</label>
                    <input type="text" name="code" class="form-control" placeholder="Ex: C1" required>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jenis</label>
                    <select name="attribute" class="form-control">
                        <option value="benefit" selected>Benefit</option>
                        <option value="cost">Cost</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bobot</label>
                    <input type="number" name="weight" class="form-control" step=".01" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('criterias.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
