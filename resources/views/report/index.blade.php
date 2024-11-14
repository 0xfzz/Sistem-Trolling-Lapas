@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-gradient-trolling text-white">
            <h3 class="card-title">Daftar Laporan</h3>
        </div>
        <div class="card-body">
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
                <button type="submit" class="btn btn-secondary">Cetak Laporan</button>
            </form>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Petugas</th>
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
                            <td>{{ $report->nama_lengkap }}</td>
                            <td>{{ $report->kondisi_sarpras }}</td>
                            <td>{{ $report->jumlah_hunian }}</td>
                            <td>{{ $report->keterangan }}</td>
                            <td>{{ $report->created_at }}</td>
                            <td>
                                <form action="{{ route('delete-report', $report->id) }}" method="POST" class="d-inline">
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
    </div>
</div>
@endsection
