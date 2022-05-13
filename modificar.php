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
        <title>Show your Halo Infinite Spartan</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br>Bienvenido <?= $user['email'] ?>
      <br> Has ingresado sesión existosamente
      <a href="logout.php">Cerrar sesión</a>
            <?php
                include("database-imagen.php");

                $id = $_REQUEST['id'];

                $query = "SELECT * FROM tabla_imagen WHERE id='$id'";
                $resultado = $conn->query($query);
                $row = $resultado->fetch(PDO::FETCH_ASSOC);
            ?>
      <center>
          <form action="proceso_modificar.php?id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
              <input type="text"  name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']; ?>"/>
              <img height="400px" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']); ?>"/>
              <input type="file"  name="Imagen"/>
              <input type="submit" value="Aceptar"/>
          </form>
      </center>
    <?php else: ?>
        <h1>Please Login or Sign up</h1>

        <a href="login.php">Login</a> or
        <a href="signup.php">Sign up</a>
    <?php endif; ?>
    </body>
</html>