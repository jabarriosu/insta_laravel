@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Perfil</h1>
            <hr>
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
                </div>
            </div>
            @foreach($usuario->imagenes as $imagen)
                @include('includes.imagen',['imagen'=>$imagen])
            @endforeach

        </div>
    </div>
</div>
@endsection