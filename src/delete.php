<?php
    include 'pdo.php';
    $fav=$_GET['favori'];
    $result = $pdo->prepare("DELETE FROM `favoris` WHERE id_fav=:fav ;");
    $favori = $result->execute(array(
        ':fav' => $fav,
    ));
    header('Location: index.php');
    exit();
    
?>