<?php
    include 'head.php';
?>

<header class = 'flex justify-center'>
    <h1 class = 'dark:text-white text-2xl'>Créer un nouveau favoris</h1>
</header>
    <section class = " my-10">
        <form action="" method="POST">

            <div class ="my-12 px-4 flex justify-center">
                
                <input type="text" name="libelle" id="lib" required size="50" class = " block w-2/6 p-2 ps-10 text-sm
                text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                dark:focus:border-blue-500 " placeholder = "your bookmark name here">
            
            </div>
            <div class = " my-12 px-4 flex justify-center flex-wrap">
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
                <span class = " flex flex-col mx-6">
                    <label class = "dark:text-white" for="link">lien</label>
                    <input type="url" name="link" id="link" required size="50" class = "  block w-full p-2 ps-10 text-sm
                    text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 " placeholder = "place URL here">
                </span>
            </div>
            <div class = " my-12 px-4 flex justify-center flex-wrap">
                <?php
                    $data = $pdo->query("SELECT * FROM `categorie` ORDER BY `id_cat` ASC;");
                    $categories = $data->fetchAll(PDO::FETCH_ASSOC);
                ?>
            </div>
        </form>
    </section>

    <?php

    $today = date("Y-m-d");
    ?>
<?php
    include 'footer.php'
?>