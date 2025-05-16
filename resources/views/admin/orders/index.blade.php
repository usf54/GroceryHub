@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Manage Orders</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Final Total</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <!-- Main Order Row -->
                    <tr onclick="toggleOrderDetails({{ $order->id }})" style="cursor: pointer;">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                        <td>
                            <span class="badge 
                                @if($order->status == 'pending') bg-warning text-dark
                                @elseif($order->status == 'completed') bg-success
                                @elseif($order->status == 'shipped') bg-info text-dark
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ number_format($order->final_total, 2) }}mad</td>
                        <td>
                            @if($order->order_date instanceof \DateTime)
                                {{ $order->order_date->format('Y-m-d') }}
                            @else
                                {{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="event.stopPropagation(); return confirm('Delete this order?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Order Details Row (hidden by default) -->
                    <tr id="order-details-{{ $order->id }}" style="display: none;">
                        <td colspan="6" class="bg-light p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><i class="fas fa-boxes"></i> Order Contents</h5>
                                    
                                    <div class="mb-4">
                                        <h6><i class="fas fa-shopping-basket"></i> Individual Products</h6>
                                        @if($order->orderDetails->count() > 0)
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderDetails as $detail)
                                                        @if ($detail->product)
                                                            <tr>
                                                                <td>{{ $detail->product->name }}</td>
                                                                <td>{{ $detail->quantity }}</td>
                                                                <td>{{ number_format($detail->product->price, 2) }}mad</td>
                                                                <td>{{ number_format($detail->subtotal, 2) }}mad</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-muted">No individual products</p>
                                        @endif
                                    </div>

                                    <div>
                                        <h6><i class="fas fa-box-open"></i> Product Packs</h6>
                                        @if($order->orderPackDetails->count() > 0)
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Pack</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderPackDetails as $packDetail)
                                                        @if ($packDetail->pack)
                                                            <tr>
                                                                <td>
                                                                    <strong>{{ $packDetail->pack->name }}</strong>
                                                                    <button class="btn btn-sm btn-link p-0 ms-2" type="button" onclick="event.stopPropagation(); togglePackContents({{ $packDetail->id }})">
                                                                        <i class="fas fa-chevron-down"></i> Contents
                                                                    </button>
                                                                    <div id="pack-contents-{{ $packDetail->id }}" style="display: none;" class="mt-2 ps-3">
                                                                        <ul class="list-unstyled small">
                                                                            @foreach ($packDetail->pack->products as $product)
                                                                                <li>• {{ $product->name }} ({{ $product->pivot->quantity }}x)</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $packDetail->quantity }}</td>
                                                                <td>{{ number_format($packDetail->pack->price, 2) }}mad</td>
                                                                <td>{{ number_format($packDetail->subtotal, 2) }}mad</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-muted">No product packs</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h5><i class="fas fa-receipt"></i> Order Summary</h5>
                                    
                                    <div class="mb-3">
                                        <h6><i class="fas fa-user"></i> Customer Info</h6>
                                        <p><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}<br>
                                        <strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}<br>
                                        <strong>Phone:</strong> {{ $order->phone }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6><i class="fas fa-truck"></i> Shipping Info</h6>
                                        <p>
                                            <strong>Address:</strong> {{ $order->address }}<br>
                                            <strong>City:</strong> {{ $order->city }}<br>
                                            <strong>Postal Code:</strong> {{ $order->postal_code ?? 'N/A' }}
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <h6><i class="fas fa-money-bill-wave"></i> Payment Summary</h6>
                                        <table class="table table-sm">
                                            <tr>
                                                <td>Subtotal:</td>
                                                <td class="text-end">{{ number_format($order->total, 2) }}mad</td>
                                            </tr>
                                            <tr>
                                                <td>Discount:</td>
                                                <td class="text-end">-{{ number_format($order->discount, 2) }}mad</td>
                                            </tr>
                                            <tr>
                                                <td>Shipping:</td>
                                                <td class="text-end">{{ number_format($order->shipping, 2) }}mad</td>
                                            </tr>
                                            <tr class="table-active">
                                                <td><strong>Total:</strong></td>
                                                <td class="text-end"><strong>{{ number_format($order->final_total, 2) }}mad</strong></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div>
                                        <h6><i class="fas fa-clock"></i> Timestamps</h6>
                                        <p>
                                            <strong>Order Placed:</strong> 
                                            @if($order->created_at instanceof \DateTime)
                                                {{ $order->created_at->format('Y-m-d H:i') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}
                                            @endif
                                            <br>
                                            <strong>Last Updated:</strong> 
                                            @if($order->updated_at instanceof \DateTime)
                                                {{ $order->updated_at->format('Y-m-d H:i') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($order->updated_at)->format('Y-m-d H:i') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Simple Pagination -->
        <div class="d-flex justify-content-center mt-4">
           
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
    function toggleOrderDetails(orderId) {
        const detailsRow = document.getElementById(`order-details-${orderId}`);
        if (detailsRow.style.display === 'none') {
            detailsRow.style.display = 'table-row';
        } else {
            detailsRow.style.display = 'none';
            // Also hide any open pack contents when closing order details
            document.querySelectorAll(`#order-details-${orderId} [id^="pack-contents-"]`).forEach(el => {
                el.style.display = 'none';
            });
        }
    }

    function togglePackContents(packDetailId) {
        const contents = document.getElementById(`pack-contents-${packDetailId}`);
        const button = contents.previousElementSibling;
        
        if (contents.style.display === 'none') {
            contents.style.display = 'block';
            button.innerHTML = '<i class="fas fa-chevron-up"></i> Contents';
        } else {
            contents.style.display = 'none';
            button.innerHTML = '<i class="fas fa-chevron-down"></i> Contents';
        }
    }
</script>

<style>
    tr[onclick]:hover {
        background-color: #f8f9fa;
    }
    .table-sm td, .table-sm th {
        padding: 0.3rem;
    }
</style>
@endsection