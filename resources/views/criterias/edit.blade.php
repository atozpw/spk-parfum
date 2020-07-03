@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kriteria</h1>
    <p class="mb-4">Digunakan untuk menambah data kriteria, mengedit data kriteria, dan menghapus data kriteria.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Kriteria Baru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('criterias.update', [$criteria->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Kode</label>
                    <input type="text" name="code" value="{{ $criteria->code }}" class="form-control" placeholder="Ex: C1" required>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ $criteria->name }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jenis</label>
                    <select name="attribute" class="form-control">
                        <option value="benefit" @if($criteria->attribute == 'benefit') selected @endif>Benefit</option>
                        <option value="cost" @if($criteria->attribute == 'cost') selected @endif>Cost</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bobot</label>
                    <input type="number" name="weight" value="{{ $criteria->weight }}" class="form-control" step=".01" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('criterias.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
