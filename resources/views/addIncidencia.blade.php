<!DOCTYPE html>
<html lang="es">
@include('include/head')

<body>
    
@include('include/header') 

<div class="alert alert-warning text-center">Abrir Incidencia</div>
@if (session('mensaje'))
    <div class="alert alert-success text-center text-dark">{{ session('mensaje') }}</div>
@endif
   
    <div class="container d-flex justify-content-center my-4">
        <form action="{{ route('incidencia.add') }}" method="POST" name="formUser" enctype="multipart/form-data">
        @csrf
            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="titulo">Titulo: <input type="text" class="form-control" name="titulo" value="">
            @error('titulo')<div class="alert alert-danger">{{$message}}</div>@enderror</label>

            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="estado">Estado: <select class="form-control" name="estado" value="">
                                                                                                                  <option value=""></option>
                                                                                                                  <option value="Abierta">Abierta</option>
                                                                                                                  <option value="En Resolucion">En Resolucion</option>
                                                                                                                  <option value="En Espera">En Espera</option>
                                                                                                                  <option value="Finalizada">Finalizada</option></select>
            @error('estado')<div class="alert alert-danger">{{$message}}</div>@enderror</label><br>

            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="fecha">Fecha: <input type="date" class="form-control" name="fecha" value="{{ date('Y-d-m')}}">
            </label><br>

            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="descripcion">Descripcion: <textarea class="form-control" name="descripcion" id="descripcion" cols="50" rows="8" value=""></textarea>
            @error('descripcion')<div class="alert alert-danger">{{$message}}</div>@enderror</label><br>

            

            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="prioridad">Prioridad: <select name="prioridad" class="form-control" value="" >
                                                                                                            <option value=""></option>
                                                                                                            <option value="alta">Alta</option>
                                                                                                            <option value="normal">Normal</option>
                                                                                                            <option value="baja">Baja</option></select>
            @error('prioridad')<div class="alert alert-danger">{{$message}}</div>@enderror</label><br>

            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="ubicacion">Ubicación: <select name="ubicacion" class="form-control" value="">
                                                                                                            <option value=""></option>
                                                                                                            <option value="Informatica">Informatica</option>
                                                                                                            <option value="Administracion">Administracion</option>
                                                                                                            <option value="Tecnico">Tecnico</option>
                                                                                                            <option value="Contabilidad">Contabilidad</option>
                                                                                                            <option value="Calidad-Seguridad">Calidad-Seguridad</option>
                                                                                                            <option value="RRHH">RRHH</option></select>
            @error('ubicacion')<div class="alert alert-danger">{{$message}}</div>@enderror</label><br>

            <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="imagen">Añadir imagen: <input type="file" class="form-control" name="imagen"></label><br>
            <input type="submit" class="btn btn-dark" value="Registrar" name="ok">
            <a href="/"><button type="button" class="btn btn-secondary" name="volver">Volver</button></a>
        </form>
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script>
        ClassicEditor
        .create(document.querySelector('#descripcion'))
        .catch(error => {
            console.error(error);
        });
        </script>
    </div>
@include('include/footer')
               
</body>

</html>