@extends('layouts.app')
@section('content')

<!-- Page Heading -->
@guest
<h1>Login</h1>
<li class="nav-item">
   <a class="nav-link" href="{{ route('register') }}">{{ __('Login') }}</a>
</li>
@if (Route::has('register'))
<h1>register</h1>
<li class="nav-item">
   <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
</li>
@endif
@else
<div class="d-sm-flex align-items-center justify-content-between mb-4">

   <h3 class="h3 mb-0 text-gray-800"><label id="txtsaludo"> </label> {{ Auth::user()->sUsrName}} </h3>
   <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Ver reportes</a> -->
</div>
@endguest

<!-- Content Row -->
<div class="row">


</div>

@endsection
