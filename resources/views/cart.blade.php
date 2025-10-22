@extends('layouts.master')
@section('title','Cart | GroceryHub')
@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>Shopping Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Remove product</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $item)
                    @php $total += $item['subtotal']; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price'], 2) }}mad</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['subtotal'], 2) }}mad</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: {{ number_format($total, 2) }}mad</h4>

        <form action=" {{ route('checkout.form' )}} " method="GET" class='py-4'>
            @csrf
            <button type="submit" class="btn btn-success">Proceed to Checkout</button>
        </form>
    @else
        <div class='my-5'>
            <p>Your cart is empty.</p>
            <a href="{{ route('products.list') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection
