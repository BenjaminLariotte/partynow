<?php require_once (ROOT."public/php/header.php") ?>

<main>
    <div id="main_div">
        <h1>Profil Zoom</h1>

        <div class="zoom_avatar_div">
            <?php require_once(ROOT . "public/php/avatars/avatar_image.php") ?>
        </div>

        <div class="profile_zoom_div web">
            <ul>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Date de création du compte :</span><span class="profile_zoom_values">le <?= date_format($user->getUserAccountCreationDatetime(), "d-m-Y à H\h i\m s\s") ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Pseudo :</span><span class="profile_zoom_values"><?= $user->getUserPseudo() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Réputation :</span><span class="profile_zoom_values"><?= $user->getUserReputation() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Statut :</span><span class="profile_zoom_values"><?= $user->getUserStatusName() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Email :</span><span class="profile_zoom_values"><?= $user->getUserEmail() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Prénom :</span><span class="profile_zoom_values"><?= $user->getUserDataFirstname() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Nom :</span><span class="profile_zoom_values"><?= $user->getUserDataLastname() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Date de naissance :</span><span class="profile_zoom_values"><?= $user->getUserDataBirthdate() == null ? "" : date_format(new DateTime($user->getUserDataBirthdate()), "d-m-Y") ?></span></li>

                <?php
                /*
                    echo $user->getUserDataBirthdate();


                    $date = ($user->getUserDataBirthdate() == null ?  "" : date_format(new DateTime($user->getUserDataBirthdate()), "d-m-Y"));

                    if ($user->getUserDataBirthdate() == null)
                    {
                        echo "";
                    }
                    else
                    {
                        echo $user->getUserDataBirthdate();
                    }

                    */ ?>

                <li class="profile_zoom_li"><span class="profile_zoom_titles">Genre :</span><span class="profile_zoom_values"><?= $user->getUserDataGenderName() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Adresse :</span><span class="profile_zoom_values"><?= $user->getUserDataAddress() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Code Postal :</span><span class="profile_zoom_values"><?= $user->getUserDataPostcode() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Ville :</span><span class="profile_zoom_values"><?= $user->getUserDataCity() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Pays :</span><span class="profile_zoom_values"><?= $user->getUserDataCountry() ?></span></li>
                <li class="profile_zoom_li"><span class="profile_zoom_titles">Téléphone :</span><span class="profile_zoom_values"><?= $user->getUserDataPhone() ?></span></li>
            </ul>
        </div>

        <div class="profile_zoom_div mobile">
            <ul>
                <li class="profile_zoom_li">
                    <div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Date de création du compte :</span><span
                            class="profile_zoom_values">le <?= date_format($user->getUserAccountCreationDatetime(), "d-m-Y à H\h i\m s\s") ?></span>
                    </div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Pseudo :</span><span class="profile_zoom_values"><?= $user->getUserPseudo() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Réputation :</span><span class="profile_zoom_values"><?= $user->getUserReputation() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Statut :</span><span class="profile_zoom_values"><?= $user->getUserStatusName() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Email :</span><span class="profile_zoom_values"><?= $user->getUserEmail() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Prénom :</span><span class="profile_zoom_values"><?= $user->getUserDataFirstname() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Nom :</span><span class="profile_zoom_values"><?= $user->getUserDataLastname() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Date de naissance :</span><span class="profile_zoom_values"><?= $user->getUserDataBirthdate() == null ? "" : date_format(new DateTime($user->getUserDataBirthdate()), "d-m-Y") ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Genre :</span><span class="profile_zoom_values"><?= $user->getUserDataGenderName() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Adresse :</span><span class="profile_zoom_values"><?= $user->getUserDataAddress() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Code Postal :</span><span class="profile_zoom_values"><?= $user->getUserDataPostcode() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Ville :</span><span class="profile_zoom_values"><?= $user->getUserDataCity() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Pays :</span><span class="profile_zoom_values"><?= $user->getUserDataCountry() ?></span></div></li>
                <li class="profile_zoom_li"><div style="display: flex; flex-direction: column"><span class="profile_zoom_titles">Téléphone :</span><span class="profile_zoom_values"><?= $user->getUserDataPhone() ?></span></div></li>
            </ul>
        </div>
        <div class="profile_zoom_buttons_div">
            <?php
            if ($_SESSION["user_id"] == $user->getId())
            {
                echo '<a href="' . WEBROOT . 'User/modification/' . $user->getId() . '"><button class="profile_zoom_button_modify neutral">Modifier</button></a><a href = "' . WEBROOT . 'User/security/' . $_SESSION["user_id"] . '" ><button class="profile_zoom_button_security bad"> Sécurité</button ></a >';
            }
            ?>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
