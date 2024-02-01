<!--inclusion du head de la page-->
<?php
include 'head.php';
?>
<!--inclusion du head de la page-->

    <!-- récupération du favoris à supprimé -->
    <?php
        $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom WHERE favoris.id_fav= ".$_GET['favori'].";");
        $favoris = $result->fetch(PDO::FETCH_ASSOC); 
    ?>
    <!-- récupération du favoris à supprimé -->
    
    <section class = "dark:text-white flex flex-col justify-center items-center text-xl py-80">

        <!-- indication du favoris a supprimé -->
        <h1>VOULEZ VOUS SUPPRIMER LE FAVORI <?php echo $favoris['libelle'] ?></h1>
        <!-- indication du favoris a supprimé -->

        <div class = 'flex-row m-10'>

            <!-- validation de la suppretion du favoris -->
            <button class = 'm-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'> 
                <a href="delete.php?favori=<?php echo $favoris['id_fav']?>">OUI </a>
            </button>
            <!-- validation de la suppretion du favoris -->

            <!-- ne pas supprimé / retour a l'index -->
            <button class = 'm-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>
                <a href="index.php">
                NON
                </a>
            </button>
            <!-- ne pas supprimé / retour a l'index -->
        </div>
    </section>

    </body>
</html>