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
@if(session('midtrans'))
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{session('midtrans')['client_id']}}"></script>
@endif
@endpush
@section('content')
@include('app.navbar.auth',['titlePage'=>'Tiket Anda'])

<!-- <div class="title-user">Pemesanan Tiket Wisata di Kabupaten Madiun</div>
<div class="px-auto text-center text-light font-weight-bold h4 mt-3">Pilih Destinasi</div> -->


<div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                            <h6 class="text-white text-capitalize ps-3 pt-2 text-center">Data Transaksi</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Wisata</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total Pembayaran</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaksi as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{$item['wisata']['photo_path']}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item['wisata']['nama']}}</h6>
                                                    <p class="text-xs text-secondary mb-0">Rp {{$item['wisata']['harga']}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{$item['amount']/$item['wisata']['harga']}}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="mb-0 text-sm">Rp {{$item['amount']}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm bg-gradient-{{$item['midtrans_result']!=null?json_decode($item['midtrans_result'],true)['transaction_status']=='settlement'?'success':'danger':'danger'}} ">{{$item['midtrans_result']!=null?json_decode($item['midtrans_result'],true)['transaction_status']=='settlement'?'Sukses':'Gagal':'Gagal'}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{base_url('tiket').'/show?slug='.$item['slug']}}" class="badge badge-sm bg-gradient-info" data-toggle="tooltip" data-original-title="Edit user">
                                                Lihat Tiket
                                            </a><br>
                                            
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if(session('midtrans'))
<script type="text/javascript">
    window.snap.pay("{{session('midtrans')['token']}}", {
        onSuccess: function(result) {
            window.location.replace("{{base_url('order/check?order_id=')}}"+result.order_id);
        },
        onPending: function(result) {
            /* You may add your own implementation here */
            window.location.replace("{{base_url('order/check?order_id=')}}"+result.order_id);
        },
        onError: function(result) {
            /* You may add your own implementation here */
            window.location.replace("{{base_url('order/check?order_id=')}}"+result.order_id);
        },
        onClose: function() {
            /* You may add your own implementation here */
        }
    })
</script>
@endif

@endsection('content')