@extends('layouts.app')
@section('content')
    <div class="container">
        <header>
            <h1>Crea Nuovo Post</h1>
        </header>
        <section id="form">
            @include('includes.admin.posts.form')
        </section>
    </div>
@endsection