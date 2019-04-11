<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Imagen;
use App\Comentario;
use App\Megusta;

class ImagenController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function cargar(){
        return view('imagen.cargar');
    }

    public function guardar(Request $request){

        $validar = $this->validate($request, [
            'imagen_path' => 'required|image',
            'descripcion' => 'required'
        ]);
        
        $usuario = \Auth::user();
        
        $imagen = new Imagen();
        $imagen->descripcion = $request->input('descripcion');
        $imagen->usuario_id = $usuario->id;
        
        $imagen_path = $request->file('imagen_path');

        if($imagen_path){
            $imagen_nombre = time().$imagen_path->getClientOriginalName();
            Storage::disk('imagenes')->put($imagen_nombre, File::get($imagen_path));
            $imagen->imagen_path = $imagen_nombre;
        }

        $imagen->save();

        return redirect()->route('inicio')->with(['mensaje'=>'Imagen subida correctamente!']);
    }

    public function getImagen($nombrearchivo){
        $archivo = Storage::disk('imagenes')->get($nombrearchivo);
        return new Response($archivo, 200);
    }

    public function detalle($id){
        $imagen = Imagen::find($id);

        return view('imagen.detalle',[
            'imagen' => $imagen
        ]);
    }

    public function eliminar($id){
        $usuario = \Auth::user();
        $imagen = Imagen::find($id);

        if($usuario && $imagen && $usuario->id == $imagen->usuario->id){

            //Obtener Comentarios y Likes de la imagen
            $comentarios = Comentario::where('imagen_id',$imagen->id)->get();
            $likes = Megusta::where('imagen_id',$imagen->id)->get();

            //Eliminar Comentarios
            if($comentarios && count($comentarios) >= 1){
                foreach($comentarios as $comentario){
                    $comentario->delete();
                }
            }

            //Eliminar Likes
            if($likes && count($likes) >= 1){
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            //Eliminar Archivo
            Storage::disk('imagenes')->delete($imagen->imagen_path);

            //Eliminar registro de la imagen
            $imagen->delete();

            $mensaje = 'Imagen eliminada correctamente.';
        }else{
            $mensaje = 'Error eliminando imagen.';
        }

        return redirect()->route('inicio')->with(['mensaje' => $mensaje]);
    }

    public function editar($id){
        $usuario = \Auth::user();
        $imagen = Imagen::find($id);

        if($usuario && $imagen && $usuario->id == $imagen->usuario->id){

            return view('imagen.editar',[
                'imagen' => $imagen
            ]);
        }else{
            return redirect()->route('inicio');
        }
    }

    public function actualizar(Request $request){

        $validar = $this->validate($request, [
            'imagen_path' => 'image',
            'descripcion' => 'required'
        ]);
        
        $imagen_id = $request->input('imagen_id');
        $usuario_id = \Auth::user()->id;

        $imagen = Imagen::find($imagen_id);

        if($imagen && $imagen->usuario->id == $usuario_id){
            $imagen->descripcion = $request->input('descripcion');
            
            $imagen_path = $request->file('imagen_path');

            if($imagen_path){
                $imagen_nombre = time().$imagen_path->getClientOriginalName();
                Storage::disk('imagenes')->put($imagen_nombre, File::get($imagen_path));
                $imagen->imagen_path = $imagen_nombre;
            }

            $imagen->update();
            return redirect()->route('imagen.detalle',['id' => $imagen->id])->with(['mensaje' => 'Imagen actualizada correctamente!']);
        }else{
            return redirect()->route('inicio');
        }
        
    }
}
