@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Welcome, Admin!</h1>
    <p class="mb-4">Manage users, products, and more...</p>

    <!-- Cards Section -->
    <div class="row">
        <!-- Total Users Card -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card text-white bg-primary">
                <a href="{{ route('admin.users.index') }}" style=" text-decoration:none;color: white; ">
                    <div class="card-body">
                        <i class="fa-solid fa-user"></i>
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text">{{ $usersCount }}</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Total Products Card -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card text-white bg-success">
                <a href="{{ route('admin.products.index') }}" style=" text-decoration:none;color: white; ">
                    <div class="card-body">
                        <i class="fas fa-cubes"></i>
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text">{{ $productsCount }}</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Total Categories Card -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card text-white bg-danger">
                <a href="{{ route('admin.categories.index') }}" style=" text-decoration:none;color: white; ">
                    <div class="card-body">
                        <i class="fas fa-list"></i>
                        <h5 class="card-title">Total Categories</h5>
                        <p class="card-text">{{ $categoriesCount }}</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Total Packs Card -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card text-white bg-warning">
                <a href="{{ route('admin.packs.index') }}" style=" text-decoration:none;color: white; ">
                    <div class="card-body">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <h5 class="card-title">Total Packs</h5>
                        <p class="card-text">{{ $packsCount }}</p>
                    </div>
                </a>        
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card text-white bg-dark">
                <a href="{{ route('admin.orders.index') }}" style=" text-decoration:none;color: white; ">
                    <div class="card-body">
                        <i class="fa-solid fa-credit-card"></i>
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text">{{ $ordersCount }}</p>
                    </div>
                </a>    
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="row mt-5">
        <!-- Recent Users -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Recent Users</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Registered At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentUsers as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Products -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Recent Products</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentProducts as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Orders -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Recent Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>Total</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ $order->total }} mad</td>
                                        <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
<!-- Charts Section -->
<div class="row mt-5">
            <!-- User Registrations Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">User Registrations Over Time</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="userRegistrationsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Product Stock Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Product Stock Levels</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="productStockChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        // User Registrations Chart (Line Chart)
        const userRegistrationsCtx = document.getElementById('userRegistrationsChart').getContext('2d');
        const userRegistrationsChart = new Chart(userRegistrationsCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($userRegistrations->pluck('date')) !!},
                datasets: [{
                    label: 'User Registrations',
                    data: {!! json_encode($userRegistrations->pluck('count')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Product Stock Chart (Bar Chart)
        const productStockCtx = document.getElementById('productStockChart').getContext('2d');
        const productStockChart = new Chart(productStockCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($productStocks->pluck('name')) !!},
                datasets: [{
                    label: 'Stock',
                    data: {!! json_encode($productStocks->pluck('stock')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    </div>

</div>
@endsection