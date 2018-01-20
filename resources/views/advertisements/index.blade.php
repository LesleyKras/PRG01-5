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
            <th>Price</th>
            <th>More info</th>
            <th>Categories</th>
        </tr>
        </thead>
        <tbody>
        @foreach($advertisements as $advertisement)
        <tr>
            <td>{{$advertisement->title}}</td>
            <td>{{$advertisement->description}}</td>
            <td>{{$advertisement->price}}</td>
            <td><a href="{{route('advertisements.post', ['id' => $advertisement->id])}}">Lees meer</a></td>
            {{--<td>--}}
                {{--<a href="{{route('profile.edit', ['id' => $advertisement->id])}}">Edit</a>--}}
                {{--<a href="{{route('profile.delete', ['id' => $advertisement->id])}}">Delete</a>--}}
            {{--</td>--}}
            <td>
                @foreach($advertisement->categorys as $category)
                 - {{ $category->name }} -
                @endforeach
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 text-center">
            {{$advertisements->links()}}
        </div>
    </div>
@endsection
