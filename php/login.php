<?php

require("conexion.php");
$correo = $_POST['email'];
$contraseña = $_POST['pass'];

$q = "select COUNT(*) as contar from login where correo = '$correo'";
$consulta = mysqli_query($con, $q);
$array = mysqli_fetch_array($consulta);

if ($array['contar'] > 0) {
    $q2 = "select * from login where correo = '$correo' ";
    $consulta2 = mysqli_query($con, $q2);
    while ($fila = $consulta2->fetch_array(MYSQLI_BOTH)) {
        $hash = $fila['contraseña'];

        if (password_verify($contraseña, $hash)) {

            session_start();
            $_SESSION['user'] = $correo;
            echo '<script type="text/javascript">
            alert("Bien ");
            window.location.href="../sesion.php";
            </script>';
        } else {

            echo '<script type="text/javascript">
            alert("Contraseña incorrecta ");
            window.location.href="../index.php";
            </script>';
        }
    }
} else {
    echo '<script type="text/javascript">
        alert("No se encuentra en la base de datos ");
        window.location.href="../index.php";
        </script>';
}
