<header>

    <div id="header_div">

        <div class="header_logo_span web">
            <a class="header_logo_link" href="<?= WEBROOT ?>Home/main"><img id="header_logo" src="<?= WEBROOT ?>public/images/logo_mini.png" alt="logo"></a>
        </div>

        <nav class="header_menu">
            <?php require_once (ROOT."public/php/menu.php") ?>
        </nav>


        <div class="header_user_div web">
            <?php
            // Action si l'utilisateur est connecté
            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
            {
                // Affichage du pseudo et affichage de la carte utilisateur onmouseover
                echo '<div id="header_buttons"><div onmouseover="showUserCard()" onmouseout="hideUserCard()"><a href="' . WEBROOT . 'User/main/' . $_SESSION["user_id"] . '"><Button class="header_pseudo_button normal">' . $user->getUserPseudo() . '</Button></a>';
                require(ROOT . "public/php/cards/user_card.php");
                echo '</div>';
                // Affichage du bouton de déconnection
                echo '<a id="disconnection_button" href="' . WEBROOT . 'User/disconnect"><button class="header_button bad">Se déconnecter</button></a></div>';
                echo '<div id="header_avatar_div">';
                require(ROOT . "public/php/avatars/header_avatar_image.php");
                echo '</div>';
            }
            // Action si l'utilisateur n'est pas connecté
            else
            {
                // Affichage des boutons d'inscription et de déconnection
                echo '<div id="header_buttons"><a href="' . WEBROOT . 'User/inscription"><button class="header_button good">S\'inscrire</button></a>';
                echo '<a href="' . WEBROOT . 'User/connection"><button class="header_button good" formaction="">Se Connecter</button></a></div>';
                require(ROOT . "public/php/avatars/header_avatar_image.php");
            }
            ?>
        </div>
        <div class="header_user_div mobile">
            <?php
            if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
            {
                require(ROOT . "public/php/avatars/header_mobile_avatar_image.php");
                echo '<div id="header_buttons_mobile" style="display: none"><div onmouseup="toggleUserCard()"><Button class="header_pseudo_button normal">' . $user->getUserPseudo() . '</Button>';
                require(ROOT . "public/php/cards/user_card_mobile.php");
                echo '</div>';
                echo '<a class="user_header_button_mobile_link" id="disconnection_button" href="' . WEBROOT . 'User/disconnect"><button class="header_button bad">Se déconnecter</button></a></div>';
            }
            else
            {
                require(ROOT . "public/php/avatars/header_mobile_avatar_image.php");
                echo '<div id="header_buttons_mobile" style="display: none"><a class="user_header_button_mobile_link" href="' . WEBROOT . 'User/inscription"><button class="header_button good">S\'inscrire</button></a>';
                echo '<a class="user_header_button_mobile_link" href="' . WEBROOT . 'User/connection"><button class="header_button good" formaction="">Se Connecter</button></a></div>';
            } ?>
        </div>

    </div>

    <div id = "log_div" <?= !isset($log) ? 'style = "display : none;"' : 'style = "display : block;"' ?>>
        <?= isset($log) ? $log : "" ?>
    </div>
</header>
