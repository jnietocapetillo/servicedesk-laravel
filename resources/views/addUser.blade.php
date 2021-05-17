<!DOCTYPE html>
<html lang="es">
@include ('include/head')

<body>
    
@include ('include/header')
    

<div class="container d-flex justify-content-center my-4">

    <form action="index.php?accion=addUser" method="POST" name="formAddUser" enctype="multipart/form-data">
        {{csrf_field()}}
        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="usuario">Nombre de Usuario: <input type="text" class="form-control" name="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'];?>">
        <?php if (isset($_POST['ok'])) if (isset($error['usuario'])) echo '<div class="alert alert-danger">'.$error['usuario'].'</div>';?></label><br>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="pass">Contraseña: <input type="password" class="form-control" name="pass"> 
        <?php if (isset($_POST['ok'])) if (isset($error['pass'])) echo '<div class="alert alert-danger">'.$error['pass'].'</div>';?></label><br>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="pass1">Repite contraseña: <input type="password" class="form-control" name="pass1">
        <?php if (isset($_POST['ok'])) if (isset($error['pass'])) echo '<div class="alert alert-danger">'.$error['pass'].'</div>';?></label><br>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="nombre">Nombre: <input type="text" class="form-control" name="nombre" value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>">
        <?php if (isset($_POST['ok'])) if (isset($error['nombre'])) echo '<div class="alert alert-danger">'.$error['nombre'].'</div>';?></label><br>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="apellidos">Apellidos: <input type="text" class="form-control" name="apellidos" value="<?php if (isset($_POST['apellidos'])) echo $_POST['apellidos'];?>"> 
        <?php if (isset($_POST['ok'])) if (isset($error['apellidos'])) echo '<div class="alert alert-danger">'.$error['apellidos'].'</div>';?></label><br>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="dpto">Departamento: <select name="dpto" class="form-control" value="<?php if(isset($_POST['ok'])) echo $_POST['dpto'];?>">
                                                                                                                  <option value="0"></option>
                                                                                                                  <option value="informatica">Informatica</option>
                                                                                                                  <option value="administracion">Administracion</option>
                                                                                                                  <option value="tecnico">Tecnico</option>
                                                                                                                  <option value="contabilidad">Contabilidad</option>
                                                                                                                  <option value="calidad">Calidad-Seguridad</option>
                                                                                                                    <option value="RRHH">RRHH</option></select>
        <?php if (isset($_POST['ok'])) if (isset($error['dpto'])) echo '<div class="alert alert-danger">'.$error['dpto'].'</div>';?></label><br>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="email">Email: <input type="email" class="form-control" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>"> 
        <?php if (isset($_POST['ok'])) if (isset($error['email'])) echo '<div class="alert alert-danger">'.$error['email'].'</div>';?></label><br>

        <label class="text-dark" style="font-family: 'Open Sans Condensed', sans-serif;" for="imagen">Imagen: <input type="file" class="form-control" name="imagen"></label><br>

        <input type="submit" name="ok" class="btn btn-dark" value="Registrar">
        <a href="indexp.php"><button type="button" class="btn btn-secundary" value="Cancelar" name="volver"></button></a>
    </form>

</div>

<?php require 'includes/footer.php'; ?>
               
</body>

</html>