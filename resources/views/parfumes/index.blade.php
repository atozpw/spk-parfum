@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Parfum</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    @if(session('mess'))
        <div class="alert alert-success">
            {{ session('mess') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Parfum</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 pb-2">
                    <a href="{{ route('parfumes.create') }}" class="btn btn-primary">Tambah Baru</a>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('parfumes.index') }}" method="GET">
                    <input type="text" name="q" class="form-control" placeholder="Cari Data" value="{{ old('q') }}"></form>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Merk / Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @forelse($parfumes as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td width="200px">
                                <a href="{{ route('parfumes.edit', [$item->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" onclick="confirmDelete({{$i}})" class="btn btn-sm btn-danger">Hapus</a>
                                <form id="form-delete{{$i}}" action="{{ route('parfumes.destroy', [$item->id]) }}" method="POST" style="display: none;">
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
                            <td colspan="2">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $parfumes->links() }}
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