<?php
    include("database-imagen.php");

    $id = $_REQUEST['id'];

    $query = "DELETE tabla_imagen WHERE id='$id'";
    $resultado = $conn->query($query);

    if($resultado){
        header("Location: mostrar.php");
    }else{
        echo "No se subió correctamente";
    }


?>