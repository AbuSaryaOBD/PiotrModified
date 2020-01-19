<div class="my-2">
@auth
  <form action="{{ route('posts.comments.store', ['post' => $post->id]) }}" method="POST">
    @csrf

    <div class="form-group">
      <textarea class="form-control" type="text" name="content"></textarea>
    </div>

    <div class="form-group">
      <button class="btn btn-outline-success form-control" type="submit">Add Comment</button>
    </div>
  </form>
  @errors @enderrors
@else
  <a href="{{ route('login') }}">Sign In</a> to post comments!
@endauth
  <hr>
</div>