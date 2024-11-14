@extends('layout')
@section('css')
<style>
    .container {
        color: white;
        margin-top: 20px;
    }
    .form-group label {
        color: white;
    }
    .table th, .table td {
        color: black;
    }
    .table th {
        border-bottom: 2px solid white;
    }
    .table td {
        border-top: 1px solid white;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mb-4">
            <h2>Generate QR Code</h2>
            <!-- Form untuk menghasilkan QR code -->
            <form action="{{ route('create-qr') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="data">Lokasi:</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Masukkan data">
                </div>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </form>
        </div>
        <div class="col-md-6">
            <h2>Kelola QR Code</h2>
            <!-- Tabel untuk mengelola QR code -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>QR Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($qrcodes as $qrcode)
                    <tr>
                        <td>{{ $qrcode->lokasi }}</td>
                        <td><img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $qrcode->id }}" /></td>
                        <td>
                            <a href="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $qrcode->id }}" download="qrcode_{{ $qrcode->id }}.png" class="btn btn-success">Download</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
