@extends('layouts.master')

@section('content')
    <a href="{{ URL::previous() }}">Go Back</a>
    @include('partials.errors')
    <form class="form-horizontal" role="form" action="{{route('advertisements.update')}}" method="post">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="title" class="col-md-4 control-label">Title:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{$advertisement->title}}" id="title" name="title" placeholder="Title">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="description" class="col-md-4 control-label">Description:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="{{$advertisement->description}}"  id="description" name="description" placeholder="Description">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="price" class="col-md-4 control-label">Price:</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="price" id="price" value="{{$advertisement->price}}">
                    </div>
                </div>
            </div>
            @foreach($categorys as $category)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="categorys[]" value="{{$category->id}}" {{$advertisement->categorys->contains($category->id) ? 'checked' : ''}} >{{$category->name}}
                    </label>
                </div>
            @endforeach
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$advertisementId}}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
    </form>
@endsection
