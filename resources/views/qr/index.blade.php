@extends('layout')

@section('css')
<style>
    .container {
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-gradient-trolling text-white">
            <h3 class="card-title">Generate QR Code</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <!-- Form untuk menghasilkan QR code -->
                    <form action="{{ route('create-qr') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="data">Lokasi:</label>
                            <input type="text" name="lokasi" class="form-control" placeholder="Masukkan Lokasi">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </form>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h3 class="card-title">Kelola QR Code</h3>
                    <!-- Tabel untuk mengelola QR code -->
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Lokasi</th>
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
                                    <a href="https://api.qrserver.com/v1/create-qr-code/?size=512x512&data={{ $qrcode->id }}" download="qrcode_{{ $qrcode->id }}.png" class="btn btn-success btn-sm">Download</a>
                                    <form action="{{ route('delete-qr', $qrcode->id) }}" method="POST" class="d-inline">
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
</div>
@endsection
