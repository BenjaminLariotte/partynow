<?php require_once(ROOT . "public/php/header.php") ?>

<main>
    <div id="main_div">
        <?php

        //Récupération de la date de l'évènement dans un format spécial
        $eventDate = new DateTime($event->getEventDate());
        $eventDateFormated = $eventDate->format("l j F Y");

        //Déclaration du créateur de l'event en player pour la carte
        $creator = $creatorsCardList[0];

        //Récupération de la date actuelle en timestamp
        $dayTimestamp = date_format(new DateTime(), "U");

        ?>
        <h1>Zoom sur évènement :<br/><?= $event->getEventName() ?></h1>
        <h3>Le <?= $eventDateFormated ?> à <?= substr($event->getEventTime(), 0, 5) ?></h3>
        <div style="position: relative">
            <p style="text-align: center">Créé par <span class="creator_pseudo" onmouseup="toggleCreatorCard(<?= $creator->getId() ?>)"><?= $event->getEventCreatorPseudo() ?></span></p>
            <?php require_once (ROOT . "public/php/cards/creator_card.php")?>
        </div>

        <div class="event_zoom_creator_buttons_div">
        <?php
        //Affichage du bouton pour modifier la description si l'utilisateur est le créateur et que l'évènement n'est pas passé
        if ($event->getEventCreatorId() === $_SESSION["user_id"] && $event->getEventArchived() === 0 && $event->getEventTimestamp() >= $dayTimestamp)
        {
            echo '<a id="event_modification_button" href="' . WEBROOT . 'Event/modification/' . $event->getId() . '/'.$event->getEventCreatorId().'"><button class="event_modification_button neutral">Modifier évènement</button></a>';
        }

        //Affichage du bouton pour supprimer ou restaurer l'évènement si l'utilisateur est le créateur et que l'évènement n'est pas passé
        if ($event->getEventCreatorId() === $_SESSION["user_id"] && $event->getEventArchived() === 0 && $event->getEventTimestamp() >= $dayTimestamp)
        {
            echo '<a id="event_suppression_button" href="' . WEBROOT . 'Event/deleteEvent/' . $event->getId() . '"><button class="event_suppression_button bad">Supprimer évènement</button></a>';
        }
        elseif ($event->getEventCreatorId() === $_SESSION["user_id"] && $event->getEventArchived() === 1 && $event->getEventTimestamp() >= $dayTimestamp)
        {
            echo '<a href="' . WEBROOT . 'Event/recoverEvent/' . $event->getId() . '"><button class="event_restoration_button good">Restaurer évènement</button></a>';
        }
        ?>
        </div>

        <div class="event_zoom_content">
            <div class="event_zoom_infos">
                <div class="event_zoom_presentation">
                    <p>Description :</p><br/>
                    <p><?= nl2br($event->getEventDescription()) ?></p>
                </div>
            </div>

            <div class="event_zoom_lists">
                <div class="event_players_list_div">
                    <ul id="event_players_list">
                        <p>Joueurs inscrits - <?= $event->getEventPlayersNumber() ?>/<?= $event->getEventMaxPlayers() ?></p><br/>
                        <?php
                        //Affichage de la liste des joueurs
                        if (is_array($eventPlayersList))
                        {
                            $isOnPlayersList = false;

                            foreach ($eventPlayersList as $key => $eventPlayer)
                            {
                                if ($eventPlayer->getEventPlayerFk() == $_SESSION["user_id"])
                                {
                                    $isOnPlayersList = true;
                                }
                                $player = $playersCardList[$key];
                                $playerTempId = "1" . $key;
                                echo '<li onmouseup="togglePlayerCard('.$playerTempId.')" class="event_player_name_parent">' . $eventPlayer->getEventPlayerPseudo();
                                require(ROOT . "public/php/cards/player_card.php");
                                echo '</li><br/>';
                            }

                            //Affichage du bouton d'inscription si l'utilisateur n'est pas dans la liste
                            if (!$isOnPlayersList && $event->getEventPlayersNumber() < $event->getEventMaxPlayers() && $event->getEventTimestamp() >= $dayTimestamp)
                            {
                                echo '<a id="inscription_to_event_button" href="' . WEBROOT . 'Event/addPlayerToEvent/' . $event->getId() . '/' . $_SESSION["user_id"] . '"><button class="event_list_buttons good">S\'inscrire</button></a>';
                            }
                            //Affichage du bouton de retrait si l'utilisateur est dans la liste
                            elseif ($isOnPlayersList && $event->getEventcreatorId() != $_SESSION["user_id"] && $event->getEventTimestamp() >= $dayTimestamp)
                            {
                                echo '<a id="remove_from_event_button" href="' . WEBROOT . 'Event/removePlayerFromEvent/' . $event->getId() . '/' . $_SESSION["user_id"] . '"><button class="event_list_buttons bad">Se retirer</button></a>';
                            }
                        }
                        ?>
                    </ul>
                </div>


                <div class="event_waiters_list_div">
                    <ul id="event_waiters_list">
                        <p>Liste d'attente - <?= $event->getEventWaitersNumber()?></p><br/>
                        <?php
                        if (is_array($eventWaitersList))
                        {
                            $isOnWaitersList = false;

                            foreach ($eventWaitersList as $key => $eventWaiter)
                            {
                                if ($eventWaiter->getEventWaiterFk() == $_SESSION["user_id"])
                                {
                                    $isOnWaitersList = true;
                                }
                                $waiter = $waitersCardList[$key];
                                $waiterTempId = "2" . $key;
                                echo '<li onmouseup="toggleWaiterCard('.$waiterTempId.')" class="event_waiter_name_parent">' . $eventWaiter->getEventWaiterPseudo();
                                require(ROOT . "public/php/cards/waiter_card.php");
                                echo '</li><br/>';
                            }

                            // Show a button to add user to the waiting list if event is in the future and if user isn't already in
                            if (!$isOnWaitersList && !$isOnPlayersList && $event->getEventTimestamp() >= $dayTimestamp)
                            {
                                echo '<a id="add_to_waiting_list_button" href="' . WEBROOT . 'Event/addWaiterToEvent/' . $event->getId() . '/' . $_SESSION["user_id"] . '"><button class="event_list_buttons good">S\'inscrire</button></a>';
                            }
                            // Show a button to remove user from the waiting list if event is in the future and user is in the list
                            elseif ($isOnWaitersList && $event->getEventTimestamp() >= $dayTimestamp)
                            {
                                echo '<a id="remove_from_waiting_list_button" href="' . WEBROOT . 'Event/removeWaiterFromEvent/' . $event->getId() . '/' . $_SESSION["user_id"] . '"><button class="event_list_buttons bad">Se retirer</button></a>';
                            }
                        }
                        else
                        {
                            echo '<p class="waiters_list_text">Il n\'y a aucun joueur en liste d\'attente.</p>';
                            if (!$isOnPlayersList && $event->getEventTimestamp() >= $dayTimestamp && $event->getEventPlayersNumber() >= $event->getEventMaxPlayers())
                            {
                                echo '<a id="add_to_waiting_list_button" href="' . WEBROOT . 'Event/addWaiterToEvent/' . $event->getId() . '/' . $_SESSION["user_id"] . '"><button class="event_list_buttons good">S\'inscrire</button></a>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="event_zoom_chat_div">
            <h2>Chat à venir..</h2>
        </div>

    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
