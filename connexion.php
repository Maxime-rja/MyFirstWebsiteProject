<?php

    include_once('include.php'); 


    if(isset($_POST["connexion_submit"]) && $_POST["connexion_submit"] == 1)
    {
        extract($_POST);

        if($_POST["connexion_submit"] == 1)
        {

            $email = trim($email);
            $motDePasse = trim($motDePasse);

            $req = $DB->prepare
            ("SELECT idEtu 
            FROM Etudiant
            WHERE email = '".$email."'
            AND motDePasse = '".$motDePasse."' "); 

            $req->execute();

            while ($row = $req->fetch())
            {
    
                $_SESSION["compte_id"] = $row["idEtu"];
                
            }

        } 
    }

?>

<!DOCTYPE html>
<html>

    <head>

        <?php
            require('_head/meta.php');
            require('_head/link.php');
            require('_head/script.php');  
        ?>

        <div>
            <?php
            if (empty($_SESSION["compte_id"])) { 
            ?>
        </div>

        <title>ESEO'MEET | Connexion </title>

        <?php
                } else { 
        ?>

        <title>ESEO'MEET | Deconnexion </title>

        <?php
                }
        ?>
        
    </head>

    <body>

        <?php
            require('_navbar/navbar.php'); 
        ?>




        
        <?php
            if (empty($_SESSION["compte_id"])) { 
        ?>
        



        <div class="container">
            <div class="form">

                <div class="titre_connexion">
                    <img class="dragon8_gauche" src="public/img/Dragon8.gif">
                    <h1>Connexion</h1>
                    <img class="dragon16_droite" src="public/img/Dragon16.gif">
                </div>
                
                    <form method="post">
                        <div class="form_column">
                            <div class="form_block">
                                <img class="dragon17" src="public/img/Dragon17.png">
                            </div>
                            <div class="form_block">
                                <h4 class="form_label"><b>Email</b></h4>
                                <input class="form_input" type="email" name="email" placeholder="Email" required="required">
                            </div>
                            <div class="form_block">
                                <h4 class="form_label"><b>Mot de passe</b></h4>
                                <input class="form_input" type="password" name="motDePasse" placeholder="Mot De Passe" required="required">
                            </div>
                            <div>
                                <button class="btn_connexion" name="connexion_submit" value="1" type="submit">Se Connecter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        



        <?php
                } else { 
        ?>

        <div class="alert-success">
            <span 
                class="closebtn" onclick="this.parentElement.style.display='none';">&times;
            </span> 
            <strong> Success ! </strong> Vous êtes connecté(e) 
        </div>

        <div class="alert-info">
            <span 
                class="closebtn" onclick="this.parentElement.style.display='none';">&times;
            </span> 
            <strong> Info ! </strong> Vous avez bonne mémoire 
        </div>

        <div class="column">

            <div class="titre_deconnexion">
                <img class="dragon8_gauche" src="public/img/Dragon8.gif">
                <h1> Déconnexion </h1>
                <img class="dragon16_droite" src="public/img/Dragon16.gif">
            </div>

            

            <div class="btn_deco">
                <a href="http://192.168.56.80/pwnd/Projet/connexion.php?logout=1" class="btn_deconnexion"> Se déconnecter </a>
            </div>
        </div>


        <?php
                }
        ?>
        

        <?php
            require('_footer/footer.php'); 
        ?>
        
    </body>

</html>