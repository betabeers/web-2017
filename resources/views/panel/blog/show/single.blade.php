@extends('layouts/panel')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <h2>{{$post->id}}: {{$post->title}}</h2>
            </div>
            <div class="col-12 col-md-6 text-right">
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
                            Publicar
                        </button>
                    </form>
                @endif
            </div>
        </div>
        <form action="{{route('panel_blog_edit', ['id' => $post->id])}}" method="POST">
            {{csrf_field()}}
            {{method_field('put')}}
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">@lang('betabeers_panel_blog.title')</label>
                                <input id="title" class="form-control required" type="text" name="post[title]" value="{{$post->title}}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="body">@lang('betabeers_panel_blog.body')</label>
                                <textarea id="body" class="form-control ckeditor" name="post[body]" rows="150">
                                    {{ $post->body }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="author">@lang('betabeers_panel_blog.author')</label>
                                <input id="author" class="form-control required" type="text" value="{{$post->author->name}}" disabled>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="category">@lang('betabeers_panel_blog.category')</label>
                                <select id="category" class="form-control" name="post[type]">
                                    <option value="1" @if($post->type == 1) selected @endif>@lang('betabeers_panel_blog.category_1')</option>
                                    <option value="2" @if($post->type == 2) selected @endif>@lang('betabeers_panel_blog.category_2')</option>
                                    <option value="3" @if($post->type == 3) selected @endif>@lang('betabeers_panel_blog.category_3')</option>
                                    <option value="4" @if($post->type == 4) selected @endif>@lang('betabeers_panel_blog.category_4')</option>
                                    <option value="5" @if($post->type == 5) selected @endif>@lang('betabeers_panel_blog.category_5')</option>
                                    <option value="6" @if($post->type == 6) selected @endif>@lang('betabeers_panel_blog.category_6')</option>
                                    <option value="7" @if($post->type == 7) selected @endif>@lang('betabeers_panel_blog.category_7')</option>
                                    <option value="8" @if($post->type == 8) selected @endif>@lang('betabeers_panel_blog.category_8')</option>
                                    <option value="9" @if($post->type == 9) selected @endif>@lang('betabeers_panel_blog.category_9')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for ="slug">@lang('betabeers_panel_blog.slug')</label>
                                <input id="slug" class="form-control required" type="text" name="post[slug]" value="{{$post->slug}}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="date">@lang('betabeers_panel_blog.date')</label>
                                <input id="date" class="form-control" type="datetime-local" name="post[date]" value="{{ date('Y-m-d\Th:i', strtotime($post->date))}}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="status">@lang('betabeers_panel_blog.status')</label>
                                <select id="status" class="form-control" name="post[status]">
                                    <option value="0">@lang('betabeers_panel_blog.status_unpublished')</option>
                                    <option value="1" @if($post->status == 1)selected @endif > @lang('betabeers_panel_blog.status_published')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <div class="alert alert-warning">
                                Visitas:<br>
                                {{$post->hits}}
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <div class="alert alert-success">
                                Votos:<br>
                                {{$post->votes}}
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
