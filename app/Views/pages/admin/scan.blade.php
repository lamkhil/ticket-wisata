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
    const Http = new XMLHttpRequest();

    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            ++countResults;
            lastResult = decodedText;
            // Handle on success condition with the decoded message.
            console.log(lastResult);

            const url = '{{base_url()}}klaim?kode=' + lastResult;
            Http.open("GET", url);
            Http.send();

        }
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", {
            fps: 10,
            qrbox: 250
        });
    html5QrcodeScanner.render(onScanSuccess);

    Http.onreadystatechange = (e) => {
        if (Http.readyState === 4 && Http.status === 200) {
            var result = JSON.parse(Http.response);
            if (result.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: "Tiket berhasil di scan, silahkan masuk :)",
                    icon: 'success'
                })
            }else{
                Swal.fire({
                    title: 'Gagal!',
                    text: result.message,
                    icon: 'error'
                })
            }
        }
    }
</script>

@endsection