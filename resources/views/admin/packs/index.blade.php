@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Packs</h1>

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.packs.create') }}" class="btn btn-primary mb-4">Add New Pack</a>

    <div class="table-responsive">
        <table id="packs-table" class="table table-bordered table-striped bg-light">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Products</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($packs as $pack)
                    <tr>
                        <td>{{ $pack->id }}</td>
                        <td>{{ $pack->name }}</td>
                        <td>
                            @if ($pack->img)
                                <img src="{{ asset('storage/' . $pack->img) }}" alt="{{ $pack->name }}" class="img-thumbnail" style="width: 50px; height: 50px;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>

                        <td>{{ $pack->description ?? 'N/A' }}</td>
                        <td>
                            @foreach ($pack->products as $product)
                                <span class="badge badge-info text-dark">{{ $product->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ number_format($pack->price, 2) }} mad</td>
                        <td>{{ $pack->stock }}</td>
                        <td>{{ $pack->category->name ?? 'N/A' }}</td>
                        <td>{{ $pack->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $pack->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('admin.packs.edit', $pack) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.packs.destroy', $pack) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this pack?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    <!-- DataTables and jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function () {
            $('#packs-table').DataTable({
                pageLength: 10,
                order: [[0, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [3, 9] } // Disable sorting on Products and Actions
                ]
            });
        });
    </script>
@endsection
