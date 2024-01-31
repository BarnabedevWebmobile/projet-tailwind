<?php
    include 'head.php'
?>
<?php
$fav=$_GET['favori'];
?>
<?php
    // if(count($_POST)>0){
        // $libelle = htmlspecialchars($_POST['libelle']);
        // $cats = array(htmlspecialchars($_POST['cats']));
        // $desc = htmlspecialchars($_POST['description']);
        // $lien = htmlspecialchars($_POST['link']);
        // $dom = htmlspecialchars($_POST['domaine']);

    //     foreach($cats as $cat){
    //         $result2 = $pdo->prepare("UPDATE `cat_fav`SET `id_cat`=:cats;");
    //         $catfav = $result2->execute(array(
    //             'cats' => $cat

    //         ));
    //     };

    //     $result = $pdo->prepare("UPDATE `favoris` SET `libelle`= :lib, `date_creation` = NOW(), 
    //     `url`=:link, id_dom=:dom, `description`=:summary WHERE id_fav=".$fav."");
    //     $result->execute(array(
    //         'lib' => $libelle,

    //         'link' => $lien,

    //         'dom' =>$dom,

    //         'summary' =>$desc,
    //     ));
    // }
?>
    <header>
        <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">
           Modifier votre favori
        </h1>
    </header>

    <?php
        $result = $pdo->query("SELECT favoris.`id_fav`, `libelle`,`date_creation`,`url`,`nom_dom`,`description`,
        GROUP_CONCAT(`nom_cat` SEPARATOR \"|\") AS concat_cat
        FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom
        INNER JOIN `cat_fav` ON favoris.id_fav=cat_fav.id_fav INNER JOIN `categorie` ON categorie.id_cat=cat_fav.id_cat
        WHERE favoris.id_fav=".$_GET['favori'].";");
        $favori = $result->fetch(PDO::FETCH_ASSOC); 
    ?>

    <?php
        $result = $pdo->query("SELECT DISTINCT id_cat FROM `favoris` 
        INNER JOIN `cat_fav` ON favoris.id_fav=cat_fav.id_fav 
        WHERE favoris.id_fav=".$_GET['favori'].";");
        $favoricats = $result->fetchAll(PDO::FETCH_ASSOC); 
    ?>


    <section class = "w-full flex justify-center my-10">
        <form class=" w-full md:w-2/6" action="" method="POST">

            <div class ="my-12 px-4 flex justify-center">
                
                <input type="text" name="libelle" id="lib" required size="50" class = " block w-full p-2 ps-10 text-sm
                text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                dark:focus:border-blue-500 " placeholder = "<?php echo $favori['libelle'] ?>" value="<?php echo $favori['libelle'] ?>">


                    
            </div>
            <div class = " my-12 px-4 w-full flex justify-center flex-wrap">
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
                <span class = " flex flex-col w-full mx-6">
                    <label class = "dark:text-white" for="link">lien</label>
                    <input type="url" name="link" id="link" required size="50" class = "  block w-full p-2 ps-10 text-sm
                    text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 " placeholder = "<?php echo $favori['url'] ?>" value="<?php echo $favori['url'] ?>">
                

                </span>
            </div>
            <div class = " my-12 px-4  dark:text-white">
                <?php
                    $data = $pdo->query("SELECT * FROM `categorie` ORDER BY `id_cat` ASC;");
                    $categories = $data->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <h3 class = "text-center py-2">catégorie</h3>
                <span class = " flex justify-center flex-wrap">
                    
                

                    <?php
                    var_dump($favoricats);
                    foreach($categories as $categorie){
                        $checked = '';
                        foreach($favoricats as $favoricat){
                            if($favoricat['id_cat'] == $categorie['id_cat']){
                                $checked = 'checked';
                            }
                        }

                            ?>
                        <span>

                            <input class = "m-2" type="checkbox" name="cats[cat<?php echo $categorie['id_cat'] ?>]" 
                            id="<?php echo $categorie['nom_cat'] ?>" value = "<?php echo $categorie['id_cat'] ?>" <?php echo $checked?>>
                            <label class = "m-2" for="<?php echo $categorie['nom_cat'] ?>"><?php echo $categorie['nom_cat'] ?></label>
                        </span>
                    <?php

                        
                    }
                    
                    ?> 
                </span>

            </div>

            <div class = " my-12 px-4 flex justify-center flex-wrap dark:text-white">
                <textarea name="description" id="description" cols="30" rows="10" block class = "w-full p-2 ps-10 text-sm
                    text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 " placeholder = "bookmarks description here" maxlength = "16000000"><?php echo $favori['description'] ?></textarea>
            </div>


            <span class ="flex justify-center">
            <button class = "dark:text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">update</button>
            </span>

        </form>
    </section>
    <?php
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    ?>

<?php
    include 'footer.php'
?>