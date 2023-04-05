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

<div class="title-user">Pemesanan Tiket Wisata di Kabupaten Madiun</div>
<div class="px-auto text-center text-light font-weight-bold h4 mt-3">Pilih Destinasi</div>


<div class="container d-flex justify-content-center mt-50 mb-50">

    <div class="row">
     @foreach($wisata as $item)
     <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="card-img-actions">

                        <img src="{{$item['photo_path']}}" class="card-img img-fluid" width="96" height="350" alt="">


                    </div>
                </div>

                <div class="card-body bg-light text-center">
                    <div class="mb-0">
                        <h6 class="font-weight-semibold mb-0">
                            <a href="#" class="text-default mb-2" data-abc="true">{{$item['nama']}}</a>
                        </h6>
                    </div>

                    <h3 class="mb-0 font-weight-semibold">Rp {{$item['harga']}}</h3>

                    <button type="button" class="btn bg-success text-white"><i class="fa fa-cart-plus mr-0"></i> Order</button>
                </div>
            </div>
    </div>
     @endforeach
</div>
</div>

@endsection('content')