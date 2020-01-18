<div class="container">
@card(['title' => 'Most Commented'])
  @slot('subTitle')
    What people are currently talking about
  @endslot
  @slot('items')
    @foreach ($mostCommented as $post)
      <li class="list-group-item px-2">
        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
          {{ Str::words($post->title, 7) }}
        </a>
      </li>
    @endforeach
  @endslot
@endcard

@card(['title' => 'Most Active'])
  @slot('subTitle')
    Users with most posts written
  @endslot
  @slot('items', collect($mostActive)->pluck('name'))
@endcard

@card(['title' => 'Most Active Last Month'])
  @slot('subTitle')
    Users with most posts written in last month
  @endslot
  @slot('items', collect($mostActiveLastMonth)->pluck('name'))
@endcard
</div>