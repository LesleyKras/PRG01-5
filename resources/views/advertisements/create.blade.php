@extends('layouts.master')

@section('content')
    <a href="{{ URL::previous() }}">Go Back</a>

    @include('partials.errors')
    <form class="form-horizontal" role="form" action="{{route('advertisements.create')}}" method="post">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="title" class="col-md-4 control-label">Title:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="description" class="col-md-4 control-label">Description:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="price" class="col-md-4 control-label">Price:</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="price" id="price" placeholder="25">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="form-group">
                    <label for="category" class="col-md-4 control-label">Category:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="category" placeholder="Category">
                    </div>
                </div>
            </div>
            @foreach($categorys as $category)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="categorys[]" value="{{$category->id}}">{{$category->name}}
                    </label>
                </div>
            @endforeach
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
    </form>
@endsection
