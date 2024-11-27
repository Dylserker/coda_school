<?php
function getUser(PDO $pdo,string $username): array | bool
    {
    $query = 'SELECT username, password FROM users WHERE username = :username';
        /**
         * @var PDO $pdo
         */
    $res = $pdo->prepare($query);
    $res->bindParam(':username', $username);
    $res->execute();
    return $res->fetch();
    }