<?php require_once (ROOT."public/php/header.php") ?>


<main>
    <div id="main_div">
        <h1>Inscription</h1>
        <div id="inscription_form_div">
            <form id="inscription_form" action="<?= WEBROOT ?>User/create" method="post">
                <label for="inscription_form_pseudo">Pseudo : *</label>
                <input class="inscription_form_inputs" id="inscription_form_pseudo" type="text" name="pseudo" placeholder="Veuillez entrer un pseudo" required autofocus>
                <label for="inscription_form_email">Email : *</label>
                <input class="inscription_form_inputs" id="inscription_form_email" type="email" name="email" placeholder="Veuillez entrer un email" required>
                <label for="inscription_form_email_verification">Email vérification : *</label>
                <input class="inscription_form_inputs" id="inscription_form_email_verification" type="email" name="email_verification" placeholder="Veuillez entrer à nouveau l'email" required>
                <label for="inscription_form_password">Mot de passe : *</label>
                <input class="inscription_form_inputs" id="inscription_form_password" type="password" name="password" placeholder="Veuillez entrer un mot de passe" required>
                <label for="inscription_form_password_verification">Mot de passe vérification : *</label>
                <input class="inscription_form_inputs" id="inscription_form_password_verification" type="password" name="password_verification" placeholder="Veuillez entrer à nouveau le mot de passe" required>
                <p id="inscription_form_explanation">* Champs requis</p>
                <input class="inscription_form_button good" type="submit" value="Envoyer">
            </form>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
