@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="admin-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <h2>Admin Panel</h2>
        </div>
        <ul class="menu">
            <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="#"><i class="fas fa-shopping-cart"></i> Orders</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="admin-header">
            <div class="header-left">
                <h2>Dashboard</h2>
            </div>
            <div class="header-right">
                <i class="fas fa-user-circle"></i> Admin
            </div>
        </header>

        <!-- Statistics -->
        <section class="dashboard-stats">
            <div class="card">
                <i class="fas fa-box"></i>
                <h3>150</h3>
                <p>Products</p>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <h3>245</h3>
                <p>Users</p>
            </div>
            <div class="card">
                <i class="fas fa-shopping-cart"></i>
                <h3>89</h3>
                <p>Orders</p>
            </div>
            <div class="card">
                <i class="fas fa-dollar-sign"></i>
                <h3>$12,540</h3>
                <p>Revenue</p>
            </div>
        </section>

        <!-- Graphs -->
        <section class="dashboard-graphs">
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="usersChart"></canvas>
            </div>
        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Sales Data
    var salesCtx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Monthly Sales',
                data: [500, 700, 900, 1100, 1500, 1700],
                backgroundColor: 'rgba(255, 152, 0, 0.2)',
                borderColor: '#FF9800',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Users Growth
    var usersCtx = document.getElementById('usersChart').getContext('2d');
    var usersChart = new Chart(usersCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'New Users',
                data: [50, 80, 120, 200, 250, 300],
                backgroundColor: '#FF9800'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
</script>
@endsection
