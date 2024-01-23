<?php
    include 'head.php'
?>
    <header>
        <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">
            A Propos
        </h1>
    </header>
    <?php
        $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom WHERE id_fav=".$_GET['favori'].";");
        $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
    ?>
    <section class = "w-full flex justify-center dark:text-white">
        <table class="w-5/6">
        <tr class="border-y-2">
            <th class = "py-2">
                id favoris
            </th>
            <th>
                libellé
            </th>
            <th>
                date ajout
            </th>
            <th>
                liens
            </th>
            <th>
                nom domaine
            </th>
            <th>
                edition/supression
            </th>
        </tr>
        
        <?php
        foreach($favoris as $favori){
        ?>
            <tr class="border-y-2 py-2 odd:bg-slate-600 even:bg-slate-700 hover:bg-slate-400">
                <td class = "p-2">
                    <?php echo $favori['id_fav'] ?>
                </td>
                <td>
                <?php echo $favori['libelle'] ?>
                </td>
                <td>
                <?php echo $favori['date_creation'] ?>
                </td>
                <td>
                    <a href="<?php echo $favori['url'] ?>"><?php echo $favori['url'] ?></a>
                </td>
                <td>
                <?php echo $favori['nom_dom'] ?>
                </td>
                <td class="text-center">
                <button class = "px-2  hover:text-sky-600"><i class="fa-solid fa-pen-to-square "></i></button><button class = "px-2 text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
                
            <?php
            }
            ?>
        </table>
        
    </section>
    <div class = " w-full flex justify-center text-center "> 
    <span class = "w-5/6 flex justify-center text-center border-b-2 bg-slate-600">
        <p class = "w-3/6 "><?php echo $favori['description'] ?></p>
    </span>
    </div>
    
      <?php
  echo '<pre>';
  var_dump($_GET);
  echo '</pre>';
  ?>
    
</body>
</html>