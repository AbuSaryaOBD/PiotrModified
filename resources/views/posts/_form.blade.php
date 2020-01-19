<div class="form-group">
    <label for="title">Title</label>
    <input class="form-control" type="text" name="title" value="{{ old('title', $post->title ?? null) }}">
</div>
<div class="form-group">
    <label for="content">Content</label>
    <input class="form-control" type="text" name="content" value="{{ old('content', $post->content ?? null) }}">
</div>
@errors @enderrors