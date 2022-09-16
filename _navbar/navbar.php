<div class="header">
    <div class="header_texture"></div>
        <div class="header_mask">
            <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 L 0 0 C 25 100 75 100 100 0 L 100 100" fill="#fff"></path>
            </svg>
        </div>
        <div class="container">
            <div class="header_navbar">


                <div class="header_navbar--menu">

                    <img class = "logo" src="public/img/logo_eseo.png">
                    <a href="http://192.168.56.80/pwnd/Projet/forum.php" class="header__navbar--menu-link"><i class="fa-solid fa-newspaper"></i> Forum </a>
                    <a href="http://192.168.56.80/pwnd/Projet/membres.php" class="header__navbar--menu-link"><i class="fa-solid fa-dragon"></i> Membres</a>

                    <?php
                        if (empty($_SESSION["compte_id"])) {
                    ?>

                    
                    <a href="http://192.168.56.80/pwnd/Projet/connexion.php" class="header__navbar--menu-link"><i class="fa-solid fa-person-military-rifle"></i> Connexion</a>
                    <a href="http://192.168.56.80/pwnd/Projet/inscription.php" class="header__navbar--menu-link"><i class="fa-solid fa-person-circle-question"></i> Inscription</a>
                    
                    
                    <?php
                        } else {
                    ?>

                    <a href="http://192.168.56.80/pwnd/Projet/connexion.php" class="header__navbar--menu-link"><i class="fa-solid fa-person-walking-arrow-right"></i> Déconnexion </a>
                    <a href="http://192.168.56.80/pwnd/Projet/profil.php" class="header__navbar--menu-link"><i class="fa-solid fa-id-card"></i> Mon profil </a>
                    
                    <?php
                        }
                    ?>

                </div>

                <div class="header_navbar--toggle">
                    <span class="header_navbar--toggle-icons"></span>
                </div>

                <div class="header_slogan">

                    <div class="Title">
                        <img class ="dragon19" src="public/img/Dragon19.gif" >
                        <h1 class="header_slogan--title">ESEO'meet</h1>
                        <img class ="dragon14_droite" src="public/img/Dragon14.gif">
                    </div>
        

                </div>
            </div>
        </div>
    </div>
<div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="public/js/app.js"></script>



