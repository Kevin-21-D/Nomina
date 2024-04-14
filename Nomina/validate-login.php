<?php
session_start();

    // Connect to the database
    $host = "localhost";
    $db = "nomina_pro"; // Replace with your database name
    $user = "root"; // Replace with your database user
    $pass = ""; // Replace with your database password
    $charset = "utf8mb4";

    $host = "localhost";
    $db = "nomina_pro"; // Replace with your database name
    $user = "root"; // Replace with your database user
    $pass = ""; // Replace with your database password
    
    $host = "localhost";
    $db = "gtzarsmp_melonayfoforro_deusapacolombia";
    $user = "gtzarsmp_yshyvsev";
    $pass = "]p@5+N+0*_bB";

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);

    // Get the email and hashed password from the AJAX request
    $email = $_POST['email'];
    $hashedPassword = $_POST['password'];

    // Query the database to get the user's role based on their email and hashed password
    $stmt = $pdo->prepare("SELECT IDrol, IDusuario FROM usuario WHERE Correo = :email AND Contraseña = :password LIMIT 1");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['usuario'] = $user['IDusuario'];
        $_SESSION['tipo'] = $user['IDrol'];
        if ($_SESSION['tipo'] == 3) {
            header("Location: admin/index-admin.php");
            exit();
        }
        if ($_SESSION['tipo'] == 2) {
            header("Location: admin/index-admin.php");
            exit();
        }
        if ($_SESSION['tipo'] == 1) {
            header("Location: admin/index-admin.php");
            exit();
        }
    }
    else
    {
        echo"<script>alert('Credenciales invalidas o usuario inactivo.')</script>";
        echo"<script>window.location='index_iniciar_sesion.html'</script>";
        exit();
    }
?>