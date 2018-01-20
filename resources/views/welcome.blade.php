@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <p class="alert alert-info">{{Session::get('info')}}</p>
    @endif

<div class="row">
    <div class="col-md-12">
        <h1>Welcome to the marketplace</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et minus nobis quos. Nam, necessitatibus, placeat? Animi at, blanditiis consequatur, ducimus ea earum ex excepturi facere harum magnam non perferendis similique.</p>
    </div>

</div>
@endsection
