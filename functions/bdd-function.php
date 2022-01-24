<?php
function bddConnect()
{
    try {
        $bdd = new PDO("mysql:dbname=exam_pdo;host=localhost", "root", "");
        $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch (\Exception $e){
        echo('Impossible de se connecter !!! ');
        throw $e;
    }
};

function limited()
{
    if(id > 24) {

    }
}

?>