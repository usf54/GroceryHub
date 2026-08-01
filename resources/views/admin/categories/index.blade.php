@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Categories</h1>

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-4">Add New Category</a>

    <div class="table-responsive">
        <table id="categories-table" class="table table-bordered table-striped bg-light">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <!-- 🧪 DEMO MODE - For testing only -->
                    @php
                    $imageParts = explode('-', $category->image);
                    $imageUrl = ($imageParts[0] === 'demo') 
                        ? asset('assets/img/demo/categories/' . $category->image) 
                        : asset('storage/' . $category->image);
                    @endphp
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            @if ($category->image)
                                <img src="{{ $imageUrl }}" alt="{{ $category->name }}" class="img-thumbnail" style="width: 100px; height: 100px;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $category->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    <!-- Include jQuery and DataTables scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function () {
            $('#categories-table').DataTable({
                pageLength: 10,
                order: [[0, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [4] } // Disable sorting on Actions column
                ]
            });
        });
    </script>
@endsection
