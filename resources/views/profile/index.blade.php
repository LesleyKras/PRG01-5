@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <p class="alert alert-info">{{Session::get('info')}}</p>
    @endif
    <h2>Profile</h2>
    <p>Name: {{$user->name}}</p>
    <p>E-mail: {{$user->email}}</p>
    <p>Role: {{$roles->name}}</p>


    <h2>My Advertisements</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Categories</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($advertisements as $advertisement)
            <tr>
                <td>{{$advertisement->title}}</td>
                <td>{{$advertisement->description}}</td>
                <td>{{$advertisement->price}}</td>
                <td>
                    @foreach($advertisement->categorys as $category)
                        - {{ $category->name }} -
                    @endforeach
                </td>
                <td>
                    <a href="{{route('advertisements.edit', ['id' => $advertisement->id])}}">Edit</a>
                    <a href="{{route('advertisements.delete', ['id' => $advertisement->id])}}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
