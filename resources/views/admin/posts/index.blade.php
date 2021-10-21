@extends('layouts.app')

@section('content')
<div class="container">
  @if(session('alert-message'))
    <div class="alert alert-{{session('alert-type')}}">
      {{session('alert-message')}}
    </div>
  @endif
  <header class="my-5 d-flex justify-content-between align-items-center">
    <h1>I miei post</h1>
    <a href="{{route('admin.posts.create')}}" class="btn btn-success">Nuovo post</a>

  </header>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Categoria</th>
            <th scope="col">Creato il</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>@if ($post->category)
                    {{$post->category->name}}
                @else
                    -
                @endif</td>
                <td>{{$post->getFormattedDate('created_at')}}</td>
                <td class="d-flex">
                  <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary">Vai</a>
                  <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning ml-2">Modifica</a>
                  <form action="{{route('admin.posts.destroy', $post->id)}}" method="post" class="delete-button">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ml-2">Elimina</button>                  
                  </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Non ci sono post da visualizzare</td>
                </tr>
            @endforelse
        </tbody>
      </table>
      <footer class="d-flex justify-content-end">
        {{$posts->links()}}
      </footer>
</div>
    @section('scripts')
    <script>
      const deleteButtons = document.querySelectorAll('.delete-button');
      deleteButtons.forEach(form => {
        form.addEventListener('submit', function(e){
          e.preventDefault();
          const conf = confirm('Vuoi eliminare questo post?');
          if (conf) this.submit();       
        });
      });
    </script>
    @endsection
@endsection