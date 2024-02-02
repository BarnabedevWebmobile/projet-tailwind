<!--inclusion du head de la page-->
<?php
    include 'head.php'
?>
<!--inclusion du head de la page-->


<?php
// mise en variable d'un get/post sécurité supplémentaire
$fav=$_GET['favori'];
// mise en variable d'un get/post sécurité supplémentaire
?>

<?php
    // n'execute pas le code au chargement de la page
    if(count($_POST)>0){
    // n'execute pas le code au chargement de la page
        
        // mise en variable d'un get/post sécurité supplémentaire
        $libelle = htmlspecialchars($_POST['libelle']);
        $cats = ($_POST['cats']);
        $desc = htmlspecialchars($_POST['description']);
        $lien = htmlspecialchars($_POST['link']);
        $dom = htmlspecialchars($_POST['domaine']);
        // mise en variable d'un get/post sécurité supplémentaire

        // vérification supplémentaire du remplissage de champs
        if(strlen($libelle) !== 0||strlen($lien)!==0
        || is_numeric($dom) ||strlen($desc) !== 0){
        // vérification supplémentaire du remplissage de champs

        // alerte si champs non remplis
            ?><script> alert("champs non rempli")</script>;<?php
        // alerte si champs non remplis

        }else{
            // requete préparée pour mettre a jour le favori
            $result = $pdo->prepare("UPDATE `favoris` SET `libelle`= :lib, `date_creation` = NOW(), 
            `url`=:link, id_dom=:dom, `description`=:summary WHERE id_fav=:fav");
            // requete préparée pour mettre a jour le favori

            // execution de la requete préparée pour mettre a jour le favori
            $result->execute(array(

                // préparation des éléments de la requete SQL
                ':lib' => $libelle,
    
                ':link' => $lien,
    
                ':dom' =>$dom,
    
                ':fav' =>$fav,
    
                'summary' =>$desc,
                // préparation des éléments de la requete SQL

            ));
            // execution de la requete préparée pour mettre a jour le favori

            // vérification supplémentaire du remplissage de champs
            if(count($cats) == 0){
            // vérification supplémentaire du remplissage de champs

                // alerte si champs non remplis
                ?><script> alert("pas de catégorie attribué")</script>;<?php
                // alerte si champs non remplis

            }else{
                
                    // requete préparée pour supprimé toutes les catégories du favori
                    $result2 = $pdo->prepare("DELETE FROM `cat_fav` WHERE id_fav=:fav;");
                    // requete préparée pour supprimé toutes les catégories du favori

                    // execution de la requete préparée pour mettre a jour le favori
                    $catfav = $result2->execute(array(

                        // préparation des éléments de la requete SQL
                        ':fav' => $fav
                        // préparation des éléments de la requete SQL

                    ));
                    // execution de la requete préparée pour mettre a jour le favori

                // vérification du nombre de checkbox coché
                foreach($cats as $_key=>$cat){
                // vérification du nombre de checkbox coché

                    // requete préparée pour ajouter toutes les catégories du favori
                    $result3 = $pdo->prepare("INSERT INTO `cat_fav`(`id_fav`, `id_cat`) 
                    VALUES ( :fav,:cats);");
                    // requete préparée pour ajouter toutes les catégories du favori

                    // execution de la requete préparée pour mettre a jour le favori
                    $catfav = $result3->execute(array(

                        // préparation des éléments de la requete SQL
                        ':fav' => $fav,
                        ':cats' => $cat
                        // préparation des éléments de la requete SQL

                    ));
                    // execution de la requete préparée pour mettre a jour le favori
                }; 
            }
        }
    }
?>

    <!-- titre de la page -->
    <header>
        <h1 class="text-3xl font-bold underline Table text-center py-8 dark:text-white">
           Modifier votre favori
        </h1>
    </header>
    <!-- titre de la page -->

    <!-- retour a la page d'acceuil -->
    <section class = "w-full flex justify-center my-10">
        <a href="index.php">
            <button class = "dark:text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">HOME</button>
        </a>
    </section>
    <!-- retour a la page d'acceuil -->

    <!-- récupération du contenu d'un favoris -->
    <?php
        $result = $pdo->query("SELECT favoris.`id_fav`, `libelle`,`date_creation`,`url`,`nom_dom`,`description`,
        GROUP_CONCAT(`nom_cat` SEPARATOR \"|\") AS concat_cat
        FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom
        INNER JOIN `cat_fav` ON favoris.id_fav=cat_fav.id_fav INNER JOIN `categorie` ON categorie.id_cat=cat_fav.id_cat
        WHERE favoris.id_fav=".$_GET['favori'].";");
        $favori = $result->fetch(PDO::FETCH_ASSOC); 
    ?>
    <!-- récupération du contenu d'un favoris -->

    <!-- récupération de l'ID des catégories liés a un favoris -->
    <?php
        $result = $pdo->query("SELECT DISTINCT id_cat FROM `favoris` 
        INNER JOIN `cat_fav` ON favoris.id_fav=cat_fav.id_fav 
        WHERE favoris.id_fav=".$_GET['favori'].";");
        $favoricats = $result->fetchAll(PDO::FETCH_ASSOC); 
    ?>
    <!-- récupération de l'ID des catégories liés a un favoris -->

    <!-- formulaire de modification d'un favori -->
    <section class = "w-full flex justify-center my-10">
        <form class=" w-full md:w-2/6" action="" method="POST">

            <!-- champs de modification du libellé -->
            <div class ="my-12 px-4 flex justify-center">
                
                <input type="text" name="libelle" id="lib" required size="50" class = " block w-full p-2 ps-10 text-sm
                text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                dark:focus:border-blue-500 " placeholder = "<?php echo $favori['libelle'] ?>" value="<?php echo $favori['libelle'] ?>">
            </div>
            <!-- champs de modification du lien -->

            <!-- champs du choix du domaine et de la modification du lien -->
            <div class = " my-12 px-4 w-full flex justify-center flex-wrap">

                <!-- select du domaine -->
                <span class = " flex flex-col">
                    
                    <label class = "dark:text-white" for="domaine">nom de domaine</label>
                    <select class="rounded-lg p-2" name="domaine" id="domaine">
                        
                        <!-- récupération de la table des domaines -->
                        <?php
                        $data1 = $pdo->query("SELECT * FROM `domaine` ORDER BY `id_dom` ASC;");
                        $domaines = $data1->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <!-- récupération de la table des domaines -->

                        <!-- création auto des options par domaines -->
                        <?php
                        foreach($domaines as $domaine){?>
                        <?php
                        if($favori['nom_dom'] == $domaine['nom_dom']){
                            ?>
                            <option class="" value="<?php echo $domaine['id_dom'] ?>" selected><?php echo $domaine['nom_dom'] ?></option>
                            <?php
                        }else{
                            ?>
                            <option class="" value="<?php echo $domaine['id_dom'] ?>"><?php echo $domaine['nom_dom'] ?></option>
                            <?php
                        }

                        };
                        ?>
                        <!-- création auto des options par domaines -->
                        
                    </select>

                </span>
                <!-- select du domaine -->

                <!-- champs de modification du lien -->
                <span class = " flex flex-col w-full mx-6">
                    <label class = "dark:text-white" for="link">lien</label>
                    <input type="url" name="link" id="link" required size="50" class = "  block w-full p-2 ps-10 text-sm
                    text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 " placeholder = "<?php echo $favori['url'] ?>" value="<?php echo $favori['url'] ?>">
                </span>
                <!-- champs de modification du lien -->

            </div>
            <!-- champs du choix du domaine et de la modification du lien -->

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

                    foreach($categories as $categorie){

                        // réinitialise le statue de checked a chaque tour de la boucle
                        $checked = '';
                        // réinitialise le statue de checked a chaque tour de la boucle

                        // vérifie si la checkbox doit avoir l'attribut checked
                        foreach($favoricats as $favoricat){
                            if($favoricat['id_cat'] == $categorie['id_cat']){
                                $checked = 'checked';
                            }
                        }
                        // vérifie si la checkbox doit avoir l'attribut checked

                            ?>
                        <span>

                            <input class = "m-2" type="checkbox" name="cats[]" 
                            id="<?php echo $categorie['nom_cat'] ?>" value = "<?php echo $categorie['id_cat'] ?>" <?php echo $checked?>>
                            <label class = "m-2" for="<?php echo $categorie['nom_cat'] ?>"><?php echo $categorie['nom_cat'] ?></label>
                        </span>
                    <?php

                        
                    }
                    
                    ?> 
                    <!-- création auto des checkbox par catégories -->
                </span>

            </div>

            <!-- modification de la description du favori -->
            <div class = " my-12 px-4 flex justify-center flex-wrap dark:text-white">
                <textarea name="description" id="description" cols="30" rows="10" block class = "w-full p-2 ps-10 text-sm
                    text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 " placeholder = "bookmarks description here" maxlength = "16000000"><?php echo $favori['description'] ?></textarea>
            </div>
            <!-- modification de la description du favori -->

            <!-- validation de la modification du favori -->
            <span class ="flex justify-center">
            <button class = "dark:text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">update</button>
            </span>
            <!-- validation de la modification du favori -->

        </form>
    </section>
    <!-- formulaire de modification d'un favori -->

    <!--inclusion du footer de la page-->
<?php
    include 'footer.php'
?>
<!--inclusion du footer de la page-->