@extends('layout')

@section('content')
<div class="row">
    <div class="col-8">
        <h1>
            {{ $post->title }}
            <small>
                @badge(['show' => now()->diffInMinutes($post->created_at) < 30])
                    Brand New
                @endbadge
            </small>
        </h1>
        @if ($post->image)
            <img src="{{ $post->image->url() }}" class="img-fluid">
        @endif
        <p>{{ $post->content }}</p>

        <div>
            @updated(['date' => $post->created_at, 'name' => $post->user->name])
            @endupdated
        </div>
        
        <div>
            @updated(['date' => $post->updated_at, 'name' => $post->user->name])
                Updated
            @endupdated
        </div>

        <div>
            @tags(['tags' => $post->tags])@endtags
        </div>

        <p>Currently Read By <strong>{{ $counter }}</strong> People</p>

        <h4>Comments</h4>

        @commentForm(['route' => route('posts.comments.store', ['post' => $post->id])])
        @endcommentForm

        @commentList(['comments' => $post->comments])
        @endcommentList
    </div>
    <div class="col-4">
        @include('posts._activity')
    </div>
</div>
@endsection