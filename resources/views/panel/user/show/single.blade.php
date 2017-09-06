@extends('layouts/panel')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <h2>{{$user->name}}</h2>
            </div>
            <div class="col-12 col-md-6 text-right">
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
        <form action="{{route('panel_user_edit', $user->id)}}" method="POST" class="row">
            {{csrf_field()}}
            {{method_field('put')}}
            @foreach($user['attributes'] as $key=>$value)
            <div class="col-12 col-md-4 col-lg-3">
                <div class="form-group">
                    <label for="{{$key}}">{{$key}}</label>
                    <input id="{{$key}}" class="form-control" type="text" name="user[{{$key}}]" value="{{$value}}">
                </div>
            </div>
            @endforeach
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-success">
                    Guardar
                </button>
            </div>
        </form>
    </div>
@endsection
