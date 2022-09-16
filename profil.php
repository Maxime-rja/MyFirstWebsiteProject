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
        WHERE idEtu = '".$_SESSION["compte_id"]."' "); 

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

        $id = $_SESSION["compte_id"];
        $nbAnnee = $_SESSION["compte_anneeScolaire"]; 


        $req_year = $DB->prepare(
        "SELECT AnneeScolaire.nom
        FROM Etudiant, AnneeScolaire
        WHERE AnneeScolaire.idAnneeScolaire = $nbAnnee AND idEtu = $id "); 

        $req_year->execute();

        while($row = $req_year->fetch()); 
        {
            $_SESSION["compte_anneeScolaire_letter"] = $row["AnneeScolaire.nom"];
        }

        // echo $id;
        // echo $nbAnnee; 

        // echo $_SESSION["compte_anneeScolaire_letter"]; 

    }
    

    

    

?>

<!DOCTYPE html>
<html>

    <head>

        <title>ESEO'MEET | Profil </title>

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
                <h1> Bienvenue sur votre profil <?php echo $_SESSION["compte_prenom"]; ?> </h1>
            </div>

            <img class="dragon_profil" src="public/img/Dragon20.gif">

            <div class="userData_column">
                <div class="userData_block">
                    
                    <h2 class="id_utilisateur"> ID Etudiant : <?php echo $_SESSION["compte_id"]; ?> </h2>
                    <h2 class="nom_utilisateur"> Nom : <?php echo $_SESSION["compte_nom"] ?> </h2>
                    <h2 class="prenom_utilisateur"> Prenom : <?php echo $_SESSION["compte_prenom"]; ?> </h2>
                    <h2 class="anneeScolaire_utilisateur"> Annee Scolaire : <?php echo $_SESSION["compte_anneeScolaire_letter"]; ?> </h2>
                    <h2 class="email_utilisateur"> Email : <?php echo $_SESSION["compte_email"]; ?> </h2>
                    <h2 class="motDePasse_utilisateur"> Mot De Passe : <?php echo $_SESSION["compte_motDePasse"]; ?> </h2>
                    <h2 class="description_utilisateur"> Description : <?php echo $_SESSION["compte_description"]; ?> </h2>
                    <img class="dragon18" src="public/img/Dragon18.gif">
                    <a class='btn_modification' href="modifier-profil.php" > Modifier mes informations </a>
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
            require('_footer/footer.php'); 
        ?>
        
    </body>

</html>