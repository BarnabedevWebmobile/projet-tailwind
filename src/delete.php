<?php
    include 'pdo.php';

    $result = $pdo->query("DELETE FROM `favoris` WHERE id_fav= ".$_GET['favori'].";");
    $favori = $result->fetch(PDO::FETCH_ASSOC);
    header('Location: index.php');
    exit();
    
?>