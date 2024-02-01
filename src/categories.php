<!--inclusion du head de la page-->
<?php
    include 'head.php'
?>
<!--inclusion du head de la page-->

<!-- création d'une nouvelle catégorie -->
    <?php
    if(count($_POST)>0){
    $libelle = htmlspecialchars($_POST['libelle']);
    if(strlen($libelle) == 0){
            ?><script> alert("champs non rempli")</script>;<?php
        }else{
            $result = $pdo->prepare("INSERT INTO `categorie`(`id_cat`, `nom_cat`) VALUES ('[value-1]',:lib)");
            $result->execute(array(
                ':lib' => $libelle,
    
            ));
            header('Location: categories.php');
            exit();
        }
    }
    ?>
<!-- création d'une nouvelle catégorie -->

<header>
    <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">
        liste des catégories
    </h1>
</header>
    <section class = "w-full flex justify-center dark:text-white">
        <table class="w-full sm:w-2/6">
            <tr class="border-y-2">
                <th class = " py-2  w-1/2">
                    id catégorie
                </th>
                <th class = " py-2 w-1/2">
                    nom catégories
                </th>
            </tr>
            




        <?php
            $data = $pdo->query("SELECT * FROM `categorie` ORDER BY `id_cat` ASC;");
            $categories = $data->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php

            foreach($categories as $categorie){?>

            <tr class="border-y-2">
                <td class = " py-2 text-center">
                <?php echo $categorie['id_cat'] ?>
                </td>
                <td class = " py-2 text-center flex justify-center">
                    <?php echo $categorie['nom_cat'] ?>
                    <button class = "px-2  hover:text-sky-600"><a href="updatecat.php?categorie=<?php echo $categorie['id_cat']?>"><i class="fa-solid fa-pen-to-square "></i></a></button>
                    <button class = "px-2 text-red-600 hover:text-red-800"><a href="deletecat.php?categorie=<?php echo $categorie['id_cat'] ?>">
                    <i class="fa-solid fa-trash"></i></a></button>
                </td>
            </tr>

            <?php
            };
            ?> 
        </table>


    </section>
    <section class = "w-full flex justify-center py-6 dark:text-white" >
        <form action="" method="POST" class = "flex flex-col justify-center">
            <input type="text" name="libelle" id="lib" required size="50" class = " block w-full p-2 ps-10 text-sm
            text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
            dark:focus:border-blue-500 " placeholder = "nom de la nouvelle catégorie">
            <button class = "dark:text-white my-4  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">create new categorie</button>
        </form>
    </section>


<?php
    include 'footer.php'
?>