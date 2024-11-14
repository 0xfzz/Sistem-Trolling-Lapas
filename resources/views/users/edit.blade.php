@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-gradient-trolling text-white">
            <h3>Edit User</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div cass="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif
            <form action="{{ url('users/' . $user->id . '/edit') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                </div>
                <div class="mb-3">
                    <label for="tim" class="form-label">Tim</label>
                    <input type="text" class="form-control" id="tim" name="tim" value="{{ $user->tim }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="form-text text-muted">Leave blank if you don't want to change the password</small>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>
@endsection
