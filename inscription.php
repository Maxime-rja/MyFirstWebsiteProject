
<?php

include_once('include.php'); 

if(isset($_POST["inscription_submit"]) && $_POST["inscription_submit"] == 1)
{
    extract($_POST); 

    if($_POST["inscription_submit"] == 1)
    {
        $prenom = trim($prenom); 
        $nom = trim($nom);
        $anneeScolaire = trim($anneeScolaire);
        $email = trim($email);
        $motDePasse = trim($motDePasse);
        $motDepasse_retype = trim($motDepasse_retype);
        $description = trim($description);
            
        if(strlen($prenom) <= 12)
        {
            if(strlen($nom) <= 12)
            {
                if(filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                            
                    if($motDePasse == $motDePasse_retype)
                    {
                        $req = $DB->prepare
                        ("
                            SELECT idEtu
                            FROM Etudiant
                            WHERE email = '".$email."' 
                        ");

                        $req->execute(array($email)); 

                        $req = $req->fetch(); 

                        if(isset($req['idEtu']))
                        {
                            header('Location: inscription.php?reg_err=already');
                        }
                        
                        else
                        {
                            $req = $DB->prepare("INSERT INTO Etudiant(nom, prenom, anneeScolaire, email, motDePasse, description) VALUES (?, ?, ?, ?, ?, ?);"); 
                            $req->execute(array($nom, $prenom, $anneeScolaire, $email, $motDePasse, $description)); 

                            header('Location: inscription.php?reg_err=success');
                        }
                        
                    }else header('Location: inscription.php?reg_err=password'); 

                }else header('Location: inscription.php?reg_err=email'); 

            }else header('Location: inscription.php?reg_err=nom_length');

        }else header('Location: inscription.php?reg_err=prenom_length'); 
    }
}


?>

<!DOCTYPE html>
<html>
    
    <head>
        
        <title> ESEO'MEET | Inscription </title>

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
                    <img class="dragon15_gauche" src="public/img/Dragon15.gif">
                    <h1>Inscription</h1>
                    <img class="dragon15_droite" src="public/img/Dragon15.gif">
                </div>
                
                    <form method='post'>
                        <div class="form_column">

                            <div class="form_block">
                                <img class="dragon17" src="public/img/Dragon17.png">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Prenom</b></h4>
                                <input class="form_input" type="text" name="prenom" placeholder="Prenom" required="required" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Nom</b></h4>
                                <input class="form_input" type="text" name="nom" placeholder="Nom" required="required" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Année Scolaire</b></h4>
                                <select class="form_input_annee" type="int" name="anneeScolaire" placeholder="" required="required" autocomplete="off">
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
                                <input class="form_input" type="email" name="email" placeholder="Email" required="required" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Mot de passe</b></h4>
                                <input class="form_input" type="password" name="motDePasse" placeholder="Mot de passe" required="required" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Confirmation du mot de passe</b></h4>
                                <input class="form_input" type="password" name="motDePasse_retype" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Description</b></h4>
                                <input class="form_input" type="text" name="description" placeholder="Parle nous de toi" autocomplete="off">
                            </div>

                            <div>
                                <button type="submit" value ="1" name="inscription_submit" class ="btn_inscription">S'inscrire</button>
                                <?php
                                    header('http://192.168.56.80/pwnd/Projet/connexion.php');
                                ?>
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