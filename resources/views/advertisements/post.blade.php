@extends('layouts.master')

@section('content')
    <h1>{{$advertisement->title}}</h1>
    <p>{{$advertisement->description}}</p>
    <p>{{$advertisement->price}}</p>
@endsection
