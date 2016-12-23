@extends('frontend.layouts.master')

@section('content')
<div class="col-md-10 col-md-offset-1">
    @include('frontend.includes.nav')

    @yield('wrap')
</div>
@endsection
