<?php require_once (ROOT."public/php/header.php") ?>

<main>
    <div id="main_div">
        <h1>Page Avatar Change</h1>
        <div class="avatar_form_div">
            <div class="avatar_form_avatar"><?php require (ROOT."public/php/avatars/avatar_image.php")?></div>
            <form id="avatar_change_form" action="<?= WEBROOT ?>User/updateUserAvatar/<?= $_SESSION["user_id"] ?>" enctype="multipart/form-data" method="post">
                <label for="new_avatar_image" id="new_avatar_image_label">Veuillez choisir une image : *</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <input class="avatar_form_inputs" id="new_avatar_image" type="file" name="new_avatar_image" accept="image/*">
                <p id="avatar_form_explanation">* Il est recommandé d'utiliser une image carrée<br/>* Taille max 2 Mo</p>
                <input class="avatar_form_button good" type="submit" value="Envoyer">
            </form>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
