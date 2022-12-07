<?php

    session_start();

    // db connect
    require("include/dbconnect.php");

    #----------------To prevent a user from accessing this page if they are not logged in----------------#
    if (!isset($_SESSION['id'])){
        header('Location: accueil/index.php');
    }  

    $viewdb = mysqli_query($connect, "SELECT id, login, prenom, nom FROM `utilisateurs`");
    $showdb = $viewdb -> fetch_all();
    
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Admin</title>
    </head>

    <body>

        <div class="hder1">
            <header>
                <?php require("include/header.php"); ?>
            </header>
        </div>

        <main>

            <div class="array">

                <table>
                    <tbody>                     
                        <tr>                    
                            <th>Id</th>       
                            <th>Login</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                        </tr>  

                        <?php 
                        
                        foreach($showdb as $resultat => $personne){
                            echo 
                            "<tr>                    
                                <td>$personne[0]</td>       
                                <td>$personne[1]</td>
                                <td>$personne[2]</td>
                                <td>$personne[3]</td>
                            </tr>";
                        }
                        ?>

                        
                    </tbody>
                </table>

            </div>

        </main>
        
    </body>
</html>