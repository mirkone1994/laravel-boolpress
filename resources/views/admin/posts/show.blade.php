@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$post->title}}</h1>
    <address>Categoria: @if ($post->category) {{$post->category->name}} @else Nessuna Categoria @endif</address>
    <p>{{$post->content}}</p>
    <address>Pubblicato il: {{$post->getFormattedDate('created_at')}}</address>
    <div class="d-flex justify-content-end">
        <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Torna alla lista</a>
    </div>
</div>
    
@endsection