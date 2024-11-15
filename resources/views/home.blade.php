@extends('layout')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="row justify-content-center">
        @if (Auth::user()->role == 'admin')
            <div class="col-6 col-md-4 mb-4 d-flex justify-content-center text-center">
                <a href="{{ route('report-list') }}" class="d-flex flex-column justify-content-center align-items-center bg-gradient-trolling text-decoration-none" style="width: 150px; height: 150px;">
                    <img src="{{ asset('images/laporan.png') }}" alt="Laporan Icon" class="img-fluid" style="width: 50%; height: 50%;">
                    <span class="text-white">Laporan</span>
                </a>
            </div>
            <div class="col-6 col-md-4 mb-4 d-flex justify-content-center text-center">
                <a href="{{ route('users.index') }}" class="d-flex flex-column justify-content-center align-items-center bg-gradient-trolling text-decoration-none" style="width: 150px; height: 150px;">
                    <img src="{{ asset('images/user.png') }}" alt="Menajemen Akun Icon" class="img-fluid" style="width: 50%; height: 50%;">
                    <span class="text-white">Menajemen Akun</span>
                </a>
            </div>
            <div class="col-6 col-md-4 mb-4 d-flex justify-content-center text-center">
                <a href="{{ route('kelola-qr') }}" class="d-flex flex-column justify-content-center align-items-center bg-gradient-trolling text-decoration-none" style="width: 150px; height: 150px;">
                    <img src="{{ asset('images/qr.png') }}" alt="Menajemen Akun Icon" class="img-fluid" style="width: 50%; height: 50%;">
                    <span class="text-white">Kelola QR</span>
                </a>
            </div>
        @endif
        @if(Auth::user()->role == 'user' || Auth::user()->role == 'admin')
            <div class="col-6 col-md-4 mb-4 d-flex justify-content-center text-center">
                <a href="{{ route('kontrol-qr') }}" class="d-flex flex-column justify-content-center align-items-center bg-gradient-trolling text-decoration-none" style="width: 150px; height: 150px;">
                    <img src="{{ asset('images/scan.png') }}" alt="Kontrol Keliling Icon" class="img-fluid" style="width: 50%; height: 50%;">
                    <span class="text-white">Kontrol Keliling</span>
                </a>
            </div>
        @endif
        <div class="col-6 col-md-4 mb-4 d-flex justify-content-center text-center">
            <a href="{{ route('logout') }}" class="d-flex flex-column justify-content-center align-items-center bg-gradient-trolling text-decoration-none" style="width: 150px; height: 150px;">
                <img src="{{ asset('images/logout.png') }}" alt="Menajemen Akun Icon" class="img-fluid" style="width: 50%; height: 50%;">
                <span class="text-white">Logout</span>
            </a>
        </div>
    </div>
</div>
@endsection
