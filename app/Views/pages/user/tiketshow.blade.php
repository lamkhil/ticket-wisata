<html>

<head>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Staatliches&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @media print {
            @page {
                size: 25cm 35.7cm;
                margin: 5mm 5mm 5mm 5mm;
            }

            .no-print,
            .no-print * {
                display: none !important;
            }
        }

        body,
        html {
            height: 100vh;
            display: grid;
            font-family: "Staatliches", cursive;
            background: #ffffff;
            color: black;
            font-size: 14px;
            letter-spacing: 0.1em;
        }

        .ticket {
            margin: auto;
            display: flex;
            background: white;
            border: #404040;
            border-width: 1px;
            border-style: dotted;
        }

        .left {
            display: flex;
        }

        .image {
            height: 250px;
            width: 250px;
            opacity: 0.85;
        }

        .admit-one {
            position: absolute;
            color: darkgray;
            height: 250px;
            padding: 0 10px;
            letter-spacing: 0.15em;
            display: flex;
            text-align: center;
            justify-content: space-around;
            writing-mode: vertical-rl;
            transform: rotate(-180deg);
        }

        .admit-one span:nth-child(2) {
            color: white;
            font-weight: 700;
        }

        .left .ticket-number {
            height: 250px;
            width: 250px;
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
            padding: 5px;
        }

        .ticket-info {
            padding: 10px 30px;
            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: space-between;
            align-items: center;
        }

        .date {
            border-top: 1px solid gray;
            border-bottom: 1px solid gray;
            padding: 5px 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .date span {
            width: 100px;
        }

        .date span:first-child {
            text-align: left;
        }

        .date span:last-child {
            text-align: right;
        }

        .date .june-29 {
            color: #d83565;
            font-size: 20px;
        }

        .show-name {
            font-size: 32px;
            font-family: "Nanum Pen Script", cursive;
            color: #d83565;
        }

        .show-name h1 {
            font-size: 48px;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: #4a437e;
        }

        .time {
            padding: 10px 0;
            color: #4a437e;
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-weight: 700;
        }

        .time span {
            font-weight: 400;
            color: gray;
        }

        .left .time {
            font-size: 16px;
        }


        .location {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            padding-top: 8px;
            border-top: 1px solid gray;
        }

        .location .separator {
            font-size: 20px;
        }

        .right {
            width: 180px;
            border-left: 1px dashed #404040;
        }

        .right .admit-one {
            color: darkgray;
        }

        .right .admit-one span:nth-child(2) {
            color: gray;
        }

        .right .right-info-container {
            height: 250px;
            padding: 10px 10px 10px 35px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
        }

        .right .show-name h1 {
            font-size: 18px;
        }

        .barcode {
            height: 100px;
        }

        .barcode img {
            height: 100%;
        }

        .right .ticket-number {
            color: gray;
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>

    <title>Print</title>
</head>

<body>
    <div style="height:29px;margin: auto; margin-bottom: 60px;" class="no-print">
        <a href="/tiket" class="button">Kembali</a>
        <button onclick="printTiket()" class="button">Print</button>
    </div>
    @for($i = 0; $i<sizeof($tiket); $i++) <div class="ticket">
        <div class="left">
        <p class="admit-one">
                <span>WISATA</span>
                <span>WISATA</span>
                <span>WISATA</span>
            </p>
            <img class="image" src="{{$wisata['photo_path']}}">
            <div class="ticket-info">
                <p class="date">
                    <span>{{date('l', strtotime($tiket[$i]['created_at']))}}</span>
                    <span class="june-29">{{date('d M', strtotime($tiket[$i]['created_at']))}}</span>
                    <span>{{date('Y', strtotime($tiket[$i]['created_at']))}}</span>
                </p>
                <div class="show-name">
                    <h2>{{$wisata['nama']}}</h2>
                </div>
                <div class="time">
                    <p>{{$wisata['alamat']}}</p>
                </div>
                <p class="location"><span></span>
                    <span class="separator">{{$pengguna->username}}<i class="far fa-smile"></i></span><span></span>
                </p>
            </div>
        </div>
        <div class="right">
            <p class="admit-one">
                <span>WISATA</span>
                <span>WISATA</span>
                <span>WISATA</span>
            </p>
            <div class="right-info-container">
                
                <div class="barcode">
                    <a href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{$tiket['kode']}}"><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{$tiket[$i]['kode']}}" alt="QR code"></a>
                </div>
                <p class="ticket-number">
                    #{{$tiket[$i]['kode']}}
                </p>
            </div>
        </div>
        </div>
        @if($i%3 == 0 && $i!= 0)
        <div style="break-after:page"></div>
        @endif
        @endfor

        <script>
            function printTiket() {
                window.print();
            }
        </script>



</body>

</html>