@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <p class="alert alert-info">{{Session::get('info')}}</p>
    @endif

    <h1>This is the profile page</h1>
    <a href="{{route('profile.create')}}">Create Advertisement</a>

@endsection
