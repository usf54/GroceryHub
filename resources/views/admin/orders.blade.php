@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Manage Orders</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>${{ $order->total }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}">View</a> |
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit">Mark as Completed</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
