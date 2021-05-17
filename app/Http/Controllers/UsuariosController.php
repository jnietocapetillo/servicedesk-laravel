<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\log;
use PDF;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\ContactoMailable;
use Illuminate\Support\Facades\Mail;

class UsuariosController extends Controller
{
    //controlamos el acceso a las funciones siempre que esté logueado el usuario
    public function __construct()
    {
        $this->middleware('auth');
    }

    //muestra una lista de los usuarios del sistema por paginacion
    public function index()
    {
        $usuarios = DB::table('users')->paginate(5);
        return view('usuarios',['usuarios'=>$usuarios]);
    }

    //muestra el detalle de un usuario
    public function detalle($id)
    {
        $detalle = User::where('id',$id)->first();
        return view('modUsuario',['detalle' =>$detalle]);
    }

    //actualiza la información de un usuario a través de un formulario y con su correspondiente validacion
    public function actualizar(Request $request)
    {
        //recibimos los datos del formulario en request
        $id = $request->id;
        $request->validate([
            'usuario' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id, //le decimos que solo puede ser unico y si es el mismo que el del usuario lo deje pasar por si no ha modificado el email
        ]);
        //necesito hacer un select del usuario en la base de datos y actualizarla
        $user = User::where('id',$id)->update(array('nombre' => $request->nombre,
                                                    'apellidos' => $request->apellidos,
                                                    'nick' => $request -> usuario,
                                                    'email' => $request->email,
                                                    'departamento' => $request->departamento,));

        //actualizamos tabla logs
        $log = log::insert(['tipo'=>'update_user','usuario'=>auth()->user()->nick,'nombre'=>auth()->user()->nombre]);

        //redirijo a la mnisma direccion para mostrar el mensaje
        return redirect()->action('App\Http\Controllers\UsuariosController@detalle',$id)->with(['mensaje'=>'El usuario se ha actualizado correctamente']);
    }

    //funcion que carga la vista para cerciorarse de eliminar un usuario
    public function eliminar($id)
    {
        $usuario = user::where('id',$id)->first();

        //cargamos la vista previa al borrado
        return view('delUser',['usuario'=>$usuario]);

    }

    //funcion que eleimina el usuario seleccionado
    public function user_delete(Request $request)
    {
        
        $incidencia = user::find($request->id);
        $incidencia->delete();

        //actualizamos tabla logs
        $log = log::insert(['tipo'=>'delete_user','usuario'=>auth()->user()->nick,'nombre'=>auth()->user()->nombre]);

        return redirect()->action('App\Http\Controllers\UsuariosController@index')->with(['mensaje'=>'El usuario se ha borrado correctamente']);
    }

    //funcion que imprime en pdf un listado de usuarios

    public function imprimirpdf()
    {
        
        $usuarios = DB::table('users')->get(); 
        $pdf = PDF::loadView('/usuariosPDF',['usuarios'=>$usuarios]);

        return $pdf->download('usuariosPDF.pdf');
    }

    //funcion que exporta una lista de usuarios en xml
    public function exportarXML()
    {
        return Excel::download(new UsersExport, 'usuarios.xlsx');
        //return (new UsersExport)->download('usuarios.xlsx');
        // o bien tambien tenemos esta opcion
        //return new UsersExport;
    }

    public function crearEmail($correo)
    {
        //nos devuelve la vista formaulario para crear el email
        return view('enviarEmail',['correo' =>$correo]);
    }

    
    public function enviarEmail(Request $request)
    {
        //creamos la vista del mensaje con los datos del formulario que pasamos al constructor de nuestro Mailable
        $correo = new ContactoMailable($request->asunto,$request->mensaje);
        Mail::to($request->direccion)->send($correo);
        return redirect()->action('App\Http\Controllers\UsuariosController@index')->with(['mensaje'=>'El email se ha enviado correctamente']);
    }
}
