@extends('layouts.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/packs.css') }}">
    <style>
        #indicators-carousel {
            margin-bottom : 40px;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.css" rel="stylesheet" />
@endpush
@section('title', 'Available Packs')
@section('content')
<div id="indicators-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
            <img src="{{ asset('assets/img/packs/packBanner1.jpg')}} " class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src=" {{asset('assets/img/packs/packBanner2.jpg')}} " class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('assets/img/packs/packBanner3.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
<div class="container">
    <h1 class="mb-4 fs-2">Available Packs</h1>
    <div class="row">
        @foreach ($packs as $pack)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm product-item">
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $pack->img) }}" class="tab-image img-fluid" alt="{{ $pack->name }}">
                        <h5 class="card-title">{{ $pack->name }}</h5>
                        <p class="card-text">{{ $pack->description ?? 'No description available.' }}</p>
                        <p><strong>Price:</strong> ${{ number_format($pack->price, 2) }}</p>
                        <p><strong>Stock:</strong> {{ $pack->stock }}</p>
                        <p><strong>Category:</strong> {{ $pack->category->name ?? 'Uncategorized' }}</p>
                        <h6>Products in this Pack:</h6>
                        <ul class="list-unstyled">
                            @foreach ($pack->products as $product)
                                <li>{{ $product->name }}</li>
                            @endforeach
                        </ul>
                        <form action="{{ route('order.add', ['type' => 'pack', 'id' => $pack->id]) }}" method="POST" class="mt-4">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" max="{{ $pack->stock }}" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary w-100 mb-2">Order Now</button>
                        </form>
                        <a href=" {{ route('packs.show', $pack->id) }} " class="btn btn-warning w-100">Show Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 
@push('js')
<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
@endpush