@extends('driver.layout')

@section('title', 'My Deliveries')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
    <div>
        <h2 style="font-size:20px;font-weight:800;">My Deliveries</h2>
        <p style="color:#6b7280;font-size:13px;">Manage your assigned orders</p>
    </div>
</div>

<!-- FILTERS -->
<div style="display:flex;gap:10px;margin-bottom:18px;">
    <button class="btn btn-light">All</button>
    <button class="btn btn-light">Assigned</button>
    <button class="btn btn-light">In Progress</button>
    <button class="btn btn-light">Delivered</button>
</div>

<!-- ORDERS -->
<div style="display:flex;flex-direction:column;gap:12px;">

    <div class="order">
        <div>
            <div class="order-title">Order #1025</div>
            <div class="order-sub">📍 Maarif, Casablanca</div>
        </div>

        <div style="display:flex;gap:8px;">
            <button class="btn btn-light">View</button>
            <button class="btn btn-primary">Start</button>
        </div>
    </div>

    <div class="order">
        <div>
            <div class="order-title">Order #1026</div>
            <div class="order-sub">📍 Ain Diab</div>
        </div>

        <div style="display:flex;gap:8px;">
            <button class="btn btn-light">View</button>
            <button class="btn btn-primary">Delivered</button>
        </div>
    </div>

</div>

@endsection