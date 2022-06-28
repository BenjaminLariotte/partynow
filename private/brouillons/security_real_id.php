<h3>Pièce d'identité</h3>
<?php
if ($user->getUserVerified() === 1)
{
    if ($user->getUserDataRealId() === 0)
    {
        ?>
        <div class="security_forms_div">
            <form action="<?= WEBROOT ?>User/getUserRealIdFile/<?= $_SESSION["user_id"] ?>" enctype="multipart/form-data" method="post">
                <label for="security_form_real_id" id="security_form_real_id_label">Veuillez nous envoyer le recto de votre pièce d'identité au format image ou pdf : *</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
                <input class="security_forms_inputs" id="security_form_real_id" type="file" name="real_id" accept="image/*, .pdf">
                <p class="security_form_explanation">* Taille max 3mo</p>
                <input class="security_forms_buttons good" type="submit">
            </form>
        </div>
        <div class="spacing"></div>
        <?php
    }
    elseif ($user->getUserDataRealId() === 1)
    {
        echo '<p class="security_real_id_text_bad">Votre pièce d\'identité est en attente de vérification.</p>';
    }
    elseif ($user->getUserDataRealId() === 1)
    {
        echo '<p class="security_real_id_text_good">Votre pièce d\'identité est vérifiée. :)</p>';
    }
    else
    {
        echo '<p class="security_real_id_text_bad">Problème inconnu, veuillez contacter un admin.</p>';
    }
}
else
{
    echo '<p class="security_real_id_text_bad">Vous devez d\'abord vérifier votre compte avant de pouvoir utiliser ce service.</p>';
}

?>
<div class="spacing"></div>