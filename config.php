<?php

    try
    {
        $bdd = new PDO('mysql: host=localhost; dbname=projet; charset=utf8; login=pwnd, password=network'); 
    }catch(Exception $e)
    {
        die('Erreur' .$e->getMessage()); 
    }

