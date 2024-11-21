@extends('layout')

@section('content')
<style>
        table {
            table-layout: fixed;
        }
        .nowrap {
            white-space: nowrap;
        }
        .half-width{
            width: 400px;
        }
        .petugas {
            width: 15%;
        }
        th{
            text-align: center;
            vertical-align:middle
        }
        th, td {
            font-size: 11px;
            padding: 2px !important;
        }
        .small-width {
            width: 60px;
        }
</style>
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
                            <label for="start_date" >Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_date">Tanggal Akhir</label>
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
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="small-width">No</th>
                            <th style="width: 120px">Waktu</th>
                            <th style="width: 100px">Lokasi</th>
                            <th style="width: 200px">Petugas</th>
                            <th style="width: 100px">Bagian</th>
                            <th class="small-width">Jumlah WBP</th>
                            <th class="half-width">Keadaan</th>
                            <th class="half-width">Inforting</th>
                            <th style="width: 200px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $index => $report)
                            <tr>
                                <td style="text-align: center">{{ $index + 1 }}</td>
                                <td class="nowrap">{{ \Carbon\Carbon::parse($report->created_at)->translatedFormat('d M Y H:i:s') }}</td>
                                <td>{{ $report->lokasi }}</td>
                                <td class="nowrap">{{ $report->nama_lengkap }}</td>
                                <td>{{ $report->tim }}</td>
                                <td>{{ $report->jumlah_hunian }}</td>
                                <td>{{ $report->kondisi_sarpras }}</td>
                                <td>{!! $report->keterangan !!}</td>
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
</div>
@endsection
