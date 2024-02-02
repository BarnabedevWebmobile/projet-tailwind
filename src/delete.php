<?php

    // inclut le fichier PDO
    include 'pdo.php';
    // inclut le fichier PDO

    // variable sécurisant le get
    $fav=$_GET['favori'];
    // variable sécurisant le get

    // préparation de la requete de suppression
    $result = $pdo->prepare("DELETE FROM `favoris` WHERE id_fav=:fav ;");
    // préparation de la requete de suppression

    // execution de la requete preparée
    $favori = $result->execute(array(

        // préparation des éléments de la requete SQL
        ':fav' => $fav,
        // préparation des éléments de la requete SQL

    ));
    // execution de la requete preparée

    // redirection vers l'acceuil
    header('Location: index.php');
    exit();
    // redirection vers l'acceuil
?>