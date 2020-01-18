@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            @include('posts._form')

            <div class="form-group">
                <button class="btn btn-outline-success form-control" type="submit">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection