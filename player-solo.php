<?php
session_start();
try {
    $bdd = new PDO("mysql:dbname=exam_pdo;host=localhost", "root", "");
    $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $bdd;
} catch (\Exception $e){
    echo('Impossible de se connecter !!! ');
    throw $e;
}
$idPlayer = $_GET["id"];

$query = $bdd->prepare("SELECT * FROM team WHERE id = :id");
$query->execute(["id" => $idPlayer]);

$player = $query->fetchAll();
?>
<head>
    <?php
    include 'parts/global-stylesheets.php'
    ?>
</head>
<body>
<div class="container">
    <h1>La page de : <?php echo($player["prenom"]) ?></h1>
    <h3>La carte du joueur au complet </h3>
    <p>Date de naissance du joueur<?php echo($player["date_naissance"]) ?></p>
    <a href="index.php">Revenir à la page d'acceuil</a>
</div>


<?php
include 'parts/global-scripts.php'
?>

</div>
</body>
</html>