<?php

namespace App\Http\Controllers;
use App\Models\incidencia;
use App\Models\mensaje;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Suppport\Facades\Storage;
use Illuminate\Http\File;
use App\Models\log;
use PDF;
use App\Exports\IncidenciasExport;
use Maatwebsite\Excel\Facades\Excel;

class IncidenciasController extends Controller
{
    //configuramos en el constructor del controlador el control de acceso a las funciones de
    //nuestro controlador por si el usuario no está logueado en el sistema
    public function __construct()
    {
        $this->middleware('auth');
    }

    //funcion que obtiene todos las incidencias y las envia paginadas a la vista corresppondiente
    public function index()
    {
        //dependiendo si es administrador o no podrá ver sus incidencias o todas
        if (auth()->user()->perfil == 'admin')
        {
            $incidencias = incidencia::paginate(5);
        }
        else
        {
            //sacamos las incidencias del usuario que está logado
            $incidencias = incidencia::where('id_usuario',auth()->user()->id)->paginate(5);
        }
        //pasamos los datos a la vista de incidencias        
        return view('incidencias',['incidencias'=>$incidencias]);
    }

    // funcion que nos devuelve la lista de incidencias ordenadas de forma descendiente y paginada
    public function desc()
    {
        //sacamos las incidencias del usuario que está logado
        $incidencias = incidencia::where('id_usuario',auth()->user()->id)->orderBy('id','DESC')->paginate(5);
        //pasamos los datos a la vista de incidencias        
        return view('incidencias',['incidencias'=>$incidencias]);
    }

    //fiuncion detalle que nos muestra la incidencia pasada por parámetros
    public function detalle($id)
    {
        //obtenemos la incidencia con el id $id
        $incidencia = incidencia::where('id',$id)->first();
        //obtenemos los mensajes de dicha incidencia
        
        //$mensajes = DB::table('mensajes')->where('id_incidencia',$id)->get();
        //foreach($incidencia->mensajes as $mensaje)
        //var_dump($mensaje->mensaje);

        
        //var_dump($incidencia->usuario->nombre);
        //die();
        //cargamos la vista de detalle de incidencia
        return view('modIncidencia',['incidencia'=>$incidencia]);
    }

    //funcion que nos permite visualizar la vista para poder agregar una nueva incidencia 
    public function agregar()
    {
        return view('addIncidencia');
    }

    //función que agrega una incidencia recogiendo los datos de un formulario y validadndo dichos datos

    public function addIncidencia(Request $request)
    {
        $id = auth()->user()->id;
        
        //validamos los datos introducidos
        $validate = $this -> validate($request,[
            'titulo'=>'required|string|max:255',
            'prioridad' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'ubicacion' => 'required|string|max:255'
        ]);
        
        $file = $request->file('imagen');
        if ($file)
        {
            $file_name = $file->getClientOriginalName();
            $file ->move('storage/img/',$file_name);
          
        }
        else $file_name ='unnamed.png';

        $incidencia = incidencia::insert(['prioridad'=>$request->prioridad, 'estado'=>$request->estado,
                                          'titulo'=>$request->titulo, 'ubicacion'=>$request->ubicacion,
                                          'descripcion'=>$request->descripcion,'imagen'=>$file_name,
                                          'id_usuario'=>$id]);

        //actualizamos tabla logs
        $log = log::insert(['tipo'=>'create_incidencia','usuario'=>auth()->user()->nick,'nombre'=>auth()->user()->nombre]);
        
        //sacamos el id de la incidencia que acabamos de insertar
        $id_incidencia = incidencia::latest('id')->first();
        return redirect()->route('detalle.incidencia',['id'=>$id_incidencia])
                         ->with(['mensaje'=>'Se ha agregado la incidencia']);
    }

    //nos permite actualizar los campos de una incidencia
    public function actualizar(Request $request)
    {
        $id = $request->id;
        //validamos campos
        $validate = $this -> validate($request,[
            'titulo'=>'required|string|max:255',
            'prioridad' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
        ]);

        
        if ($request->imagen != null )
        {
            $file = $request->file('imagen');
            $file_name = $file->getClientOriginalName();
            $file ->move('storage/img/',$file_name);
          
        }
        else $file_name ='unnamed.png';
        
        $incidencia = incidencia::where('id',$id)->update(array('fecha' => $request->fecha,
                                                    'prioridad' => $request->prioridad,
                                                    'estado' => $request -> estado,
                                                    'titulo' => $request->titulo,
                                                    'ubicacion' => $request->ubicacion,
                                                    'descripcion' => $request ->descripcion,
                                                    'imagen' =>$file_name));

        //actualizamos tabla logs
        $log = log::insert(['tipo'=>'update_incidencia','usuario'=>auth()->user()->nick,'nombre'=>auth()->user()->nombre]);

        //guardamos el mensaje en el caso que se haya puesto
        if (isset($request->mensaje))
        {
            $mensaje = mensaje::insert(['mensaje'=>$request->mensaje, 'usuario_id' =>auth()->user()->id, 'incidencia_id' =>$request->id]);

            //actualizamos tabla logs
            $log = log::insert(['tipo'=>'create_mensaje','usuario'=>auth()->user()->nick,'nombre'=>auth()->user()->nombre]);
        }
        return redirect()->action('App\Http\Controllers\IncidenciasController@detalle',$id)->with(['mensaje'=>'La incidencia se ha actualizado correctamente']);
    }

    //funcion que muestra la vista donde podemos eliminar lla incidencia pasada por parámetros
    public function eliminar($id)
    {
        $incidencia = incidencia::where('id',$id)->first();
        return view('delIncidencia',['incidencia'=>$incidencia]);

    }

    //funcion que elimina la incidencia seleccionada

    public function incidencia_delete(Request $request)
    {
        
        $incidencia = incidencia::find($request->id);
        $incidencia->delete();

        //borramos los mensajes relacionados con la incidencia a eliminar
        $mensajes = mensaje::where('incidencia_id',$request->id);
        $mensajes->delete();

        //actualizamos tabla logs
        $log = log::insert(['tipo'=>'delete_incidencia','usuario'=>auth()->user()->nick,'nombre'=>auth()->user()->nombre]);

        return redirect()->action('App\Http\Controllers\IncidenciasController@index')->with(['mensaje'=>'La incidencia se ha borrado correctamente']);
    }

    //funcion que nos permite imprimir en pdf un listado de incidencias
    public function imprimirpdf()
    {
        //dependiendo si es administrador o no podrá ver sus incidencias o todas
        if (auth()->user()->perfil == 'admin')
        {
            $incidencias = incidencia::get();
        }
        else
        {
            //sacamos las incidencias del usuario que está logado
            $incidencias = incidencia::where('id_usuario',auth()->user()->id)->get();
        }
        
        $pdf = PDF::loadView('/incidenciasPDF',['incidencias'=>$incidencias]);

        return $pdf->download('incidenciasPDF.pdf');
    }

    //función que nos exporta una lista de incidencias en formato excel
    public function exportarXML()
    {
        return Excel::download(new IncidenciasExport, 'inicidencias.xlsx');
        //return (new UsersExport)->download('usuarios.xlsx');
        // o bien tambien tenemos esta opcion
        //return new UsersExport;
    }


}
