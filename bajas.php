<?php
    //Sesión no activa se redirecciona a login
    session_start();
   if(@$_SESSION['tipo']!="admin")
       header('Location: index.php');
    //Conectar al servidor Mysql y a la base de datos
    include ("conexion.php");
    $conexion = conectar();
    //Sentencia de consulta SQL (Elimina un usuario y su info)
    $sql = "DELETE FROM usuario WHERE idu=".$_GET['id'];
    //echo $sql;
    //Verifica y ejecuta consulta
    include ("conexion2.php");
        $conexion2 = conectar2();
        $conexion2->query($sql);
    if ($conexion->query($sql) === TRUE){
        echo "<script type=\"text/javascript\">alert(\"Eliminado\");</script>";
        echo "<script type=\"text/javascript\">window.location=\"administrar.php\";</script>";
    } else {
        //echo 'Error: '. $sql . '<br>'.$conexion->error;
        echo "<script type=\"text/javascript\">alert(\"Intente mas tarde\");</script>";
        echo "<script type=\"text/javascript\">window.history.back();</script>";
    }
    mysqli_close($conexion);
?>