<!-- récupération du contenue du fichier head pour l'ajouter en haut de page -->
<?php
    include 'head.php'
?>
<!-- récupération du contenue du fichier head pour l'ajouter en haut de page -->

    <header>
        <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">
            A Propos
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

    <div class="border-y-2 py-2 bg-slate-400">
        <h2 class = " text-center p-2 py-8">
            <?php echo $favori['libelle'] ?>
        </h2>
        <p class = "py-4 text-center">
            id du favoris : <?php echo $favori['id_fav'] ?>
        </p>
        <p class = "py-4 text-center">
            date de création : <?php echo $favori['date_creation'] ?>
        </p>
        <p class = "py-4 text-center">
            liens : <a href="<?php echo $favori['url'] ?>"><?php echo $favori['url'] ?></a>
        </p>
        <p class = "py-4 text-center">
            domaine : <?php echo $favori['nom_dom'] ?>
        </p>
        <ul class = "py-4 text-center">
            catégories : 

                <li><?php echo $favori['concat_cat'] ?></li>

            
        </ul>
        <p class = "py-4 text-center">
            <?php echo $favori['description'] ?>
        </p>

        <p class="text-center">
            <button class = "px-2  hover:text-sky-600"><i class="fa-solid fa-pen-to-square "></i></button><button class = "px-2 text-red-600 hover:text-red-800"><a href="confirm.php?favori=<?php echo $favori['id_fav'] ?>">
            <i class="fa-solid fa-trash"></i></a></button>
        </p>
    </div>



      <?php
    include 'footer.php';
    ?>
