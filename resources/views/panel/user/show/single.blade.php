@extends('layouts/panel')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <h2>{{$user->id}}: {{$user->name}}</h2>
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
        <form action="{{route('panel_user_edit', ['id' => $user->id])}}" method="POST" class="row">
            {{csrf_field()}}
            {{method_field('put')}}
            @foreach($user['attributes'] as $key=>$value)
                @unless($key === 'id')
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label for="{{$key}}">@lang( 'betabeers_panel_user.' . $key)</label>
                            @if(key_exists($key, $user['casts']))
                                @if($user['casts'][$key] === 'string')
                                    @if($key === 'email')
                                        <input id="{{$key}}" class="form-control" type="email" name="user[{{$key}}]" value="{{$value}}">
                                    @elseif(in_array($key, ['body', 'looking_for']))
                                        <textarea id="{{$key}}" class="form-control" type="email" name="user[{{$key}}]" value="{{$value}}">
                                            {{$value}}
                                        </textarea>
                                    @elseif($key==='pass')
                                        <input id="{{$key}}" class="form-control" type="password" name="user[{{$key}}]" value="{{$value}}">
                                    @else
                                        <input id="{{$key}}" class="form-control" type="text" name="user[{{$key}}]" value="{{$value}}">
                                    @endif
                                @elseif($user['casts'][$key] == 'boolean')
                                    <select id="{{$key}}" name="user[{{$key}}]" class="form-control">
                                        <option value="1">
                                            SI
                                        </option>
                                        <option value="0" @if($value != 1) selected @endif>
                                            NO
                                        </option>
                                    </select>
                                @elseif($user['casts'][$key] == 'date')
                                    <input id="{{$key}}" class="form-control" type="datetime-local"  name="user[{{$key}}]" value="{{$value}}">
                                @elseif($user['casts'][$key] == 'integer')
                                    <input id="{{$key}}" class="form-control" type="number" min="0" name="user[{{$key}}]" value="{{$value}}">
                                @endif
                            @else
                            <input id="{{$key}}" class="form-control" type="text" name="user[{{$key}}]" value="{{$value}}">
                            @endif
                        </div>
                    </div>
                @endunless
            @endforeach
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-success">
                    Guardar
                </button>
            </div>
        </form>
    </div>
@endsection
