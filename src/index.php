
<!-- récupération du contenue du fichier head pour l'ajouter en haut de page -->
<?php
  include 'head.php';
?>
<!-- récupération du contenue du fichier head pour l'ajouter en haut de page -->

  <!-- zone du titre -->
  <header>
    <h1 class="text-3xl font-bold underline Table favoris text-center py-8 dark:text-white">Table SQL des favoris</h1>
  </header>
  <!-- zone du titre -->

  <!-- section de mise en forme du formulaire -->
  <section class = "w-full flex justify-center text-black p-8">

    <!-- création du formulaire  -->
    <form class = "py-8 px-8" action="" method="GET">

    <!-- select = barre deroulantes des domaines -->
    <select class="rounded-lg ml-2" name="domaine" id="domaine">

        <?php
          $data1 = $pdo->query("SELECT * FROM `domaine` ORDER BY `id_dom` ASC;");
          $domaines = $data1->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <option value="none">domaine</option>

        <!-- création auto des options par domaines -->
        <?php
        foreach($domaines as $domaine){?>
        <option class="" value="<?php echo $domaine['id_dom'] ?>"><?php echo $domaine['nom_dom'] ?></option>
        <?php
        };
        ?>
        <!-- création auto des options par domaines -->

      </select>
      <!-- select = barre deroulantes des domaines -->

      <!-- select = barre deroulantes des limites de query -->
      <select class="rounded-lg ml-2" name="show" id="show">
        <option value="100">affiche : tout</option>
        <option value="1">affiche : 1</option>
        <option value="5">affiche : 5</option>
        <option value="10">affiche : 10</option>
        <option value="15">affiche : 15</option>
        <option value="20">affiche : 20</option>
      </select>
      <!-- select = barre deroulantes des limites de query -->

      <!-- select = barre deroulantes des catégories -->
      <select class="rounded-lg ml-2" name="categorie" id="categorie">
        <?php
          $data = $pdo->query("SELECT * FROM `categorie` ORDER BY `id_cat` ASC;");
          $categories = $data->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <option value="none">categorie</option>

        <!-- création auto des options par catégories -->
        <?php
        foreach($categories as $categorie){?>
        <option class="" value="<?php echo $categorie['id_cat'] ?>"><?php echo $categorie['nom_cat'] ?></option>
        <?php
        };
        ?>
        <!-- création auto des options par catégories -->
      </select>
      <!-- select = barre deroulantes des catégories -->

      <!-- select = barre deroulantes trie par colonnes -->
      <select class="rounded-lg ml-2" name="order" id="order">
        <option value="favoris.id_fav">favori</option>
        <option value="libelle">libellé</option>
        <option value="date_creation">date de création</option>
        <option value="url">URL</option>
        <option value="id_dom">domaine</option>
      </select>
      <!-- select = barre deroulantes trie par colonnes -->
      
      <!-- select = barre deroulantes de l'ordre de trie par colonnes -->
      <select class="rounded-lg ml-2" name="by" id="by">
        <option value="ASC">ascendant</option>
        <option value="DESC">descendant</option>
      </select>
      <!-- select = barre deroulantes de l'ordre de trie par colonnes -->

      <!-- zone de la barre de recherche par libellé -->
      <div class="relative py-8">
        <!-- loupe de la barre de recherche par libellé -->
          <div class="absolute inset-y-0 start-0 flex items-center  ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" 
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" 
                  stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
              </svg>
          </div>
          <!-- loupe de la barre de recherche par libellé -->

          <!-- input = barre de recherche par libellé -->
          <input type="search" name = "search" id="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos...">
          <!-- input = barre de recherche par libellé -->
          
          <!-- boutton submit du filtrage -->
          <button type="submit" class="text-white absolute end-2.5 bottom-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
          <!-- boutton submit du filtrage -->

        </div>
      <!-- zone de la barre de recherche par libellé -->

    </form>
    <!-- création du formulaire  -->

  </section>
  <!-- section de mise en forme du formulaire -->

  <section class= 'flex justify-center'>
    <button class='my-16  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'><a href="create.php"><h2 class = ' dark:text-white'>add a bookmark</h2></a></button>
  </section>

  <!-- section prenant l'ensemble de la table -->
  <section class = "w-full flex justify-center dark:text-white"> 
    <!-- création de la table -->

    
    <table class="w-5/6"> <!-- table prenant 5/6 de la page -->
      
    <!-- création de la ligne contenant le nom de chaque colone -->
    <tr class="border-y-2">
        <!-- création des colonnes -->
          <th class = " py-2">
              id favoris
          </th>
          <th class = "">
              libellé
          </th>
          <th class = " ">
              date ajout
          </th>
          <th class = " text-center ">
              nom domaine
          </th>
          <th class = "  text-center ">
            actions
          </th>
      </tr>
      <!-- zone de filtrage -->
          <?php   
          // Affichage (SELECT) :


        // recherche par libellé de favoris 

        if (isset($_GET['search']) 
        && $_GET['search'] !== "" ){
          $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom WHERE libelle LIKE '%".htmlspecialchars($_GET['search'])."%' ORDER BY favoris.".htmlspecialchars($_GET['order'])." ".htmlspecialchars($_GET['by'])." LIMIT ".htmlspecialchars($_GET['show']).";");
          $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
        }else{

          // recherche par catégorie et domaine

          if(isset($_GET['categorie'],$_GET['domaine']) 
          && $_GET['categorie'] !== "none" 
          && $_GET['domaine'] !== "none"){
            $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `cat_fav` ON favoris.id_fav=cat_fav.id_fav 
            INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom
            INNER JOIN `categorie` ON cat_fav.id_cat=categorie.id_cat 
            WHERE categorie.id_cat=".htmlspecialchars($_GET['categorie'])." AND domaine.id_dom=".htmlspecialchars($_GET['domaine'])." 
            ORDER BY favoris.".htmlspecialchars($_GET['order'])." ".htmlspecialchars($_GET['by'])." LIMIT ".htmlspecialchars($_GET['show']).";");
            $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
          }else{

            // recherche par domaines uniquement

            if(isset($_GET['domaine']) 
            && $_GET['domaine'] !== "none" 
            && $_GET['categorie'] == "none"){
              $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom 
              WHERE domaine.id_dom=".$_GET['domaine']." ORDER BY favoris.".htmlspecialchars($_GET['order'])." ".htmlspecialchars($_GET['by'])." LIMIT ".htmlspecialchars($_GET['show']).";");
              $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
            }else{

              // recherche par catégories uniquement

              if(isset($_GET['categorie'])
              && $_GET['categorie'] !== "none"
              && $_GET['domaine'] == "none"){
                $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `cat_fav` ON favoris.id_fav=cat_fav.id_fav 
                INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom 
                INNER JOIN `categorie` ON cat_fav.id_cat=categorie.id_cat 
                WHERE categorie.id_cat=".htmlspecialchars($_GET['categorie'])." ORDER BY favoris.".htmlspecialchars($_GET['order'])." ".htmlspecialchars($_GET['by'])." LIMIT ".htmlspecialchars($_GET['show']).";");
                $favoris = $result->fetchAll(PDO::FETCH_ASSOC);

              }else{

                // limiter nombre de favoris

                if(isset($_GET['show'])){
                  $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom 
                  ORDER BY favoris.".htmlspecialchars($_GET['order'])." ".htmlspecialchars($_GET['by'])." LIMIT ".htmlspecialchars($_GET['show']).";");
                  $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
                }else{

                  // affichage initial de la page

                  $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom ORDER BY `id_fav` ASC ;");
                  $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
                }
              }
            }
          }        
        }
    ?> 
    <!-- zone de filtrage -->


    <!-- création auto des lignes de contenu pour chaque favori -->
    <!-- début du foreach générant chaque ligne -->
    <?php
    foreach($favoris as $favori){
    ?>
    <!-- début du foreach générant chaque ligne -->
      <tr class="border-y-2 py-2 h-full odd:bg-slate-600 even:bg-slate-700 hover:bg-slate-400">

          <!-- écriture de l'id du favorit -->
          <td class = "p-2  text-amber-400">
            <?php echo $favori['id_fav'] ?>
          </td>
      
          <!-- écriture du libellé du favorit -->
          <td>
            <?php echo $favori['libelle'] ?>
          </td>

          <!-- écriture de la date de création du favorit -->
          <td class = "">
            <?php echo $favori['date_creation'] ?>
          </td>

          <!-- écriture du nom de domaine du favorit -->
          <td class = "">
            <?php echo $favori['nom_dom'] ?>
          </td>

          <!-- écriture des pictograme -->
          <td class="text-center ">

            <!-- pictogramme de l'url du favoris -->
            <button class = "px-2 text-blue-400 hover:text-violet-800"><a href="<?php echo $favori['url'] ?>" target="_blank"><i class="fa-solid fa-link"></i></A</button>
            
            <!-- pictogramme amenant a la page des détails -->
            <button class = "px-2 text-lime-600 hover:text-lime-400"><a href="detail.php?favori=<?php echo $favori['id_fav']?>"><i class="fa-solid fa-eye"></i></A</button>
            
            <!-- pictogramme de l'édition du favoris -->
            <button class = "px-2  hover:text-sky-600"><a href="update.php?favori=<?php echo $favori['id_fav']?>"><i class="fa-solid fa-pen-to-square "></i></a></button>
            
            <!-- pictogramme de la supression du favoris -->
            <button class = "px-2 text-red-600 hover:text-red-800"><a href="confirm.php?favori=<?php echo $favori['id_fav'] ?>">
            <i class="fa-solid fa-trash"></i></a></button>
          </td>
      </tr>

      <!-- fin du foreach -->
      <?php
      }
      ?>
      <!-- fin du foreach -->

      <!-- création auto des lignes de contenu -->

    </table>
    <!-- fin de la table -->
  </section>
  <!-- section prenant l'ensemble de la table -->
  <span class ="flex justify-center">
            <a href="categories.php" class = 'my-5'><button class = "dark:text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm mx-4 px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">
            Catégories
            </button></a>
            <a href="domaine.php" class = 'my-5'><button class = "dark:text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm mx-4 px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">
            Domaine
            </button></a>
</span>
  <!-- récupération du contenue du fichier footer pour l'ajouter en bas de page -->
  <?php include 'footer.php' ?>
  <!-- récupération du contenue du fichier footer pour l'ajouter en bas de page -->

