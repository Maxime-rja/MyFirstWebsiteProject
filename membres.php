<?php

    include_once('include.php'); 

    $req_sql = "SELECT prenom, idEtu 
    FROM Etudiant "; 

    if(isset($_SESSION["idEtu"]))
    {
        $req_sql .= "WHERE idEtu <> ?"; 
    }

    $req = $DB->prepare($req_sql); 

    if(empty($_SESSION["compte_id"]))
    {
        $req->execute(); 
    }
    else
    {
        $req->execute([$_SESSION]["idEtu"]); 
    }


    // $req = $DB->prepare("SELECT * FROM Etudiant "); 


    $req_membres = $req->fetchAll(); 

?>


<!DOCTYPE html>
<html>
    <head>
    

    <title> ESEO'MEET | Membres </title>

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

        <div class="container">

            <div class="titre_logo_membres"> 

                <img class ="dragon10_gauche" src="public/img/Dragon10.gif" >
                <h1> Membres </h1>
                <img class ="dragon10_droite" src="public/img/Dragon10.gif" >
    
            </div>

            <div class="liste_profil">

                <?php
                    foreach($req_membres as $rm) {
                ?>

                <div class="prenom_btn">
                    
                    <img class="chevalier" src="public/img/Chevalier.gif">
                    
                    <div class="prenom">
                        <b> <?= $rm['prenom'] ?> </b>
                    </div>

                    <div class="btn">
                        <a class="btn_voir-profil" href="voir-profil.php?idEtu= <?= $rm['idEtu'] ?>">Voir profil</a>
                    </div>

                </div>
                

                <?php
                    }
                ?>

            </div>

        </div>




        <?php
            require('_footer/footer.php'); 
        ?>
        
    </body>
</html>