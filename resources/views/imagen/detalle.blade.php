@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @include('includes.mensaje')

            <div class="card pub-imagen">
                <div class="card-header">
                    <div class="container-avatar">

                        @if($imagen->usuario->imagen)
                            <img src="{{ route('user.avatar',['img_nombre' => $imagen->usuario->imagen]) }}" class="avatar" alt="Avatar">
                        @else
                            <img src="https://st2.depositphotos.com/1007566/12301/v/950/depositphotos_123013306-stock-illustration-avatar-man-cartoon.jpg" class="avatar" alt="Avatar">
                        @endif

                    </div>

                    <div class="usr-datos">
                        {{ $imagen->usuario->name.' '.$imagen->usuario->surname}}
                        <span class="usr-nick">
                            {{ ' | @'.$imagen->usuario->nickname }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="imagen-container">
                        <img src="{{ route('archivo.imagen',['nombrearchivo' => $imagen->imagen_path]) }}" alt="...">
                    </div>
                    
                    <div class="descripcion">
                        <span class="usr-nick"> {{ '@'.$imagen->usuario->nickname }}</span>
                        <span clase="contenido">{{ $imagen->descripcion }}</span>
                        <span class="tiempo-detalle"> - {{ \FormatTime::LongTimeFilter($imagen->created_at) }}</span>
                    </div>

                    <div class="like">
                        <?php $usuario_like = false; ?>
                        @foreach($imagen->megustas as $like)
                            @if($like->usuario->id == Auth::user()->id)
                                <?php $usuario_like = true; ?>
                            @endif
                        @endforeach

                        @if($usuario_like)
                            <img src="{{ asset('img/heart-red.png') }}" data-id="{{ $imagen->id }}" class="btn-dislike">
                        @else
                            <img src="{{ asset('img/heart.png') }}" data-id="{{ $imagen->id }}" class="btn-like">
                        @endif
                        
                        <span class="count-likes">{{ count($imagen->megustas) }}</span>
                    </div>

                    @if(Auth::user() && Auth::user()->id == $imagen->usuario->id)
                        
                        <a href="{{ route('imagen.editar',['id' => $imagen->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                            Eliminar
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Eliminar Imagen</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Una vez eliminada la imagen, no podras recuperarla.
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                <a href="{{ route('imagen.eliminar',['id' => $imagen->id]) }}" class="btn btn-danger">Confirmar</a>
                            </div>

                            </div>
                        </div>
                        </div>
                    @endif

                    <div class="clearfix"></div>
                    <div class="comentar">
                        <h3> Comentarios ({{ count($imagen->comentarios) }}) </h3>
                        <hr>

                        <form action="{{ route('comentario.guardar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="imagen_id" value="{{ $imagen->id }}">
                            <p>
                                <textarea name="contenido" class="form-control{{ $errors->has('contenido') ? ' is-invalid' : '' }}" required></textarea>
                                @if ($errors->has('contenido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contenido') }}</strong>
                                    </span>
                                @endif
                            </p>
                            <button type="submit" class="btn btn-success">Comentar</button>
                        </form>
                        <hr>

                        @foreach($imagen->comentarios as $comentario)
                            <div class="comentario">
                                <span class="usr-nick"> {{ '@'.$comentario->usuario->nickname }}</span>
                                <span class="tiempo-detalle"> | {{ \FormatTime::LongTimeFilter($comentario->created_at) }}</span>
                                <div class="comentario-contenido">
                                    <span clase="contenido">{{ $comentario->contenido }}</span>
                                    @if($comentario->usuario_id == Auth::user()->id || $comentario->imagen->usuario_id == Auth::user()->id)
                                        <a href="{{ route('comentario.eliminar',['id'=>$comentario->id]) }}" class="" title="Borrar comentario">
                                            <img src="{{ asset('img/delete.png') }}" alt="Like">
                                        </a>
                                    @endif
                                </div>
                                
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
