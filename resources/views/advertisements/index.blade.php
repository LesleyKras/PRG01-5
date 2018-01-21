@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <p class="alert alert-info">{{Session::get('info')}}</p>
    @endif
    <a href="{{route('advertisements.create')}}">Create Advertisement</a>
    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Email</th>
            <th>More info</th>
            <th>Categories</th>
        </tr>
        </thead>
        <tbody>
        @foreach($advertisements as $advertisement)
            @if($advertisement->active)
        <tr>
            <td>{{$advertisement->title}}</td>
            <td>{{$advertisement->description}}</td>
            <td>{{$advertisement->price}}</td>
            <td><a href="{{route('advertisements.post', ['id' => $advertisement->id])}}">Lees meer</a></td>
            <td>
                @foreach($advertisement->categorys as $category)
                 - {{ $category->name }}
                @endforeach
            </td>
        </tr>
        @endif
        @endforeach
        </tbody>
    </table>
@endsection
