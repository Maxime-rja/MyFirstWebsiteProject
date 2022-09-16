<?php

    include_once('include.php');
    
    if (empty($_SESSION["compte_id"])) 
    {
       
    }

    else
    {
        $req = $DB->prepare
        ("SELECT idEtu, nom, prenom, photo, anneeScolaire, email, motDePasse, description
        FROM Etudiant
        WHERE idETU = '".$_SESSION["compte_id"]."' "); 

        $req->execute();

        while ($row = $req->fetch())
        {
            $_SESSION["compte_photo"] = $row["photo"];
            $_SESSION["compte_id"] = $row["idEtu"];
            $_SESSION["compte_nom"] = $row["nom"];
            $_SESSION["compte_prenom"] = $row["prenom"];
            $_SESSION["compte_anneeScolaire"] = $row["anneeScolaire"];
            $_SESSION["compte_email"] = $row["email"];
            $_SESSION["compte_motDePasse"] = $row["motDePasse"];
            $_SESSION["compte_description"] = $row["description"];
        }
    }
    

    

    

?>

<!DOCTYPE html>
<html>

    <head>

        <title>ESEO'MEET | Profil </title>

        <?php
            require('../_head/meta.php');
            require('../_head/link.php');
            require('../_head/script.php');  
        ?>
        
    </head>



    <body>

        <?php
            require('../_navbar/navbar.php'); 
        ?>




        <div>
            <?php
            if (empty($_SESSION["compte_id"])) { 
            ?>
        </div>


        <?php
                } else { 
        ?>




        <div class="column">

            <div class="titre_page">
                <h1> Bienvenue sur votre profil </h1>
            </div>

            <img class="dragon7" src="public/img/Dragon7.png">

            <div class="userData_column">
                <div class="userData_block">
                    
                    <h2 class="id_utilisateur"> Id Etudiant : <?php echo $_SESSION["compte_id"]; ?> </h2>
                    <h2 class="nom_utilisateur"> Nom : <?php echo $_SESSION["compte_nom"] ?> </h2>
                    <h2 class="prenom_utilisateur"> Prenom : <?php echo $_SESSION["compte_prenom"]; ?> </h2>
                    <h2 class="anneeScolaire_utilisateur"> Annee Scolaire : <?php echo $_SESSION["compte_anneeScolaire"]; ?> </h2>
                    <h2 class="email_utilisateur"> Email : <?php echo $_SESSION["compte_email"]; ?> </h2>
                    <h2 class="motDePasse_utilisateur"> Mot De Passe : <?php echo $_SESSION["compte_motDePasse"]; ?> </h2>
                    <h2 class="description_utilisateur"> Description : <?php echo $_SESSION["compte_description"]; ?> </h2>
                </div>
            </div>

            <div class="btn_deco">

                <a href="http://192.168.56.80/pwnd/Projet/connexion.php" class="btn_deconnexion"> Déconnexion </a>
            </div>
        </div>


        <?php
                } 
        ?>


        <?php
            require('../_footer/footer.php'); 
        ?>
        
    </body>

</html>