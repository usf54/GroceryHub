@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Orders</h1>

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table id="orders-table" class="table table-bordered table-striped bg-light">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $order->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
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
            $('#orders-table').DataTable({
                pageLength: 10,
                order: [[0, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [6] } // Disable sorting on the "Actions" column
                ]
            });
        });
    </script>
@endsection
