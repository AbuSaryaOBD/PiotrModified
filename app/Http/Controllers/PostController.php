<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Events\BlogPostPosted;
use App\Facades\CounterFacade;
use App\Http\Requests\StorePost;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index',[
            'posts' => BlogPost::latestWithRelations()->get(),
        ]);
    }

    public function dashboard()
    {
        $user = Auth::user();
        return view('posts.index',['posts' => BlogPost::latest()->withCount('comments')->where('user_id', '=', $user->id)->paginate(9)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()
    {
        //
        // $this->authorize('posts.create');
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;
        $blogPost = BlogPost::create($validatedData);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');
            $blogPost->image()->save(Image::make(['path' => $path]));
        }

        event(new BlogPostPosted($blogPost));

        return redirect()->route('posts.show',$blogPost->id)->with('success','Blog Post Has Been Created Successfuly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('posts.show',[
        //     'post' => BlogPost::with(['comments' => function ($query) {
        //         return $query->latest();
        //     }])->findOrFail($id)
        // ]);
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 300, function () use ($id) {
            return BlogPost::with('comments', 'tags', 'user', 'comments.user')->findOrFail($id);
        });

        return view('posts.show',[
            'post' => $blogPost,
            'counter' => CounterFacade::increment("blog-post-{$id}", ['blog-post']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update_post', $post)) {
        //     abort(403, "You can't edit this post !!!");
        // }
        $this->authorize($post);

        return view('posts.edit',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        //
        $post = BlogPost::findOrFail($id);
        $this->authorize($post);
        // if (Gate::denies('update_post', $post)) {
        //     abort(403, "You can't edit this post !!!");
        // }

        $validatedData = $request->validated();
        $post->fill($validatedData);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');
            if ($post->image) {
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(Image::make(['path' => $path]));
            }

        }

        $post->save();
        return redirect()->route('posts.show',$post->id)->with('success','Blog post has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update_post', $post)) {
        //     abort(403, "You can't delete this post !!!");
        // }
        $this->authorize($post);

        $post->delete($id);
        return redirect()->route('posts.index')->with('danger','Blog post has been deleted!');
    }
}
