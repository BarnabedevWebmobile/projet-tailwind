<?php
  include 'head.php';
?>

  <header>
    <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">Table SQL des favoris</h1>
  </header>
  <section class = "w-full flex justify-center text-black p-8">
    <form class = "py-8 px-8" action="" method="GET">
    <select class="rounded-lg ml-2" name="domaine" id="formulaire">
        <?php
          $data1 = $pdo->query("SELECT * FROM `domaine` ORDER BY `id_dom` ASC;");
          $domaines = $data1->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <option value="none">domaine</option>
        <?php
        foreach($domaines as $domaine){?>
        <option class="" value="<?php echo $domaine['id_dom'] ?>"><?php echo $domaine['nom_dom'] ?></option>
        <?php
        };
        ?>
      </select>
      <select class="rounded-lg ml-2" name="show" id="show">
        <option value="100">affiche : tout</option>
        <option value="1">affiche : 1</option>
        <option value="5">affiche : 5</option>
        <option value="10">affiche : 10</option>
        <option value="15">affiche : 15</option>
        <option value="20">affiche : 20</option>
      </select>

      <select class="rounded-lg ml-2" name="categorie" id="formulaire">
        <?php
          $data = $pdo->query("SELECT * FROM `categorie` ORDER BY `id_cat` ASC;");
          $categories = $data->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <option value="none">categorie</option>
        <?php
        foreach($categories as $categorie){?>
        <option class="" value="<?php echo $categorie['id_cat'] ?>"><?php echo $categorie['nom_cat'] ?></option>
        <?php
        };
        ?>
      </select>
      <select class="rounded-lg ml-2" name="order" id="order">
        <option value="favoris.id_fav">favori</option>
        <option value="libelle">libellé</option>
        <option value="date_creation">date de création</option>
        <option value="url">URL</option>
        <option value="id_dom">domaine</option>
      </select>
      <select class="rounded-lg ml-2" name="by" id="by">
        <option value="ASC">ascendant</option>
        <option value="DESC">descendant</option>
      </select>
      <div class="relative py-8">
          <div class="absolute inset-y-0 start-0 flex items-center  ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
              </svg>
          </div>
          <input type="search" name = "search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos...">
          <button type="submit" class="text-white absolute end-2.5 bottom-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
      </div>
    </form>

    
  </section>

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
          <th>
            visiter
          </th>
      </tr>
      <!-- zone de filtrage -->
          <?php   
          // Affichage (SELECT) :

        if (isset($_GET['search']) && $_GET['search'] !== "" ){
          $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom WHERE libelle LIKE '%".$_GET['search']."%' ORDER BY ".$_GET['order']." ".$_GET['by']." ;");
          $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
        }else{
          if(isset($_GET['categorie'],$_GET['domaine']) && $_GET['categorie'] !== "none" && $_GET['domaine'] !== "none"){
            $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `cat_fav` ON favoris.id_fav=cat_fav.id_fav 
            INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom 
            INNER JOIN `categorie` ON cat_fav.id_cat=categorie.id_cat 
            WHERE categorie.id_cat=".$_GET['categorie']." AND domaine.id_dom=".$_GET['domaine']." 
            ORDER BY favoris.".$_GET['order']." ".$_GET['by']." LIMIT ".$_GET['show'].";");
            $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
          }else{
            if(isset($_GET['domaine']) && $_GET['domaine'] !== "none" && $_GET['categorie'] == "none"){
              $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom 
              WHERE domaine.id_dom=".$_GET['domaine']." ORDER BY favoris.".$_GET['order']." ".$_GET['by']." LIMIT ".$_GET['show'].";");
              $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
            }else{
              if(isset($_GET['categorie']) && $_GET['categorie'] !== "none" && $_GET['domaine'] == "none"){
                $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `cat_fav` ON favoris.id_fav=cat_fav.id_fav 
                INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom 
                INNER JOIN `categorie` ON cat_fav.id_cat=categorie.id_cat 
                WHERE categorie.id_cat=".$_GET['categorie']." ORDER BY favoris.".$_GET['order']." ".$_GET['by']." LIMIT ".$_GET['show'].";");
                $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
              }else{
                if(isset($_GET['show'])){
                  $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom 
                  ORDER BY favoris.".$_GET['order']." ".$_GET['by']." LIMIT ".$_GET['show'].";");
                  $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
                }else{
                  $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom ORDER BY `id_fav` ASC ;");
                  $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
                }
              }
            }
          }        
        }
    ?> 
    <!-- zone de filtrage -->
    <?php
    foreach($favoris as $favori){
    ?>
      <tr class="border-y-2 py-2 odd:bg-slate-600 even:bg-slate-700 hover:bg-slate-400">
          <td class = "p-2 text-amber-400">
            <?php echo $favori['id_fav'] ?>
          </td>
          <td>
            <?php echo $favori['libelle'] ?>
          </td>
          <td>
            <?php echo $favori['date_creation'] ?>
          </td>
          <td>
            <a href="<?php echo $favori['url'] ?>">link</a>
          </td>
          <td>
            <?php echo $favori['nom_dom'] ?>
          </td>
          <td class="text-center">
            <button class = "px-2  hover:text-sky-600"><i class="fa-solid fa-pen-to-square "></i></button><button class = "px-2 text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
          </td>
          <td class="text-center">
            <button class = "px-2 rounded hover:bg-lime-400 bg-lime-600"><a href="detail.php?favori=<?php echo $favori['id_fav']?>">plus d'information</a></button>
          </td>
      </tr>
      <?php
      }
      ?>
    </table>
  </section>
  <?php include 'footer.php' ?>
</body>
</html>