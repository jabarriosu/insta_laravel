<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($busqueda = null){

        if(!empty($busqueda)){
            $usuarios = User::where('nickname','LIKE','%'.$busqueda.'%')
                            ->orWhere('name','LIKE','%'.$busqueda.'%')
                            ->orWhere('surname','LIKE','%'.$busqueda.'%')
                            ->orderBy('id','desc')->paginate(5);
        }else{
            $usuarios = User::orderBy('id','desc')->paginate(5);
        }

        return view('user.index',[
            'usuarios' => $usuarios
        ]);
    }

    public function config(){
        return view('user.configuracion');
    }

    public function update(Request $request){

        //Obtener usuario legueado.
        $usuario = \Auth::user();
        $id = $usuario->id;

        $validar = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nickname' => 'required|string|max:255|unique:usuarios,nickname,'.$id,
            'email' => 'required|string|email|max:255|unique:usuarios,email,'.$id
        ]);
        
        //Asignar al objeto usuario, los valores obtenidos por el formulario.
        $usuario->name = $request->input('name');
        $usuario->surname = $request->input('surname');
        $usuario->nickname = $request->input('nickname');
        $usuario->email = $request->input('email');

        //Cargar imagen de usuario.
        $imagen = $request->file('imagen');
        if($imagen){
            $imagen_nombre = time().$imagen->getClientOriginalName();

            Storage::disk('users')->put($imagen_nombre, File::get($imagen));

            $usuario->imagen = $imagen_nombre;
        }

        //Guardar cambios
        $usuario->update();
        return redirect()->route('config')->with(['mensaje'=>'Usuario actualizado correctamente!']);
    }

    public function getAvatar($img_nombre){
        $file = Storage::disk('users')->get($img_nombre);
        return new Response($file, 200);
    }

    public function perfil($id){
        $usuario = User::find($id);

        return view('user.perfil',[
            'usuario' => $usuario
        ]);
    }
}
