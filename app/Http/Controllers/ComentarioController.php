<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentario;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function guardar(Request $request){

        $validar = $this->validate($request, [
            'imagen_id' => 'required|integer',
            'contenido' => 'required|string'
        ]);

        $usuario = \Auth::user();

        $comentario = new Comentario();
        $comentario->usuario_id = $usuario->id;
        $comentario->imagen_id = $request->input('imagen_id');
        $comentario->contenido = $request->input('contenido');

        $comentario->save();

        return redirect()->route('imagen.detalle',['id' => $request->input('imagen_id')])->with(['mensaje' => 'Has realizado un comentario!']);
        
    }

    public function eliminar($id){

        $usuario = \Auth::user();

        $comentario = Comentario::find($id);

        $mensaje = 'Error eliminando comentario!';
        if($comentario->usuario_id == $usuario->id || $comentario->imagen->usuario_id = $usuario->id){
            $comentario->delete();
            $mensaje = 'Comentario Eliminado!';
        }

        return redirect()->route('imagen.detalle',['id' => $comentario->imagen->id])
                             ->with(['mensaje' => $mensaje]);
    }
}
