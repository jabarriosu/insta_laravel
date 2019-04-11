<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
#use App\Imagen;

Route::get('/', function () {
    
    /*
    $imagenes = Imagen::all();
    foreach($imagenes as $imagen){
        echo $imagen->usuario->nombre.' '.$imagen->usuario->apellidos.'<br>';
        echo $imagen->imagen_path.'<br>';
        echo $imagen->descripcion.'<br>';

        echo '<h4>Comentarios</h4>';
        foreach($imagen->comentarios as $comentario){
            echo $comentario->usuario->nombre.' '.$comentario->usuario->apellidos.': ';
            echo $comentario->contenido.'<br>';
        }
        echo '<hr>';
    }
    die();
    */
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('inicio');

Route::get('/personas/{busqueda?}','UserController@index')->name('user.index');
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/usuario/actializar','UserController@update')->name('user.update');
Route::get('/usuario/avatar/{img_nombre}', 'UserController@getAvatar')->name('user.avatar');
Route::get('/perfil/{id}','UserController@perfil')->name('perfil');

Route::get('/subir-imagen','ImagenController@cargar')->name('imagen.cargar');
Route::post('/imagen/guardar','ImagenController@guardar')->name('imagen.guardar');
Route::get('/imagen/archivo/{nombrearchivo}','ImagenController@getImagen')->name('archivo.imagen');
Route::get('/imagen/{id}','ImagenController@detalle')->name('imagen.detalle');
Route::get('/imagen/eliminar/{id}','ImagenController@eliminar')->name('imagen.eliminar');
Route::get('/imagen/editar/{id}','ImagenController@editar')->name('imagen.editar');
Route::post('/imagen/actualizar','ImagenController@actualizar')->name('imagen.actualizar');

Route::post('/comentario/guardar','ComentarioController@guardar')->name('comentario.guardar');
Route::get('/comentario/eliminar/{id}','ComentarioController@eliminar')->name('comentario.eliminar');

Route::get('/likes','MegustaController@index')->name('likes.imagenes');
Route::get('/like/{imagen_id}','MegustaController@like')->name('like.save');
Route::get('/dislike/{imagen_id}','MegustaController@dislike')->name('like.delete');
