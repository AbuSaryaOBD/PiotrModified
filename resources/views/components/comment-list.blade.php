@forelse ($comments as $comment)
  <div class="media mb-3">
      <i class="fa fa-user fa-2x bg-secondary rounded p-2 mr-2 mt-1" style="border: #bbb 2px solid;"></i>
      <div class="media-body">
          <small class="text-muted">
              @updated(['date' => $comment->created_at, 'name' => $comment->user->name, 'userId' => $comment->user->id])
              @endupdated
          </small>

          <p>{{ $comment->content }}</p>
      </div>
  </div>
@empty
  <p>No Comments yet!</p>
@endforelse