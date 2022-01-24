<?php
function getAllPlayers($bdd){
    $query = $bdd->query('SELECT * FROM team');
    $resultat = $query->fetchAll();
    return $resultat;
}

function getMyPlayers($bdd, $id){
    $query = $bdd->prepare('SELECT * FROM team WHERE prenom = :prenom');
    $query->execute(["id"=> $id]);
    $resultat = $query->fetchAll();

    return $resultat;
}

function getOnePlayer($bdd, $id){
    $query = $bdd->prepare('SELECT * FROM team WHERE id = :id');
    $query->execute(['id'=> $id]);

    $resultat = $query->fetch();

    return $resultat;
}

function deleteOne($bdd, $id){
    $query = $bdd->prepare('DELETE FROM team WHERE id = :id');
    $query->execute(['id'=> $id]);
}

?>
