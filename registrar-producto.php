<?php
    //Sesión activa se redirecciona a index 
    session_start();
    if(@$_SESSION['tipo']!="admin")
        header('Location: index.php');
    //Extraer valor de variables
    $array = array_keys($_POST);
    foreach ($array as $post) {
    	$$post = $_POST[$post];
    	//echo $_POST[$post];
    }
    
	//Conectar al servidor Mysql y a la base de datos tienda
        include ("conexion.php");
        $conexion = conectar();

        include ("conexion2.php");
        $conexion2 = conectar2();
    //Agregamos imagenes a la carpeta /imagenes/productos/
       if(is_file($_FILES['archivo']['tmp_name'])){
            copy($_FILES['archivo']['tmp_name'],"imagenes/productos/".$_FILES['archivo']['name']);
            echo "<script type=\"text/javascript\">alert(\"Imagen agregada\");</script>";
            //Sentencias de consulta SQL
            $sql = "INSERT INTO `producto`(`idp`, `idcat`, `nombre`, `descripcion`, `precio`, `existencia`, `promedio`, `imagen`) VALUES (NULL,'".$categoria."','".$nombre."','".$descripcion."',".$precio.",".$existencia.",0,'".$_FILES['archivo']['name']."')";
       }else{
            $sql = "INSERT INTO `producto`(`idp`, `idcat`, `nombre`, `descripcion`, `precio`, `existencia`, `promedio`, `imagen`) VALUES (NULL,'".$categoria."','".$nombre."','".$descripcion."',".$precio.",".$existencia.",0,'general.png')";
       }

        $result = $conexion2->query($sql);
        $result = $conexion->query($sql);
        if($result){
?>
    <script language="JavaScript">
    	window.alert("Registro exitoso");
    	window.location="productos.php";
	</script>	
<?php 	      
				}else{
?>
    <script language="JavaScript">
    	window.alert("Intente más tarde");
    	window.history.back();
	</script>	
<?php 	        	
	        }
    echo mysqli_error($conexion);
?>