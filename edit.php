<?php
//On demarre une sesssion
session_start();

//Esct ce que la variable global $_POST['label']n'est pas vide
if ((isset($_POST['produit_ref'])) && (!empty($_POST['produit_ref']))) {
    // 
    $produit_id = strip_tags($_GET['produit_id']);
    $produit_ref = strip_tags($_POST['produit_ref']);
    $produit_quantite = strip_tags($_POST['produit_quantite']);


    // On se connecte à la base de données
    include_once('connect.php');

    $sql = 'UPDATE produit SET produit_ref = ?, produit_quantite = '. $produit_quantite .' WHERE produit_id = ?;';

    //on prepare la requete 
    $stmt = mysqli_prepare($DataBase, $sql);

    // on relie la variable produit et id
    mysqli_stmt_bind_param($stmt, 'si', $produit_ref, $produit_id);

    //on execute la requete
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    //On ferme la connexion 
    //include_once('close.php');

    $_SESSION['message'] = 'Le nom du produit "' . $produit_ref . '"a été modifié';

    header('Location: index.php');
} else {
    //Esct ce que l'id existe et n'est pas vite dans l'URL
    if ((isset($_GET['produit_id'])) && !empty($_GET['produit_id'])) {
        $produit_id = strip_tags($_GET['produit_id']);




        // On se connecte à la base de données
        include_once('connect.php');
        //On exécute la reque^te SQL et on stocke le résultat dans un tableau associatif 


        $sql = 'SELECT produit_id, produit_ref, produit_quantite FROM produit WHERE produit_id = ?;';

        //on prepare la requete 
        $stmt = mysqli_prepare($DataBase, $sql);

        // on relie la variable id
        mysqli_stmt_bind_param($stmt, 'i', $produit_id);

        //on execute la requete
        mysqli_stmt_execute($stmt);

        //on definit les variable qui va recup le type de livre
        mysqli_stmt_bind_result($stmt, $produit_id, $produit_ref, $produit_quantite);

        mysqli_stmt_fetch($stmt);

        //On ferme la connexion 
        //include_once('close.php');

    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Modifier</title>
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Modifier le nom du produit <?php print($produit_ref); ?></h1>

                <form method="POST">
                    <div class="mb-3">

                        <p>ID : <?php print($produit_id); ?> </p>


                        <label for="produit_ref">produit</label>
                        <input type="hidden" id='produit_id' name="produit_id" value="<?php print($produit_id); ?>">
                        <input type="text" id="produit_ref" name="produit_ref" class="form-control" value="<?php print($produit_ref); ?>">
                        <input type="number" name="produit_quantite" id="produit_quantite" value="<?php print($produit_quantite ); ?>">
                    </div>
                    <p>

                        <a class="btn btn-info" href="index.php"> Retour à la liste </a>
                        <button class="btn btn-primary"> Modifier</button>

                    </p>
                </form>
            </section>
        </div>
    </main>

</body>

</html>