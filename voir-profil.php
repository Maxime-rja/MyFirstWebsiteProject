<?php

    include_once('include.php');
    
    $get_idEtu = (int) $_GET['idEtu']; 

    if($get_idEtu <= 0)
    {
        header('Location: membres.php');
        exit; 
    }

    if($get_idEtu == $SESSION['compte_id'])
    {
        header('Location: profil.php');
        exit; 
    }



    $req = $DB->prepare
    ("SELECT idEtu, nom, prenom, photo, anneeScolaire, email, description
    FROM Etudiant
    WHERE idEtu = '".$get_idEtu."' "); 

    $req->execute();

    while ($row = $req->fetch())
    {
        $_SESSION["compte_photo"] = $row["photo"];
        $_SESSION["compte_idEtu"] = $row["idEtu"];
        $_SESSION["compte_nom"] = $row["nom"];
        $_SESSION["compte_prenom"] = $row["prenom"];
        $_SESSION["compte_anneeScolaire"] = $row["anneeScolaire"];
        $_SESSION["compte_email"] = $row["email"];
        $_SESSION["compte_description"] = $row["description"];
    }

?>

<!DOCTYPE html>
<html>

    <head>

        <title>ESEO'MEET | Voir-Profil </title>

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
                <h1> Bienvenue sur le profil de  <?php echo $_SESSION["compte_prenom"], ' ', $_SESSION["compte_nom"] ?> </h1>
            </div>

            <img class="dragon_profil" src="public/img/Dragon7.png">

            <div class="userData_column">
                <div class="userData_block">
                    
                    <h2 class="id_utilisateur"> ID Etudiant : <?php echo $_SESSION["compte_idEtu"]; ?> </h2>
                    <h2 class="nom_utilisateur"> Nom : <?php echo $_SESSION["compte_nom"] ?> </h2>
                    <h2 class="prenom_utilisateur"> Prenom : <?php echo $_SESSION["compte_prenom"]; ?> </h2>
                    <h2 class="anneeScolaire_utilisateur"> Annee Scolaire : <?php echo $_SESSION["compte_anneeScolaire"]; ?> </h2>
                    <h2 class="email_utilisateur"> Email : <?php echo $_SESSION["compte_email"]; ?> </h2>
                    <h2 class="description_utilisateur"> Description : <?php echo $_SESSION["compte_description"]; ?> </h2>
                    <img class="dragon18" src="public/img/Dragon18.gif">
                </div>
            </div>

            <div class="btn_deco">

                <a href="http://192.168.56.80/pwnd/Projet/membres.php" class="btn_retour"> Retour </a>
            </div>
        </div>

        <?php
            require('_footer/footer.php'); 
        ?>
        
    </body>

</html>