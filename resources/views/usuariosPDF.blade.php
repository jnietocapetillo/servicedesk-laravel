<!DOCTYPE html>
<html lang="es">
<head>
<title>Listado de Usuarios</title>
</head>
<style>
    
    thead{
        background-color:  #cec0de ;
    }
</style>
<body>
      <h1>Listado de Usuarios en ServiceDesk</h1> 
    <div class="cuerpo"> 
        <table class="tabla">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Perfil</th>
                    <th>Departamento</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td class="text-center">{{$usuario -> nick}}</td>
                    <td class="text-center">{{$usuario -> perfil}}</td>
                    <td class="text-center">{{$usuario -> departamento}}</td>
                    <td class="text-center">{{$usuario -> nombre}}</td>
                    <td class="text-center">{{$usuario -> apellidos}}</td>
                    <td class="text-center">{{$usuario -> email}}</td>
                @endforeach 
            </tbody>
        </table>
        
    </div> 
               
</body>
</html>