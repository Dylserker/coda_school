<?php
/**
 * @var PDO $pdo
 */
    require "Model/persons.php";
if (
    !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')
){
        $page = isset($_GET['page']) ? cleanString($_GET['page']) : null;
        $countPersons  = getCountPersons($pdo);

        $persons = getAllPersons($pdo, $page);


        if (!is_array($persons)){
            $errors[] = $persons;
        }

        header('Content-Type: application/json' );
        echo json_encode(
            [
                'personCount' => $countPersons,
                'persons' => $persons
            ]
        );
        exit();
    }



    require "View/persons.php";
