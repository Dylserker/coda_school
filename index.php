<?php
    session_start();
    require __DIR__ . '/vendor/autoload.php';
    require 'Includes/database.php';
    require "Includes/functions.php";
    $errors = [];
    if (isset($_GET['logout']) && $_GET['logout']) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
    if (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')
    ){
        if (isset($_SESSION['auth']))
        {
            if (isset($_GET['component'])) {
                $componentName = cleanString($_GET['component']);
                if (file_exists("Controller/$componentName.php")) {
                    require "Controller/$componentName.php";
                }
            }
        } else {
            require "Controller/login.php";
        }
         exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>MVC</title>

        <link
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
                rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                crossorigin="anonymous"
        >
        <link
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
                rel="stylesheet"
        >

        <style>
            a{
                text-decoration: none !important;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <?php

                if (isset($_SESSION['auth']))
                {
                    require "_Partials/navbar.php";

                    if (isset($_GET['component'])) {
                        $componentName = cleanString($_GET['component']);
                        if (file_exists("Controller/$componentName.php")) {
                            require "Controller/$componentName.php";
                        }
                    }

                } else {
                    require "Controller/login.php";
                }

                require "_Partials/errors.php";
            ?>

        </div>

        <?php require "_Partials/toast.html";?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>