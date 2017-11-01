@extends('layouts/panel')

@section('content')
    <div class="row">
        <div class="col-6">
            @include('panel.user.search')
        </div>
        <div class="col-6 text-right">
            <a href="#" class="btn btn-success">Crear nuevo</a>
        </div>
    </div>
    <div class="row mb-1 mt-1">
        <div class="col-md-1">
            <strong>Id</strong>
        </div>
        <div class="col-md-3">
            <strong>Title</strong>
        </div>
        <div class="col-md-3">
            <strong>Author</strong>
        </div>
        <div class="col-md-3">
            <strong>Slug</strong>
        </div>
        <div class="col-md-2 text-center">
            <strong>Actions</strong>
        </div>
    </div>
    @foreach($posts as $post)
    <div class="row mb-1 mt-1 @unless($post->status) bg-light @endunless ">
        <div class="col-md-1">
            {{$post->id}}
        </div>
        <div class="col-md-3">
            {{$post->title}}
        </div>
        <div class="col-md-3">
            {{$post->author->name}}
        </div>
        <div class="col-md-3">
            {{$post->slug}}
        </div>
        <div class="col-md-2 text-center">
            <a href="{{route('panel_blog_single_show', $post->id)}}" class="btn btn-primary">
                Editar
            </a>
            @if($post->status)
                <form action="{{route('panel_blog_delete', ['id' => $post->id])}}" method="POST" class="d-inline">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">
                        Eliminar
                    </button>
                </form>
            @else
                <form action="{{route('panel_blog_restore', ['id' => $post->id])}}" method="POST" class="d-inline">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-success">
                        Recuperar
                    </button>
                </form>
            @endif
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{$posts->links('vendor/pagination/bootstrap-4')}}
    </div>
@endsection