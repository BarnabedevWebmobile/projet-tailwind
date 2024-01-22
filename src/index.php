<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/aa422d9bdc.js" crossorigin="anonymous"></script>
</head>
<body class = "dark:bg-slate-900 dark:text-white">
  <header>
    <h1 class="text-3xl font-bold underline Table favoris text-center py-8">Table SQL des favoris</h1>
  </header>
  <section class = "w-full flex justify-center">
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
              id domaine
          </th>
          <th>
            edition/supression
          </th>
      </tr>
          <?php   
    include("pdo.php");
        // Affichage (SELECT) :
        $result = $pdo->query("SELECT * FROM `favoris` INNER JOIN `domaine` ON favoris.id_dom=domaine.id_dom");
        $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 

    ?> 
    <?php
    foreach($favoris as $favori){
    ?>
        <tr class="border-y-2 py-2 odd:bg-slate-600 even:bg-slate-700 hover:bg-slate-400">
            <td class = "py-2">
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
              <button class = "px-2"><i class="fa-solid fa-pen-to-square "></i></button><button class = "px-2 text-red-600"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
  </section>
  <footer>
    <h2 class="text-center py-4">Design by berta@bretzeldesign</h2>
  </footer>
</body>
</html>