@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Subir Imagen </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('imagen.guardar') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="imagen_path" class="col-md-3 text-md-right col-form-label">Imagen</label>

                            <div class="col-md-7">
                                <input type="file" name="imagen_path" class="form-control{{ $errors->has('imagen_path') ? ' is-invalid' : '' }}" required>

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
                                <textarea name="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" required></textarea>
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
                                    Subir Imagen
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