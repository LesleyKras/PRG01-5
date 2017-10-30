@extends('layouts.master')

@section('content')
    <h1>{{$advertisement->title}}</h1>
    <p>{{$advertisement->description}}</p>
    <p>{{$advertisement->price}}</p>
    <p>{{count($advertisement->likes)}} Likes |
        <a href="{{route('advertisement.like', ['id' => $advertisement->id])}}">Like</a></p>
@endsection
