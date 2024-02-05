<!--inclusion du head de la page-->
<?php
    include 'head.php';
?>
<!--inclusion du head de la page-->

    <?php

    try{

    // vérification supplémentaire du remplissage de champs
    if(
        isset($_POST['libelle'])
        && isset($_POST['domaine'])
        && isset($_POST['link']) 
        && (isset($_POST['cats']) && count($_POST['cats'])!== 0)
        && strlen($_POST['description']) == 0
        && strlen($_POST['libelle']) < 300
        && strlen($_POST['link']) < 1000 
        ){
    // vérification supplémentaire du remplissage de champs

    //  cas ou la personne n'a pas remplis le champ description

        // insertion d'une nouvelle ligne dans la tables favoris
        $result = $pdo->query("INSERT INTO `favoris` (`id_fav`, `libelle`, `date_creation`, `url`, `id_dom`, `description`) VALUES 
        ('[value-1]','".htmlspecialchars($_POST['libelle'])."', NOW() ,'".htmlspecialchars($_POST['link'])."',".htmlspecialchars($_POST['domaine']).",'description');");
        $favori = $result->fetch(PDO::FETCH_ASSOC);
        // insertion d'une nouvelle ligne dans la tables favoris

        // insertion d'une nouvelle ligne dans la tables cat_fav
        $dernier_id = $pdo -> lastInsertId();
        foreach($_POST['cats'] as $_POST['cat']){
                $result2 = $pdo->query("INSERT INTO `cat_fav`(`id_fav`, `id_cat`) VALUES (".$dernier_id.",".htmlspecialchars($_POST['cat']).");");
                $catfav = $result2->fetch(PDO::FETCH_ASSOC);
        };
        // insertion d'une nouvelle ligne dans la tables cat_fav

        // redirection a l'index
        header('Location: index.php');
        exit();
        // redirection a l'index

    //  cas ou la personne n'a pas remplis le champ description
    }else{
    //  cas ou la personne a remplis le champ description

        // vérification supplémentaire du remplissage de champs
        if( isset($_POST['libelle'])
        && isset($_POST['domaine'])
        && isset($_POST['link']) 
        && (isset($_POST['cats']) && count($_POST['cats'])!== 0)
        && strlen($_POST['description']) !== 0
        && strlen($_POST['libelle']) < 300
        && strlen($_POST['link']) < 1000 ){
        // vérification supplémentaire du remplissage de champs

            // insertion d'une nouvelle ligne dans la tables favoris
            $result = $pdo->query("INSERT INTO `favoris` (`id_fav`, `libelle`, `date_creation`, `url`, `id_dom`, `description`) VALUES 
            ('[value-1]','".htmlspecialchars($_POST['libelle'])."', NOW() ,'".htmlspecialchars($_POST['link'])."',".htmlspecialchars($_POST['domaine']).",'".htmlspecialchars($_POST['description'])."');");
            $favori = $result->fetch(PDO::FETCH_ASSOC);
            $dernier_id = $pdo -> lastInsertId();
            // insertion d'une nouvelle ligne dans la tables favoris

            // insertion d'une nouvelle ligne dans la tables cat_fav
            foreach($_POST['cats'] as $_POST['cat']){
             $result2 = $pdo->query("INSERT INTO `cat_fav`(`id_fav`, `id_cat`) VALUES (".$dernier_id.",".htmlspecialchars($_POST['cat']).");");
             $catfav = $result2->fetch(PDO::FETCH_ASSOC);
            };
            // insertion d'une nouvelle ligne dans la tables cat_fav

            // redirection a l'index
            header('Location: index.php');
            exit();
            // redirection a l'index

        
        }else{

        }
        //  cas ou la personne a remplis le champ description
    };
}catch(Exception $e){
    ?><script>alert("erreur lors de l'insertion")</script><?php
}   
?>

<!-- titre de la page -->
<header class = 'flex justify-center'>
    <h1 class = 'dark:text-white text-2xl'>Créer un nouveau favoris</h1>
</header>
<!-- titre de la page -->

<!-- retour a la page d'acceuil -->
<div class = "w-full flex justify-center py-6">
        <a href="index.php"><button class = "dark:text-white my-4  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">HOME</button></a>

    </div>
<!-- retour a la page d'acceuil -->

<!-- formulaire de création -->
    <section class = "w-full flex justify-center my-8">


        <form class=" w-full md:w-2/6" action="" method="POST">

            <!-- champs de création du libellé-->
            <div class ="my-12 px-4 flex justify-center">
                
                <input type="text" name="libelle" id="lib" required size="50" class = " block w-full p-2 ps-10 text-sm
                text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                dark:focus:border-blue-500 " placeholder = "your bookmark name here">
            
            </div>
            <!-- champs de création du libellé -->

            <!-- champs du choix du domaine et de l'ajout du lien -->
            <div class = " my-12 px-4 w-full flex justify-center flex-wrap">
                
                <!-- select du domaine -->
                <span class = " flex flex-col">
                    <label class = "dark:text-white" for="domaine">nom de domaine</label>
                    <select class="rounded-lg p-2" name="domaine" id="domaine">
                        <?php
                            $data1 = $pdo->query("SELECT * FROM `domaine` ORDER BY `id_dom` ASC;");
                            $domaines = $data1->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                            <!-- création auto des options par domaines -->
                            <?php
                            foreach($domaines as $domaine){?>
                            <option class="" value="<?php echo $domaine['id_dom'] ?>"><?php echo $domaine['nom_dom'] ?></option>
                            <?php
                            };
                        ?>
                        <!-- création auto des options par domaines -->
                        
                    </select>
                </span>
                <!-- select du domaine -->

                <!-- champs d'ajout du lien -->
                <span class = " flex flex-col w-full mx-6">
                    <label class = "dark:text-white" for="link">lien</label>
                    <input type="url" name="link" id="link" required size="50" class = "  block w-full p-2 ps-10 text-sm
                    text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 " placeholder = "place URL here">
                </span>
                <!-- champs d'ajout du lien -->

            </div>
            <!-- champs du choix du domaine et de l'ajout du lien -->
            
            <!-- champs du choix des catégories -->
            <div class = " my-12 px-4  dark:text-white">

                <!-- récupération de la table des catégories -->
                <?php
                    $data = $pdo->query("SELECT * FROM `categorie` ORDER BY `id_cat` ASC;");
                    $categories = $data->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <!-- récupération de la table des catégories -->
                
                <h3 class = "text-center py-2">catégorie</h3>
                <span class = " flex justify-center flex-wrap">
                    <!-- création auto des checkbox par catégories -->
                    <?php
                    foreach($categories as $categorie){?>

                        <span>

                            <input class = "m-2" type="checkbox" name="cats[cat<?php echo $categorie['id_cat'] ?>]" 
                            id="<?php echo $categorie['nom_cat'] ?>" value = "<?php echo $categorie['id_cat'] ?>">
                            <label class = "m-2" for="<?php echo $categorie['nom_cat'] ?>"><?php echo $categorie['nom_cat'] ?></label>
                        </span>
                    <?php
                    };
                    ?> 
                    <!-- création auto des checkbox par catégories -->
                </span>

            </div>
            <!-- champs du choix des catégories -->

            <!-- champs de création de la description -->
            <div class = " my-12 px-4 flex justify-center flex-wrap dark:text-white">
                <textarea name="description" id="description" cols="30" rows="10" block class = "w-full p-2 ps-10 text-sm
                    text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 " placeholder = "bookmarks description here" maxlength = "16000000"></textarea>
            </div>
            <!-- champs de création de la description -->

            <!-- validation de la création d'un nouveau favori -->
            <span class ="flex justify-center">
            <button class = "dark:text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">create</button>
            </span>
            <!-- validation de la création d'un nouveau favori -->
            
        </form>
    </section>
    <!-- formulaire de création -->

<!--inclusion du footer de la page-->
<?php
    include 'footer.php'
?>
<!--inclusion du footer de la page-->