@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Products</h1>
    
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-4">Add New Product</a>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table id="products-table" class="table table-bordered table-striped bg-light">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if ($product->img)
                                <img src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 50px; height: 50px;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $product->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
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
            $('#products-table').DataTable({
                pageLength: 10,
                order: [[0, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [1, 9] } // Disable sorting on image and actions
                ]
            });
        });
    </script>
@endsection
