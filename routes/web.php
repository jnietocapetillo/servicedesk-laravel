<?php

use Illuminate\Support\Facades\Route;

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
use App\Models\mensaje;
use App\Models\incidencia;


Route::get('/', function () {
    
    //sacamos todos los mensajes de la tabla mensaje
    /*$mensajes = mensaje::all();

    foreach($mensajes as $mensaje){
        //sacamos el usuario de cada mensaje gracias a la funcion usuarios de la clase mensaje
        
        echo $mensaje->mensaje."<br/>";
        echo $mensaje->id_usuario."<br/>";
        echo $mensaje->usuarios->nombre.' '.$mensaje->usuarios->apellidos."<br/>";
        echo $mensaje->incidencias->titulo.' '.$mensaje->incidencias->ubicacion."<br/>";
        echo "<hr>";
    }
    die();*/
    return view('inicio');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//rutas para los diferentes listados
Route::get('/incidencias', 'App\Http\Controllers\IncidenciasController@index')->name('incidencias');
Route::get('/incidenciasDes','App\Http\Controllers\IncidenciasController@desc')->name('incidenciasDes');
Route::get('/usuarios', 'App\Http\Controllers\UsuariosController@index')->name('users');

Route::get('/logs','App\Http\Controllers\LogsController@index');
Route::get('/logsDes','App\Http\Controllers\LogsController@logDes');

//rutas para detalles

Route::get('/usuarios/{id}','App\Http\Controllers\UsuariosController@detalle')->name('detalle.usuario');
Route::get('/incidencia/{id}','App\Http\Controllers\IncidenciasController@detalle')->name('detalle.incidencia');           
Route::get('/incidencia_add', 'App\Http\Controllers\IncidenciasController@agregar') -> name('addIncidencia');

//rutas para eliminar
Route::get('/incidencia_delete/{id}','App\Http\Controllers\IncidenciasController@eliminar')->name('incidencia.delete');
Route::get('/logs_delete','App\Http\Controllers\LogsController@eliminar')-> name('logs.delete');
Route::get('/user_delete/{id}','App\Http\Controllers\UsuariosController@eliminar')->name('user.delete');

//rutas enviar correo

//actualizar
Route::post('/usuario/actualizar','App\Http\Controllers\UsuariosController@actualizar')->name('usuario.update');
Route::post('/incidencia/actualizar','App\Http\Controllers\IncidenciasController@actualizar')->name('incidencia.update');


//rutas para agregar
Route::post('/incidencia_add','App\Http\Controllers\IncidenciasController@addIncidencia')->name('incidencia.add');

//rutas borrado
Route::post('/incidencia_delete','App\Http\Controllers\IncidenciasController@incidencia_delete')->name('incidencia_delete');
Route::post('/logs_delete','App\Http\Controllers\LogsController@logs_delete')->name('logs_delete');
Route::post('/user_delete', 'App\Http\Controllers\UsuariosController@user_delete')->name('user_delete');

//imprimir en pdf
Route::get('/usuariospdf','App\Http\Controllers\UsuariosController@imprimirpdf')->name('usuPdf');
Route::get('/incidenciaspdf','App\Http\Controllers\IncidenciasController@imprimirpdf')->name('incidenciasPdf');
Route::get('/logspdf','\App\Http\Controllers\LogsController@imprimirpdf')->name('logsPdf');

//exportar excel
Route::get('/usuariosXML','App\Http\Controllers\UsuariosController@exportarXML')->name('usuariosxml');
Route::get('/incidenciasXML','App\Http\Controllers\IncidenciasController@exportarXML')->name('incidenciasxml');
Route::get('/logsXML','App\Http\Controllers\LogsController@exportarXML')->name('logsxml');

//Envios de email
Route::get('/email/{correo}','App\Http\Controllers\UsuariosController@crearEmail')->name('crear.email');
Route::post('/email/enviar','App\Http\Controllers\UsuariosController@enviarEmail') ->name('enviar.email');