@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Generate QR Code</h2>
            <!-- Form untuk menghasilkan QR code -->
            <form action="{{ route('add.qr') }}" method="POST">
                @csrf
                <div class="form-group">
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
                        <td><img src="{{ $qrcode->image }}" alt="QR Code"></td>
                        <td>
                            <!-- Tambahkan aksi pengelolaan QR code di sini -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
