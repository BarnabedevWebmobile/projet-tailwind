<?php
    include 'head.php'
?>

<header>
    <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">
        catégories
    </h1>
</header>
    <section class = "w-full flex justify-center dark:text-white">
        <table class="w-2/6">
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
                    <form action="" method="post" class = "flex justify-center">
                        <input type="text" name="libelle" id="lib" required size="50" class = " block w-3/6 p-2 ps-10 text-sm
                        text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                        dark:focus:border-blue-500 " placeholder = "<?php echo $categorie['nom_cat'] ?>" value="<?php echo $categorie['nom_cat'] ?>">
                        <button class = "px-2  hover:text-sky-600"><a href="update.php?favori=<?php echo $favori['id_fav']?>"><i class="fa-solid fa-pen-to-square "></i></a></button>
                    </form>
                </td>
            </tr>

            <?php
            };
            ?> 
        </table>

    </section>

<?php
    include 'footer.php'
?>