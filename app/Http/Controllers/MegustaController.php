<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Megusta;

class MegustaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $usuario = \Auth::user();

        $likes = Megusta::where('usuario_id',$usuario->id)->orderBy('id','desc')->paginate(3);

        return view('megusta.index',[
            'likes' => $likes
        ]);
    }

    public function like($imagen_id){
        $usuario = \Auth::user();

        $existe_like = Megusta::where('usuario_id', $usuario->id)
                              ->where('imagen_id', $imagen_id)
                              ->count();

        if($existe_like == 0){
            $like = new Megusta();
            $like->usuario_id = $usuario->id;
            $like->imagen_id = (int)$imagen_id;

            $like->save();

            return response()->json([
                'like' => $like
            ]);
        }
    }

    public function dislike($imagen_id){
        $usuario = \Auth::user();

        $like = Megusta::where('usuario_id', $usuario->id)
                              ->where('imagen_id', $imagen_id)
                              ->first();

        if($like){
            $like->delete();

            return response()->json([
                'like' => $like,
                'mensaje' => 'Has dado dislike'
            ]);
        }
    }
}
