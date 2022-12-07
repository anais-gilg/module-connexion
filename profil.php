<?php
    session_start();

    #----------------db connect----------------#
    require("include/dbconnect.php");

    #----------------creation of a variable for error messages----------------#
    $msgError = "";
    $msgSucces = "";
    
    #----------------To prevent a user from accessing this page if they are not logged in----------------#
    if (!isset($_SESSION['id'])){
        header('Location: accueil/index.php');
    }
    
    #----------------Recover the information of the connected user----------------#
    $id = $_SESSION['id'][0];
    $recupUser = mysqli_query($connect, "SELECT * FROM `utilisateurs` WHERE id = '$id'" );
    $user = mysqli_fetch_array($recupUser);

    $login = $user['login'];
    $prenom = $user['prenom'];
    $nom = $user['nom'];
    $password = $user['password'];

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

            $id = $_SESSION['id'][0];

            $check_login = mysqli_query($connect, "SELECT * FROM `utilisateurs` WHERE login='$login'");
            if (mysqli_num_rows($check_login) == 0){
                
                #----------------the same password----------------#
                if ($password === $confpassword){
                    #----------------Add user in db----------------#
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  
                    $new_info = mysqli_query($connect, "UPDATE `utilisateurs` SET `login`='$login',`prenom`='$prenom',`nom`='$nom',`password`='$password' WHERE id = '$id'");
                    

                    if ($new_info){
                        $msgSucces = 'The modification has been correctly done';
                    }
                    else {
                        $msgError = 'The modification failed';
                    }

                }
                else {
                    $msgError = 'Invalid password';
                } 


            }else {
                $msgError = '';
            }

        }
        else {
            $msgError = 'ID incorrect, <br> please check your login and/or password';
        }

    }
    else {
        
    }


?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Profil</title>
    </head>

    <body>
        <div class="hder1">
            <header>
                <?php require("include/header.php"); ?>          
            </header>
        </div>

        <main>

            <div class="titre2">
            
                <h1 class="otherh1">Modification</h1>
                <p class="msgerror"><?php echo $msgError ?></p>
                <p class="msgsucces"><?php echo $msgSucces ?></p>

                <div class="blocform">
                <form action="" method="post" id="form">
                    
                    <div class="newinfo">
                    <input type="text" name="login" id="login" placeholder="New login" value="<?php echo $login; ?>" required> <br />
                    <input type="text" name="prenom" id="prenom" placeholder="New firstname" value="<?php echo $prenom; ?>" required> <br />
                    <input type="text" name="nom" id="nom" placeholder="New lastname" value="<?php echo $nom; ?>" required> <br />

                    <!--type password to hide the code-->
                    <input type="password" name="password" id="password" placeholder="New password" required> <br/>
                    <input type="password" name="confpassword" id="confpassword" placeholder="Confirmation new password" required> <br/>
                    <br /> <br />
                    <input class="submit" type="submit" name="envoyer" value="Enter" id="buton">
                    </div>
                </form>
                </div>

            </div>
        </main>

        
    </body>
</html>