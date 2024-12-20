<?php
    function getAllPersons(PDO $pdo, int $page)
    {
        $query = "SELECT * FROM persons LIMIT 20";

       if (1 !== $page) {
           $page = ($page - 1) * 20;
           $query .= " OFFSET $page";
       }
        $statement = $pdo->prepare($query);

        try {
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    function getCountPersons (PDO $pdo){
        $query = 'SELECT COUNT(id) AS `idCount` FROM persons';
        $statement = $pdo->prepare($query);
        try {
            $statement -> execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            return $e ->getMessage();
        }
    }
