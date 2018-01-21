@extends('layouts.master')

@section('content')
    <a href="{{route('advertisements.index')}}">Go Back</a>
    <h1>{{$advertisement->title}}</h1>
    <p>{{$advertisement->description}}</p>
    <p>{{$advertisement->price}}</p>
    <p>{{count($advertisement->likes)}} Likes |
        <a href="{{route('advertisements.like', ['id' => $advertisement->id])}}">Like</a></p>
@endsection
