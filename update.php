<?php
session_start();
require 'functions/bdd-function.php';
require 'functions/player-function.php';
require 'functions/coach-function.php';

checkAuthentification();

$bdd = bddConnect();
$player = getOnePlayer($bdd, $_GET["id"]);


$types = [
    'Gardien',
    'Défenseur',
    'Milieu',
    'Attaquant'
];
$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["titre"])) {
        $errors[] = "Veuillez saisir un titre";
    }

    if (empty($_POST["contenu"])) {
        $errors[] = "Le contenu est vide";
    }

        $query =
            $bdd->prepare("UPDATE team SET prenom=:prenom, nom=:nom, date_naissance=:date_naissance, poste=:poste WHERE id=:id");
        $query->execute([
            "prenom" => $_POST["prenom"],
            "nom" => $_POST["nom"],
            "date_naissance" => $_POST["date_naissance"],
            "poste" => $_POST["poste"],
            "id"=> $player["id"]
        ]);

        header('Location: coach-dashboard.php');
}
?>
<html>
<head>
    <?php
    include 'parts/global-css.php';
    ?>
</head>
<body>
<div class="container">

    <h1>Modifier les information du joueur</h1>
    <div class="row">
        <div class="col- d-flex justify-content-end">
    <button type="button" class="btn btn-secondary me-2"><a href="coach-dashboard.php" class="text-white text-decoration-none">Retour au dashboard</a></button>
    <button type="button" class="btn btn-dark"><a href="logout.php" class="text-white text-decoration-none">Se déconnecter</a></button>
            </div>
    </div>

    <form enctype="multipart/form-data" method="post" action="update.php?id=<?php echo($player["id"]);?>">
        <div class="mb-3">
            <label for="titre" class="form-label">Prenom</label>
            <input value="<?php echo($player["prenom"]);?>" type="text" name="prenom"  class="form-control" id="prenom">
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input value="<?php echo($player["nom"]);?>" type="text" name="nom" class="form-control" id="nom ">
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input value="<?php echo($player["date_naissance"]);?>" type="date" name="date_naissance" class="form-control" id="date_naissance">
        </div>

        <div class="mb-3">
            <label for="poste" class="form-label">Poste</label>
            <select id="poste" name="poste" class="form-control">
                <?php
                foreach ($types as $type){
                    if($type == $player["type"]){
                        echo('<option selected value="'.$type.'">'.$type.'</option>');
                    } else{
                        echo('<option  value="'.$type.'">'.$type.'</option>');
                    }
                }

                ?>
            </select>
        </div>

        <input type="submit" class="btn btn-success">

    </form>

    <?php
    foreach ($errors as $error){
        echo('<div class="alert alert-danger" role="alert">
  '.$error.'
</div>');
    }
    ?>

</div>
</body>
