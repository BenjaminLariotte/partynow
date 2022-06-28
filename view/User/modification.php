<?php
require_once (ROOT."public/php/header.php");
$genderNumber = $user->getUserDataGender();
$genderChecked = "checked='checked'";
$dayDate = date_format(new DateTime(), "Y-m-d");
?>


<main>
    <div id="main_div">
        <h1>Modification</h1>

        <div class="modification_form_div">
            <form method="post" action="<?= WEBROOT ?>User/update/<?= $_SESSION["user_id"] ?>">

                <label for="modification_form_pseudo">Pseudo :</label>
                <input class="modification_form_inputs" id="modification_form_pseudo" type="text" name="pseudo" value="<?= $user->getUserPseudo() ?>">

                <label for="modification_form_email">Email :</label>
                <input class="modification_form_inputs" id="modification_form_email" type="email" name="email" value="<?= $user->getUserEmail() ?>">

                <label for="modification_form_firstname">Prénom : ¹</label>
                <input class="modification_form_inputs" id="modification_form_firstname" type="text" name="firstname" value="<?= $user->getUserDataFirstname() ?>">

                <label for="modification_form_lastname">Nom : ¹</label>
                <input class="modification_form_inputs" id="modification_form_lastname" type="text" name="lastname" value="<?= $user->getUserDataLastname() ?>">

                <label for="modification_form_birthdate">Date de naissance : * ¹</label>
                <input class="modification_form_inputs" id="modification_form_birthdate" type="date" name="birthdate" max="<?= $dayDate ?>" value="<?= $user->getUserDataBirthdate() == null ? "" : date_format(new DateTime($user->getUserDataBirthdate()), "Y-m-d") ?>" required>

                <label for="modification_form_genders">Genre :</label><br>
                <div class="modification_form_radio_inputs"  id="modification_form_genders">
                    <label for="modification_form_gender_1">Homme</label>
                    <input class="modification_form_inputs modification_form_inputs_gender" id="modification_form_gender_1" type="radio" name="gender" value="1" <?= $genderNumber == 1 ? $genderChecked : "" ?>>
                    <label for="modification_form_gender_2">Femme</label>
                    <input class="modification_form_inputs modification_form_inputs_gender" id="modification_form_gender_2" type="radio" name="gender" value="2" <?= $genderNumber == 2 ? $genderChecked : "" ?>>
                    <label for="modification_form_gender_3">Autre</label>
                    <input class="modification_form_inputs modification_form_inputs_gender" id="modification_form_gender_3" type="radio" name="gender" value="3" <?= $genderNumber == 3 ? $genderChecked : "" ?>>
                    <label for="modification_form_gender_4">Non spécifié</label>
                    <input class="modification_form_inputs modification_form_inputs_gender" id="modification_form_gender_4" type="radio" name="gender" value="4" <?= $genderNumber == 4 ? $genderChecked : "" ?>>
                </div>

                <label for="modification_form_address">Adresse :</label>
                <input class="modification_form_inputs" id="modification_form_address" type="text" name="address" value="<?= $user->getUserDataAddress() ?>">

                <label for="modification_form_postcode">Code Postal :</label>
                <input class="modification_form_inputs" id="modification_form_postcode" type="text" name="postcode" value="<?= $user->getUserDataPostcode() ?>">

                <label for="modification_form_city">Ville :</label>
                <input class="modification_form_inputs" id="modification_form_city" type="text" name="city" value="<?= $user->getUserDataCity() ?>">

                <label for="modification_form_country">Pays :</label>
                <input class="modification_form_inputs" id="modification_form_country" type="text" name="country" value="<?= $user->getUserDataCountry() ?>">

                <label for="modification_form_phone">Téléphone :</label>
                <input class="modification_form_inputs" id="modification_form_phone" type="tel" name="phone" value="<?= $user->getUserDataPhone() ?>">

                <p id="modification_form_explanation">* Champs requis<br/>¹ Ces informations ne peuvent plus être modifiées une fois votre pièce d'identité validée</p>
                <button class="modification_form_button good">Envoyer</button>
            </form>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
