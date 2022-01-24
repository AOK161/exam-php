<?php
require "functions/coach-function.php";
require "functions/player-function.php";
require "functions/bdd-function.php";

$bdd = bddConnect();
checkAuthentification();
$id = $_GET["id"];
deleteOne($bdd, $id);

header("Location: coach-dashboard.php");
