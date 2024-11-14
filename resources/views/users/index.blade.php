@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-gradient-trolling text-white">
            <h3 class="card-title">User List</h3>
            <a href="{{ route('users.showadd') }}" class="btn btn-success float-end">Add User</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('users.showedit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('users.delete', $user->id) }}" method="POST" class="d-inline">
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
