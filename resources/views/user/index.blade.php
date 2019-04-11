@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-4"><h1>Personas</h1></div>
                <div class="col-8">
                    <form action="{{ route('user.index') }}" method="GET" id="buscar_personas">
                        <div class="row">
                            <div class="col">
                                <input type="text" id="busqueda" class="form-control">
                            </div>
                            <div class="col">
                                <input type="submit" class="btn btn-success" value="Buscar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            @foreach($usuarios as $usuario)
                <div class="row datos-perfil">
                    <div class="col-md-4">
                        <div class="avatar-perfil">
                            @if($usuario->imagen)
                                <img src="{{ route('user.avatar',['img_nombre' => $usuario->imagen]) }}" alt="Avatar">
                            @else
                                <img src="https://st2.depositphotos.com/1007566/12301/v/950/depositphotos_123013306-stock-illustration-avatar-man-cartoon.jpg" class="avatar" alt="Avatar">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 info">
                        <h2>{{ '@'.$usuario->nickname }}</h2>
                        <h3>{{ $usuario->name.' '.$usuario->surname }}</h3>
                        <h6>Se unió: {{ \FormatTime::LongTimeFilter($usuario->created_at) }}</h6>
                        <a href="{{ route('perfil',['id' => $usuario->id]) }}" class="btn btn-sm btn-success">Ver perfil</a>
                    </div>
                </div>
                <hr>
            @endforeach

            <div class="clearfix"></div>
            {{ $usuarios->links() }}
        </div>
    </div>
</div>
@endsection