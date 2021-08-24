    <?php
    session_start();
    // if ((isset($_GET['produit_id']) && !empty($_GET['produit_id']))) {

        $produit_id = strip_tags($_GET['produit_id']);
        include_once('connect.php');

        $sql = 'SELECT produit_id, produit_ref FROM produit WHERE produit_id = ?;';

        $stmt = mysqli_prepare($DataBase, $sql);

        mysqli_stmt_bind_param($stmt, 'i', $produit_id);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $produit_id, $produit_ref);
		mysqli_stmt_fetch($stmt);

        // include_once('close.php');

        // if (!$produit_id) {
        //     $_SESSION['erreur'] = "Ce type de livre n'existe pas";
        //     header('Location: index.php');
        //     exit();
        // }
    // } else {
        // $_SESSION['erreur'] = "URL invalide";
        // header('Location: index.php');
        // exit();
    // }
    ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <title>Document</title>
    </head>

    <body>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h1> Détail du type de livre <?php print($produit_ref); ?> </h1>
                    <p>ID : <?php print($produit_id); ?></p>
                    <p>Libellé : <?php print($produit_ref); ?></p>
                    <p>
						<a class="btn btn-primary" href="index.php">Retour à la liste</a>
						<a class="btn btn-primary" href="edit.php?id=<?php print($produit_id); ?>">Modifier</a>
                    </p>
                </section>
            </div>
        </main>
    </body>

    </html>