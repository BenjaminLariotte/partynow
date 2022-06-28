<?php require_once (ROOT."public/php/header.php") ?>


<main>
    <div id="main_div">
        <h1>Évènements</h1>
        <h3>de <?= $eventsUser->getUserPseudo() ?></h3>

        <h3>Évènements à venir :</h3>
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
                    $nextEvent->getId() . '" title="' . $nextEvent->getEventName() . '">' . $nextEvent->getEventName() . '</a></td><td class="user_event_table_game">' . $nextEvent->getEventGameId() . '<br/>' . $nextEvent->getId() . '</td><td class="user_event_table_players">' . $nextEvent->getEventPlayersNumber() . '/' . $nextEvent->getEventMaxPlayers() . $waiters . '</td><td class="user_event_table_creator"><div class="user_events_next_creator_div" onmouseover="showCreatorsCard(' . $creatorTempId . ')" onmouseout="hideCreatorsCard(' . $creatorTempId . ')"><a href="' . WEBROOT . 'User/main/' . $nextEvent->getEventCreatorId() . '">' . $nextEvent->getEventCreatorPseudo() . '</a></div>';
                require(ROOT . "public/php/cards/creators_card.php");
                echo '</td></tr>';
            }
        }
//        onClick="document.location.href="""
        else
        {
            echo '<tr><td colspan="7"><p class="events_text">Vous n\'avez aucun évènement à venir.</p></td></tr>';
        }
        ?>
        </table>

        <h3>Évènements passés :</h3>

        <table class="list_events_array" id="user_next_events_array">
            <tr>
                <th class="user_event_table_datetime">Date<br/>Heure</th>
                <th class="user_event_table_name">Nom</th>
                <th class="user_event_table_game">Jeu<br/>Support</th>
                <th class="user_event_table_players">Joueurs</th>
                <th class="user_event_table_creator">Créateur</th>
            </tr>
        <?php
        if (isset($userPassedEvents) && $userPassedEvents != null)
        {
            foreach ($userPassedEvents as $key => $passedEvent)
            {

                $creator = $passedEventsCreators[$key][0];
                $creatorTempId = "2" . $key;

//                Création d'une variable waiters pour définir l'affichage ou non du nombre de joueur en liste d'attente
                $waiters = ($passedEvent->getEventWaitersNumber() > 0) ? ' + '. $passedEvent->getEventWaitersNumber() : '';

                echo '<tr><td class="user_event_table_datetime">' . date_format(new DateTime($passedEvent->getEventDate()), "d/m/y") . '<br/>' . substr
                    ($passedEvent->getEventTime(), 0, 5) . '</td><td class="user_event_table_name"><a href="' . WEBROOT . 'Event/zoom/' .
                    $passedEvent->getId() . '" title="'. $passedEvent->getEventName() . '">' . $passedEvent->getEventName() .
                    '</a></td><td class="user_event_table_game">' . $passedEvent->getEventGameId() . '<br/>'.$passedEvent->getId().
                    '</td><td class="user_event_table_players">' . $passedEvent->getEventPlayersNumber() . '/' . $passedEvent->getEventMaxPlayers()
                    . $waiters . '</td><td class="user_event_table_creator"><div class="user_events_passed_creator_div"
                    onmouseover="showCreatorsCard('.$creatorTempId.')" onmouseout="hideCreatorsCard('.$creatorTempId.')"><a href="' . WEBROOT . 'User/main/' .
                    $passedEvent->getEventCreatorId() . '">' . $passedEvent->getEventCreatorPseudo() . '</a></div>';
                require (ROOT . "public/php/cards/creators_card.php");
                echo '</td></tr>';
            }
        }
        else
        {
            echo '<tr><td colspan="7"><p class="events_text">Vous n\'avez aucun évènement passé.</p></td></tr>';
        }
        ?>
        </table>

        <h3>Évènements supprimés :</h3>


        <table class="list_events_array" id="user_next_events_array">
            <tr>
                <th class="user_event_table_datetime">Date<br/>Heure</th>
                <th class="user_event_table_name">Nom</th>
                <th class="user_event_table_game">Jeu<br/>Support</th>
                <th class="user_event_table_players">Joueurs</th>
                <th class="user_event_table_creator">Créateur</th>
            </tr>
        <?php
        if (isset($userArchivedEvents) && $userArchivedEvents != null)
        {
            foreach ($userArchivedEvents as $key => $archivedEvent)
            {
                $creator = $archivedEventsCreators[$key][0];
                $creatorTempId = "3" . $key;

//                Création d'une variable waiters pour définir l'affichage ou non du nombre de joueur en liste d'attente
                $waiters = ($archivedEvent->getEventWaitersNumber() > 0) ? ' + '. $archivedEvent->getEventWaitersNumber() : '';

                echo '<tr><td class="user_event_table_datetime">' . date_format(new DateTime($archivedEvent->getEventDate()), "d/m/y") . '<br/>' . substr($archivedEvent->getEventTime(), 0, 5) .
                    '</td><td class="user_event_table_name"><a href="' . WEBROOT . 'Event/zoom/' . $archivedEvent->getId() . '" title="'.
                    $archivedEvent->getEventName() . '">' . $archivedEvent->getEventName() . '</a></td><td class="user_event_table_game">' .
                    $archivedEvent->getEventGameId() . '<br/>'. $archivedEvent->getId() .'</td><td class="user_event_table_players">' .
                    $archivedEvent->getEventPlayersNumber() . '/' . $archivedEvent->getEventMaxPlayers() . $waiters .'</td><td class="user_event_table_creator"><div class="user_events_passed_creator_div" onmouseover="showCreatorsCard('.$creatorTempId.')" onmouseout="hideCreatorsCard('.$creatorTempId.')"><a href="' . WEBROOT . 'User/main/' . $archivedEvent->getEventCreatorId() . '">' . $archivedEvent->getEventCreatorPseudo() . '</a></div>';
                require (ROOT . "public/php/cards/creators_card.php");
                echo '</td></tr>';
            }
        }
        else
        {
            echo '<tr><td colspan="7"><p class="events_text">Vous n\'avez aucun évènement supprimé.</p></td></tr>';
        }
        ?>
        </table>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
