@php
use Fluent\Auth\Facades\Auth;
use App\Models\TiketModel;

$user=Auth::user();
@endphp
@extends('app.layout',['bodyClass'=>'g-sidenav-show bg-gray-200'])

@section('content')
@include('app.navbar.sidebar',['activePage'=>'user'])

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg " style=" overflow-x:hidden;">
    <!-- Navbar -->
    @include('app.navbar.admin',['titlePage'=>'User'])
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                            <h6 class="text-white text-capitalize ps-3 pt-2 text-center">Data Admin</h6>
                            <a href="user/create" class="btn bg-gradient-info  text-center me-3 text-white text-capitalize">Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0  px-3">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama/Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal dibuat</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($admin as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->username}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$item->email}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{$item->created_at}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{base_url('user').'/'.$item->id}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a><br>
                                            <a href="javascript:;" id="submitForm" onclick="submit()" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Delete
                                                <form action="{{base_url('user/'.$item->id.'/delete')}}" method="POST">
                                                    {!!csrf_field()!!}
                                                </form>
                                            </a>
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

<script>
    function submit() {
        var form = document.getElementById('submitForm').firstElementChild;
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {

                form.submit();
            }
        });
    }
</script>
@endsection