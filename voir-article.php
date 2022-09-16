<?php

    include_once('include.php');
    
    $get_idArt = (int) $_GET['idArt'];
    

    if($get_idArt <= 0)
    {
        header('Location: forum.php');
        exit; 
    }

    $req = $DB->prepare
    ("SELECT idArt, contenu, dateCreation, auteur, titre
    FROM Article
    WHERE idArt = '".$get_idArt."' "); 

    $req->execute();

    while ($row = $req->fetch())
    {
        $_ARTICLE["article_idArt"] = $row["idArt"];
        $_ARTICLE["article_contenu"] = $row["contenu"];
        $_ARTICLE["article_DateCreation"] = $row["dateCreation"];
        $_ARTICLE["article_auteur"] = $row["auteur"];
        $_ARTICLE["article_titre"] = $row["titre"];
    }

?>

<!DOCTYPE html>
<html>

    <head>

        <title>ESEO'MEET | Voir-Article </title>

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




        <div class="column">

            <div class="titre_page">
                <h1>  <?php echo $_ARTICLE["article_titre"]; ?> </h1>
            </div>

            <img class="dragon_profil" src="public/img/Dragon7.png">

            <div class="userData_column">
                <div class="userData_block">
                    <h3 class="id_utilisateur"> ID Article : <?php echo $_ARTICLE["article_idArt"]; ?> </h3>
                    <h3 class="nom_utilisateur"> Date de Création : <?php echo $_ARTICLE["article_DateCreation"] ?> </h3>
                    <h3 class="prenom_utilisateur"> Auteur : <?php echo $_ARTICLE["article_auteur"]; ?> </h3>
                    <h2 class="anneeScolaire_utilisateur"><?php echo $_ARTICLE["article_contenu"]; ?> </h2>
                    <img class="dragon18" src="public/img/Dragon18.gif">
                </div>
            </div>

            <div class="btn_deco">
                <a href="http://192.168.56.80/pwnd/Projet/forum.php" class="btn_retour"> Retour </a>
            </div>

            <?php

                if ($_ARTICLE["article_auteur"] == $_SESSION["compte_id"])
                {

            ?>
            
            <form method='post'>
                <div>
                    <button type="submit" value ="1" name="delete_submit" class="btn_delete"> Supprimer l'Article </button>
                </div>
            </form>

            <?php
                    if(isset($_POST["delete_submit"]) && $_POST["delete_submit"] == 1)
                    {
                        extract($_POST); 


                        $req = $DB->prepare
                        (" DELETE FROM Article
                        WHERE Article.auteur = '".$_SESSION["compte_id"]."' 
                        AND Article.idArt = '".$_ARTICLE["article_idArt"]."' ");
                            
                        $req->execute();
                    }
                    header('Location: forum.php');
                    exit; 
                }
            ?>

        </div>

        <?php
            require('_footer/footer.php'); 
        ?>
        
    </body>

</html>