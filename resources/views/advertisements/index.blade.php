@extends('layouts.master')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Email</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($advertisements as $advertisement)
        <tr>
            <td>{{$advertisement->title}}</td>
            <td>{{$advertisement->description}}</td>
            <td>{{$advertisement->price}}</td>
            <td><a href="{{route('advertisements.post', ['id' => $advertisement->id])}}">Lees meer</a></td>
            <td>
                <a href="{{route('profile.edit', ['id' => $advertisement->id])}}">Edit</a>
                <a href="{{route('profile.delete', ['id' => $advertisement->id])}}">Delete</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
