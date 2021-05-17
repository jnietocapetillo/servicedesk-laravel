<!DOCTYPE html>
<html lang="es">
<head>
<title>Listado de Log del Sistema</title>
</head>
<style>
    
    thead{
        background-color:  #cec0de ;
    }
</style>
<body>
    <h1>Listado de Log del Sistema</h1> 
    <div>      
        <table>
            <thead class="thead-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Nick</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td class="text-center">{{$log->id}}</td>
                    <td class="text-center">{{$log->tipo}}</td>
                    <td class="text-center">{{$log->fecha}}</td>
                    <td class="text-center">{{$log->usuario}}</td>
                    <td class="text-center">{{$log->nombre}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>               
</body>
</html>