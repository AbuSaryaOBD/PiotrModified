@extends('layout')

@section('content')
<form method="POST" enctype="multipart/form-data" action="{{ route('users.update', ['user' => $user->id]) }}" class="form-horizontal">
  @csrf
  @method('PUT')

  <div class="row">
    <div class="col-4">
      <img src="{{ $user->image ? $user->image->url() : '' }}" alt="" class="img-thumbnail avatar">
      <div class="card mt-4">
        <div class="card-body">
          <h6>Upload a different photo</h6>
          <input type="file" name="avatar" class="form-control-file">
        </div>
      </div>
    </div>

    <div class="col-8">
      <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" name="name" value="" class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
      @errors @enderrors
    </div>
  </div>
</form>
@endsection