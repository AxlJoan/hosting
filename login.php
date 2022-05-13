<?php
    session_start();

    if(isset($_SESSION['user_id'])){
        header('Location: /proyecto-semestre');
    }

    require 'database.php';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: /proyecto-semestre');
        }else{
            $message = 'Lo siento, el usuario y/o contraseña son incorrectos';
        }

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <?php require 'partials/header.php' ?>
        <h1>Te damos la bienvenida</h1>
        <span> o <a href="signup.php">Registrate si aun no tienes una cuenta</a></span>

        <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif;?>

        <form action="login.php" method="post">
            <input type="text" name="email" placeholder="Ingresa tu correo electrónico">
            <input type="password" name="password" placeholder="Ingresa tu contraseña">
            <input type="submit" value="Ingresar">
    </body>
</html>