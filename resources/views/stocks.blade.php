@extends('layout.nav')
@section('content')

@if (Auth::user()->rule == 1)



<div class="container">


    <div class=" text-center">
        <canvas class="radius-10" width="320" height="240" id="webcodecam-canvas"></canvas>
        <br>
        <span class="text-center mt-3 mb-3 text-dark">Barcode : <b id="barcode"></b></span>
        <br>
        <span class="notify text-center mt-3 mb-3 text-danger"></span>
        <br>
        <button title="Play" class="btn btn-white m-2" id="play" type="button" data-toggle="tooltip">Play</button>
        <button class=" btn btn-white" id="mytxt" onclick="myFunction()">set it</button>
        <select class="form-control border-0 mt-2 mb-2 w d-none" id="camera-select"></select>
    </div>
    <br>
    @if($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{$error}}</div>
    @endforeach
    @endif
    @if(session('result'))
    <div class="alert alert-warning">{{session('result')}}</div>
    @endif
    
    <form action="buy/0/0" method="POST" class="text-center">
        @csrf
        <div class="row m-5 justify-content-center">

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark" id="tt">Barcode Stocks</label>
                <input name="id" type="text" placeholder="Code Barcode" id="Binput"
                    class="form-control radius-10 border-0">
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">Name Stocks</label>
                <input name="name" type="text" placeholder="Name Stocks" class="form-control radius-10 border-0">
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">Supplier</label>
                <select name="supplier_id" class="form-control radius10 border-0">
                    @foreach ($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">Count Stocks</label>
                <input name="count" type="number" placeholder="Count Stocks" class="form-control radius-10 border-0">
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">Price Stocks</label>
                <input name="price" type="number" placeholder="Price Stocks" class="form-control radius-10 border-0">
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">Expire Stocks</label>
                <input name="expire_date" type="date" class="form-control radius-10 border-0">
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">is Debt?</label>
                <select name="is_debt" class="form-control radius-10 border-0">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">Type</label>
                <select name="type" class="form-control radius-10 border-0">
                    <option value="0">Barcode</option>
                    <option value="1">Qrcode</option>
                </select>
            </div>

        </div>
        <button class="btn btn-white radius-20 mt-3 w-25">Submit <i class="ion-upload"></i></button>
    </form>
    <hr>




    @include('layout.datatable')


    <div class="d-flex justify-content-center mt-4">
        {{$stocks->links()}}
    </div>
</div>

@else
<h1 class="text-center mt-5 text-capitalize">you don't have permission to access this page</h1>


@endif





<script type="text/javascript" src="{{asset('assets/lib/qrcodelib.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/lib/webcodecamjs.js')}}"></script>
<script type="text/javascript">
    function sound(sound) {
        var obj = document.createElement("audio");
        obj.src = "assets/audio/" + sound + ".mp3";
        obj.play();
    }

    function myFunction() {
        var x = document.getElementById("barcode").textContent;
        document.getElementById("Binput").value = x;
    }


    (function (undefined) {
        "use strict";

        function Q(el) {
            if (typeof el === "string") {
                var els = document.querySelectorAll(el);
                return typeof els === "undefined" ? undefined : els.length > 1 ? els : els[0];
            }
            return el;
        }


        var play = Q("#play"),
            args = {
                resultFunction: function (res) {
                    var id = res.code;
                    $("#barcode").html(id);
                }

            };
        var decoder = new WebCodeCamJS("#webcodecam-canvas").buildSelectMenu("#camera-select", "environment|back")
            .init(args);
        play.addEventListener("click", function () {
            decoder.play();
        }, false);

        document.querySelector("#camera-select").addEventListener("change", function () {
            if (decoder.isInitialized()) {
                decoder.stop().play();
            }
        });
    }).call(window.Page = window.Page || {});

</script>



@endsection
