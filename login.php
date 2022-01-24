<?php
session_start();
require 'functions/bdd-function.php';
require 'functions/coach-function.php';
$bdd = bddConnect();
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (empty($_POST["username"])) {
        $errors[] = "Veuillez rentrer un nom d'utilisateur";
    }
    if (empty($_POST["password"])) {
        $errors[] = "Veuillez rentrer un mode de passe";
    }

    $user = getUserByUsername($bdd, $_POST["username"]);

    if(!$user){

    $errors[] = "Identifiants inconnus";

} else {

        if (!password_verify($_POST["password"], $user["password"])) {
            $errors[] = "Pas les bons identifiants";
        } else {
            $_SESSION["username"] = $user;
            header('Location: coach-dashboard.php');
        }
    }
}
?>

<html>
<head>
    <?php
    include 'parts/global-stylesheets.php'
    ?>
    <?php
    include 'parts/global-css.php';
    ?>
</head>
<body>
<div class="container">
    <h1>LOGIN</h1>

    <form method="post" action="login.php">
        <label for="username">Indiquez votre nom d'utilisateur</label>
        <input id="username" type="text" name="username" class="form-control">
        <label for="password">Indiquez votre mot de passe</label>
        <input id="password" type="password" name="password" class="form-control">

        <input type="submit" class="btn btn-success mt-3"><br>
    </form>
    <?php
        foreach ($errors as $error){
            echo ('<div class="alert alert-danger" role="alert">'.$error.'
</div>');
        }
    ?>
    <a href="index.php">Revenir à la page d'acceuil</a>
</div>

<?php
include 'parts/global-scripts.php';
?>
</body>
</html>