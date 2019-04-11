@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Actualizar Imagen </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('imagen.actualizar')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="imagen_id" value="{{$imagen->id}}">
                        <div class="form-group row">
                            <label for="imagen_path" class="col-md-3 text-md-right col-form-label">Imagen</label>
                            <div class="col-md-7">
                                @if($imagen->imagen_path)
                                    <img src="{{ route('archivo.imagen',['nombrearchivo' => $imagen->imagen_path]) }}" class="avatar" alt="...">
                                @endif
                                <input type="file" name="imagen_path" class="form-control{{ $errors->has('imagen_path') ? ' is-invalid' : '' }}">
                                @if ($errors->has('imagen_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('imagen_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descripcion" class="col-md-3 text-md-right col-form-label">Descripción</label>

                            <div class="col-md-7">
                                <textarea name="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" required>{{$imagen->descripcion}}</textarea>
                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-7 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection