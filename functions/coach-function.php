<?php
function getUserByUsername($bdd, $username){
    $query = $bdd->prepare('SELECT * FROM users WHERE username = :username');
    $query->execute(["username"=>$username]);
    $resultat = $query->fetch();

    return $resultat;
}

function checkAuthentification(){
    if(isset($_SESSION["users"])){
        header("Location: login.php");
    }
}
?>