@php
use Fluent\Auth\Facades\Auth;

$user=Auth::user();
@endphp
@extends('app.layout',['bodyClass'=>'g-sidenav-show bg-gray-200'])

@section('content')
@include('app.navbar.sidebar',['activePage'=>'dashboard'])

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg " style=" overflow-x:hidden;">
    <!-- Navbar -->
    @include('app.navbar.admin',['titlePage'=>'Dashboard'])
    <!-- End Navbar -->
    <div class="h4 font-weight-bold px-3 pt-3">Majukan pariwisata di Kabupaten Madiun</div>
    <div class="h4 font-weight-normal px-3">Selamat Datang <span class="font-weight-bold">{{$user->username}}</span></div>
    
    <img src="{{base_url('assets/img/kontruksi 1.png')}}" alt="" style="width:90vw; height: fit-content; block-size: fit-content; max-width:800; position:fixed; bottom:0; right:0;">
</main>
@endsection