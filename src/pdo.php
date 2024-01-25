<?php
require("connect.php");
//connexion a la base de données
$dsn="mysql:dbname=".BASE.";host=".SERVER;
try{
    $connection=new PDO($dsn,USER,PASSWD);
}catch(PDOException $e){
    echo "échec de la connexion : %s\n" .$e->getMessage();
    exit();
}
$pdo = new PDO($dsn, 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

?>