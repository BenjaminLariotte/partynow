<?php
require_once (ROOT."public/php/header.php");

if (isset($user))
{
    $contact_email_content = 'value="'.$user->getuserEmail().'"';
}
else
{
    $contact_email_content = 'placeholder="Votre email"';
}
?>


<main>
    <div id="main_div">
        <h1>Contact</h1>

        <div id="contact_form_div">
            <form class="contact_form" action="<?= WEBROOT ?>Home/contactEmail" method="post">
                Votre email : *
                <input class="contact_form_inputs" type="email" name="contact_email" <?= $contact_email_content ?>">
                Objet : *
                <input class="contact_form_inputs" type="text" name="contact_object" placeholder="Objet de votre message" required>
                Message : *
                <textarea class="contact_form_text_area" name="contact_message" placeholder="Votre message" required></textarea>
                <p id="contact_form_explanation">* Champs requis</p>
                <input id="contact_form_button" class="good" type="submit">
            </form>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
