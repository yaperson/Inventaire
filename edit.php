    <?php
    session_start();

    // variable global $_post['libelle'] non vide ?
    if (isset($_POST['libellé']) && !empty($_POST['libellé'])){



    }

    // Id existant ?
    if ((isset($_GET['id']) && !empty($_GET['id']))) {

        $id = strip_tags($_GET['id']);
        // connection a la BD
        include_once('connect.php');
        // requete SQL
        $sql = 'UPDATE type_livre SET libellé = ? WHERE id = ?;';
        // preparation de la requete
        $stmt = mysqli_prepare($db, $sql);
        // on relie la variable label et id
        mysqli_stmt_bind_param($stmt, 'i', $id);
        // execution de la requete
        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $id, $libelle);

        //include_once('close.php');


            $_SESSION['erreur'] = "Le type '". $libelle ."' a été modifié";
            header('Location: index.php');
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
                    
                    <label for="label">Libellé</label>
                    <input type="text" id="Libellé" name="Libellé">

                    <p>
                        <a href="index.php">Retour</a>
                        <a href="edit.php?id<?php print($id); ?>">Modifier</a>
                    </p>
                </section>
            </div>
        </main>
    </body>

    </html>