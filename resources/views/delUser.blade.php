<!DOCTYPE html>
<html lang="es">
@include('include/head')

<body>
    
@include('include/header') 

<div class="d-flex justify-content-center my-3"> 

<div class="card">
  <h3 class="card-header text-danger text-center">Eliminar Usuario</h3>
  <div class="card-body">
    <h4 class="card-title">¿Desea continuar?</h4>
    <p class="card-text">** Si elimina el usuario, eliminará sus incidencias **</p>
    <div class="d-flex flex-row justify-content-center mx-2">
        <div class="p-2">
            <form action="{{ route('user_delete') }}" method="POST">
                <input type="hidden" name="id" value="{{$usuario->id}}">
                <input type="submit" class="btn btn-warning" value="Eliminar" name="ok"><br>
            </form>
        </div>
        <div class="p-2">
            <a href="{{ route('users') }}"><button type="button" class="btn btn-success">Cancelar</button></a>
        </div>
    </div>
  </div>
</div>
</div>
      <div class="d-flex justify-content-center my-3"> 
        <div class="p-2">
            <a href="{{ route('users') }}"><button type="button" class="btn btn-success">Volver</button></a>
        </div>
      </div>

@include('include/footer')

</body>
</html>