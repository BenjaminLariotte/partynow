<?php require_once (ROOT."public/php/header.php") ?>


<main>
    <div id="main_div">
        <div class="event_modification_form_div">
            <h1>Modification de l'évènement</h1>

            <form id="event_modification_form" action="<?= WEBROOT ?>Event/updateEvent/<?= $event->getId() ?>" method="post">

                <label for="event_modification_name_input">Nom de l'évènement : *</label>
                <input class="event_modification_form_inputs" id="event_modification_name_input" type="text" name="event_modification_name" placeholder="Entrez un nom pour votre évènement" required value="<?= $event->getEventName() ?>">
                <div id="event_modification_name_div" style="display: none"></div>

                <label for="event_modification_date_input">Date : *</label>
                <input class="event_modification_form_inputs" id="event_modification_date_input" type="date" min="<?php echo date("Y-m-d") ?>" name="event_modification_date" placeholder="La date de votre évènement" required value="<?= $event->getEventDate() ?>">
                <div id="event_modification_date_div" style="display: none"></div>

                <label for="event_modification_time_input">Heure : *</label>
                <input class="event_modification_form_inputs" id="event_modification_time_input" type="time" name="event_modification_time" placeholder="L'heure de votre évènement" required value="<?= $event->getEventTime() ?>">
                <div id="event_modification_time_div" style="display: none"></div>

                <label for="event_modification_description_input">Description : *</label>
                <textarea class="event_modification_form_inputs" id="event_modification_description_input" name="event_modification_description" minlength="50" maxlength="200" placeholder="Entrez une description pour votre évènement" required><?= $event->getEventDescription() ?></textarea>
                <div id="event_modification_description_div" style="display: none"></div>

                <label for="event_modification_game_input">Jeu : * 2</label>
                <input class="event_modification_form_inputs" id="event_modification_game_input" type="search" name="event_modification_game_id" placeholder="Choisissez le jeu lié à votre évènement" autocomplete="off" required value="<?= $event->getEventGameId() ?>">
                <div id="event_modification_game_div" style="display: none"></div>

                <div class="event_modification_max_players_div">Vous avez défini le nombre de joueur à <?= $event->getEventMaxPlayers() ?>. Il n'est actuellement pas possible de modifier ce nombre. </div>

                <p class="event_modification_form_explanation">² Mettre un chiffre car en construction.</p>
                <p class="event_modification_form_explanation">* Champs requis</p>

                <input class="event_modification_button good" type="submit">
            </form>

        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
