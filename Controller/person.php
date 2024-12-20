<?php
/**
 * @var PDO $pdo
 */
    require "Model/person.php";
    require "Model/users.php";
    require "Model/user.php";

    $unlikedUser = getUnlikedUsers($pdo);



function prepareData($tab)
{
    $tab['first_name'] = !empty($_POST['first_name']) ? cleanString($_POST['first_name']) : null;
    $tab['last_name'] = !empty($_POST['last_name']) ? cleanString($_POST['last_name']) : null;
    $tab['address'] = !empty($_POST['address']) ? cleanString($_POST['address']) : null;
    $tab['zip_code'] = !empty($_POST['zip_code']) ? cleanString($_POST['zip_code']) : null;
    $tab['city'] = !empty($_POST['city']) ? cleanString($_POST['city']) : null;
    $tab['phone'] = !empty($_POST['phone']) ? cleanString($_POST['phone']) : null;
    $tab['type'] = !empty($_POST['type']) ? cleanString($_POST['type']) : null;
    $tab['linked_user_id'] = !empty($_POST['linked_user_id']) ? cleanString($_POST['linked_user_id']) : null;
    return $tab;
}

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (!is_numeric($id)) {
            $errors[] = 'id au mauvais format';
        } else {
            $person = person($pdo, $id);
            if(!is_array($person)) {
                $errors[] = $person;
            }
        }
    }

    if (
        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')
    ){
        $tab = [];
        switch ($_GET['action']){
            case "create" :
                $tab = prepareData($tab);
                $result = createPerson($pdo, $tab);
                if (is_string($result)){
                    header('Content-Type: application/json' );
                    echo json_encode(
                        [
                            'result' => $result
                        ]
                    );
                    exit();
                }

                $isLinked = isLinkedUser($pdo,$tab['linked_user_id']);
                if ($isLinked){
                    header('Content-Type: application/json' );
                    echo json_encode(
                        [
                            'result' => "Cet utilisateur est déjà lié a une personne"
                        ]
                    );
                    exit();
                }
                $res = createLinkUserToPerson($pdo, $tab, $result);

                header('Content-Type: application/json' );
                if ($res){
                    echo json_encode(
                        [
                            'result' => $res
                        ]
                    );
                } else {
                    echo json_encode(
                        [
                            'result' => "Erreur lors de la création du lien entre l'utilisateur et la personne"
                        ]
                    );
                }
                exit();

            case "update" :
                $id = $_GET['id'];
                $tab = prepareData($tab);
                $result = updatePerson($pdo, $tab, $id);

                if($tab['linked_user_id'] !== null){
                    $isLinked = isLinkedUser($pdo,$tab['linked_user_id']);
                    if ($isLinked){
                        header('Content-Type: application/json' );
                        echo json_encode(
                            [
                                'result' => "Cet utilisateur est déjà lié a une personne"
                            ]
                        );
                        exit();
                    }
                    $res = createLinkUserToPerson($pdo, $tab, $result);

                    header('Content-Type: application/json' );
                    if ($res){
                        echo json_encode(
                            [
                                'result' => $res
                            ]
                        );
                    } else {
                        echo json_encode(
                            [
                                'result' => "Erreur lors de la création du lien entre l'utilisateur et la personne"
                            ]
                        );
                    }
                    exit();
                }
                header('Content-Type: application/json' );
                echo json_encode(
                    [
                        'result' => $result
                    ]
                );
                exit();
        }
    }
    require "View/person.php";