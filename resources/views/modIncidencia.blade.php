<!DOCTYPE html>
<html lang="es">

@include('include/head')

<body>
    
@include('include/header') 
    
<div class="alert alert-warning text-center text-dark">Modificar Incidencia</div>
@if (session('mensaje'))
    <div class="alert alert-success text-center text-dark">{{ session('mensaje') }}</div>
@endif
<div class="container d-flex justify-content-center my-4" style="width: 650px !important">
    <form action="{{ route('incidencia.update') }}" method="POST" name="formUser" enctype="multipart/form-data">
    @csrf
    <div class="d-flex flex-row justify-content-start">
        <input type="hidden" id='id' value="{{ $incidencia->id }}">
        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="imgactual">Imagen actual: <img src="{{ '../storage/img/'.$incidencia->imagen }}" width="60px" height="60px"/>
        
        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="imagen">Sustituir: <input type="file" name="imagen" class="form-control"></label>
                                                 
    </div>
    <div class="d-flex flex-row justify-content-between">
        <div class="p-2">
            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="id">ID: <input type="text" class= "form-control" name="id" value="{{ $incidencia -> id}}"></label>
        </div>
        <div class="p-2">
           <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="fecha">Fecha: <input type="text" class="form-control" name="fecha" value="{{ $incidencia -> fecha }}">
            </label>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-between">
        <div class="p-2"> 
            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="titulo">Titulo: <input type="text" class="form-control" name="titulo" value="{{ $incidencia->titulo }}">
            @error('titulo')<div class="alert alert-danger">{{$message}}</div>@enderror</label>
        </div>
        <div class="p-2">
            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="estado">Estado: <select class="form-control" name="estado">
                                                                                                                  <option>{{ $incidencia->estado }}</option>
                                                                                                                  <option value="Abierta">Abierta</option>
                                                                                                                  <option value="En Resolucion">En Resolucion</option>
                                                                                                                  <option value="En Espera">En Espera</option>
                                                                                                                  <option value="Finalizada">Finalizada</option></select>
            @error('estado')<div class="alert alert-danger">{{$message}}</div>@enderror</label>
        </div>
        <div class="p-2">
            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="prioridad">Prioridad: <select name="prioridad" class="form-control">
                                                                                                            <option>{{ $incidencia->prioridad }}</option>
                                                                                                            <option value="Alta">Alta</option>
                                                                                                            <option value="Normal">Normal</option>
                                                                                                            <option value="Baja">Baja</option></select>
            @error('prioridad')<div class="alert alert-danger">{{$message}}</div>@enderror</label>
        </div>    
    </div>
    <div class="d-flex flex-row justify-content-start">
         <div class="p-2">
            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="ubicacion">Ubicacion: <input type="text" name="ubicacion" class="form-control" value="{{ $incidencia ->ubicacion }}"></label> 
        </div>
    </div>
    <div class="d-flex flex-row justify-content-center">
        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="descripcion" >Descripción: <textarea class="form-control" name="descripcion" id="descripcion" rows="10" cols="100" >{{ $incidencia->descripcion }}</textarea>
        @error('descripcion')<div class="alert alert-danger">{{$message}}</div>@enderror</label>
    </div> 
</div>           
    
        <div class="alert alert-secondary text-center">Mensajes</div>
      <div class="d-flex flex-column justify-content-center">
        <div class="p-2">
          <table class="table">
            <thead>
                <tr>
                    <th>Perfil:</th>
                    <th>Para:</th>
                    <th>Mensaje:</th>  
                    <th>Fecha:</th>
                </tr>     
            </thead>
            <tbody>
                @foreach ($incidencia->mensajes as $mensaje)
                <tr>
                    <td>{{ $incidencia->usuario->perfil }}</td>
                    <td>{{ $incidencia->usuario ->nombre }} {{ $incidencia ->usuario ->apellidos }}</td>
                    <td>{{ $mensaje ->mensaje }}</td>
                    <td>{{ $mensaje -> fecha }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>     
        </div>
      </div>
        <div class="d-flex flex-column justify-content-center">
            <div class="p-2 mx-5">
            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="mensaje">Nuevo Mensaje: 
            <textarea id="mensaje" class="form-control" cols="250" rows="3" name="mensaje"></textarea></label>
            </div>
        </div>
      
     
    <div class="d-flex flex-row justify-content-center">
        <div class="p-2">
            <input type="submit" class="btn btn-dark" value="Actualizar" name="ok"/><br>
        </div>
        <div class="p-2">
            <a href="{{ route('incidencias') }}"><button type="button" class="btn btn-secondary" name="volver">Volver</button></a>
        </div>
    </div>
    </form>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
        .create(document.querySelector('#descripcion'))
        .catch(error => {
            console.error(error);
        });
    </script>
    <script>
        ClassicEditor
        .create(document.querySelector('#mensaje'))
        .catch(error => {
            console.error(error);
        });
    </script>

@include('include/footer')
               
</body>

</html>