<?php

    include_once('include.php');

    $req = $DB->prepare
    ("SELECT *
    FROM Article
    ORDER BY dateCreation DESC
    ");

    $req->execute(); 

    $req_forum = $req->fetchAll(); 

?>


<!DOCTYPE html>
<html>
    <head>

    <title> ESEO'MEET | Forum </title>

        <?php
            require('_head/meta.php');
            require('_head/link.php');
            require('_head/script.php');  
        ?>

    </head>

    <body>

        <?php
            require('_navbar/navbar.php'); 
        ?>

        <?php
            if(isset($_GET['reg_err']))
            {
                $err = htmlspecialchars($_GET['reg_err']);

                switch($err)
                {
                    case 'empty' :
                    ?> 

                        <div class="alert-danger">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Danger ! </strong> L'un des champs n'a pas été rempli.
                        </div>

                        <div class="alert-info">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Info ! </strong> Veillez à remplir tout les champs.
                        </div>
                        
                    <?php
                    break;

                    case 'success' :
                        ?>
                            <div class="alert-success">
                            <span 
                                class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                            </span> 
                                <strong> Success ! </strong> Votre article a bien été publié. 
                            </div>

                            <div class="alert-info">
                            <span 
                                class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                            </span> 
                                <strong> Info ! </strong> Dirigez-vous vers le forum pour le visualiser. 
                            </div>
                        <?php
                        break;
                }
            }
        ?>

        <div class='container_forum'>
            
            <div class= 'titre_forum'>
                <h1> Forum </h1>
            </div>


            <div class="liste_article">

                <?php
                    foreach($req_forum as $rf) {
                ?>

                <div class="article">
                

                    <b> <?= $rf['titre'] ?> </b>

                    <a class="btn_voir-article" href="voir-article.php?idArt= <?= $rf['idArt'] ?>">Voir article</a>
                    
                </div>

                <?php
                    }
                ?>

            </div>
            
            <?php
                if (!empty($_SESSION["compte_id"])) {
            ?>

                <div class="btn_creation_article">
                    <a href="http://192.168.56.80/pwnd/Projet/new-article.php" class="btn_article"> Créer un Article </a>
                </div>
            
            <?php
                } else {
            ?>

                <div class="btn_creation_article">
                    <h2 class='msg_redirection'>Connectez-vous pour créer votre Article ! <h2>
                    <a href="http://192.168.56.80/pwnd/Projet/connexion.php" class="btn_article"> Se Connecter </a>
                </div>
            
            <?php
                }
            ?>
            

        </div>


        <?php
            require('_footer/footer.php'); 
        ?>
        
    </body>
</html>