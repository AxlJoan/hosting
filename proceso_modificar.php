<?php
    include("database-imagen.php");

    $id = $_REQUEST['id'];

    $nombre = $_POST['nombre'];
    $imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));

    $query = "UPDATE tabla_imagen SET nombre='$nombre', imagen='$imagen' WHERE id='$id'";
    $resultado = $conn->query($query);

    if($resultado){
        header("Location: mostrar.php");
    }else{
        echo "No se subió correctamente";
    }


?>
