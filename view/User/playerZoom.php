<?php require_once (ROOT."public/php/header.php") ?>

<main>
    <div id="main_div">
        <h1>Profil Zoom</h1>

        <div class="player_zoom_avatar_div">
            <?php require_once(ROOT . "public/php/avatars/player_avatar_image.php") ?>
        </div>

        <div class="profile_zoom_div web">
            <ul>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Date de création du compte :</span><span class="profile_zoom_values">le <?= date_format($player->getUserAccountCreationDatetime(), "d-m-Y à H\h i\m s\s") ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Pseudo :</span><span class="profile_zoom_values"><?= $player->getUserPseudo() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Réputation :</span><span class="profile_zoom_values"><?= $player->getUserReputation() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Statut :</span><span class="profile_zoom_values"><?= $player->getUserStatusName() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Email :</span><span class="profile_zoom_values"><?= $player->getUserEmail() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Prénom :</span><span class="profile_zoom_values"><?= $player->getUserDataFirstname() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Nom :</span><span class="profile_zoom_values"><?= $player->getUserDataLastname() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Date de naissance :</span><span class="profile_zoom_values"><?= $player->getUserDataBirthdate() == null ? "" : date_format(new DateTime($player->getUserDataBirthdate()), "d-m-Y") ?></span></li>

                <?php
                /*
                    echo $player->getUserDataBirthdate();


                    $date = ($player->getUserDataBirthdate() == null ?  "" : date_format(new DateTime($player->getUserDataBirthdate()), "d-m-Y"));

                    if ($player->getUserDataBirthdate() == null)
                    {
                        echo "";
                    }
                    else
                    {
                        echo $player->getUserDataBirthdate();
                    }

                    */ ?>

                <li class="profile_zoom_li"><span class="profile_zoom_titles">Genre :</span><span class="profile_zoom_values"><?= $player->getUserDataGenderName() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Adresse :</span><span class="profile_zoom_values"><?= $player->getUserDataAddress() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Code Postal :</span><span class="profile_zoom_values"><?= $player->getUserDataPostcode() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Ville :</span><span class="profile_zoom_values"><?= $player->getUserDataCity() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Pays :</span><span class="profile_zoom_values"><?= $player->getUserDataCountry() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Téléphone :</span><span class="profile_zoom_values"><?= $player->getUserDataPhone() ?></span></li>
            </ul>
        </div>

        <div class="profile_zoom_div mobile">
            <ul>
                <li class="profile_zoom_li">
                    <div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Date de création du compte :</span><span
                            class="profile_zoom_values">le <?= date_format($player->getUserAccountCreationDatetime(), "d-m-Y à H\h i\m s\s") ?></span>
                    </div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Pseudo :</span><span class="profile_zoom_values"><?= $player->getUserPseudo() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Réputation :</span><span class="profile_zoom_values"><?= $player->getUserReputation() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Statut :</span><span class="profile_zoom_values"><?= $player->getUserStatusName() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Email :</span><span class="profile_zoom_values"><?= $player->getUserEmail() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Prénom :</span><span class="profile_zoom_values"><?= $player->getUserDataFirstname() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Nom :</span><span class="profile_zoom_values"><?= $player->getUserDataLastname() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Date de naissance :</span><span class="profile_zoom_values"><?= $player->getUserDataBirthdate() == null ? "" : date_format(new DateTime($player->getUserDataBirthdate()), "d-m-Y") ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Genre :</span><span class="profile_zoom_values"><?= $player->getUserDataGenderName() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Adresse :</span><span class="profile_zoom_values"><?= $player->getUserDataAddress() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Code Postal :</span><span class="profile_zoom_values"><?= $player->getUserDataPostcode() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Ville :</span><span class="profile_zoom_values"><?= $player->getUserDataCity() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Pays :</span><span class="profile_zoom_values"><?= $player->getUserDataCountry() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Téléphone :</span><span class="profile_zoom_values"><?= $player->getUserDataPhone() ?></span></div></li>
            </ul>
        </div>

        <div class="profile_zoom_buttons_div">
            <?php
            if ($_SESSION["user_id"] == $player->getId())
            {
                echo '<a href="' . WEBROOT . 'User/modification/' . $player->getId() . '"><button class="profile_zoom_buttons">Modifier</button></a><a href = "' . WEBROOT . 'User/security/' . $_SESSION["user_id"] . '" ><button class="profile_zoom_buttons"> Sécurité</button ></a >';
            }
            ?>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
