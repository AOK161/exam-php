<?php
session_start();
require 'functions/coach-function.php';
require 'functions/bdd-function.php';
require 'functions/player-function.php';

checkAuthentification();

$types = [
    'Gardien',
    'Défenseur',
    'Milieu',
    'Attaquant'
];

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bdd = bddConnect();

    $uniqName = null;
    if (empty($_POST["prenom"])) {
        $errors[] = "Veuillez saisir un prenom";
    }

    if (empty($_POST["nom"])) {
        $errors[] = "Veuillez saisir un nom";
    }

    if (empty($_POST["date_naissance"])) {
        $errors[] = "Veuillez saisir une date de naissance";
    }

    if (empty($_POST["poste"])) {
        $errors[] = "Veuillez choisir un poste";
    }

    $query =
        $bdd->prepare("INSERT INTO team (prenom , nom, date_naissance, poste)
            VALUES (:prenom, :nom, :date_naissance, :poste)");
    $query->execute([
        "prenom" => $_POST["prenom"],
        "nom" => $_POST["nom"],
        "date_naissance" => $_POST["date_naissance"],
        "poste" => $_POST["poste"]
    ]);
    header("Location: coach-dashboard.php");
}
?>

<html>
<head>
    <?php
    include 'parts/global-stylesheets.php'
    ?>
</head>
<body>
<div class="container">
    <h1>Ajouter un joueur à la liste</h1>
    <form enctype="multipart/form-data" method="post" action="add.php">
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input name="prenom" type="text" class="form-control" id="prenom">
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input name="nom" type="text" class="form-control" id="nom">
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input name="date_naissance" type="date" class="form-control" id="date_naissance">
        </div>
        <select id="poste" name="poste" class="form-select mb-3">
            <option selected>Quel poste ?</option>
            <?php
            foreach ($types as $type) {
                echo('<option value="' . $type . '">' . $type . '</option>');
            }
            ?>
        </select>
        <button type="submit" class="btn btn-success">Ajouter le joueur</button>
    </form>
    <a href="coach-dashboard.php">Retour au dashboard</a>
    <?php
    foreach ($errors as $error) {
        echo('<div class="alert alert-danger" role="alert">
  ' . $error . '
</div>');
    }
    ?>

</div>

<?php
include 'parts/global-scripts.php';
?>
</body>
</html>