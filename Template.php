
<html>
<head>
<meta charset="ISO-8859-1">
<title>	 Bd 04	</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<h1 align=center> Bd 04 </h1>

<header>
    <nav id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="">Accueil</a>
      <a href="contact.php">Contact</a>
      <a href="p2.php">Connection</a>
    </nav>
  </header>

  <main id="main">

  <span style="font-size:30px;cursor:pointer; position:fixed;" onclick="openNav()">&#9776;</span>
<?php

function  InsertBD (){
 
  $nbrvaleurs=count($_GET);
  if ($nbrvaleurs != 7){echo'<h1>le formulaire est incomplet</h1>';}
  
  else{
  $NomFamille  = $_GET ["NomFamille"]   ;
  $Prenom      = $_GET ["Prenom"]       ;
  $Age         = $_GET ["Age"]          ;
  $Sexe        = $_GET ["Sexe"]         ;
  $Metier      = $_GET ["Metier"]       ;
  $departement = $_GET ["departement"]  ;

 //--- Connection au SGBDR 
 $DataBase = mysqli_connect ( "localhost" , "root" , "" ) ;

 //--- Ouverture de la base de données
 mysqli_select_db ( $DataBase, "bd04" ) ;

 //--- Préparation de la requête
 $Requete = "INSERT INTO client (NomFamille, Prenom, Age, Sexe, Metier, NumDep) VALUES ( '$NomFamille', '$Prenom', $Age, '$Sexe', '$Metier', $departement);" ;
 //echo "<hr> $Requete <hr>" ;
 //--- Exécution de la requête (fin du script possible sur erreur ...)
 $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

 echo "<h2> La personne $NomFamille $Prenom a été ajouté à la base <h2><hr>" ;
  
 //--- Libérer l'espace mémoire du résultat de la requête
 //mysqli_free_result ( $Resultat ) ;

 //--- Déconnection de la base de données
 mysqli_close ( $DataBase ) ;
  }
}
function  Recherche (){
  $nbrvaleurs=count($_GET);
  if ($nbrvaleurs != 3){echo'<h1>le formulaire est incomplet</h1>';}
  
  else{
  $Nom = $_GET ["Nom"] ;
  $Prenom = $_GET ["Prenom"] ;}

  //--- Début de table en HTML
  echo "<center>" ;
  echo "<table border>" ;
  echo "<caption> <h2> Clients </h2> </caption>" ;
  echo "<tr> <th> Nom </th> <th> Prénom </th> <th> Age </th> <th> Sexe </th> <th> Metier </th> <th> Departement </th> </tr>" ;

  //--- Connection au SGBDR 
  $DataBase = mysqli_connect ( "localhost" , "root" , "" ) ;

  //--- Ouverture de la base de données
  mysqli_select_db ( $DataBase, "bd04" ) ;

  //--- Préparation de la requête
  $Requete = "Select * From client join departement on client.NumDep=departement.NumDep where NomFamille = '$Nom' and Prenom='$Prenom' ;" ;
    
  //--- Exécution de la requête (fin du script possible sur erreur ...)
  $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

  //--- Enumération des lignes du résultat de la requête
  while (  $ligne = mysqli_fetch_array($Resultat)  )
  {
    //--- Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
    echo "<tr>\n" ;
    $id_option= $ligne['IDPers'] ;
    echo "<td>" . $ligne['NomFamille']    . "</td>\n" ;
    echo "<td>" . $ligne['Prenom']        . "</td>\n" ;
    echo "<td>" . $ligne['Age']           . "</td>\n" ;
    echo "<td>" . $ligne['Sexe']          . "</td>\n" ;
    echo "<td>" . $ligne['Metier']        . "</td>\n" ;
    echo "<td>" . $ligne['NomDep']        . "</td>\n" ;
    echo "<td>  <form action='?.php'> 
                <input type=hidden name=id value='$id_option'>
                <input type=hidden name=action value='Modifier'>                
                <input type=submit value=Modifier>
                </form></td>" ;
    echo "</tr>\n" ;
  }
  //--- Libérer l'espace mémoire du résultat de la requête
  mysqli_free_result ( $Resultat ) ;

  //--- Déconnection de la base de données
  mysqli_close ( $DataBase ) ;  

  //--- Fin de table en HTML
  echo "</table>" ;
  echo "</center>" ;
}
function  ConsulterBD (){
  //--- Début de table en HTML
  echo "<center>" ;
  echo "<table border>" ;
  echo "<caption> <h2> Clients </h2> </caption>" ;
  echo "<tr> <th> Nom </th> <th> Prénom </th> <th> Age </th> <th> Sexe </th> <th> Metier </th> <th> Departement </th> </tr>" ;

  //--- Connection au SGBDR 
  $DataBase = mysqli_connect ( "localhost" , "root" , "" ) ;

  //--- Ouverture de la base de données
  mysqli_select_db ( $DataBase, "bd04" ) ;

  //--- Préparation de la requête
  $Requete = "Select * From client join departement on client.NumDep=departement.NumDep order by IDPers DESC ;" ;
    
  //--- Exécution de la requête (fin du script possible sur erreur ...)
  $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

  //--- Enumération des lignes du résultat de la requête
  while (  $ligne = mysqli_fetch_array($Resultat)  )
  {
    //--- Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
    echo "<tr>\n" ;
    $id_option= $ligne['IDPers'] ;
    echo "<td>" . $ligne['NomFamille']    . "</td>\n" ;
    echo "<td>" . $ligne['Prenom']        . "</td>\n" ;
    echo "<td>" . $ligne['Age']           . "</td>\n" ;
    echo "<td>" . $ligne['Sexe']          . "</td>\n" ;
    echo "<td>" . $ligne['Metier']        . "</td>\n" ;
    echo "<td>" . $ligne['NomDep']        . "</td>\n" ;
    echo "<td>  <form action='?.php'> 
                <input type=hidden name=IDPers value='$id_option'>
                <input type=hidden name=action value='Modifier'>                
                <input type=submit value=Modifier>
                </form></td>" ;
    echo "</tr>\n" ;


  }
   
  //--- Libérer l'espace mémoire du résultat de la requête
  mysqli_free_result ( $Resultat ) ;

  //--- Déconnection de la base de données
  mysqli_close ( $DataBase ) ;  

  //--- Fin de table en HTML
  echo "</table>" ;
  echo "</center>" ;
}
function  Modifier(){
  echo "<h2>Modifier</h2><br>";
  $id_option = $_GET['IDPers'];
  //--- Connection au SGBDR 
  $DataBase = mysqli_connect ( "localhost" , "root" , "" ) ;

  //--- Ouverture de la base de données
  mysqli_select_db ( $DataBase, "bd04" ) ;

  //--- Préparation de la requête
  $Requete = "SELECT * FROM client WHERE IDPers = $id_option ;";
    
  //--- Exécution de la requête (fin du script possible sur erreur ...)
  $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

  //--- Enumération des lignes du résultat de la requête
  while (  $ligne = mysqli_fetch_array($Resultat)  )
  {
    //--- Afficher une ligne du tableau HTML pour chaque enregistrement de la table 
    echo "<tr>\n" ;
    $id_option= $ligne['IDPers'] ;
    echo "<td>" . $ligne['NomFamille']    . "</td>\n" ;
    echo "<td>" . $ligne['Prenom']        . "</td>\n" ;
    echo "<td>" . $ligne['Age']           . "</td>\n" ;
    echo "<td>" . $ligne['Sexe']          . "</td>\n" ;
    echo "<td>" . $ligne['Metier']        . "</td>\n" ;
    echo "<td>" . $ligne['NomDep']        . "</td>\n" ;
 }
  $id_option    = $ligne ['IDPers']      ;
  $NomFamille   = $ligne ["NomFamille"]  ;
  $Prenom       = $ligne ["Prenom"]      ;
  $Age          = $ligne ["Age"]         ;
  $Sexe         = $ligne ["Sexe"]        ;
  $Metier       = $ligne ["Metier"]      ;
  $departement  = $ligne ["NumDep"]      ;

  $i = 1 ;
  reset($_GET) ;
      $id_option= $ligne['IDPers'] ;
  $NomFamille   = $ligne ["NomFamille"]  ;
  $Prenom       = $ligne ["Prenom"]      ;
  $Age          = $ligne ["Age"]         ;
  $Sexe         = $ligne ["Sexe"]        ;
  $Metier       = $ligne ["Metier"]      ;
  $departement  = $ligne ["NomDep"]      ;
  echo "  <form action='?.php' >  
  <input type=hidden name=action value='Modifier' >
  Nom    :                  <input name=NomFamille        type=text value=$NomFamille    >	    <br>
  Prénom :                  <input name=Prenom            type=text value=$Prenom >	    <br>
  Age    :                  <input name=Age               type=text value=$Age    >	    <br>
  Sexe   :                  <select name='Sexe' value=>
                                  <option value='H'>homme</option>
                                  <option value='F'>femme</option>
                            </select><br>
  Metier :                  <input name=Metier            type=text value=$Metier >   	<br>
  Departement :             <select name='departement'>";


      $NumDep= $ligne['NumDep']  ;
      $NomDep= $ligne['NomDep']  ;

      echo"
      <option value='$NumDep'>
          $NomDep 
      </option> ";

  echo "
  </select>
            <input type=submit value='Envoyer' >
            </form> 
            ";
}
function  Modifier2(){
  echo "<h2>Modifier</h2><br>";
  $IDPers = $_GET['IDPers'];
 //--- Connection au SGBDR 
 $DataBase = mysqli_connect ( "localhost" , "root" , "" ) ;

 //--- Ouverture de la base de données
 mysqli_select_db ( $DataBase, "bd04" ) ;

 $Requete = "SELECT * FROM client WHERE IDPers = $IDPers ;";

 //--- Exécution de la requête (fin du script possible sur erreur ...)
 $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

 if (  $ligne = mysqli_fetch_array($Resultat)  )
 {
  $id_option    = $ligne ['IDPers']      ;
  $NomFamille   = $ligne ["NomFamille"]  ;
  $Prenom       = $ligne ["Prenom"]      ;
  $Age          = $ligne ["Age"]         ;
  $Sexe         = $ligne ["Sexe"]        ;
  $Metier       = $ligne ["Metier"]      ;
  $departement  = $ligne ["NumDep"]      ;
 }
 //--- Déconnection de la base de données
 mysqli_close ( $DataBase ) ;
 //--- Connection au SGBDR 
 $DataBase = mysqli_connect ( "localhost" , "root" , "" ) ;

 //--- Ouverture de la base de données
 mysqli_select_db ( $DataBase, "bd04" ) ;
 //--- Préparation de la requête
 $Requete = "UPDATE client SET 
                               NomFamille = '$NomFamille',
                               Prenom     = '$Prenom',
                               Age        = '$Age',
                               Sexe       = '$Sexe',
                               Metier     = '$Metier',
                               NumDep     = '$departement',
                               WHERE
                               IDPers     = '$IDPers'; ";
 //echo "<hr> $Requete <hr>" ;
 //--- Exécution de la requête (fin du script possible sur erreur ...)
 $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

 echo "<h2> La personne $NomFamille $Prenom a été modifier dans la base <h2><hr>" ;
  
 //--- Libérer l'espace mémoire du résultat de la requête
 //mysqli_free_result ( $Resultat ) ;
  
 //--- Déconnection de la base de données
 mysqli_close ( $DataBase ) ;
  
    //--- Enumération des lignes du résultat de la requête
  if (  $ligne = mysqli_fetch_array($Resultat)  )
  {
  $i = 1 ;
  reset($_GET) ;
      $id_option= $ligne['IDPers'] ;
  $NomFamille   = $ligne ["NomFamille"]  ;
  $Prenom       = $ligne ["Prenom"]      ;
  $Age          = $ligne ["Age"]         ;
  $Sexe         = $ligne ["Sexe"]        ;
  $Metier       = $ligne ["Metier"]      ;
  $departement  = $ligne ["NomDep"]      ;
  echo "  <form action='?.php' >  
  <input type=hidden name=action value='Modifier' >
  Nom    :                  <input name=NomFamille        type=text value=$NomFamille    >	    <br>
  Prénom :                  <input name=Prenom            type=text value=$Prenom >	    <br>
  Age    :                  <input name=Age               type=text value=$Age    >	    <br>
  Sexe   :                  <select name='Sexe' value=>
                                  <option value='H'>homme</option>
                                  <option value='F'>femme</option>
                            </select><br>
  Metier :                  <input name=Metier            type=text value=$Metier >   	<br>
  Departement :             <select name='departement'>";
  

  while (  $ligne = mysqli_fetch_array($Resultat)  )
  {
      $NumDep= $ligne['NumDep']  ;
      $NomDep= $ligne['NomDep']  ;

      echo"
      <option value='$NumDep'>
          $NomDep 
      </option> ";
      
  }
  echo "
  </select>
            <input type=submit value='Envoyer' >
            </form> 
            ";
    }
}
{
  //------------------------------------------------------------------------------
  //  Programme Principal
  //
  session_start();

  /*
  si la variable de session login n'existe pas cela siginifie que le visiteur
  n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
  acceder à l'espace membres
  */
  if(!isset($_SESSION['username'])) {
    echo 'Vous n\'êtes pas autoris´ à acceder à cette zone';
    include('envoi.php');
    exit;
  }
  $username = $_SESSION['username'];

  echo"Bienvenue ". $username;
  echo"<a href='index.php'><--retour</a>";
  //************************************//
  $action='Affichage';

  if (count($_GET))
  {
    $action = $_GET['action'];

    if        ($action== 'Insertion')   {InsertBD    () ;}
    elseif    ($action== 'Recherche')   {Recherche   () ;}
    elseif    ($action== 'Modifier')   {Modifier   () ;}
  }
  echo"
  <h2>Insertion</h2><br>
  <form action='?.php' >
  <input type=hidden name=action value='Insertion' >
  Nom    :                  <input name=NomFamille        type=text placeholder='Entrez votre nom ici'    >	    <br>
  Prénom :                  <input name=Prenom            type=text placeholder='Entrez votre prenom ici' >	    <br>
  Age    :                  <input name=Age               type=text placeholder='Entrez votre Age ici'    >	    <br>
  Sexe   :                  <select name='Sexe'>
                                  <option value='H'>homme</option>
                                  <option value='F'>femme</option>
                            </select><br>
  Metier :                  <input name=Metier            type=text placeholder='Entrez votre Metier ici' >   	<br>
  Departement :             <select name='departement'> ";

  //--- Connection au SGBDR 
  $DataBase = mysqli_connect ( "localhost" , "root" , "" ) ;

  //--- Ouverture de la base de données
  mysqli_select_db ( $DataBase, "bd04" ) ;

  //--- Préparation de la requête
  $Requete = "Select client.NumDep,departement.NomDep From client join departement on client.NumDep=departement.NumDep group by departement.NomDep;" ;
    
  //--- Exécution de la requête (fin du script possible sur erreur ...)
  $Resultat = mysqli_query ( $DataBase, $Requete )  or  die(mysqli_error($DataBase) ) ;

  while (  $ligne = mysqli_fetch_array($Resultat)  )
  {
      $NumDep= $ligne['NumDep']  ;
      $NomDep= $ligne['NomDep']  ;

      echo"
      <option value='$NumDep'>
          $NomDep 
      </option> ";
      
  }
  echo "
  </select>
  <br><br>
  <input type='submit' value='envoyer a la base'>
  </form><br><br>";

  echo "
  <form	action='?' >
  <input type=submit value='rafraichir' >
  </form>";



  //--- Libérer l'espace mémoire du résultat de la requête
  mysqli_free_result ( $Resultat ) ;

  //--- Déconnection de la base de données
  mysqli_close ( $DataBase ) ;  


    echo " 
    <hr>
    <br>
    <h2>Recherche</h2>
    <br>
    <form	action='?' >
    <input type=hidden name=action value='Recherche' >
    Nom :                 <input name=Nom       type=text placeholder='Entrez le nom ici'    >	<br>
    Prénom :              <input name=Prenom    type=text placeholder='Entrez le prenom ici' >	<br><br>
      <input type=submit value='Rechercher' >
    </form>";
    
    //--- Consultation ...
    ConsulterBD();}
?>
  </main>

<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
</script>