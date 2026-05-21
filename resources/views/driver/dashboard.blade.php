@extends('driver.layout')

@section('title', 'Dashboard')

@section('content')

<!-- HEADER -->
<div style="margin-bottom:18px;">
    <h1 style="font-size:26px;font-weight:900;letter-spacing:-0.5px;">
        Good afternoon 👋
    </h1>
    <p style="color:#6b7280;margin-top:6px;font-size:14px;">
        Here’s your delivery performance overview
    </p>
</div>

<!-- STATS GRID -->
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:22px;">

    <div class="card">
        <h4>Today’s Deliveries</h4>
        <p>5</p>
        <span style="font-size:12px;color:#6b7280;">+2 from yesterday</span>
    </div>

    <div class="card">
        <h4>Completed</h4>
        <p style="color:#22c55e;">3</p>
        <span style="font-size:12px;color:#6b7280;">Good performance</span>
    </div>

    <div class="card">
        <h4>Pending</h4>
        <p style="color:#ff9800;">2</p>
        <span style="font-size:12px;color:#6b7280;">Needs attention</span>
    </div>

</div>

<!-- QUICK ACTIONS -->
<div style="margin-bottom:18px;">
    <h3 style="font-size:16px;font-weight:800;margin-bottom:10px;">
        Quick Actions
    </h3>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">

        <button class="btn btn-primary">View Deliveries</button>
        <button class="btn btn-light">Refresh Orders</button>
        <button class="btn btn-light">Contact Support</button>

    </div>
</div>

<!-- ACTIVE DELIVERIES -->
<div>
    <h3 style="font-size:16px;font-weight:800;margin-bottom:12px;">
        Active Deliveries
    </h3>

    <div style="display:flex;flex-direction:column;gap:12px;">

        <div class="order">
            <div>
                <div class="order-title">Order #1025</div>
                <div class="order-sub">📍 Maarif, Casablanca</div>
            </div>

            <div style="text-align:right;">
                <div style="font-size:12px;color:#ff9800;font-weight:700;">
                    Assigned
                </div>
                <button class="btn btn-primary" style="margin-top:6px;">
                    Start
                </button>
            </div>
        </div>

        <div class="order">
            <div>
                <div class="order-title">Order #1026</div>
                <div class="order-sub">📍 Ain Diab</div>
            </div>

            <div style="text-align:right;">
                <div style="font-size:12px;color:#f59e0b;font-weight:700;">
                    In Progress
                </div>
                <button class="btn btn-light" style="margin-top:6px;">
                    View
                </button>
            </div>
        </div>

    </div>
</div>

@endsection