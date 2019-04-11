@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($likes as $like)
                @include('includes.imagen',['imagen'=>$like->imagen])
            @endforeach

            <div class="clearfix"></div>
            {{ $likes->links() }}
        </div>
    </div>
</div>
@endsection