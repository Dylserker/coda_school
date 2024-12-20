<?php
    /**
 * @var PDO $pdo
 */

    require "Model/users.php";

if (
    !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')
){
    if (
        isset($_GET['action']) &&
        isset($_GET['id']) &&
        is_numeric($_GET['id'])
    ) {
        $id = cleanString($_GET['id']);
        $action = cleanString($_GET['action']);
        switch ($action) {
            case 'toggle-enabled':
                $toggle = toggleEnabled($pdo, $id);
                header('Content-Type: application/json' );
                if (is_array($toggle)){
                    echo json_encode(['toggle' => $toggle]);
                } else {
                    echo json_encode($toggle);
                }
                exit();
            case 'delete':

                $delete = delete($pdo, $id);

                if (!empty($delete))
                {
                    $delete = "Impossible de supprimer l'utilisateur car celui-ci est encore lié !";
                    $errors[] = $delete;
                } else {
                    header("Location: index.php?component=users");
                }

                break;
            default:
                break;
        }


    }
}



    $search = isset($_POST['search']) ? $_POST['search'] : null;
    $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : null;
    $users = getAll($pdo, $search, $sortby);

    if (!is_array($users))
    {
        $errors[] = $users;
    }





    require "View/users.php";