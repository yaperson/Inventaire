<?php
// On demarre une session
session_start();

// On verifie l'envoie du formulaire
if (isset($_POST['libellé']) && !empty($_POST['libellé'])){
    $_SESSION['message'] = 'Nouveau type de livre : "' . $_POST['libellé'] . '"';


    // Connection a la BD
    include_once 'connect.php';

    try {
        // Netoyge des donnés envoyées
        $libellé = strip_tags($_POST['libellé']);

        // Préparation de requete
        $sql = "INSERT INTO type_livre (libelle) VALUE (?);";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, 's', $libellé);

        // Execution de la requete
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } 
    catch (Exception $e){
        $_SESSION['erreur'] = "Une erreur est survenue ". $e->getMessage();
    }
    // Message d'indication
    $_SESSION['message'] = 'Le type de livre "'.$libellé.'" a été enregistrer';
    // Fermeture de la session
    include_once('close.php');
// On renvoie vers la page principale

// Si erreur
}
else{
    $_SESSION['message'] = 'Aucun type de livre ajouté';
}
// On affiche le formulaire de saisie d'un nouveau "type de livre"

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter un type de livre</title>
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['erreur'])) {
                    print('<div class="alert alert-danger" role="alert"></div>');
                    $_SESSION['message'] = "";
                }
                ?>
                <h1>Ajouter un type de livre</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label>Libellé</label>
                        <input type="text" id="libellé" name="libellé" class="form-control">
                    </div>
                    <a href="index.php" class="btn btn-primary"> Retour </a>
                    <button class="btn btn-primary"> Enregistrer </button>
                </form>
            </section>
        </div>
    </main>
</body>

</html>