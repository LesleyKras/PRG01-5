@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <p class="alert alert-info">{{Session::get('info')}}</p>
    @endif
    <h2>All Advertisements</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Categories</th>
            <th>Modify</th>
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
                    <a href="{{route('advertisements.toggle', ['id' => $advertisement->id])}}">
                        @if($advertisement->active)
                            Disable
                        @else()
                            Enable
                        @endif
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
