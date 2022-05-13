<?php
    require 'database.php';

    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);

        if($stmt->execute()){
            $message = 'Usuario exitosamente creado';
        }else{
            $message = 'Hubo un error creando el usuario';
        }

    }
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>Regristro</title>
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <?php require 'partials/header.php' ?>

        <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>

        <h1>Registrate</h1>
        <span> o <a href="login.php">Ingresa si ya tienes una cuenta</a></span>
        
        <form action="signup.php" method="post">
            <input type="text" name="email" placeholder="Ingresa tu correo electrónico">
            <input type="password" name="password" placeholder="Ingresa tu contraseña">
            <input type="password" name="confirm_password" placeholder="Confirma tu contraseña">
            <input type="submit" value="Ingresar">
    </body>
</html>