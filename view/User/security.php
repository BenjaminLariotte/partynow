<?php require_once (ROOT."public/php/header.php") ?>


<main>
    <div id="main_div">
        <h1>Sécurité</h1>

        <h3>Changer le mot de passe</h3>
        <div class="security_forms_div">
            <form method="post" action="<?= WEBROOT ?>User/newPassword/<?= $_SESSION["user_id"] ?>">
                <label for="security_form_old_password">Ancien mot de passe : *</label>
                <input class="security_forms_inputs" id="security_form_old_password" type="password" name="old_password" placeholder="Veuillez entrer votre ancien mot de passe">
                <label for="security_form_password">Nouveau mot de passe : *</label>
                <input class="security_forms_inputs" id="security_form_password" type="password" name="password" placeholder="Veuillez entrer votre nouveau mot de passe">
                <label for="security_form_password_verification">Vérification mot de passe : *</label>
                <input class="security_forms_inputs" id="security_form_password_verification" type="password" name="password_verification" placeholder="Veuillez entrer à nouveau votre nouveau mot de passe">
                <p class="security_form_explanation">* Champs requis</p>
                <input class="security_forms_buttons good" type="submit" value="Valider">
            </form>
        </div>

        <div class="spacing"></div>

        <h3>Vérification de compte</h3>
        <?php
        if ($user->getUserVerified() === 0)
        {
            echo '<p class=\'security_verification_text_bad\'>Votre compte n\'est pas vérifié.</p><a class="security_verification_link" href="'.WEBROOT.'User/sendVerificationEmail/'.$_SESSION["user_id"].'"><button class="security_verification_button normal">Renvoyer l\'email de vérification</button></a>';
        }
        else
        {
            echo "<p class='security_verification_text_good'>Votre compte est vérifié.</p>";
        }
        ?>
        <div class="spacing"></div>
        <h3>Suppression de compte</h3>
        <?php
        if ($_SESSION["user_id"] == $user->getId())
        {
            echo '<a class="security_suppression_button_link" href = "' . WEBROOT . 'User/suppression" ><button class="security_suppression_button bad" > SUPPRIMER</button ></a >';
        }
        ?>

    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>

</main>
