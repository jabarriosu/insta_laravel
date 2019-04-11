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
            <a href="{{route('perfil',['id' => $imagen->usuario->id])}}">
                {{ $imagen->usuario->name.' '.$imagen->usuario->surname}}
                <span class="usr-nick">
                    {{ ' | @'.$imagen->usuario->nickname }}
                </span>
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <div class="imagen-container">
            <img src="{{ route('archivo.imagen',['nombrearchivo' => $imagen->imagen_path]) }}" alt="...">
        </div>
        
        <div class="descripcion">
            <span class="usr-nick"> {{ '@'.$imagen->usuario->nickname }}</span>
            <span clase="contenido">{{ $imagen->descripcion }}</span>
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

        <div class="btn-comentarios">
            <a href="{{route('imagen.detalle',['id' => $imagen->id])}}" class="btn btn-sm btn-warning">Comentarios ({{ count($imagen->comentarios) }}) </a>
        </div>

        <div class="tiempo">
            <span> {{ \FormatTime::LongTimeFilter($imagen->created_at) }}</span>
        </div>
    </div>
</div>