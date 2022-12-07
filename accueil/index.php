<?php

session_start();

require("../include/dbconnect.php");

    $userConnected = false;

    if(isset ($_SESSION['id'])){
        $id = $_SESSION['id'][0];
        $userConnected = true;

        $login = $_SESSION['login'];

        $recupUser = mysqli_query($connect, "SELECT prenom, nom FROM `utilisateurs` WHERE id = '$id'" );
        $correctUser = mysqli_fetch_array($recupUser);
    }



?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Accueil</title>
    </head>

    <body>
        
        <?php require("../include/header.php"); ?>

            <main>
                <div class="titre">
                    <?php if ($userConnected) {?>
                        
                        <h1>Welcome <?php echo $login ?> ! </h1>
                        
                    <?php } else {?>
                        <h1>Welcome ! </h1>
                    <?php } ?>
                </div>
                
            </main>
    </body>
</html>