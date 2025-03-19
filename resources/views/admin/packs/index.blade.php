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
        <table class="table table-bordered table-striped bg-light">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
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
                        <td>{{ $pack->description ?? 'N/A' }}</td>
                        <td>
                            @foreach ($pack->products as $product)
                                <span class="badge badge-info text-dark">{{ $product->name }} | </span>
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
@endsection