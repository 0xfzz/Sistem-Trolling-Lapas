@extends('layout')
@section('content')
<div class="container d-flex justify-content-center align-items-center login-container" style="height: 100vh;">
    <div class="login-card">
        <div class="text-center mb-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="width: 25%">
        </div>
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST">
            @csrf
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-gradient-trolling border-0 text-white" id="basic-addon1"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-gradient-trolling border-0 text-white"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <span class="input-group-text bg-gradient-trolling border-0 text-white">
                        <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn bg-gradient-trolling w-full text-white">Masuk</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // toggle the eye slash icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    });
</script>
@endsection
