<?php
    include 'head.php'
?>

<header>
    <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">
        catégories
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

<?php
    include 'footer.php'
?>