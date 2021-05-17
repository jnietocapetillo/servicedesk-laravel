<!DOCTYPE html>
<html lang="es">
@include ('include/head')

<body>
    
@include ('include/header') 
         

<div class="alert alert-warning text-center text-dark">Detalle Usuario</div>
@if (session('mensaje'))
    <div class="alert alert-success text-center text-dark">{{ session('mensaje') }}</div>
@endif
<div class="container d-flex justify-content-center my-4">

    <form action="{{ route('usuario.update') }}" method="POST" name="formAddUser" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$detalle->id}}">
        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="usuario">Nombre de Usuario: <input type="text" class="form-control" name="usuario" value="{{$detalle->nick}}">
        </label><br>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="nombre">Nombre: <input type="text" class="form-control" name="nombre" value="{{$detalle->nombre}}">
        </label>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="apellidos">Apellidos: <input type="text" class="form-control" name="apellidos" value="{{$detalle->apellidos}}"> 
        </label><br>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="email">Email: <input type="text" class="form-control" name="email" value="{{$detalle->email}}"> 
        </label><br>


        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="departamento">Departamento: <select name="departamento" class="form-control">
                                                                                                                  <option>{{$detalle->departamento}}</option>
                                                                                                                  <option value="informatica">Informatica</option>
                                                                                                                  <option value="administracion">Administracion</option>
                                                                                                                  <option value="tecnico">Tecnico</option>
                                                                                                                  <option value="contabilidad">Contabilidad</option>
                                                                                                                  <option value="calidad">Calidad-Seguridad</option>
                                                                                                                    <option value="RRHH">RRHH</option></select>
        </label>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="perfil">Perfil: <select name="perfil" class="form-control" disabled> 
                                                                                                            <option>{{$detalle->perfil}}</option>
                                                                                                                  <option value="user">Usuario</option>
                                                                                                                  <option value="admin">Administrador</option></select></label><br>
        
        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="imagen">Imagen actual:<input type="text" name="imagen" class="form-control" value="{{$detalle->imagen}}">
        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="nueva_imagen">Cambiar Imagen: <input type="file" class="form-control" name="nueva_imagen"></label><br>

        <input type="submit" name="ok" class="btn btn-dark" value="Modificar">
        <a href="{{ route('users') }}"><button type="button" class="btn btn-secondary" name="volver" value="Volver">Volver</button></a>
    </form>

</div>

@include('include/footer')
               
</body>

</html>