<?php require_once (ROOT."public/php/header.php") ?>


<main>
    <div id="main_div">
        <h1>Évènements à venir</h1>
        <h3>de <?= $incomingEventsUser->getUserPseudo() ?></h3>

        <table class="list_events_array" id="user_next_events_array">
            <tr>
                <th class="user_event_table_datetime">Date<br/>Heure</th>
                <th class="user_event_table_name">Nom</th>
                <th class="user_event_table_game">Jeu<br/>Support</th>
                <th class="user_event_table_players">Joueurs</th>
                <th class="user_event_table_creator">Créateur</th>
            </tr>
        <?php
        if (isset($userNextEvents) && $userNextEvents != null)
        {
            foreach ($userNextEvents as $key => $nextEvent)
            {
                $creator = $nextEventsCreators[$key][0];
                $creatorTempId = "1" . $key;

//                Création d'une variable waiters pour définir l'affichage ou non du nombre de joueur en liste d'attente
                $waiters = ($nextEvent->getEventWaitersNumber() > 0) ? ' + ' . $nextEvent->getEventWaitersNumber() : '';

                echo '<tr><td class="user_event_table_datetime">' . date_format(new DateTime($nextEvent->getEventDate()), "d/m/y") . '<br/>' . substr
                    ($nextEvent->getEventTime(), 0, 5) . '</td><td class="user_event_table_name"><a href="' . WEBROOT . 'Event/zoom/' .
                    $nextEvent->getId() . '" title="'. $nextEvent->getEventName() . '">' . $nextEvent->getEventName() . '</a></td><td class="user_event_table_game">' . $nextEvent->getEventGameId() . '<br/>' . $nextEvent->getId() . '</td><td class="user_event_table_players">' . $nextEvent->getEventPlayersNumber() . '/' . $nextEvent->getEventMaxPlayers() . $waiters . '</td><td class="user_event_table_creator"><span class="incoming_events_creator_span" onmouseover="showCreatorsCard('.$creatorTempId.')" onmouseout="hideCreatorsCard('.$creatorTempId.')"><a href="' . WEBROOT . 'User/main/' . $nextEvent->getEventCreatorId() . '">' . $nextEvent->getEventCreatorPseudo() . '</a>';

                require (ROOT . "public/php/cards/creators_card.php");

                echo '</span></td>';
            }
        }
        else
        {
            echo '<tr><td colspan="7"><p class="events_text">Il n\'y a aucun évènement à venir.</p></td></tr>';
        }
        ?>
        </table>
    </div>

<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
