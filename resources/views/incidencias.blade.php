<!DOCTYPE html>
<html lang="es">
@include('include/head')
<body>
@include('include/header') 
    @if (session('mensaje'))
    <div class="alert alert-success text-center text-dark">{{ session('mensaje') }}</div>
    @endif    
    <div class="d-flex justify-content-center my-3"> 
        <table class="table">
            <thead class="thead-dark text-center">
                <tr>
                    <th>ID/Estado</th>
                    <th>Prioridad</th>
                    <th>Problema</th>
                    <th>Email</th>
                    <th>Apellidos y Nombre</th>
                    <th>Dpto</th>
                    <th>Fecha Creacion&nbsp;&nbsp;<a href="{{ route('incidencias') }}"><i class="fas fa-sort-numeric-down"></i></a>&nbsp;&nbsp;<a href="{{ route('incidenciasDes') }}"><i class="fas fa-sort-numeric-up"></i></a></th>
                    <th>Operaciones</th>
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
                    <td class="text-center"><a href="{{route('detalle.incidencia',['id'=>$incidencia->id])}}" title="Modificar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                            @if (Auth::user()->perfil == 'admin') <a href="{{route('incidencia.delete',['id'=>$incidencia->id])}}" title="Eliminar"><i class="fas fa-trash-alt"></i></a>&nbsp;&nbsp;
                                            @endif
                                            <a href="#" title="Enviar Correo"><i class="far fa-envelope"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div> 
    <!-- añadimos paginado -->
    <div class="d-flex flex-row justify-content-center">
    
        
            {{$incidencias ->links()}}

    
    </div>
     <div style="padding-top: 20px; padding-bottom:20px; text-align:center;"><a href="/incidenciaspdf" title="Imprimir"><img src="../storage/img/pdf.png" width="40px" height="47px"></a>
    <a href="/incidenciasXML" title="Imprimir"><img src="{{ '../storage/img/excel.jpg' }}" width="40px" height="47px"></a></div>
    @include('include/footer')
               
</body>
</html>