<?php require_once (ROOT."public/php/header.php") ?>


<main id="home">
    <div id="main_div">

        <?php
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
        ?>

            <div class="main_buttons_div">
                <a href="<?= WEBROOT ?>Event/main/<?= date("Y-m-d") ?>">
                    <button class="event_day_button normal">Parties du jour</button>
                </a>
                <a class="event_creation_link" href="<?= WEBROOT ?>Event/creation/<?= $_SESSION["user_id"] ?>">
                    <button class="event_creation_button good">Créer un évènement</button>
                </a>
            </div>

            <?php
            if (isset($freeNextEvents))
            {
                ?>

                <h1>Évènements à la une :</h1>

                <table class="list_events_array" id="user_next_events_array">
                    <tr>
                        <th class="event_table_datetime">Date<br/>Heure</th>
                        <th class="event_table_name">Nom</th>
                        <th class="event_table_game">Jeu</th>
                        <th class="event_table_players">Joueurs</th>
                        <th class="event_table_creator">Créateur</th>
                    </tr>
                    <?php

                    foreach ($freeNextEvents as $key => $nextEvent)
                    {
                        $creator = $freeNextEventsCreators[$key];
                        $creatorTempId = "1" . $key;

                        // Création d'une variable waiters pour définir l'affichage ou non du nombre de joueur en liste d'attente
                        $waiters = ($nextEvent->getEventWaitersNumber() > 0) ? ' + ' . $nextEvent->getEventWaitersNumber() : '';

                        echo '<tr><td class="event_table_datetime">' . date_format(new DateTime($nextEvent->getEventDate()), "d/m/y") . '<br/>' .
                            substr($nextEvent->getEventTime(), 0, 5) .
                            '</td><td class="event_table_name"><a href="' . WEBROOT . 'Event/zoom/' . $nextEvent->getId() . '" title="' .
                            $nextEvent->getEventName() . '">' . $nextEvent->getEventName() . '</a></td><td class="event_table_game">' .
                            $nextEvent->getEventGameId() . '<br/>' . $nextEvent->getId() . '</td><td class="event_table_players">' .
                            $nextEvent->getEventPlayersNumber() . '/' . $nextEvent->getEventMaxPlayers() . $waiters . '</td>
                            <td class="event_table_creator"><span class="incoming_events_creator_span" onmouseover="showCreatorsCard(' .
                            $creatorTempId . ')" onmouseout="hideCreatorsCard(' . $creatorTempId . ')"><a href="' . WEBROOT . 'User/main/' .
                            $nextEvent->getEventCreatorId() . '">' . $nextEvent->getEventCreatorPseudo() . '</a>';
                        require(ROOT . "public/php/cards/creators_card.php");
                        echo '</span></td>';
                    }
                    ?>
                </table>
                <?php
            }
            else
            {
                echo '<p class="events_text">Il n\'y a aucun évènement à la une.</p><p class="events_text">Vous pouvez toujours en creer un! ^^</p>';
            }
        }
        elseif(isset($_SESSION["user_id"]) && $_SESSION["user_id"] === 0)
        {
        ?>

            <div class="home_base">
                Bonjour,<br/><br/>
                Bienvenue sur PartyNow.<br/><br/>
                Vous devez vous connecter ou créer un compte afin d'accéder au contenu du site.<br/>
                Tel que les évènements, le social et les concours!<br/><br/>
                Nous espèrons vous compter parmis nous bientôt!
            </div>

        <?php
        }
        ?>
    </div>
</main>

