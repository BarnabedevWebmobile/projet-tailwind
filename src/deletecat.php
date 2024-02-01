<?php
    include 'pdo.php';
    $del=$_GET['categorie'];
    $result = $pdo->prepare("DELETE FROM `categorie` WHERE id_cat=:del ;");
    $categorie = $result->execute(array(
        ':del' => $del,
    ));
    header('Location: categories.php');
    exit();
    
?>