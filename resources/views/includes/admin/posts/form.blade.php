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
    <div class="form-group">
      <label for="category_id">Categoria</label>
      <select class="form-control" id="category_id" name="category_id">
        <option value="">Nessuna categoria</option>
        @foreach ($categories as $category)
        <option @if(old('category_id', $post->category_id) == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option> 
        @endforeach
      </select>
    </div>
    <fieldset class="mb-3">
      <legend class="h6">Tag</legend>
      @foreach ($tags as $tag)
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="tag-{{$tag->id}}" value="{{$tag->id}}" name="tags[]" @if (in_array($tag->id, old('tags', $tagIds ?? []))) checked @endif>
        <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->name}}</label>
      </div>
      @endforeach
    
    </fieldset>
    <button type="submit" class="btn btn-success">Salva</button>
  </form>