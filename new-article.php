
<?php

include_once('include.php'); 

if(isset($_POST["creation_submit"]) && $_POST["creation_submit"] == 1)
{
    extract($_POST); 

    if($_POST["creation_submit"] == 1)
    {
        $Titre = trim($titre); 
        $DateCreation = trim($dateCreation);
        $Contenu = trim($contenu);

        
        
        if(!empty($titre) && !empty($dateCreation) && !empty($contenu))
        {

            $req = $DB->prepare("INSERT INTO Article(auteur, titre, dateCreation, contenu) VALUES (?, ?, ?, ?);"); 
            $req->execute(array($_SESSION["compte_id"], $Titre, $DateCreation, $Contenu));

            header('Location: forum.php?reg_err=success');

        }else header('Location: new-article.php?reg_err=empty'); 
    }
}

?>

<!DOCTYPE html>
<html>
    <head>

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
        
        <title> ESEO'MEET | Modifier Informations </title>

        <?php
            require('_head/meta.php');
            require('_head/link.php');
            require('_head/script.php');  
        ?>

    </head>

    <body>

        <div class="container">
            <div class="form">

                <div class="titre_inscription">
 
                    <h1>Création de votre Article</h1>

                </div>
                
                    <form method='post'>
                        <div class="form_column">

                            <div class="form_block">
                                <img class="dragon17" src="public/img/Dragon17.png">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Titre</b></h4>
                                <input class="form_input" type="text" name="titre" placeholder="Titre de l'Article" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Date de Creation</b></h4>
                                <input class="form_input" type="datetime-local" name="dateCreation" placeholder="Date de Création de l'Article" autocomplete="off">
                            </div>

                            <div class = "form_block">
                                <h4 class="form_label"><b>Contenu</b></h4>
                                <input class="form_input" type="text" name="contenu" placeholder="Contenu de l'Article" autocomplete="off">
                            </div>

                            <div>
                                <button type="submit" value ="1" name="creation_submit" class ="btn_creation">Publication de l'Article</button>
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