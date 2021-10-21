@if ($post->exists)
    <form method="POST" action="{{route('admin.posts.update', $post->id)}}">
    @method('PATCH')
@else
    <form method="POST" action="{{route('admin.posts.store', $post->id)}}">
@endif
    @csrf
    <div class="form-group">
      <label for="title">Email address</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Scrivi il titolo" value="{{old('title', $post->title)}}">
    </div>
    <div class="form-group">
        <label for="image">Immagine</label>
        <input type="text" class="form-control" id="image" name="image" placeholder="Inserisci un url" value="{{old('image', $post->image)}}">
    </div>
    <div class="form-group">
      <label for="content">Contenuto del Post</label>
      <textarea class="form-control" id="content" name="content" rows="5">
        {{old('content', $post->content)}}
      </textarea>
    </div>
    <button type="submit" class="btn btn-success">Salva</button>
  </form>