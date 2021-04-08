<?php
include('conexion.php');
//OBTIENE LOS DATOS DE CREAR.PHP
$correo = $_POST['email'];
$contraseña = $_POST['pass'];

//VERIFICA SI EL CÓDIGO QUE SE ENVIO AL USUARIO ES CORRECTO
$q = "select COUNT(*) as contar from login where correo = '$correo'";
$consulta = mysqli_query($con, $q);
$array = mysqli_fetch_array($consulta);
if ($array['contar'] <= 0) {
    //ENCRIPTA LA CONTRASEÑA
    $contraseñas =  password_hash($_POST['pass'], PASSWORD_DEFAULT, ['cost' => 5]);
    $q2 = "INSERT INTO login VALUES (NULL,'$correo','$contraseñas')";

    if (mysqli_query($con, $q2)) {
        echo '<script type="text/javascript">
        alert("Ya tiene una cuenta, felicidades ");
        window.location.href="../index.php";
        </script>';
    }
} else {
    //MANDA UNA ALERTA INDICANDO QUE EL CÓDIGO ESTA INCORRECTO
    echo '<script type="text/javascript">
    alert("Ya tiene una cuenta registrado ");
    window.location.href="../index.php";
    </script>';
}
?>