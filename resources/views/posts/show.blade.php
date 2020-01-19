@extends('layout')

@section('content')
<div class="row">
    <div class="col-8">
        <h1>
            {{ $post->title }}
            @badge(['show' => now()->diffInMinutes($post->created_at) < 30])
                Brand New
            @endbadge
        </h1>

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

        @include('comments._form')

        @forelse ($post->comments as $comment)
            <div class="media mb-3">
                <i class="fa fa-user fa-2x bg-secondary rounded p-2 mr-2 mt-1" style="border: #bbb 2px solid;"></i>
                <div class="media-body">
                    <small class="text-muted">
                        @updated(['date' => $comment->created_at, 'name' => $comment->user->name])
                        @endupdated
                    </small>

                    <p>{{ $comment->content }}</p>
                </div>
            </div>
        @empty
            <p>No Coments yet!</p>
        @endforelse
    </div>
    <div class="col-4">
        @include('posts._activity')
    </div>
</div>
@endsection