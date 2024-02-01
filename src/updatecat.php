<?php
    include 'head.php'
?>
    <?php
    if(count($_POST)>0){
    $libelle = htmlspecialchars($_POST['libelle']);
    $idcat = $_GET['categorie'];
    if(strlen($libelle) == 0){
            ?><script> alert("champs non rempli")</script>;<?php
        }else{
            $result = $pdo->prepare("UPDATE `categorie` SET `nom_cat`= :lib WHERE id_cat=:idcat");
            $result->execute(array(
                ':lib' => $libelle,
    
                ':idcat' =>$idcat,
                

            ));
            header('Location: categories.php');
            exit();
        }
    }
    ?>

    <?php
        $data = $pdo->query("SELECT * FROM `categorie` WHERE id_cat=".$_GET['categorie'].";");
        $categories = $data->fetch(PDO::FETCH_ASSOC);
    ?>
    <header>
        <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">
            veuillez selectionnez le nouveau nom de <?php echo $categories['nom_cat']?>
        </h1>
    </header>
    <form action="" method = "POST" class="w-full flex justify-center">
        <input type="text" name="libelle" id="lib" required size="50" class = " block w-1/2 p-2 ps-10 text-sm
            text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
            dark:focus:border-blue-500 " placeholder = "<?php echo $categories['nom_cat']?>" value="<?php echo $categories['nom_cat']?>">
            <button class = "dark:text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">update</button>
    </form>