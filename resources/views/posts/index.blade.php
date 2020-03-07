@extends('layout')

@section('content')
<div class="row">
    <div class="col-8">
        @forelse ($posts as $post)
            <div class="card mt-5 {{ $post->trashed() ? 'border-danger' : '' }}">
                <div class="card-body pb-1" style="position: relative;">
                    <div class="rounded-circle text-center text-light bg-secondary" style="width: 75px; height: 75px; position: absolute; top: -50px;border: 1px #ccc solid;"><i class="fa fa-user fa-3x pt-1"></i></div>
                    <p class="rounded-top px-1 text-light bg-secondary" style="position: absolute;right: 15px; top: -22.5px; font-size: 0.8em; font-weight: bold;">{{ $post->user->name }}</p>
                    <h4 class="card-title">
                        @if ($post->trashed())
                            <del>
                        @endif
                        <a href="{{ route('posts.show',['post' => $post->id]) }}" class="{{ $post->trashed() ? 'text-muted' : '' }}">{{ Str::words($post->title, 3) }}</a>
                        @if ($post->trashed())
                            </del>
                        @endif
                    </h4>
                    <p class="card-text">{{ Str::words($post->content, 15) }}</p>
                    <hr class="my-1">
                    <small>
                        @updated(['date' => $post->created_at, 'name' => $post->user->name, 'userId' => $post->user->id])
                        @endupdated
                    </small>
                    @tags(['tags' => $post->tags])@endtags
                </div>
                <div class="card-footer text-muted p-1">
                    <div class="row m-0">
                        <div class="col-10 pl-1">
                            <small><i class="fas fa-clock mr-1"></i>{{ $post->created_at->diffForHumans() }}</small>
                            @if ($post->comments_count)
                                <small class="mx-1">|</small>
                                <small><i class="fas fa-comment mr-1"></i>{{ trans_choice('messages.comments', $post->comments_count) }}</small>
                            @endif
                        </div>
                        @auth
                            <div class="col-2 p-0">
                                <div class="row m-0 text-center">
                                    <div class="col-6 p-0">
                                        @can('update', $post)
                                            <a href="{{ route('posts.edit',['post' => $post->id]) }}" class="text-info"><i class="fas fa-edit"></i></a>
                                        @endcan
                                    </div>
                                    <div class="col-6 p-0">
                                        @if (!$post->trashed())
                                            @can('delete', $post)
                                            <form action="{{ route('posts.destroy',['post' => $post->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="close text-danger p-0 pr-1"><i class="fas fa-times"></i></button>
                                            </form>
                                            @endcan
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p>No Blog Posts Yet !!!</p><br>
            <p>!....Comming Soon...!</p>
        @endforelse
        {{-- <hr>
        <div class="d-flex justify-content-center w-100">
            <div>{{ $posts->render() }}</div>
        </div> --}}
    </div>
    <div class="col-4">
        @include('posts._activity')
    </div>
</div>

@endsection