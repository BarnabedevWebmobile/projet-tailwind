<?php
    // inclut le fichier PDO
    include 'pdo.php';
    // inclut le fichier PDO

    // variable sécurisant le get
    $del=$_GET['categorie'];
    // variable sécurisant le get

    // préparation de la requete de suppression
    $result = $pdo->prepare("DELETE FROM `categorie` WHERE id_cat=:del ;");
    // préparation de la requete de suppression

    // execution de la requete preparée
    $categorie = $result->execute(array(

        // préparation des éléments de la requete SQL
        ':del' => $del,
        // préparation des éléments de la requete SQL

    ));
    // execution de la requete preparée

    // redirection vers l'acceuil
    header('Location: categories.php');
    exit();
    // redirection vers l'acceuil
    
?>