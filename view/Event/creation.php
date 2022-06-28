<?php require_once (ROOT."public/php/header.php") ?>


<main>
    <div id="main_div">
        <div class="new_event_form_div">
            <h1>Création d'évènement</h1>

            <form id="form_event_creation" action="<?= WEBROOT ?>Event/create" method="post">

                <label for="new_event_name_input">Nom de l'évènement : *</label>
                <input class="new_event_form_inputs" id="new_event_name_input" type="text" name="new_event_name" placeholder="Entrez un nom pour votre évènement" required autofocus>
                <div id="new_event_name_div" style="display: none"></div>

                <label for="new_event_date_input">Date : *</label>
                <input class="new_event_form_inputs" id="new_event_date_input" type="date" min="<?php echo date("Y-m-d") ?>" name="new_event_date" placeholder="La date de votre évènement" required>
                <div id="new_event_date_div" style="display: none"></div>

                <label for="new_event_time_input">Heure : *</label>
                <input class="new_event_form_inputs" id="new_event_time_input" type="time" name="new_event_time" placeholder="L'heure de votre évènement" required>
                <div id="new_event_time_div" style="display: none"></div>

                <label for="new_event_description_input">Description : *</label>
                <textarea class="new_event_form_inputs" id="new_event_description_input" name="new_event_description" minlength="50" maxlength="200" placeholder="Entrez une description pour votre évènement" required></textarea>
                <div id="new_event_description_div" style="display: none"></div>

                <label for="new_event_game_input">Jeu : * 2</label>
                <input class="new_event_form_inputs" id="new_event_game_input" type="search" name="new_event_game" placeholder="Choisissez le jeu lié à votre évènement" autocomplete="off" required>
                <div id="new_event_game_div" style="display: none"></div>

                <label for="new_event_max_players_input">Nombre de joueurs : *</label>
                <input class="new_event_form_inputs" type="text" id="new_event_max_players_input" name="new_event_max_players" placeholder="Définissez le nombre de joueurs max" required>
                <div id="new_event_max_players_div" style="display: none"></div>

                <p class="new_event_form_explanation">² Mettre un chiffre car en construction.</p>
                <p class="new_event_form_explanation">* Champs requis</p>

                <input class="new_event_button good" type="submit">
            </form>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
