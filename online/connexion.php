<?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=qogi2013_portfolio;charset=utf8','qogi2013_admin','Epse565Z3',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Erreur: '.$e->getMessage());
    }
?>