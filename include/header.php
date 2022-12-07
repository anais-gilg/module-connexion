
<?php
    



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
        <title>Header</title>
    </head>

    <body>

        <?php if ($userConnected == false) {?>
            
            <div class="hder2">            
                <header>
                    <nav>
                        <ul>
                            
                            <li><a href="http://localhost:8888/module-connexion/accueil/index.php">Home</a></li>
                            <li><a href="http://localhost:8888/module-connexion/connexion.php">Log in</a></li> 
                            <li><a href="http://localhost:8888/module-connexion/inscription.php">Creation account</a></li>
                        </ul>
                    </nav>
                </header>
            </div>

        <?php } elseif ($login === "admin"){ ?>

            <div class="hder2">
                <header>
                    <nav>
                        <ul>
                            <li><a href="http://localhost:8888/module-connexion/accueil/index.php">Home</a></li>
                            <li><a href="http://localhost:8888/module-connexion/profil.php">Modification</a></li>
                            <li><a href="http://localhost:8888/module-connexion/admin.php">Admin</a></li>
                            <li><a href="http://localhost:8888/module-connexion/include/logout.php">Logout</a></li> 
                        </ul>
                    </nav>
                <header>
            </div>
            
            
        <?php } else { ?>
                
            <div class="hder2">
                <header>
                    <nav>
                        <ul>
                            <li><a href="http://localhost:8888/module-connexion/accueil/index.php">Home</a></li>
                            <li><a href="http://localhost:8888/module-connexion/profil.php">Modification</a></li>
                            <li><a href="http://localhost:8888/module-connexion/include/logout.php">Logout</a></li> 
                        </ul>
                    </nav>
                <header>
            </div>
        <?php } ?>
    </body>
            
</html>