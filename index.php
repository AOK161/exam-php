<?php
session_start();
require "functions/coach-function.php";
include 'functions/bdd-function.php';
require 'functions/player-function.php';
$bdd = bddConnect();

$reponse = $bdd->query('SELECT * FROM team ORDER BY poste LIMIT 23');
$resultats = $reponse->fetchAll();
?>

<html>
<head>
    <?php
    include 'parts/global-stylesheets.php'
    ?>
</head>
<body>
<div class="container">
    <div class="col- d-flex justify-content-end my-3">
        <button type="button" class="btn btn-primary"><a href="login.php" class="text-white text-decoration-none">Se connecter en tant que sélectionneur</a></button>
    </div>
<h1>Voici la liste des joueurs qui sont selectionnés pour l'Euro 2021</h1>
    <h3 class="d-flex justify-content-center my-5">Sélectionneur : Didier DESCHAMPS</h3>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Poste</th>
        </thead>
        <tbody>
        <?php

        foreach ($resultats as $result) {

            echo '<tr>
            <th scope="row">'.$result["id"].'</th>
            <td>'.$result["prenom"].'</td>
            <td>'.$result["nom"].'</td>
            <td>'.date_diff(date_create($result["date_naissance"]), date_create('now'))->y .'</td>
            <td>'.$result["poste"].'</td>
        </tr>';
        };
        ?>
        </tbody>
    </table>
</body>
</div>
</html>
