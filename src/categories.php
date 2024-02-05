<!--inclusion du head de la page-->
<?php
    include 'head.php'
?>
<!--inclusion du head de la page-->

<!-- création d'une nouvelle catégorie -->
    <?php


    try{

        // n'execute pas le code au chargement de la page
        if(count($_POST)>0){
        // n'execute pas le code au chargement de la page

        // préparation d'une variable sécuriser pour le libellé
        $libelle = htmlspecialchars($_POST['libelle']);
        // préparation d'une variable sécuriser pour le libellé

        // vérification supplémentaire du remplissage de champs
        if(strlen($libelle) == 0){
        // vérification supplémentaire du remplissage de champs  
        
            // alerte si champs non remplis
            ?><script> alert("champs non rempli")</script>;<?php
            // alerte si champs non remplis

            }else{

                // préparation de la requete SQL de création d'une catégorie
                $result = $pdo->prepare("INSERT INTO `categorie`(`id_cat`, `nom_cat`) VALUES ('[value-1]',:lib)");
                // préparation de la requete SQLde création d'une catégorie

                // execution de la requete préparée pour mettre a jour le favori
                $result->execute(array(
                    // préparation des éléments de la requete SQL
                    ':lib' => $libelle,
                    // préparation des éléments de la requete SQL
                ));
                // execution de la requete préparée pour mettre a jour le favori

                // rafraichissement invisible de la page
                header('Location: categories.php');
                exit();
                // rafraichissement invisible de la page
            }
        }
    }catch(Exception $e){
        ?><script>alert("erreur lors de l'insertion")</script><?php
    }
    ?>
<!-- création d'une nouvelle catégorie -->

<!-- titre de la page des catégorie -->
<header>
    <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">
        liste des catégories
    </h1>
</header>
<!-- titre de la page des catégorie -->

<!-- création d'une table des catégorie -->
    <section class = "w-full flex justify-center dark:text-white">
        <table class="w-full sm:w-2/6">

            <!--entête du tableau des catégories-->
            <tr class="border-y-2">
                <th class = " py-2  w-1/2">
                    id catégorie
                </th>
                <th class = " py-2 w-1/2">
                    nom catégories
                </th>
            </tr>
            <!--entête du tableau des catégories-->



        <!-- récupération de la table des catégories -->
        <?php
            $data = $pdo->query("SELECT * FROM `categorie` ORDER BY `id_cat` ASC;");
            $categories = $data->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!-- récupération de la table des catégories -->

        <!--génération auto des lignes du tableau des catégories-->
        <?php

            foreach($categories as $categorie){?>

            <tr class="border-y-2">
                <td class = " py-2 text-center">
                <?php echo $categorie['id_cat'] ?>
                </td>
                <td class = " py-2 text-center flex justify-center">
                    <?php echo $categorie['nom_cat'] ?>
                    <button class = "px-2  hover:text-sky-600"><a href="updatecat.php?categorie=<?php echo $categorie['id_cat']?>"><i class="fa-solid fa-pen-to-square "></i></a></button>
                    <button class = "px-2 text-red-600 hover:text-red-800"><a href="deletecat.php?categorie=<?php echo $categorie['id_cat'] ?>" onclick="return checkDelete()">
                    <i class="fa-solid fa-trash"></i></a></button>
                </td>
            </tr>

            <?php
            };
            ?> 
            <!--génération auto des lignes du tableau des catégories-->
        </table>


    </section>
<!-- création d'une table des catégorie -->

<!-- formulaire de création d'une catégorie -->
    <section class = "w-full flex justify-center py-6 dark:text-white" >
        <form action="" method="POST" class = "flex flex-col justify-center">

            <!-- champs d'insertion du nom de la nouvelle catégorie -->
            <input type="text" name="libelle" id="lib" required size="50" class = " block w-full p-2 ps-10 text-sm
            text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
            dark:focus:border-blue-500 " placeholder = "nom de la nouvelle catégorie">
            <!-- champs d'insertion du nom de la nouvelle catégorie -->

            <!-- boutons lançant la création de la nouvelle catégorie -->
            <button class = "dark:text-white my-4  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">create new categorie</button>
            <!-- boutons lançant la création de la nouvelle catégorie -->

        </form>
        <!-- formulaire de création d'une catégorie -->
    </section>

    <!-- retour a la page d'acceuil -->
    <div class = "w-full flex justify-center py-6">
        <a href="index.php"><button class = "dark:text-white my-4  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">HOME</button></a>

    </div>
    <!-- retour a la page d'acceuil -->

<!--inclusion du footer de la page-->
<?php
    include 'footer.php'
?>
<!--inclusion du footer de la page-->