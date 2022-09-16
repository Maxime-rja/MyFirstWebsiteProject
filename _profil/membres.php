<?php

    include_once('../include.php'); 

    $req_sql = "SELECT prenom, idEtu 
    FROM Etudiant "; 

    if(isset($_SESSION["compte_id"]))
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
            require('../_head/meta.php');
            require('../_head/link.php');
            require('../_head/script.php');  
        ?>

    </head>

    <body>



        <?php
            require('../_navbar/navbar.php'); 
        ?>

        <div class="container">

                <div class="titre_page">
                    <img class="dragon3" src="../public/img/Dragon3.png">
                    <h1>Membres</h1>
                    <img class="dragon3" src="../public/img/Dragon3.png">
                </div>

                <!-- <div class="img_dragons">
                    <img class="dragon3" src="../public/img/Dragon3.png">
                </div> -->


                <?php
                    foreach($req_membres as $rm) {
                ?>

                <div class="prenom">

                    <div>
                        <?= $rm['prenom'] ?>
                    </div>
                    
                    <div>
                        <a href="voir_profil.php?idEtu= <?= $rm['idEtu'] ?>">Voir profil</a>
                    </div>

                </div>

                <?php
                    }
                ?>
            </div>
        </div>




        <?php
            require('../_footer/footer.php'); 
        ?>
        
    </body>
</html>