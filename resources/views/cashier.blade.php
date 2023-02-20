@extends('layout.nav')
@section('content')

@if (Auth::user()->rule == 1)

<div class="container">
    <br>
    @if($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{$error}}</div>
    @endforeach
    @endif
    @if(session('result'))
    <div class="alert alert-warning">{{session('result')}}</div>
    @endif
    <form action="cashier/0/0" method="POST" class="text-center">
        @csrf
        <div class="row m-5 justify-content-center">

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">Cashier Name</label>
                <input name="name" type="text" placeholder=" Cashier Name" class="form-control radius-10 border-0">
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">Cashier Email</label>
                <input name="email" type="email" placeholder=" Cashier Email" class="form-control radius-10 border-0">
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">Cashier Password</label>
                <input name="password" type="password" placeholder=" Cashier Password"
                    class="form-control radius-10 border-0">
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-dark">Cashier Rule</label>
                <select name="rule" class="form-control radius-10 border-0">
                    <option value="0">Cashier</option>
                    <option value="1">Admin</option>
                </select>
            </div>
        </div>
        <button class="btn btn-white radius-20 mt-3 w-25">Submit <i class="ion-upload"></i></button>
    </form>
    <hr>



    @include('layout.datatable')

</div>


@else
<h1 class="text-center mt-5 text-capitalize">you don't have permission to access this page</h1>

@endif

@endsection
