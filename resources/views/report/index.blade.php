@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-white">Daftar Laporan</h1>

    <form action="{{ route('report-list') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="start_date" class="text-white">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end_date" class="text-white">Tanggal Akhir</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <form action="{{ route('download-report') }}" method="POST" class="mb-4">
        @csrf
        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
        <button type="submit" class="btn btn-secondary">Download Filtered Report</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Kondisi Sarpras</th>
                <th>Jumlah Hunian</th>
                <th>Keterangan</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->user_id }}</td>
                    <td>{{ $report->kondisi_sarpras }}</td>
                    <td>{{ $report->jumlah_hunian }}</td>
                    <td>{{ $report->keterangan }}</td>
                    <td>{{ $report->created_at }}</td>
                    <td>
                        <form action="{{ route('delete-report', $report->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
