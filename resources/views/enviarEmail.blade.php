<!DOCTYPE html>
<html lang="es">
@include('include/head')

<body>
    
@include('include/header')
 
<div class="d-flex justify-content-center my-3"> 
    <div class="card mb-3" style="width: 900px !important">
        <div class="row g-0">
            <div class="col-md-2 d-flex align-items-center">
                <img src="{{ '../storage/img/email.jpg' }}" width="70px" height="70px">
            </div>
            <div class="col-md-8">
                <form action="{{ route('enviar.email') }}" method="post">
                @csrf
                    <label for="direccion">Destinatario: <input type="text" id="direccion" name="direccion" size="30" class="form-control" value="{{ $correo }}"></label><br>
                    <label for="asunto">Asunto: <input type="text" id="asunto" name="asunto" size="50" class="form-control"></label><br>
                    <label for="mensaje">Mensaje: <textarea name="mensaje" id="mensaje" class="form-control"></textarea><br>
                    <input type="submit" name="enviar" class="btn btn-success" value="Enviar">
                </form>
            </div>
        </div>
    </div>
</div> 
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
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