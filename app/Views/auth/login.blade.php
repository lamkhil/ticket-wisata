@extends('app.layout', ['bodyClass'=>'bg-gray-200"'])

@section('content')
<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container mt-10">
            <div class="row signin-margin">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-info shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Aplikasi Pemesanan Tiket Wisata</h4>
                                <div class="row mt-3">
                                    <h6 class='text-white text-center'>
                                        Kab. Madiun
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mx-auto">
                            <div id="g_id_onload" data-client_id="177019467763-3lmq8p5en6eanh15boil0n14te8o0ntv.apps.googleusercontent.com" data-context="signin" data-ux_mode="popup" data-login_uri="login" data-auto_prompt="false">
                            </div>

                            <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="filled_blue" data-text="signin_with" data-size="large" data-logo_alignment="left">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.guest></x-footers.guest>
    </div>
</main>
@push('js')
<script src="{{ base_url('assets') }}/js/jquery.min.js"></script>
<script>
    $(function() {

        var text_val = $(".input-group input").val();
        if (text_val === "") {
            $(".input-group").removeClass('is-filled');
        } else {
            $(".input-group").addClass('is-filled');
        }
    });
</script>
<script src="https://accounts.google.com/gsi/client" async defer></script>
@endpush
@endsection