<!-- récupération du contenue du fichier head pour l'ajouter en haut de page -->
<?php
  include 'head.php';
?>
<!-- récupération du contenue du fichier head pour l'ajouter en haut de page -->
<!-- création d'un nouveau domaine -->
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

            // préparation de la requete SQL de création d'un domaine
            $result = $pdo->prepare("INSERT INTO `domaine`(`id_dom`, `nom_dom`) VALUES ('[value-1]',:lib)");
            // préparation de la requete SQLde création d'un domaine

            // execution de la requete préparée pour mettre a jour le favori
            $result->execute(array(
                // préparation des éléments de la requete SQL
                ':lib' => $libelle,
                // préparation des éléments de la requete SQL
            ));
            // execution de la requete préparée pour mettre a jour le favori

            // rafraichissement invisible de la page
            header('Location: domaine.php');
            exit();
            // rafraichissement invisible de la page
        }
    }
    }catch(Exception $e){
        ?><script>alert("erreur lors de l'insertion")</script><?php
    }
    ?>
<!-- création d'un nouveau domaine -->
  <!-- zone du titre -->
  <header>
    <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">Liste des domaines</h1>
  </header>
  <!-- zone du titre -->

  <!-- création d'une table des domaines -->
  <section class = "w-full flex justify-center dark:text-white">
        <table class="w-full sm:w-2/6">

            <!--entête du tableau des domaines-->
            <tr class="border-y-2">
                <th class = " py-2  w-1/2">
                    id domaine
                </th>
                <th class = " py-2 w-1/2">
                    nom de domaine
                </th>
            </tr>
            <!--entête du tableau des domaines-->



        <!-- récupération de la table des domaines -->
        <?php
            $data = $pdo->query("SELECT * FROM `domaine` ORDER BY `id_dom` ASC;");
            $domaines = $data->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!-- récupération de la table des domaines -->

        <!--génération auto des lignes du tableau des domaines-->
        <?php

            foreach($domaines as $domaine){?>

            <tr class="border-y-2">
                <td class = " py-2 text-center">
                <?php echo $domaine['id_dom'] ?>
                </td>
                <td class = " py-2 text-center flex justify-center">
                    <?php echo $domaine['nom_dom'] ?>
                    <button class = "px-2  hover:text-sky-600"><a href="updatedom.php?domaine=<?php echo $domaine['id_dom']?>"><i class="fa-solid fa-pen-to-square "></i></a></button>
                    <button class = "px-2 text-red-600 hover:text-red-800">
                        <a href="deletedom.php?domaine=<?php echo $domaine['id_dom'] ?>">
                    <i class="fa-solid fa-trash"></i></a></button>
                </td>
            </tr>

            <?php
            };
            ?> 
            <!--génération auto des lignes du tableau des domaines-->
        </table>

    </section>
    <!-- création d'une table des domaines -->

    <!-- formulaire de création d'un domaine -->
    <section class = "w-full flex justify-center py-6 dark:text-white" >
        <form action="" method="POST" class = "flex flex-col justify-center">

            <!-- champs d'insertion du nom du nouveau domaine -->
            <input type="text" name="libelle" id="lib" required size="50" class = " block w-full p-2 ps-10 text-sm
            text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
            dark:focus:border-blue-500 " placeholder = "nom de la nouvelle domaine">
            <!-- champs d'insertion du nom du nouveau domaine -->

            <!-- boutons lançant la création du nouveau domaine -->
            <button class = "dark:text-white my-4  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">create new domaine</button>
            <!-- boutons lançant la création du nouveau domaine -->

        </form>
        <!-- formulaire de création d'un domaine -->
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