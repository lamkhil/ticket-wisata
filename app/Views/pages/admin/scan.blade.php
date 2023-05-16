@php
use Fluent\Auth\Facades\Auth;

$user=Auth::user();
@endphp
@extends('app.layout',['bodyClass'=>'g-sidenav-show bg-gray-200'])



@section('content')
@include('app.navbar.sidebar',['activePage'=>'scan'])

@push('style')
<script src="https://unpkg.com/html5-qrcode"></script>
@endpush

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg " style=" overflow-x:hidden;">
    <!-- Navbar -->
    @include('app.navbar.admin',['titlePage'=>'Scan e-Tiket'])
    <!-- End Navbar -->
    <div id="qr-reader" class="w-60" style="margin:auto;margin-top:100px;"></div>
    <div id="qr-reader-results"></div>
</main>


<script>
    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 0;

    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            ++countResults;
            lastResult = decodedText;
            // Handle on success condition with the decoded message.
            Toast.fire({
                icon: 'success',
                title: "Tiket berhasil scan, silahkan masuk :)"
            })
        }
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", {
            fps: 10,
            qrbox: 250
        });
    html5QrcodeScanner.render(onScanSuccess);
</script>

@endsection