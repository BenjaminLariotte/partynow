<?php require_once (ROOT."public/php/header.php") ?>

<main>
    <div id="main_div">
        <h1>Supprimer le compte</h1>

        <div class="suppression_div">
            <div class="suppression_div_archive">
                <div><p class="suppression_archive_text">Êtes-vous sûr de vouloir supprimer votre compte?<br/>Celui-ci sera disponible pour récupération pendant une période de 6 mois suite à quoi il sera complètement supprimé du serveur.</p></div>
                <div class="suppression_archive_buttons_div">
                    <div><a href="<?= WEBROOT ?>User/archived/<?= $_SESSION["user_id"] ?>"><button class="suppression_button_archive bad">OUI</button></a></div>
                    <div><a href="<?= WEBROOT ?>User/main/<?= $_SESSION["user_id"] ?>"><button class="suppression_button_archive good" type="button" value="Retour">NON</button></a></div>
                </div>
            </div>

            <div class="spacing"></div>

            <div class="suppression_div_suppress">
                <div><p class="suppression_suppress_text_1">Si vous souhaitez le supprimer entièrement dès maintenant, veuillez cliquer ici :</p></div>
                <div style="text-align: center"><a href="<?= WEBROOT ?>User/deleteUser/<?= $_SESSION['user_id'] ?>"><button class="suppression_button_suppress bad">SUPPRIMER</button></a></div>
                <div><p class="suppression_suppress_text_2">Attention! Cette action est irréversible !</p></div>
            </div>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
