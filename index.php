<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Inventaire</title>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="alert alert-primary" role="alert">
      Vous etes connecté !
    </div>
    <?php
    session_start();
    
    /*$bdd = mysqli_connect('DBHOST', 'DBUSER', 'DBPASSWORD', 'DBNAME');
    $resultat = mysqli_query($bdd,'SELECT libelle FROM type_livre ');
    echo mysqli_num_rows($resultat);
    echo '</br>';
    while($donnees = mysqli_fetch_assoc($resultat)){
        echo $donnees['libelle'] . " " . $donnees['message'] . '</br>';
    }*/
        //--- Début de table en HTML
        echo "<center>" ;
        echo "<table class='table'>" ;
        echo "<tr> <th> produits </th> <th> quantité </th> <th colspan='3'> action </th>  </tr>" ;
      
        //--- Connection au SGBDR include('conf.php');

        include('connect.php');
        //--- Préparation de la requête
        $Requete = "Select * From produit" ;
          
        //--- Exécution de la requête (fin du script possible sur erreur ...)
        $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;
      
        //--- Enumération des lignes du résultat de la requête
        while (  $ligne = mysqli_fetch_array($Resultat)  )
        {
          $produit_id = $ligne['produit_id'];
          $produit_ref = $ligne['produit_ref'];
          //--- Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
          echo "<tr>\n" ;
          $id_option= $ligne['produit_id'] ;
          echo "<td>" . $ligne['produit_ref']    . "</td>\n" ;
          echo "<td>" . $ligne['produit_quantite']    . "</td>\n" ;
          echo '<td><a class="btn btn-primary" href="detail.php?produit_id=' . $produit_id .'&'.$produit_ref.' "> Voir </a></td>';
		      echo '<td><a class="btn btn-info" href="edit.php?produit_id=' . $produit_id .'">Modifier</a></td>';
          echo '<td><a class="btn btn-danger" href="del.php?produit_id=' . $produit_id .'">Supprimer</a></td>';
		      /* echo" <td><a alt='Voir 'class='btn btn-primary'   href='details.php?id='.$id.'> <i class='far fa-eye'>      </i></a> 
            <a alt='Modifier 'class='btn btn-info'      href='edit.php?id='.$id.'><i class='fas fa-edit'>     </i></a>
            <a alt='Supprimer 'class='btn btn-danger'    href='delet.php?id='.$id.'><i class='fas fa-trash'>    </i></a></td>";*/
          echo "</tr>\n" ;
          
        }
        //--- Libérer l'espace mémoire du résultat de la requête
        mysqli_free_result ( $Resultat ) ;
      
        //--- Déconnection de la base de données
        mysqli_close ( $DataBase ) ;  
      
        //--- Fin de table en HTML
        echo "</table>" ;
        echo "</center>" ;
        echo '    <a href="add.php" class="btn btn-primary">Ajouter</a>';
		
    ?>
    </div>

</div>
</body>
</html>