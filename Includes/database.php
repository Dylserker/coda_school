<?php

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=coda_school_new', 'root', '0000');
    } catch (Exception $e) {
        $errors[] = "Erreur de connexion à la bdd {$e->getMessage()}";
    }


?>