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
                <div class="card-body">
                    <i class="fa-solid fa-user"></i>
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">{{ $usersCount }}</p>
                </div>
            </div>
        </div>

        <!-- Total Products Card -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <i class="fas fa-cubes"></i>
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text">{{ $productsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Total Categories Card -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <i class="fas fa-list"></i>
                    <h5 class="card-title">Total Categories</h5>
                    <p class="card-text">{{ $categoriesCount }}</p>
                </div>
            </div>
        </div>

        <!-- Total Packs Card -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <h5 class="card-title">Total Packs</h5>
                    <p class="card-text">{{ $packsCount }}</p>
                </div>
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
</div>
@endsection