@extends('layouts.master')
@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/hero.css') }}">
@endpush
@section('content')
<div class="pictures-container">
  <div class="left-pic">
    <img src="{{asset('assets/img/hero1.webp')}}" alt="hero img">
  </div>
  <div class="right-pic">
    <div class="top-pic">
      <img src="{{asset('assets/img/hero2.jpg')}}" alt="hero img">
    </div>
    <div class="bottom-pic">
      <img src="{{asset('assets/img/hero3.jpg')}}" alt="hero img">
    </div>
  </div>
</div>
@endsection