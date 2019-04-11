@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.mensaje')

            @foreach($imagenes as $imagen)
                @include('includes.imagen',['imagen'=>$imagen])
            @endforeach

            <div class="clearfix"></div>
            {{ $imagenes->links() }}
        </div>
    </div>
</div>
@endsection
