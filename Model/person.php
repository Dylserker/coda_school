<?php
    function person(PDO $pdo, int $id){
        try {
            $state = $pdo->prepare("SELECT p.*, up.user_id FROM persons AS p LEFT JOIN user_person AS up ON up.person_id = p.id WHERE p.id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->execute();
            return $state->fetch();
        } catch (Exception $e) {
            return "Erreur de requete : {$e->getMessage()}";
        }

    }


    function createPerson(PDO $pdo, array $tab) : string | int
    {
        try {
            $state = $pdo->prepare("INSERT INTO persons (`first_name`, `last_name`, `address`, `zip_code`, `city`, `phone`, `type`) VALUES (:first_name, :last_name, :address, :zip_code, :city, :phone, :type) ");
            $state->bindParam(':first_name',$tab['first_name']);
            $state->bindParam(':last_name',$tab['last_name']);
            $state->bindParam(':address', $tab['address']);
            $state->bindParam(':zip_code', $tab['zip_code']);
            $state->bindParam(':city', $tab['city']);
            $state->bindParam(':phone', $tab['phone']);
            $state->bindParam('type', $tab['type'], PDO::PARAM_INT);
            $state->execute();
            return  (int)$pdo->lastInsertId();

        } catch (Exception $e){
            return $e -> getMessage();
        }
    }

    function updatePerson(PDO $pdo, array $tab, int $id) : string | bool
    {
        try {
            $state = $pdo->prepare("UPDATE persons SET first_name = :first_name, last_name = :last_name, address = :address, zip_code = :zip_code, city = :city, phone = :phone, type = :type WHERE id = :id");
            $state->bindParam(':id', $id, PDO::PARAM_INT);
            $state->bindParam(':first_name',$tab['first_name']);
            $state->bindParam(':last_name',$tab['last_name']);
            $state->bindParam(':address', $tab['address']);
            $state->bindParam(':zip_code', $tab['zlinked_user_idip_code']);
            $state->bindParam(':city', $tab['city']);
            $state->bindParam(':phone', $tab['phone']);
            $state->bindParam('type', $tab['type'], PDO::PARAM_INT);
            $state->execute();
            return $state->execute();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function createLinkUserToPerson(PDO $pdo, array $tab, int $id)
    {
        $state = $pdo->prepare("INSERT INTO user_person (`user_id`, `person_id`) VALUES (:user_id, :person_id)");
        $state->bindParam(':user_id', $tab['linked_user_id']);
        $state->bindParam(':person_id', $id);
        try {
            $state -> execute();
        } catch (PDOException $e){
            return $e -> getMessage();
        }
        return true;
    }