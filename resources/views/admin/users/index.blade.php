@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Users</h1>

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-4">Add New User</a>

    <div class="table-responsive">
        <table id="users-table" class="table table-bordered table-striped bg-light">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address ?? 'N/A' }}</td>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $user->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                pageLength: 10,
                order: [[0, 'desc']],
            });
        });
    </script>

</div>
@endsection