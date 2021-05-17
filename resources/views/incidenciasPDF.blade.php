<!DOCTYPE html>
<html lang="es">
<head>
<title>Listado de Incidencias</title>
</head>
<style>
    
    thead{
        background-color:  #cec0de ;
    }
</style>
<body>
      <h1>Listado de Incidencias en ServiceDesk</h1> 
    <div class="cuerpo"> 
        <table class="tabla">
            <thead>
                <tr>
                    <th>ID/Estado</th>
                    <th>Prioridad</th>
                    <th>Problema</th>
                    <th>Email</th>
                    <th>Apellidos y Nombre</th>
                    <th>Dpto</th>
                    <th>Fecha Creacion</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($incidencias as $incidencia)
                <tr>
                    <td class="text-center">{{$incidencia->id}}/{{$incidencia->estado}}</td>
                    <td class="text-center">{{$incidencia->prioridad}}</td>
                    <td class="text-center">{{$incidencia->descripcion}}</td>
                    <td class="text-center">{{$incidencia->usuario->email}}</td>
                    <td class="text-center">{{$incidencia->usuario->apellidos}},{{$incidencia->usuario->nombre}}</td>
                    <td class="text-center">{{$incidencia->ubicacion}}</td>
                    <td class="text-center">{{$incidencia->fecha}}</td>
                @endforeach 
            </tbody>
        </table>
        
    </div> 
               
</body>
</html>