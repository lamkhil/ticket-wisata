@extends('app.layout')
@push('style')
<style>
    body {
        background-color: #378967;
    }

    .title-user {
        width: 80vw;
        height: auto;
        margin-left: 4vw;
        margin-top: 70px;

        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 700;
        font-size: 7vw;

        background: linear-gradient(79.98deg, #F4ECEC 29.59%, rgba(255, 255, 255, 0) 111.93%), #222222;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;

    }
</style>
@endpush
@section('content')
@include('app.navbar.auth',['titlePage'=>'Kampung Pesilat'])

<div class="title-user">ISI BIODATA PEMESAN</div>


<div class="container d-flex justify-content-center mt-50 mb-50">

    <div class="container-fluid px-2 px-md-4 mb-5">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            <span class="mask  bg-gradient-success  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n12">
            <div class="card card-plain h-100">
                <div class="card-body p-3">
                    <form method='POST' action="{{ base_url('order') }} ">
                        {!!csrf_field()!!}

                        <input type="hidden" name="id" class="form-control border border-2 p-2" value="{{$wisata['id']}}">
                        <div class=" row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control border border-2 p-2" value="{{$user->username}}">
                                @error('nama')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control border border-2 p-2" value="{{$user->email}}">
                                @error('email')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" name="phone" class="form-control border border-2 p-2">
                                @error('phone')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Jumlah Tiket</label>
                                <input type="number" id="qty" onchange="change()" name="qty" class="form-control border border-2 p-2" value="1">
                                @error('qty')
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
</div>

<script>
    function change() {
        var qty = document.getElementById('qty').value;
        if (qty < 1) {
            document.getElementById('qty').value = 1;
        }
    }
</script>

@endsection('content')