<!DOCTYPE html>
<html lang="es">
@include ('include/head')

<body>
    
@include ('include/header') 
    @if (session('mensaje'))
    <div class="alert alert-success text-center text-dark">{{ session('mensaje') }}</div>
    @endif 
    <div class="d-flex justify-content-center my-3"> 
        <table class="table">
            <thead class="thead-light text-center">
                <tr>
                    <th>Usuario</th>
                    <th>Perfil</th>
                    <th>Departamento</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Imagen</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td class="text-center">{{$usuario->nick}}</td>
                    <td class="text-center">{{$usuario->perfil}}</td>
                    <td class="text-center">{{$usuario->departamento}}</td>
                    <td class="text-center">{{$usuario->nombre}}</td>
                    <td class="text-center">{{$usuario->apellidos}}</td>
                    <td class="text-center">{{$usuario->email}}</td>
                    <td class="text-center">{{$usuario->imagen}}</td>
                    <td class="text-center"><a href="/usuarios/{{$usuario->id}}" title="Modificar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                        @if ($usuario->id != Auth::user()->id)<a href="/user_delete/{{$usuario->id}}"><i class="fas fa-trash-alt"></i></a>@endif
                        &nbsp;&nbsp;<a href="/email/{{$usuario->email}}" title="Enviar Correo"><i class="far fa-envelope"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div> 
    <div class="d-flex flex-row justify-content-center">
        {{$usuarios->links()}}
    </div>
    
    <div style="padding-top: 20px; padding-bottom:20px; text-align:center;"><a href="/usuariospdf" title="Imprimir"><img src="../storage/img/pdf.png" width="40px" height="47px"></a>
    <a href="/usuariosXML" title="Imprimir"><img src="{{ '../storage/img/excel.jpg' }}" width="40px" height="47px"></a></div>
    @include ('include/footer')
               
</body>
</html>