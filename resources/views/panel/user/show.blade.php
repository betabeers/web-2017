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
            <strong>Name</strong>
        </div>
        <div class="col-md-3">
            <strong>Email</strong>
        </div>
        <div class="col-md-3">
            <strong>Slug</strong>
        </div>
        <div class="col-md-2 text-center">
            <strong>Actions</strong>
        </div>
    </div>
    @foreach($users as $user)
    <div class="row mb-1 mt-1 @unless($user->visible) bg-warning @endunless @if($user->admin) bg-success @endif">
        <div class="col-md-1">
            {{$user->id}}
        </div>
        <div class="col-md-3">
            {{$user->name}}
        </div>
        <div class="col-md-3">
            {{$user->email}}
        </div>
        <div class="col-md-3">
            {{$user->slug}}
        </div>
        <div class="col-md-2 text-center">
            <a href="{{route('panel_user_single_show', $user->id)}}" class="btn btn-primary">
                Editar
            </a>
            @if($user->visible)
            <form action="{{route('panel_user_delete', ['id' => $user->id])}}" method="POST" class="d-inline">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <button type="submit" class="btn btn-danger">
                    Eliminar
                </button>
            </form>
            @else
                <form action="{{route('panel_user_restore', ['id' => $user->id])}}" method="POST" class="d-inline">
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
        {{$users->links('vendor/pagination/bootstrap-4')}}
    </div>
@endsection