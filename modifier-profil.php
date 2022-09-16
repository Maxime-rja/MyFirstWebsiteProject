
<?php

include_once('include.php'); 

if(isset($_POST["modification_submit"]) && $_POST["modification_submit"] == 1)
{
    extract($_POST); 

    if($_POST["modification_submit"] == 1)
    {
        $new_prenom = trim($new_prenom); 
        $new_nom = trim($new_nom);
        $new_anneeScolaire = trim($new_anneeScolaire);
        $new_email = trim($new_email);
        $new_motDePasse = trim($new_motDePasse);
        $new_motDepasse_retype = trim($new_motDepasse_retype);
        $new_description = trim($new_description);

        $id_etu = $_SESSION["compte_id"]; 

            
        if(!empty($new_nom))
        {
            if(strlen($new_nom) <= 12)
            {
                $req_prenom = $DB->prepare("UPDATE Etudiant SET nom = '$new_nom' WHERE idEtu = $id_etu");
                $req_prenom->execute();
            }
            else header('Location: modifier-profil.php?reg_err=nom_length');
        }

        if(!empty($new_prenom))
        {
            if(strlen($new_prenom) <= 12)
            {
                $req_prenom = $DB->prepare("UPDATE Etudiant SET prenom = '$new_prenom' WHERE idEtu = $id_etu "); 
                $req_prenom->execute();
            }
            else header('Location: modifier-profil.php?reg_err=prenom_length');   
        }

        if(!empty($new_anneeScolaire))
        {
            $req_anneeScolaire = $DB->prepare("UPDATE Etudiant SET anneeScolaire = '$new_anneeScolaire' WHERE idEtu = $id_etu "); 
            $req_anneeScolaire->execute();
        }

        if(!empty($new_email))
        {
            if(filter_var($new_email, FILTER_VALIDATE_EMAIL))
            {
                $req = $DB->prepare
                ("
                SELECT idEtu
                FROM Etudiant
                WHERE email = '".$new_email."' 
                ");

                $req->execute(array($new_email)); 

                $req = $req->fetch(); 

                if(isset($req['idEtu']))
                {
                    header('Location: modifier-profil.php?reg_err=already');
                }

                else
                {
                    $req_email = $DB->prepare("UPDATE Etudiant SET email = '$new_email' WHERE idEtu = $id_etu "); 
                    $req_email->execute();
                } 
            }
            else header('Location: modifier-profil.php?reg_err=email');
        }


        if(!empty($new_motDePasse))
        {
            if($new_motDePasse == $new_motDePasse_retype)
            {
                $req_motDePasse = $DB->prepare("UPDATE Etudiant SET motDePasse = '$new_motDePasse' WHERE idEtu = $id_etu "); 
                $req_motDePasse->execute();
            }
            else header('Location: modifier-profil.php?reg_err=password');
        }

        if(!empty($new_description))
        {
            $req_description = $DB->prepare("UPDATE Etudiant SET description = '$new_description' WHERE idEtu = $id_etu "); 
            $req_description->execute();
        } 
    }
}

?>

<!DOCTYPE html>
<html>
    <head>

        <?php
                require('_navbar/navbar.php'); 
        ?>

        
        <title> ESEO'MEET | Modifier Informations </title>

        <?php
            require('_head/meta.php');
            require('_head/link.php');
            require('_head/script.php');  
        ?>

    </head>

    <body>
        
    <?php
            if(isset($_GET['reg_err']))
            {
                $err = htmlspecialchars($_GET['reg_err']);

                switch($err)
                {
                    case 'password' :
                    ?> 

                        <div class="alert-danger">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Danger ! </strong> Mot de passe non valide.
                        </div>

                        <div class="alert-info">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Info ! </strong> Assurez que les deux mots de passe sont identiques.
                        </div>
                        
                    <?php
                    break;
                    
                    case 'email' :
                    ?>
    
                        <div class="alert-danger">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Danger ! </strong> Email non valide.
                        </div>

                        <div class="alert-info">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Info ! </strong> Attention au format de l'email.
                        </div>
                    <?php
                    break;

                    case 'success' :
                    ?>
                        <div class="alert-success">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Success ! </strong> Votre êtes désormais inscrit. 
                        </div>

                        <div class="alert-info">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Info ! </strong> Dirigez-vous vers la page de connexion. 
                        </div>
                    <?php
                    break;
                    
                    case 'prenom_length' :
                    ?>
        
                        <div class="alert-warning">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Warning ! </strong> Prenom non valide.
                        </div>

                        <div class="alert-info">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Info ! </strong> Ne dépassez pas 12 caractères.
                        </div>
                    <?php
                    break;

                    case 'nom_length' :
                    ?>
        
                        <div class="alert-warning">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Warning ! </strong> Nom non valide.
                        </div>

                        <div class="alert-info">
                        <span 
                            class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                        </span> 
                            <strong> Info ! </strong> Ne dépassez pas 12 caractères.
                        </div>
                    <?php
                    break;


                    case 'already' :
                        ?>
            
                            <div class="alert-danger">
                            <span 
                                class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                            </span> 
                                <strong> Danger ! </strong> L'email est déjà utilisé.
                            </div>
    
                            <div class="alert-info">
                            <span 
                                class="closebtn" onclick="this.parentElement.style.display='none';">&times;
                            </span> 
                                <strong> Info ! </strong> Utilisez une autre addresse email ou retrouvez votre compte.
                            </div>
                        <?php
                        break;
                }
            }
            ?> 

        <div class="container">
            <div class="form">

                <div class="titre_inscription">
                    <!-- <img class="dragon9_gauche" src="public/img/Dragon9.gif"> -->
                    <h1>Modifier mes Informations</h1>
                    <!-- <img class="dragon9_droite" src="public/img/Dragon9.gif"> -->
                </div>
                
                    <form method='post'>
                        <div class="form_column">

                            <div class="form_block">
                                <img class="dragon17" src="public/img/Dragon17.png">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Prenom</b></h4>
                                <input class="form_input" type="text" name="new_prenom" placeholder="Nouveau Prenom" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Nom</b></h4>
                                <input class="form_input" type="text" name="new_nom" placeholder="Nouveau Nom" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Année Scolaire</b></h4>
                                <select class="form_input_annee" type="int" name="new_anneeScolaire" placeholder=""  autocomplete="off">
                                    <option value='1'>E1</option>
                                    <option value='2'>E2</option>
                                    <option value='3'>E3e</option>
                                    <option value='4'>E4e</option>
                                    <option value='5'>E5e</option>
                                    <option value='6'>E3a</option>
                                    <option value='7'>E4a</option>
                                    <option value='8'>E5a</option>
                                    <option value='9'>B1</option>
                                    <option value='10'>B2</option>
                                    <option value='11'>B3</option>
                                </select>
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Email</b></h4>
                                <input class="form_input" type="email" name="new_email" placeholder="Nouvel Email" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Mot de passe</b></h4>
                                <input class="form_input" type="password" name="new_motDePasse" placeholder="Nouveau Mot de passe" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Confirmation du mot de passe</b></h4>
                                <input class="form_input" type="password" name="new_motDePasse_retype" placeholder="Re-tapez le nouveau mot de passe" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Description</b></h4>
                                <input class="form_input" type="text" name="new_description" placeholder="Nouvelle description" autocomplete="off">
                            </div>

                            <div>
                                <button type="submit" value ="1" name="modification_submit" class ="btn_modifier">Valider les modifications</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
 

        <?php
            require('_footer/footer.php'); 
        ?>

    </body>

</html>