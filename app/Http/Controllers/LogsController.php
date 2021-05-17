<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\log;
use PDF;
use App\Exports\logsExport;
use Maatwebsite\Excel\Facades\Excel;

class LogsController extends Controller
{
    //funcion en constructor para impedir el acceso a usuarios no logueados
    public function __construct()
    {
        $this->middleware('auth');
    }

    //fucion que trae los log de la base de datos y los pasa a la vista para mostrarlos paginados
    public function index()
    {
        $logs = DB::table('logs')->paginate(10);
        return view ('logs',['logs'=>$logs]);

    }

    //muestra la vista de aviso para eliminar los logs
    public function eliminar()
    {
        return view('delLogs');
    }

    //funcion que elimina todos los logs de la base de datos
    public function logs_delete(Request $request)
    {
        //cogemos el primer registro
        $log_primero = log::first('id')->first();
        //cogemos el ultimo log introducido
        $log_ultimo = log::latest('id')->first();
        
        //var_dump($log_primero->id);die();
        
        //borramos todos los que sea igual o menor al último, todos
        for ($i=$log_primero->id; $i<=$log_ultimo->id; $i++)
            $logs = log::where('id',$i)->delete();
        
        //actualizamos tabla logs
        $log = log::insert(['tipo'=>'delete_logs','usuario'=>auth()->user()->nick,'nombre'=>auth()->user()->nombre]);
        return redirect()->action('App\Http\Controllers\LogsController@index')->with(['mensaje'=>'Se han eliminado todas las entradas de Logs']);
    }

    //funcion que imprime en pdf un listado de los log
    public function imprimirpdf()
    {
        
        $logs = DB::table('logs')->get(); 
        $pdf = PDF::loadView('/logsPDF',['logs'=>$logs]);

        return $pdf->download('logsPDF.pdf');
    }

    //funcion que exporta a excel un listado de logs del sistema
    public function exportarXML()
    {
        return Excel::download(new logsExport, 'logs.xlsx');
        //return (new logsExport)->download('logs.xlsx');
        // o bien tambien tenemos esta opcion
        
    }

}
