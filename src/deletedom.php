<?php
    // inclut le fichier PDO
    include 'pdo.php';
    // inclut le fichier PDO
    
    // variable sécurisant le get
    $del=htmlspecialchars($_GET['domaine']);
    // variable sécurisant le get

    // préparation de la requete de suppression
    $result = $pdo->prepare("DELETE FROM `domaine` WHERE id_dom=:del ;");
    // préparation de la requete de suppression

    // execution de la requete preparée
    $categorie = $result->execute(array(

        // préparation des éléments de la requete SQL
        ':del' => $del,
        // préparation des éléments de la requete SQL

    ));
    // execution de la requete preparée

    // redirection vers l'acceuil
    header('Location: domaine.php');
    exit();
    // redirection vers l'acceuil
    
?>