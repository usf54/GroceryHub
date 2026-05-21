@extends('driver.layout')

@section('title', 'Order Details')

@section('content')

<!-- HEADER CARD -->
<div class="card" style="margin-bottom:14px;">
    <h2 style="font-size:20px;font-weight:800;">Order #1025</h2>
    <p style="color:#6b7280;font-size:13px;margin-top:6px;">
        📍 Maarif, Casablanca
    </p>
</div>

<!-- CUSTOMER INFO -->
<div class="card" style="margin-bottom:14px;">
    <h4>Customer Info</h4>

    <p style="margin-top:8px;font-size:14px;">
        👤 Ahmed
    </p>

    <p style="font-size:14px;color:#6b7280;">
        📞 06XXXXXXXX
    </p>
</div>

<!-- PRODUCTS -->
<div class="card" style="margin-bottom:14px;">
    <h4>Products</h4>

    <div style="margin-top:10px;display:flex;flex-direction:column;gap:8px;">

        <div style="display:flex;justify-content:space-between;">
            <span>Milk x2</span>
            <span>20 MAD</span>
        </div>

        <div style="display:flex;justify-content:space-between;">
            <span>Bread x1</span>
            <span>5 MAD</span>
        </div>

        <div style="display:flex;justify-content:space-between;">
            <span>Apples x3</span>
            <span>15 MAD</span>
        </div>

    </div>
</div>

<!-- TOTAL -->
<div class="card" style="margin-bottom:14px;">
    <h4>Total</h4>
    <p style="font-size:22px;font-weight:800;margin-top:6px;">
        40 MAD
    </p>
</div>

<!-- ACTIONS -->
<div style="display:flex;gap:10px;">
    <button class="btn btn-light">Back</button>
    <button class="btn btn-primary">Start Delivery</button>
    <button class="btn" style="background:#22c55e;color:white;">Delivered</button>
</div>

@endsection