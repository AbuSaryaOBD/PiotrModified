@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
        <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('posts._form')

            <div class="form-group">
                <button class="btn btn-outline-success form-control" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection