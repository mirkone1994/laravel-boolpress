@extends('layouts.app')

@section('content')
<div class="container">
  <header class="my-5 d-flex justify-content-between align-items-center">
    <h1>I miei post</h1>
    <a href="{{route('admin.posts.create')}}" class="btn btn-success">Nuovo post</a>

  </header>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Creato il</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{{$post->getFormattedDate('created_at')}}</td>
                <td class="d-flex">
                  <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary">Vai</a>
                  <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning ml-2">Modifica</a>
                  <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
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
    
@endsection