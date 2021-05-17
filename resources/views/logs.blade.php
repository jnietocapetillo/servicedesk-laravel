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
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Fecha&nbsp;&nbsp;<a href="#"><i class="fas fa-sort-numeric-down"></i></a>&nbsp;&nbsp;<a href="#"><i class="fas fa-sort-numeric-up"></i></a></th>
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
    <!-- añadimos paginado -->
    <div class="d-flex flex-row justify-content-center">
        {{$logs->links()}}
    </div>
    <div style="padding-top: 20px; padding-bottom:20px; text-align:center;">
    <a href="/logspdf" title="Imprimir"><img src="{{ '../storage/img/pdf.png' }}" width="40px" height="47px"></a>
    <a href="/logsXML" title="Imprimir"><img src="{{ '../storage/img/excel.jpg' }}" width="40px" height="47px"></a></div>
    <div style="padding-top: 20px; padding-bottom:20px; text-align:center;">
    <a href="/logs_delete" title="Eliminar"><img src="{{ '../storage/img/eliminar.png' }}" width="40px" height="40px"></a></div>
@include('include/footer')
               
</body>
</html>