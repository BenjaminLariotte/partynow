<?php
@session_start();
date_default_timezone_set('CET');
if (empty($_SESSION["user_id"]))
{
    $_SESSION["user_id"] = 0;
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php
    // define the root and webroot contant
    define("WEBROOT", str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]));
    define("ROOT", str_replace("index.php", "", $_SERVER["SCRIPT_FILENAME"]));

    require_once ("core/database_connection.php");
    require_once ("core/Controller.php");
    require_once ("core/id_class.php");

    //All controller actions and verifications
    if (isset ($_GET["parameter"]))
    {
        if ($_GET["parameter"] == "")
        {
            $_GET["parameter"] = "Home/main";
        }
    }
    else
    {
        $_GET["parameter"] = "Home/main";
    }

    // Explode the get parameters into an array
    $parameter = explode("/", strip_tags($_GET["parameter"]));

    if (isset ($parameter[1]) && $parameter[1] != null)
    {
        $method = $parameter[1];
    }
    else
    {
        $method = "main";
    }

    if (isset($parameter) && $parameter[0] === "")
    {
        $parameter = ["Home", "main"];
    }

    if ($parameter[0] === "Home" || $parameter[0] === "Event" || $parameter[0] === "User" || $parameter[0] === "More")
    {
        $objectName = $parameter[0];
    }
    else
    {
        $objectName = "Home";
    }

    $objectController = $objectName."Controller";

    $objectDao = $objectName."Dao";
    ?>
    <!-- get google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= WEBROOT ?>public/css/style.css">
    <link rel="stylesheet" href="<?= WEBROOT ?>public/css/responsive_style.css">
    <link rel="stylesheet" href="<?= WEBROOT ?>public/css/menu_style.css">
    <link rel="stylesheet" href="<?= WEBROOT ?>public/css/buttons_style.css">
    <link rel="stylesheet" href="<?= WEBROOT ?>public/css/cards_style.css">
    <link rel="stylesheet" href="<?= WEBROOT ?>public/css/tables_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- color for mobile nav header  -->
    <meta name="theme-color" content="#4682B4">
    <link rel="shortcut icon" href="<?= WEBROOT ?>favicon.ico" />
    <?php
    if (file_exists("public/php/titles/title.".$parameter[0].".".$parameter[1].".php"))
    {
        require_once "public/php/titles/title." . $parameter[0] . "." . $parameter[1] . ".php";
    }
    elseif (file_exists("public/php/titles/title.".$parameter[0].".php"))
    {
        require_once "public/php/titles/title." . $parameter[0] . ".php";
    }
    else
    {
        require_once "public/php/titles/title.Home.php";
    }
    ?>
</head>
<body>
    <?php

        require_once ("controller/".$objectController.".php");
        $newController = new $objectController();

        if (method_exists($newController, $method))
        {
            unset($parameter[0]);
            unset($parameter[1]);
            call_user_func_array(array($newController, $method), $parameter);
        }
        else
        {
            require_once (ROOT."public/php/error_404.php");
        }
    ?>

    <div id="mobile_background" class="mobile" style="display: none" onmouseup="closeEverything()"></div>

    <?php require_once (ROOT."public/php/footer.php") ?>

    <script src="<?= WEBROOT ?>public/js/script.js"></script>
    <script src="<?= WEBROOT ?>public/js/script_jquery.js"></script>
    <script src="<?= WEBROOT ?>public/js/script_responsive.js"></script>
    <script>
        let url = "<?= $_SESSION['url'] ?>";
        window.onload = changeUrl(url);
    </script>
</body>
</html>
