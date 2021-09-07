    <?php
    session_start();
    if ((isset($_GET['id']) && !empty($_GET['id']))) {

        $id = strip_tags($_GET['id']);

        include_once('connect.php');

        $sql = 'SELECT id, libelle FROM type_livre WHERE id = ?;';

        $stmt = mysqli_prepare($db, $sql);

        mysqli_stmt_bind_param($stmt, 'i', $id);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $id, $libelle);

        //include_once('close.php');

        if (!$id) {
            $_SESSION['erreur'] = "Ce type de livre n'existe pas";
            header('Location: index.php');
            exit();
        }
    } else {
        $_SESSION['erreur'] = "URL invalide";
        header('Lacation: index.php');
        exit();
    }
    ?>
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
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h1> Détail du type de livre <?php print($libelle); ?> </h1>
                    <p>ID : <?php print($id); ?></p>
                    <p>Libellé : <?php print($libelle); ?></p>
                    <p>
                        <a href="index.php">Retour</a>
                        <a href="edit.php?id<?php print($id); ?>">Modifier</a>
                    </p>
                </section>
            </div>
        </main>
    </body>

    </html>