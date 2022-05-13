<?php
    session_start();

    require 'database.php';

    if(isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0){
            $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Galería de Spartans</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br>Imagenes subidas
      <a href="logout.php">Cerrar sesión</a>
      <center>
            <table border="5px">
                <thead>
                    <tr>
                        <th colspan="5"><a href="index.php">Nuevo</a></th>
                    </tr>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th colspan="2">Operaciones</th>
                    </tr>

                </thead>
                <tbody>
                <?php
                    include("database-imagen.php");

                    $query = "SELECT * FROM tabla_imagen";
                    $resultado = $conn->query($query);
                    while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><img height="400px" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']); ?>"/></td>
                        <th><a href="modificar.php?id=<?php echo $row['id']; ?>">Modificar</a></th>
                        <th><a href="eliminar.php?id=<?php echo $row['id']; ?>">Eliminar</a></th>
                    </tr>
                <?php
                    }
                ?>

                </tbody>
            </table>
      </center>
    <?php else: ?>
        <h1>Please Login or Sign up</h1>

        <a href="login.php">Login</a> or
        <a href="signup.php">Sign up</a>
    <?php endif; ?>
    </body>
</html>