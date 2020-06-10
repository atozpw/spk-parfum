@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Data</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    @if(session('mess'))
        <div class="alert alert-success">
            {{ session('mess') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Masukkan Nilai Pada Setiap Kriteria</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('statistics.store') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Merk / Jenis</th>
                                @foreach($criterias as $item)
                                <th title="{{ $item->name }}">
                                    {{ $item->code }}
                                    @if ($item->attribute == 'benefit')
                                    (+)
                                    @else
                                    (-)
                                    @endif
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @forelse($parfumes as $r)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>
                                    {{ $r->name }}
                                    <input type="hidden" name="parfume_id[{{$i}}]" value="{{ $r->id }}">
                                </td>
                                @php
                                $j = 0;
                                @endphp
                                @foreach($criterias as $item)
                                <td>
                                    <input type="number" name="value[{{$i}}][{{$j}}]" class="form-control" value="{{ $item->getValue($r->id) }}" min="1" required>
                                    <input type="hidden" name="criteria_id[{{$i}}][{{$j}}]" value="{{ $item->id }}">
                                </td>
                                @php
                                $j++;
                                @endphp
                                @endforeach
                            </tr>
                            @php
                            $i++;
                            @endphp
                            @empty
                            <tr>
                                <td colspan="{{ count($criterias) + 2 }}">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>
@endsection
