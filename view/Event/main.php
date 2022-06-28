<?php
require_once (ROOT."/public/php/header.php");

$dayBefore = new DateTime("$eventsDate -1 day");
$day = new DateTime($eventsDate);
$dayAfter = new DateTime("$eventsDate +1 day");
$dayDate = new DateTime(date("Y-m-d"));
$dayTimestamp = date("U");
?>

<main>
    <div id="main_div">
        <h1>Évènements</h1>

        <h3 class="event_day_date"><?= $day->format("d F Y") ?></h3>

        <div class="event_day_intro_buttons">

            <a class="event_calendar_link" href="<?= WEBROOT ?>Event/calendar/<?= date("Y-m") ?>">
                <button class="show_calendar_button neutral">Calendrier</button>
            </a>

            <a style="visibility: <?= $dayDate->format("Y-m-d") === $day->format("Y-m-d") ? "hidden" : "visible" ?>" class="event_today_link" href="<?= WEBROOT ?>Event/main/<?= $dayDate->format("Y-m-d") ?>">
                <button class="event_day_button neutral">Aujourd'hui</button>
            </a>

        </div>

        <div id="event_day_buttons">
            <a class="event_creation_link" href="<?= WEBROOT ?>Event/creation/<?= $_SESSION["user_id"] ?>"><button class="event_creation_button good">Créer un évènement</button></a>

            <div style="display: flex; justify-content: space-evenly" >
                <a href="<?= WEBROOT ?>Event/main/<?= $dayBefore->format("Y-m-d") ?>">
                    <button class="event_day_button normal">Jour précédent</button>
                </a>

                <a href="<?= WEBROOT ?>Event/main/<?= $dayAfter->format("Y-m-d") ?>">
                    <button class="event_day_button normal">Jour suivant</button>
                </a>
            </div>
        </div>

        <table class="list_events_array">
            <tr>
                <th class="user_event_table_datetime">Date<br/>Heure</th>
                <th class="user_event_table_name user_event_table_name_th">Nom</th>
                <th class="user_event_table_game user_event_table_game_th">Jeu</th>
                <th class="user_event_table_players user_event_table_players_th">Joueurs</th>
                <th class="user_event_table_creator user_event_table_creator_th">Créateur</th>
            </tr>
        <?php
        if (isset($dayEvents))
        {
            foreach ($dayEvents as $dayEventsKey => $events)
            {
                $creator = $creatorsCardList[$dayEventsKey];
                $creatorTempId = "1" . $dayEventsKey;

//                Création d'une variable waiters pour définir l'affichage ou non du nombre de joueur en liste d'attente
                $waiters = ($events->getEventWaitersNumber() > 0) ? ' + '. $events->getEventWaitersNumber() : '';

                echo '<tr><td class="event_table_datetime">' . date_format(new DateTime($events->getEventDate()), "d/m/y") . '<br/>' . substr
                    ($events->getEventTime(), 0, 5) . '</td><td class="event_table_name"><a href="' . WEBROOT . 'Event/zoom/' .
                    $events->getId() . '" title="' . $events->getEventName() . '">' . $events->getEventName() . '</a></td><td class="event_table_game">'
                    . $events->getEventGameId() . '<br/>' . $events->getId() . '</td><td class="event_table_players">' . $events->getEventPlayersNumber() .
                    '/' . $events->getEventMaxPlayers() . $waiters . '</td><td class="event_table_creator"><span class="event_creator_span"
onmouseover="showCreatorsCard(' . $creatorTempId . ')" onmouseout="hideCreatorsCard(' . $creatorTempId . ')"><a href="' . WEBROOT . 'User/main/' .
                    $events->getEventCreatorId() . '">' . $events->getEventCreatorPseudo() . '</a>';

                require(ROOT . "public/php/cards/creators_card.php");

                echo '</span></td>';
            }
        }
        else
        {
            echo '<tr><td colspan="7"><p class="events_text">Il n\'y a aucun évènement pour cette journée, mais vous pouvez toujours en créer un. ^^</p></td></tr>';
        }
        ?>
        </table>

    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
