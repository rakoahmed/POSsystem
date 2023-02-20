@extends('layout.nav')
@section('content')

<div style="display: flex; flex-wrap: wrap; justify-content: center;">
<div class="btn btn-white text-center btn-lg w-50 mt-3 text-capitalize">Expire Stoks</div>
</div>

<div class="mt-5">
@include('layout.datatable')
</div>

<div class="mt-5" style="display: flex; flex-wrap: wrap; justify-content: center;">
    {{ $stocks->links() }}
</div>

@endsection
