@php
use Fluent\Auth\Facades\Auth;

$user=Auth::user();
@endphp
@extends('app.layout',['bodyClass'=>'g-sidenav-show bg-gray-200'])

@section('content')
@include('app.navbar.sidebar',['activePage'=>'user'])

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg " style=" overflow-x:hidden;">
    <!-- Navbar -->
    @include('app.navbar.admin',['titlePage'=>'Admin'])
    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4 mb-5">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            <span class="mask  bg-gradient-success  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n12">

            <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-3">Edit Admin</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <form method='POST' action="{{ base_url('user/').$admin->id }} " enctype="multipart/form-data">
                        {!!csrf_field()!!}
                        <div class=" row">

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama</label>
                                <input type="text" name="username" class="form-control border border-2 p-2" value="{{$admin->username}}">
                                @error('username')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control border border-2 p-2" value="{{$admin->email}}">
                                @error('email')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control border border-2 p-2">
                                @error('password')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn bg-gradient-dark">Submit</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</main>
@endsection