<?php require_once (ROOT."public/php/header.php") ?>


<main>
    <div id="main_div">
        <h1>Mot de passe reset</h1>
        <div class="password_reset_form_div">
            <form id="form_password_reset" action="<?= WEBROOT ?>User/passwordChange/<?= $_SESSION["user_id"] ?>" method="post">
                <label for="password_reset_form_password">Mot de passe : *</label>
                <input class="password_reset_form_inputs" id="password_reset_form_password" type="password" name="password" placeholder="Veuillez entrer un mot de passe" required>
                <label for="password_reset_form_password_verification">Mot de passe vérification : *</label>
                <input class="password_reset_form_inputs" id="password_reset_form_password_verification" type="password" name="password_verification" placeholder="Veuillez entrer à nouveau le mot de passe" required>
                <p class="password_reset_form_explanation">* Champs requis</p>
                <input class="password_reset_form_button good" type="submit" value="Envoyer">
            </form>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
