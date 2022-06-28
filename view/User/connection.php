<?php require_once (ROOT."public/php/header.php") ?>


<main>
    <div id="main_div">
        <div id="connection_form_div">
            <h1>Connection</h1>
            <form id="form_connection" action="<?= WEBROOT ?>User/connect" method="post">
                <label for="connection_form_login">Login (pseudo/email) : *</label>
                <input class="connection_form_inputs" id="connection_form_login" type="text" name="login" placeholder="Veuillez entrer votre login (pseudo ou email)" required autofocus>
                <label for="connection_form_password">Mot de passe : *</label>
                <input class="connection_form_inputs" id="connection_form_password" type="password" name="password" placeholder="Veuillez entrer votre mot de passe" required>
                <p id="connection_form_explanation">* Champs requis</p>
                <input class="connection_form_button good" type="submit" value="Se connecter">
            </form>
        </div>

        <div id="connection_buttons">
            <a href="<?= WEBROOT ?>User/passwordForgotten"><button class="connection_button_forget neutral">Mot de passe oublié ?</button></a>
            <a href="<?= WEBROOT ?>User/recuperation"><button class="connection_button_deleted neutral">Compte supprimé ?</button></a>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
