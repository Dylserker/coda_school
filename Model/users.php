<?php
    function getAll(PDO $pdo, string | null $search = null, string | null $sortby = null)
    {
        $query = 'SELECT * FROM users';
        if (null !== $search) {
            $query .= ' WHERE id LIKE :search OR username LIKE :search OR email LIKE :search';
        }

        if (null !== $sortby) {
            $query .= " ORDER BY $sortby";
        }
        $statement = $pdo->prepare($query);

        try {
            if (null !== $search) {
                $statement->bindValue(':search', "%$search%");
            }


            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    function toggleEnabled (PDO $pdo, int $id)
    {
        $statement = $pdo->prepare("UPDATE users SET enabled = NOT enabled WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            return $e -> getMessage();
        }

    }

    function delete (PDO $pdo, int $id)
    {
        try {
            $statement = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return true;
        }
        catch (PDOException $e) {
            return $e -> getMessage();
        }
    }

    function getUnlikedUsers (PDO $pdo)
    {
        try {
            $statement = $pdo->prepare("
            SELECT u.id, u.username FROM users AS u
            ORDER BY u.username
        ");
            $statement->execute();
            return $statement-> fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e -> getMessage();
        }
    }

