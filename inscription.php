<?php
    session_start();

    #----------------Create a connection----------------#
    require("include/dbconnect.php");

    
    #----------------creation of a variable for error messages ----------------#
    $msgError = "";

    #----------------When you press the buton----------------#
    if(isset($_POST['envoyer'])){

        #----------------Check if the fields are filled in----------------#
        if(!empty($_POST['login']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['password'])){

            #----------------Security----------------#
            // htmlspecialchars is for security so that nobody can insert
            // an html or javascript code in this field and thus make an attack Cross-Site Scripting
            $login = htmlspecialchars($_POST['login']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);
            $password = $_POST['password'];
            $confpassword = $_POST['confpassword'];


            #----------------Check the login exist----------------#
            $check_login = mysqli_query($connect, "SELECT * FROM `utilisateurs` WHERE login='$login'");
            if (mysqli_num_rows($check_login) == 0){
            
                #----------------the same password----------------#
                if ($password === $confpassword){
                    #----------------Add user in db----------------#
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $insertUser = $connect -> query("INSERT INTO `utilisateurs`(`login`, `prenom`, `nom`, `password`) VALUES ('$login','$prenom','$nom','$password')");
                    header('Location: connexion.php');
                    
                }
                else {
                    $msgError = 'Invalid password';
                }

            }
            else {
                $msgError = 'This login already exists';
                
            }

        }
        else {
            $msgError = 'Please fill in all fields';
        }
    }
    

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Inscription</title>
    </head>

    <body>

        <div class="hder1">
            <header>
                <?php require("include/header.php"); ?>
            </header>
        </div>

        <main>

            <div class="titre2">
                <h1 class="otherh1">Inscription</h1>
                <p class="msgerror"><?php echo $msgError ?></p>
                <form action="" method="post" id="from">
                    
                    <div class="newinfo">
                        <input type="text" name="login" id="login" placeholder="Login" autocomplete="off" required> <br>
                        
                        <input type="text" name="prenom" id="prenom" placeholder="Firstname" autocomplete="off" required> <br>
                        <input type="text" name="nom" id="nom" placeholder="Lastname" autocomplete="off" required> <br>

                        <!--type password to hide the code-->
                        <input type="password" name="password" id="password" placeholder="Password" required> <br>
                        <input type="password" name="confpassword" id="confpassword" placeholder="Confirmation password" required> <br>
                        <br><br>
                        <input class="submit" type="submit" name="envoyer" value="Enter" id="buton">
                    </div>

                </form>
            </div>

        </main>


        
    </body>
</html>