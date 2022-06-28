<?php require_once (ROOT."public/php/header.php") ?>

<main>
    <div id="main_div">
        <h1>Page Profil</h1>

        <div class="profile_global_div">
            <div class="profile_div_1 web">
                <?php
                if ($user->getId() == $_SESSION["user_id"])
                {
                    require ROOT . "public/php/cards/user_card_big.php";
                }
                ?>
            </div>

            <div class="profile_div_1 mobile">
                <?php
                if ($user->getId() == $_SESSION["user_id"])
                {
                    require ROOT . "public/php/cards/user_card_profile_mobile.php";
                }
                ?>
            </div>

            <div class="profile_div_2">
                <div class="profile_div"><p>Mes messages</p></div>
                <div class="profile_div"><p>Mes sorties</p></div>
            </div>

            <div class="profile_div_3">
                <div class="profile_div"><p>Mes concours</p></div>
                <div class="profile_div"><p>Mes amis</p></div>
            </div>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
