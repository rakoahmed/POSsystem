@extends('layout.nav')
@section('content')

@if (Auth::user()->rule == 1)

    <div style="display: flex; flex-wrap: wrap; justify-content: center;">
        <div class="btn btn-white text-center btn-lg w-50 mt-3 text-capitalize">Debt List</div>
    </div>

    <div class="mt-5">
        @include('layout.datatable')
    </div>

    <div class="mt-5" style="display: flex; flex-wrap: wrap; justify-content: center;">
        {{ $stocks->links() }}
    </div>


@else
<h1 class="text-center mt-5 text-capitalize">you don't have permission to access this page</h1>

@endif


@endsection
