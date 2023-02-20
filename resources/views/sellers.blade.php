@extends('layout.nav')
@section('content')

<div class="row justify-content-center m-3 mb-5">

@foreach ($lists as $key => $value)
    <span class="btn btn-white m-2">{{$key}} : {{$value}}</span>
@endforeach


</div>

    @include('layout.datatable')

  <div class="d-flex mt-5 mb-5 justify-content-center">
    {{$solds->links()}}
  </div>

@endsection