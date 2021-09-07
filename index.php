<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <?php
      session_start();
      if (isset($_SESSION['erreur'])) {
      ?>
        <div class="alert alert-danger" role="alert">
          <?php print($_SESSION['erreur']); ?>
        </div>
      <?php
      }
      ?>
      <div class="alert alert-primary" role="alert">
        Vous etes connecté !
      </div>
      <?php
      include_once('connect.php');
      echo '</br>';
      //--- Début de table en HTML
      echo "<table class='table'>";
      echo "<h2> Type de livre </h2>";
      echo "<tr> 
                  <th> ID </th> 
                  <th> Libellé </th>
                  <th> Actions </th>
                  </tr>";
      while ($donnees = mysqli_fetch_assoc($resultat)) {
        $id = $donnees['id'];
        $libelle = $donnees['libelle'];
        //--- Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
        echo '<tr';
        echo '<td> </td>';
        echo '<td>' . $id . '</td>';
        echo '<td>' . $libelle . '</td>';
        echo '<td> 
          <a href="detail.php?id=' . $id . '"> Voir </a> 
          <a href="detail.php?id=' . $id . '"> Modifier </a> 
          <a > Suprimer </a> 
          </td>';
        echo '</tr>';
      }
      //--- Fin de table en HTML
      echo '</table>';
      echo '<a href="add.php"><button class="bt4">Ajouter un type </button></a>';
      //include_once('close.php');
      ?>
    </div>
  </div>
</body>

</html>