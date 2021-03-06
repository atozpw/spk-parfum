@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kriteria</h1>
    <p class="mb-4">Digunakan untuk menambah data kriteria, mengedit data kriteria, dan menghapus data kriteria.</p>

    @if(session('mess'))
        <div class="alert alert-success">
            {{ session('mess') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Kriteria</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 pb-2">
                    <a href="{{ route('criterias.create') }}" class="btn btn-primary">Tambah Baru</a>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('criterias.index') }}" method="GET">
                    <input type="text" name="q" class="form-control" placeholder="Cari Data" value="{{ old('q') }}"></form>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @forelse($criterias as $item)
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->attribute }}</td>
                            <td>{{ $item->weight }}</td>
                            <td width="200px">
                                <a href="{{ route('criterias.edit', [$item->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" onclick="confirmDelete({{$i}})" class="btn btn-sm btn-danger">Hapus</a>
                                <form id="form-delete{{$i}}" action="{{ route('criterias.destroy', [$item->id]) }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @empty
                        <tr>
                            <td colspan="5">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $criterias->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function confirmDelete(value){
            var alert = window.confirm("Yakin ingin dihapus?")
            if(alert) {
                event.preventDefault();
                document.getElementById('form-delete' + value).submit();
            }
            else {
                return true
            }
        }
    </script>
@endpush