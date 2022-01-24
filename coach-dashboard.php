<?php
session_start();
require 'functions/coach-function.php';
require 'functions/bdd-function.php';
require 'functions/player-function.php';
checkAuthentification();
$bdd = bddConnect();



$reponse = $bdd->query('SELECT * FROM team');
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
    <h1>Le dashboard du sélectionneur</h1>
    <div class="row">
        <div class="col- d-flex justify-content-end">
            <button type="button" class="btn btn-success me-2"><a href="add.php" class="text-white text-decoration-none">Ajouter un joueur</a></button>
            <button type="button" class="btn btn-dark"><a href="index.php" class="text-white text-decoration-none">Se déconnecter</a></button>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prenom</th>
            <th scope="col">Nom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Poste</th>
            <th scope="col">Action</th>
        </thead>
        <tbody>
        <?php
        foreach ($resultats as $result) {

            echo '<tr>
            <th scope="row">'.$result["id"].'</th>
            <td>'.$result["prenom"].'</td>
            <td>'.$result["nom"].'</td>
            <td>'.$result["date_naissance"].'</td>
            <td>'.$result["poste"].'</td>
            <td>
            <button type="button" class="btn btn-warning me-2"><a href="update.php?id='.$result["id"].'" class="text-white text-decoration-none">Modifier</a></button>
            <button type="button" class="btn btn-danger"><a href="delete.php?id='.$result["id"].'" class="text-white text-decoration-none">Supprimer</a></button>
            </td>
        </tr>';
        };
        ?>
        </tbody>
    </table>
</div>
</body>
</html