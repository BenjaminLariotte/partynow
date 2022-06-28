<?php require_once (ROOT."public/php/header.php") ?>


<main>
    <div id="main_div">
        <h1>Récupération de compte</h1>

        <div class="recuperation_form_div">
            <form class="recuperation_form" action="<?= WEBROOT ?>User/recup" method="post">
                <label for="recuperation_form_login">Login (pseudo/email) : *</label>
                <input class="recuperation_form_inputs" id="recuperation_form_login" type="text" name="login" placeholder="Veuillez entrer votre ancien login (pseudo ou email)" required>
                <label for="recuperation_form_password">Mot de passe : *</label>
                <input class="recuperation_form_inputs" id="recuperation_form_password" type="password" name="password" placeholder="Veuillez entrer votre ancien mot de passe" required>
                <p class="recuperation_form_explanation">* Champs requis</p>
                <input class="recuperation_form_button good" type="submit" value="Envoyer">
            </form>
        </div>

        <div class="recuperation_button">
            <a href="<?= WEBROOT ?>User/passwordForgotten"><button class="forgotten_password_button bad">Mot de passe oublié ?</button></a>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
