<?php require_once (ROOT."public/php/header.php") ?>



<main>
    <div id="main_div">
        <h1>Mot de passe oublié</h1>
        <div class="forgotten_password_form_div">
            <form class="forgotten_password_form" action="<?= WEBROOT ?>User/passwordReset" method="post">
                <label for="forgotten_password_login">Login (pseudo ou email) : *</label>
                <input class="forgotten_password_form_input" id="forgotten_password_login" type="text" name="login" placeholder="Veuillez entrer votre login (pseudo ou email)" required>
                <p class="forgotten_password_form_explanation">* Champs requis</p>
                <input class="forgotten_password_form_button good" type="submit" value="Envoyer">
            </form>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main
