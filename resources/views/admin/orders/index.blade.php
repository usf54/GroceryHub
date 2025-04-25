@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Manage Orders</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table id="orders-table" class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Final Total</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <!-- Main Order Row -->
                    <tr data-bs-toggle="collapse" data-bs-target="#order-details-{{ $order->id }}" class="accordion-toggle">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>${{ number_format($order->final_total, 2) }}</td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Expandable Order Detail Row -->
                    <tr class="collapse" id="order-details-{{ $order->id }}">
                        <td colspan="6" class="bg-light">
                            <div class="p-3">
                                <div class="row">
                                    <!-- Products Section -->
                                    <div class="col-md-6">
                                        <h5>🛒 Products</h5>
                                        <ul>
                                            @foreach ($order->orderDetails as $detail)
                                                @if ($detail->product)
                                                    <li>{{ $detail->product->name }} × {{ $detail->quantity }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- Packs Section -->
                                    <div class="col-md-6">
                                        <h5>📦 Packs</h5>
                                        <ul>
                                            @foreach ($order->orderDetails as $detail)
                                                @if ($detail->pack)
                                                    <li>
                                                        <strong>{{ $detail->pack->name }}</strong> × {{ $detail->quantity }}
                                                        <ul>
                                                            @foreach ($detail->pack->products as $product)
                                                                <li>• {{ $product->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-4"><strong>Address:</strong> {{ $order->address }}</div>
                                    <div class="col-md-4"><strong>City:</strong> {{ $order->city }}</div>
                                    <div class="col-md-4"><strong>Phone:</strong> {{ $order->phone }}</div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-3"><strong>Total:</strong> ${{ $order->total }}</div>
                                    <div class="col-md-3"><strong>Discount:</strong> ${{ $order->discount }}</div>
                                    <div class="col-md-3"><strong>Shipping:</strong> ${{ $order->shipping }}</div>
                                    <div class="col-md-3"><strong>Final Total:</strong> ${{ $order->final_total }}</div>
                                </div>

                                <div class="mt-3">
                                    <strong>Updated At:</strong> {{ $order->updated_at->format('Y-m-d H:i') }}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables & Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function () {
        $('#orders-table').DataTable({
            pageLength: 10,
            order: [[0, 'desc']],
            columnDefs: [
                { orderable: false, targets: [5] } // Actions column
            ],
            rowCallback: function (row, data, index) {
                // Skip rows with collapse class (the details rows)
                if ($(row).hasClass('collapse')) {
                    $(row).hide(); // optionally hide if DataTables tries to show
                    return;
                }
            }
        });
    });
</script>


<!-- Bootstrap Collapse Support -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
