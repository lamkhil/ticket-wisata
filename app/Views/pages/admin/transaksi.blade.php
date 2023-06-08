@php
use Fluent\Auth\Facades\Auth;

$user=Auth::user();
@endphp
@extends('app.layout',['bodyClass'=>'g-sidenav-show bg-gray-200'])

@section('content')
@include('app.navbar.sidebar',['activePage'=>'transaksi'])

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg " style=" overflow-x:hidden;">
    <!-- Navbar -->
    @include('app.navbar.admin',['titlePage'=>'Data Pemesan'])
    <!-- End Navbar -->
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
                                            Pengunjung</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jumlah</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total Pembayaran</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Transaksi</th>
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
                                            <span class="badge badge-sm bg-gradient-success">{{$item['user']->username}}</span>
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
                                        <td class="align-middle text-center text-sm">
                                            <span class="mb-0 text-sm">{{$item['created_at']}}</span>
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
</main>
@endsection