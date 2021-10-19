@extends('layouts.app')
@section('content')
    <div class="container">
        <header class="d-flex justify-content-between align-items-center">
            <h1>Modifica Post</h1>
            <a href="{{url()->previous()}}" class="btn btn-secondary">Indietro</a>
        </header>
        <section id="form">
            @include('includes.admin.posts.form')
        </section>
    </div>
@endsection