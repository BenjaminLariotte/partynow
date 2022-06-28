<?php

include "UserController.php";

class EventController extends Controller
{
    //Actions that render views
    public function main($date, $log = null)
    {
        // Check if user is connected
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $this->loadDao("UserDao");
            //Create an user object
            $UserObject = (new UserController)->readAndcard($_SESSION["user_id"]);

            // Connected token verification
            if ($_SESSION["user_token"] == $UserObject->getUserConnectedToken())
            {
                //get all events for one day in an array of objects
                $dayEventsObject = $this->readAllEventsOfDay($date);

                // Action if array isn't empty
                if ($dayEventsObject != null)
                {
                    $dayEventsObject = $this->setEventCreatorPseudo($dayEventsObject);

                    $dayEventsObject = $this->setEventCreatorReputationStars($dayEventsObject);

                    $dayEventsObject = $this->setEventPlayersNumber($dayEventsObject);

                    $dayEventsObject = $this->setEventTimestamp($dayEventsObject);

                    $dayEventsObject = $this->setEventWaitersNumber($dayEventsObject);

                    // Set events object into $d array
                    $d["dayEvents"] = $dayEventsObject;

                    // create event's creator cards array of objects and set it into $d array
                    $creatorsCardListObject = $this->setCreatorsCardList($dayEventsObject);
                    $d["creatorsCardList"] = $creatorsCardListObject;
                }
                $d["user"] = $UserObject;
                $d["eventsDate"] = $date;
                isset($log) ? $d["log"] = $log : null;
                $this->set($d);
                $this->render("Event", "main", $date);
            }
            else
            {
                $d["user"] = $UserObject;
                $d["log"] = "Problème de token.";
                $this->set($d);
                $this->render("Home", "main");
            }
        }
        else
        {
            $d["log"] = "Veuillez vous inscrire ou vous connecter afin de profiter de cette fonctionnalité.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function zoom($eventId, $log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $this->loadDao("UserDao");

            $UserObject = (new UserController)->readAndCard($_SESSION["user_id"]);

            if ($UserObject->getUserverified() === 1)
            {
                if ($_SESSION["user_token"] == $UserObject->getUserConnectedToken())
                {

                    $eventObject = $this->readEvent($eventId);
                    $eventObject = $this->setEventCreatorPseudo($eventObject);
                    $eventObject = $this->setEventCreatorReputationStars($eventObject);
                    $eventObject = $this->setEventPlayersNumber($eventObject);
                    $eventObject = $this->setEventWaitersNumber($eventObject);
                    $eventObject = $this->setEventTimestamp($eventObject);

                    $eventPlayersObject = $this->eventPlayersList($eventId);

                    $eventWaitersObject = $this->eventWaitersList($eventId);

                    $creatorsCardListObject = $this->setCreatorsCardList($eventObject);

                    $playersCardListObject = $this->setPlayersCardList($eventPlayersObject);

                    if (isset($eventWaitersObject))
                    {
                        $waitersCardListObject = $this->setWaitersCardList($eventWaitersObject);
                        $d["waitersCardList"] = $waitersCardListObject;
                    }

                    $d["user"] = $UserObject;
                    $d["eventPlayersList"] = $eventPlayersObject;
                    $d["eventWaitersList"] = $eventWaitersObject;
                    $d["event"] = $eventObject;
                    $d["creatorsCardList"] = $creatorsCardListObject;
                    $d["playersCardList"] = $playersCardListObject;
                    isset($log) ? $d["log"] = $log : null;

                    $this->set($d);
                    $this->render("Event", "zoom", $eventId);
                }
                else
                {
                    $d["user"] = $UserObject;
                    $d["log"] = "Problème de token.";
                    $this->set($d);
                    $this->render("Home", "main", $eventId);
                }
            }
            else
            {
                $d["user"] = $UserObject;
                $d["log"] = "Vous devez vérifier votre compte pour accéder à ce service.";
                $this->set($d);
                $this->render("User", "security", $_SESSION["user_id"]);
            }
        }
        else
        {
            $d["log"] = "Veuillez vous inscrire ou vous connecter afin de profiter de cette fonctionnalité.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function calendar($date, $log = null)
    {
        // Check if user is connected
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            // Create and fill an user object
            $userObject = (new UserController)->readAndcard($_SESSION["user_id"]);

            // Check if user is verified and not archived
            if ($userObject->getUserVerified() === 1 && $userObject->getUserArchived() === 0)
            {
                // Create an object with all event of a year
                $year = date_format(new Datetime($date), "Y");
                $yearEventsObject = $this->readAllEventsOfYear($year);
                $yearEventsObject = $this->setEventTimestamp($yearEventsObject);

                // Set $d
                $yearEventsObject != null ? $d["yearEvents"] = $yearEventsObject : "";
                $d["viewDate"] = $date;
                $d["user"] = $userObject;
                $this->set($d);
                $this->render("Event", "calendar", $date);
            }
            // Actions if user isn't verified
            elseif ($userObject->getUserVerified() === 0)
            {
                $d["user"] = $userObject;
                $d["log"] = "Vous devez vérifier votre compte avant de pouvoir utiliser ce service";
                $this->set($d);
                $this->render("User", "security", $_SESSION["user_id"]);
            }
            // Actions if user is archived
            else
            {
                $d["user"] = $userObject;
                $d["log"] = "Vous devez récupérer votre compte avant de pouvoir utiliser ce service";
                $this->set($d);
                $this->render("User", "recuperation");
            }
        }
        // Action if user isn't connected
        else
        {
            $d["log"] = "Vous devez être connecté pour profiter de ce service.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function userEvents($userId, $log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $this->loadDao("UserDao");
            $userObject = $this->UserDao->readUserInfos($_SESSION["user_id"]);
            $userObject = $this->setReputationStars($userObject);
            $userObject = $this->setStatusName($userObject);
            $userObject = $this->setUserIncomingEventsNumber($userObject);

            $eventsUserObject = $this->UserDao->readUserInfos($userId);

            $userEvents = $this->readUserEvents($userId);

            $dayTimestamp = date_format(new DateTime(), "U");

            if (isset($userEvents) && $userEvents != null)
            {
                foreach ($userEvents as $key => $userEvent)
                {
                    $eventPlayersList = $this->eventPlayersList($userEvent[0]["event_id"]);
                    $eventWaitersList = $this->eventWaitersList($userEvent[0]["event_id"]);

                    $eventTimestamp = date_format(new DateTime($userEvent[0]["event_date"] . " " . $userEvent[0]["event_time"]), "U");

                    if ($userEvent[0]["event_archived"] === 0)
                    {
                        if (isset($userEvent))
                        {
                            if ($eventTimestamp > $dayTimestamp)
                            {
                                $userNextEvents[$key] = new Event($userEvent[0]["event_creator_id"], $userEvent[0]["event_game_id"], $userEvent[0]["event_name"], $userEvent[0]["event_date"], $userEvent[0]["event_time"], $userEvent[0]["event_description"], $userEvent[0]["event_max_players"]);
                                $userNextEvents[$key]->setEventCreatorPseudo($this->getPseudoById($userEvent[0]["event_creator_id"]));
                                $userNextEvents[$key] = $this->setEventCreatorReputationStars($userNextEvents[$key]);
                                $userNextEvents[$key]->setEventPlayersNumber(count($eventPlayersList));
                                $userNextEvents[$key]->setEventWaitersNumber(is_array($eventWaitersList) ? count($eventWaitersList) : 0);
                                $userNextEvents[$key]->setEventArchived($userEvent[0]["event_archived"]);
                                $userNextEvents[$key]->setId($userEvent[0]["event_id"]);
                                $userNextEvents[$key] = $this->setEventTimestamp($userNextEvents[$key]);
                                $nextEventsCreatorsCardListObject[] = $this->setCreatorsCardList($userNextEvents[$key]);
                            }
                            else
                            {
                                $userPassedEvents[$key] = new Event($userEvent[0]["event_creator_id"], $userEvent[0]["event_game_id"], $userEvent[0]["event_name"], $userEvent[0]["event_date"], $userEvent[0]["event_time"], $userEvent[0]["event_description"], $userEvent[0]["event_max_players"]);
                                $userPassedEvents[$key]->setEventCreatorPseudo($this->getPseudoById($userEvent[0]["event_creator_id"]));
                                $userPassedEvents[$key] = $this->setEventCreatorReputationStars($userPassedEvents[$key]);
                                $userPassedEvents[$key]->setEventPlayersNumber(count($eventPlayersList));
                                $userPassedEvents[$key]->setEventWaitersNumber(is_array($eventWaitersList) ? count($eventWaitersList) : 0);
                                $userPassedEvents[$key]->setEventArchived($userEvent[0]["event_archived"]);
                                $userPassedEvents[$key]->setId($userEvent[0]["event_id"]);
                                $userPassedEvents[$key] = $this->setEventTimestamp($userPassedEvents[$key]);

                            }
                        }
                    }
                    elseif ($userEvent[0]["event_archived"] === 1)
                    {
                        if (isset($userEvent))
                        {
                            $userArchivedEvents[$key] = new Event($userEvent[0]["event_creator_id"], $userEvent[0]["event_game_id"], $userEvent[0]["event_name"], $userEvent[0]["event_date"], $userEvent[0]["event_time"], $userEvent[0]["event_description"], $userEvent[0]["event_max_players"]);
                            $userArchivedEvents[$key]->setEventCreatorPseudo($this->getPseudoById($userEvent[0]["event_creator_id"]));
                            $userArchivedEvents[$key] = $this->setEventCreatorReputationStars($userArchivedEvents[$key]);
                            $userArchivedEvents[$key]->setEventPlayersNumber(count($eventPlayersList));
                            $userArchivedEvents[$key]->setEventWaitersNumber(is_array($eventWaitersList) ? count($eventWaitersList) : 0);
                            $userArchivedEvents[$key]->setEventArchived($userEvent[0]["event_archived"]);
                            $userArchivedEvents[$key]->setId($userEvent[0]["event_id"]);
                            $userArchivedEvents[$key] = $this->setEventTimestamp($userArchivedEvents[$key]);
                            $archivedEventsCreatorsCardListObject[] = $this->setCreatorsCardList($userArchivedEvents[$key]);
                        }
                    }
                }

                // Incoming events
                if (isset($userNextEvents))
                {
                    if (is_array($userNextEvents))
                    {
                        $sortBy = array();
                        foreach ($userNextEvents as $nextEvent)
                        {
                            // Get the value to sort
                            $sortBy[] = $nextEvent->getEventTimestamp();
                        }

                        // Sort the array with the sortBy value
                        array_multisort($sortBy, SORT_ASC, $userNextEvents);
                        // Inversion of the array to have newer events first
                        $userNextEvents = array_reverse($userNextEvents);


                        $d["userNextEvents"] = $userNextEvents;
                        $d["nextEventsCreators"] = $nextEventsCreatorsCardListObject;
                    }
                }
                else
                {
                    $d["userNextEvents"] = null;
                }

                // Passed events
                if (isset($userPassedEvents))
                {
                    if (is_array($userPassedEvents))
                    {
                        $sortBy = array();
                        foreach ($userPassedEvents as $passedEvent)
                        {
                            // Get the value to sort
                            $sortBy[] = $passedEvent->getEventTimestamp();
                        }

                        // Sort the array with the sortBy value
                        array_multisort($sortBy, SORT_ASC, $userPassedEvents);
                        // Inversion of the array to have newer events first
                        $userPassedEvents = array_reverse($userPassedEvents);

                        foreach ($userPassedEvents as $key => $event)
                        {
                            $passedEventsCreatorsCardListObject[] = $this->setCreatorsCardList($userPassedEvents[$key]);
                        }

                        $d["userPassedEvents"] = $userPassedEvents;
                        $d["passedEventsCreators"] = $passedEventsCreatorsCardListObject;
                    }
                }
                else
                {
                    $d["userPassedEvents"] = null;
                }

                //Archivés
                if (isset($userArchivedEvents))
                {
                    if (is_array($userArchivedEvents))
                    {
                        $sortBy = array();
                        foreach ($userArchivedEvents as $archivedEvent)
                        {
                            // Get the value to sort
                            $sortBy[] = $archivedEvent->getEventTimestamp();
                        }

                        // Sort the array with the sortBy value
                        array_multisort($sortBy, SORT_ASC, $userArchivedEvents);
                        // Inversion of the array to have newer events first
                        $userArchivedEvents = array_reverse($userArchivedEvents);

                        $d["userArchivedEvents"] = $userArchivedEvents;
                        $d["archivedEventsCreators"] = $archivedEventsCreatorsCardListObject;
                    }
                }
                else
                {
                    $d["userArchivedEvents"] = null;
                }

                $d["eventsUser"] = $eventsUserObject;
                $d["user"] = $userObject;
                $d["log"] = $log;
                $this->set($d);
                $this->render("Event", "userEvents", $userId);
            }
            else
            {
                $d["eventsUser"] = $eventsUserObject;
                $d["user"] = $userObject;
                $d["log"] = "Vous n'avez aucun évènements à afficher, il est temps de vous y mettre!";
                $this->set($d);
                $this->render("Event", "userEvents", $userId);
            }
        }
        else
        {
            $d["log"] = "Vous devez être connecté pour profiter de ce service.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function incomingEvents($userId, $log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $this->loadDao("UserDao");
            $userObject = $this->UserDao->readUserInfos($_SESSION["user_id"]);
            $userObject = $this->setReputationStars($userObject);
            $userObject = $this->setStatusName($userObject);
            $userObject = $this->setUserIncomingEventsNumber($userObject);

            $incomingEventsUserObject = $this->UserDao->readUserInfos($userId);

            $userEvents = $this->readUserEvents($userId);

            $dayTimestamp = date_format(new DateTime(), "U");

            if (isset($userEvents) && $userEvents != null)
            {
                foreach ($userEvents as $key => $userEvent)
                {
                    $eventPlayersList = $this->eventPlayersList($userEvent[0]["event_id"]);

                    $eventTimestamp = date_format(new DateTime($userEvent[0]["event_date"] . " " . $userEvent[0]["event_time"]), "U");

                    if ($userEvent[0]["event_archived"] === 0)
                    {
                        if (isset($userEvent))
                        {
                            if ($eventTimestamp > $dayTimestamp)
                            {
                                $userNextEvents[$key] = new Event($userEvent[0]["event_creator_id"], $userEvent[0]["event_game_id"], $userEvent[0]["event_name"], $userEvent[0]["event_date"], $userEvent[0]["event_time"], $userEvent[0]["event_description"], $userEvent[0]["event_max_players"]);
                                $userNextEvents[$key]->setEventCreatorPseudo($this->getPseudoById($userEvent[0]["event_creator_id"]));
                                $userNextEvents[$key] = $this->setEventCreatorReputationStars($userNextEvents[$key]);
                                $userNextEvents[$key]->setEventPlayersNumber(count($eventPlayersList));
                                $userNextEvents[$key] = $this->setEventWaitersNumber($userNextEvents[$key]);
                                $userNextEvents[$key]->setEventArchived($userEvent[0]["event_archived"]);
                                $userNextEvents[$key]->setId($userEvent[0]["event_id"]);
                                $userNextEvents[$key] = $this->setEventTimestamp($userNextEvents[$key]);
                                $nextEventsCreatorsCardListObject[] = $this->setCreatorsCardList($userNextEvents[$key]);
                            }
                        }
                    }
                }

                if (isset($userNextEvents))
                {
                    if (is_array($userNextEvents)) //Tri du tableau dons l'ordre chronologique
                    {
                        $sortBy = array();
                        foreach ($userNextEvents as $nextEvent)
                        {
                            $sortBy[] = $nextEvent->getEventTimestamp(); //any object field
                        }

                        array_multisort($sortBy, SORT_ASC, $userNextEvents);
                        $userNextEvents = array_reverse($userNextEvents);

                        $d["userNextEvents"] = $userNextEvents;
                    }

                    $d["incomingEventsUser"] = $incomingEventsUserObject;
                    $d["nextEventsCreators"] = $nextEventsCreatorsCardListObject;
                    $d["user"] = $userObject;
                    $d["log"] = $log;
                    $this->set($d);
                    $this->render("Event", "incomingEvents", $userId);
                }
                else
                {
                    $d["userNextEvents"] = null;
                }
            }

            $d["incomingEventsUser"] = $incomingEventsUserObject;
            $d["user"] = $userObject;
            $this->set($d);
            $this->render("Event", "incomingEvents", $userId);
        }
        else
        {
        $d["log"] = "Vous devez être connecté pour profiter de ce service.";
        $this->set($d);
        $this->render("Home", "main");
        }
    }

    public function creation()
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $this->loadDao("UserDao");
            $userObject = $this->UserDao->readUserInfos($_SESSION["user_id"]);
            $userObject = $this->setReputationStars($userObject);
            $userObject = $this->setStatusName($userObject);
            $userObject = $this->setUserIncomingEventsNumber($userObject);

            if ($userObject->getUserVerified() === 1)
            {
                $d["user"] = $userObject;
                $this->set($d);
                $this->render("Event", "creation");
            }
            else
            {
                $d["user"] = $userObject;
                $d["log"] = "Vous devez vérifier votre compte pour profiter de cette fonctionnalité";
                $this->set($d);
                $this->render("User", "security", $_SESSION["user_id"]);
            }
        }
    }

    public function modification($eventId, $creatorId, $log = null)
    {
        $this->loadDao("UserDao");
        $userObject = (new UserController)->readAndCard($_SESSION["user_id"]);

        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $creatorId)
        {
            $eventObject = $this->readEvent($eventId);

            $d["event"] = $eventObject;
            $d["user"] = $userObject;
            $d["log"] = $log;
            $this->set($d);
            $this->render("Event", "modification", $eventId ."/". $creatorId);
        }
        else
        {
            $log = "Vous n'avez pas l'autorisation pour accéder à ce contenu";
            $this->zoom($eventId, $log);
        }
    }

    public function goToHomeMain($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = (new UserController())->readAndCard($_SESSION["user_id"]);
            $d["user"] = $UserObject;
            isset($log) ? $d["log"] = $log : null;
            isset($d) ? $this->set($d) : "";
            $this->render("Home", "main");
        }
        else
        {
            $log = "Une erreur est survenue lors de la connection à votre compte";
            $this->connection($log);
        }
    }


    //Actions qui renvoient vers les affichages de vue
    public function create()
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $this->loadDao("UserDao");
            $user = $this->UserDao->readUserInfos($_SESSION["user_id"]);

            if ($user->getUserVerified() === 1)
            {
                $this->loadDao("EventDao");

                $event = new Event($_SESSION["user_id"], htmlspecialchars($this->input["new_event_game"]), htmlspecialchars($this->input["new_event_name"]), htmlspecialchars($this->input["new_event_date"]), htmlspecialchars($this->input["new_event_time"]), strip_tags(htmlspecialchars($this->input["new_event_description"])), htmlspecialchars($this->input["new_event_max_players"]));

                $this->EventDao->createNewEvent($event);

                $eventId = DataBase::databaseLastId();

                $this->addEventPlayer($eventId, $_SESSION["user_id"]);

                $log = "Votre évènement à bien été créé";

                $this->main(htmlspecialchars($this->input["new_event_date"]), $log);
            }
            else
            {
                $d["log"] = "Vous devez valider votre compte avant de pouvoir utiliser ce service";
                $this->set($d);
                $this->render("User", "security");
            }
        }
        else
        {
            $d["log"] = "Vous devez être connecté pour profiter de ce service";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function deleteEvent($eventId)
    {
        $event = $this->readEvent($eventId);
        $event->setEventArchived(1);
        $this->updateEvent($eventId, $event);
        $log = "Votre évènement a bien été supprimé";

        $dayDate = date("Y-m-d");

        $this->main($dayDate, $log);
    }

    public function recoverEvent($eventId)
    {
        $event = $this->readEvent($eventId);
        $event->setEventArchived(0);
        $this->updateEvent($eventId, $event);
        $log = "Votre évènement a bien été restauré";

        $this->main($event->getEventDate(), $log);
    }

    public function addPlayerToEvent($eventId, $playerId)
    {
        if ($_SESSION["user_id"] == $playerId)
        {
            $this->loadDao("EventDao");

            $eventObject = $this->readEvent($eventId);
            $eventObject = $this->setEventPlayersNumber($eventObject);
            $eventObject = $this->setEventWaitersNumber($eventObject);

            $this->loadDao("EventPlayersDao");
            $isOnList = $this->EventPlayersDao->checkIfIsOnPlayersList($eventId, $playerId);

            $this->loadDao("EventWaitersDao");
            $isWaiting = $this->EventWaitersDao->checkIfIsOnWaitersList($eventId, $playerId);

            if ($eventObject->getEventPlayersNumber() < $eventObject->getEventMaxPlayers())
            {
                if ($isOnList)
                {
                    $log = "Vous êtes déjà inscrit à cet évènement";
                    $this->zoom($eventId, $log);
                }
                else
                {
                    if ($isWaiting)
                    {
                        $this->EventWaitersDao->removeWaiter($eventId, $playerId);
                    }
                    $this->EventPlayersDao->insertPlayer($eventId, $playerId);
                    $log = "Vous êtes bien inscrit à cet évènement";
                    $this->zoom($eventId, $log);
                }
            }
            else
            {
                $log = "Le nombre maximal de joueurs est déjà atteind.";
                $this->zoom($eventId, $log);
            }
        }
        else
        {
            $log = "Vous n'avez pas l'autorisation d'effectuer cet action.";
            $this->goToHomeMain($log);
        }
    }

    public function addWaiterToEvent($eventId, $playerId)
    {
        $this->loadDao("EventWaitersDao");

        $isOnList = $this->EventWaitersDao->checkIfIsOnWaitersList($eventId, $playerId);

        if (!$isOnList)
        {
            $this->EventWaitersDao->insertWaiter($eventId, $playerId);
            $log = 'Vous êtes bien inscrit à la liste d\'attente';
        }
        elseif ($isOnList)
        {
            $log = 'Vous déjà inscrit à la liste d\'attente';
        }

        $this->zoom($eventId, $log);
    }

    public function removePlayerFromEvent($eventId, $playerId)
    {
        $this->loadDao("EventDao");

        $eventObject = $this->readEvent($eventId);
        $eventObject = $this->setEventPlayersNumber($eventObject);
        $eventObject = $this->setEventWaitersNumber($eventObject);

        if ($eventObject->getEventPlayersNumber() == $eventObject->getEventMaxPlayers())
        {
            $eventIsFull = true;
        }
        else
        {
            $eventIsFull = false;
        }

        $this->EventDao->deleteUserFromPlayersList($eventId, $playerId);

        if ($eventIsFull && $eventObject->getEventWaitersNumber() > 0)
        {
            $eventObject = $this->setEventPlayersNumber($eventObject);

            if ($eventObject->getEventPlayersNumber() < $eventObject->getEventMaxPlayers())
            {
                $this->transferWaiterToPlayer($eventId);
            }
        }

        $log = "Vous êtes bien désinscrit de cet évènement";
        $this->zoom($eventId, $log);
    }

    public function removeWaiterFromEvent($eventId, $playerId)
    {
        $this->loadDao("EventWaitersDao");

        $this->EventWaitersDao->removeWaiter($eventId, $playerId);

        $log = "Vous êtes bien parti de la file d'attente";
        $this->zoom($eventId, $log);
    }

    public function updateEvent($eventId)
    {
        $EventObject = $this->readEvent($eventId);
        $UserObject = (new UserController)->read($_SESSION["user_id"]);

        if ($UserObject->getUserConnectedToken() === $_SESSION["user_token"] && $EventObject->getEventCreatorId() === $UserObject->getId())
        {
            $EventObject->setEventName($this->input["event_modification_name"]);
            $EventObject->setEventDate($this->input["event_modification_date"]);
            $EventObject->setEventTime($this->input["event_modification_time"]);
            $EventObject->setEventDescription($this->input["event_modification_description"]);
            $EventObject->setEventGameId($this->input["event_modification_game_id"]);
            $this->updateEventObject($eventId, $EventObject);
            $log = "Votre description a bien été modifiée";

            $this->zoom($eventId, $log);
        }
        else
        {
            $log = "Vous n'avez pas l'autorisation de modifier ce contenu.";
            $this->zoom($eventId, $log);
        }

    }



    // Affichage d'élément



    //Actions

    public function addEventPlayer($eventId, $userId)
    {
        $this->loadDao("EventPlayersDao");
        $this->EventPlayersDao->insertPlayer($eventId, $userId);
    }

    public function removeEventWaiter($eventId, $userId)
    {
        $this->loadDao("EventWaitersDao");
        $this->EventWaitersDao->removeWaiter($eventId, $userId);
    }

    public function updateEventObject($eventId, $eventObject)
    {
        $this->loadDao("EventDao");

        $this->EventDao->updateEvent($eventId, $eventObject);
    }

    public function transferWaiterToPlayer($eventId)
    {
        $this->loadDao("EventWaitersDao");

        $eventWaitersObject = $this->eventWaitersList($eventId);

        if (count($eventWaitersObject) > 1)
        {
            $sortBy = array();
            foreach ($eventWaitersObject as $eventWaiter)
            {
                // Get the value to sort
                $sortBy[] = $eventWaiter->getEventWaiterTimestamp();
            }

            // Sort the array with the sortBy value
            array_multisort($sortBy, SORT_ASC, $eventWaitersObject);

            $this->addEventplayer($eventId, $eventWaitersObject[0]->getEventWaiterFk());
            $this->removeEventWaiter($eventId, $eventWaitersObject[0]->getEventWaiterFk());
        }
        else
        {
            $this->addEventPlayer($eventId, $eventWaitersObject[0]->getEventWaiterFk());
            $this->removeEventWaiter($eventId, $eventWaitersObject[0]->getEventWaiterFk());
        }
    }



    //Actions renvoyant un objet
    public function eventPlayersList($eventId)
    {
        $this->loadDao("EventPlayersDao");

        $eventPlayers = $this->EventPlayersDao->getEventPlayers($eventId);

        if (count($eventPlayers) > 1)
        {
            foreach ($eventPlayers as $key => $eventPlayer)
            {
                $this->loadDao("UserDao");
                $eventPlayersObject[$key] = new EventPlayers($eventPlayer["event_fk"], $eventPlayer["event_player_fk"]);
                $pseudo = $this->UserDao->getPseudo($eventPlayer["event_player_fk"]);
                $eventPlayersObject[$key]->setEventPlayerPseudo($pseudo);
                $eventPlayersObject[$key] = $this->setEventPlayerReputationStars($eventPlayersObject[$key]);

            }
        }
        else
        {
            if($eventPlayers != null)
            $this->loadDao("UserDao");
            $eventPlayersObject[0] = new EventPlayers($eventPlayers[0]["event_fk"], $eventPlayers[0]["event_player_fk"]);
            $pseudo = $this->UserDao->getPseudo($eventPlayersObject[0]->getEventPlayerFk());
            $eventPlayersObject[0]->setEventPlayerPseudo($pseudo);
            $eventPlayersObject[0] = $this->setEventPlayerReputationStars($eventPlayersObject[0]);

        }

        return $eventPlayersObject;
    }

    public function eventWaitersList($eventId)
    {
        $this->loadDao("EventWaitersDao");

        $eventWaiters = $this->EventWaitersDao->getEventWaiters($eventId);

        if (!empty($eventWaiters))
        {
            if (count($eventWaiters) > 1)
            {
                foreach ($eventWaiters as $key => $eventWaiter)
                {
                    $this->loadDao("UserDao");
                    $eventWaitersObject[$key] = new EventWaiters($eventWaiter["event_fk"], $eventWaiter["event_waiter_fk"]);
                    $pseudo = $this->UserDao->getPseudo($eventWaiter["event_waiter_fk"]);
                    $eventWaitersObject[$key]->setEventWaiterPseudo($pseudo);
                    $eventWaitersObject[$key]->setEventWaiterTimestamp($eventWaiter["event_waiter_timestamp"]);
                    $eventWaitersObject[$key] = $this->setEventWaiterReputationStars($eventWaitersObject[$key]);
                }
            }
            else
            {
                $this->loadDao("UserDao");
                $eventWaitersObject[0] = new EventWaiters($eventWaiters[0]["event_fk"], $eventWaiters[0]["event_waiter_fk"]);
                $pseudo = $this->UserDao->getPseudo($eventWaitersObject[0]->getEventWaiterFk());
                $eventWaitersObject[0]->setEventWaiterPseudo($pseudo);
                $eventWaitersObject[0]->setEventWaiterTimestamp($eventWaiters[0]["event_waiter_timestamp"]);
                $eventWaitersObject[0] = $this->setEventWaiterReputationStars($eventWaitersObject[0]);
            }
            return $eventWaitersObject;
        }
    }

    public function readEvent($eventId)
    {
        $this->loadDao("EventDao");
        $eventObject = $this->EventDao->readEventById($eventId);
        return $eventObject;
    }

    public function readAllEventsOfDay($date)
    {
        $this->loadDao("EventDao");

        $dayEventsObject = $this->EventDao->readAllEventsOfDay($date);

        return $dayEventsObject;
    }

    public function readAllEventsOfYear($year)
    {
        $this->loadDao("EventDao");

        $yearsEventsObject = $this->EventDao->readAllEventsOfYear($year);

        return $yearsEventsObject;
    }

    public function setPlayersCardList($listObject)
    {
        foreach ($listObject as $key => $eventPlayerObject)
        {
            $playerObject = $this->UserDao->readUserInfos($eventPlayerObject->getEventPlayerFk());
            $playerObject = $this->setReputationStars($playerObject);
            $playerObject = $this->setStatusName($playerObject);
            $playerObject = $this->setUserIncomingEventsNumber($playerObject);
            $playersArray[] = $playerObject;
        }
        return $playersArray;
    }

    public function setWaitersCardList($listObject)
    {
        foreach ($listObject as $key => $eventWaiterObject)
        {
            $waiterObject = $this->UserDao->readUserInfos($eventWaiterObject->getEventWaiterFk());
            $waiterObject = $this->setReputationStars($waiterObject);
            $waiterObject = $this->setStatusName($waiterObject);
            $waiterObject = $this->setUserIncomingEventsNumber($waiterObject);
            $playersArray[] = $waiterObject;
        }
        return $playersArray;
    }

    public function setCreatorsCardList($eventsListObject)
    {

        if (is_array($eventsListObject))
        {
            foreach ($eventsListObject as $key => $event)
            {
                $creatorObject = $this->UserDao->readUserInfos($event->getEventCreatorId());
                $creatorObject = $this->setReputationStars($creatorObject);
                $creatorObject = $this->setStatusName($creatorObject);
                $creatorObject = $this->setUserIncomingEventsNumber($creatorObject);
                $creatorsArray[] = $creatorObject;
            }
        }
        elseif (is_object($eventsListObject))
        {
            $creatorObject = $this->UserDao->readUserInfos($eventsListObject->getEventCreatorId());
            $creatorObject = $this->setReputationStars($creatorObject);
            $creatorObject = $this->setStatusName($creatorObject);
            $creatorObject = $this->setUserIncomingEventsNumber($creatorObject);
            $creatorsArray[] = $creatorObject;
        }
        return $creatorsArray;
    }



    //Actions renvoyant un tableau
    public function readUserEvents($userId)
    {
        $this->loadDao("EventDao");
        $userEvents = $this->EventDao->getAllEventsOfPlayer($userId);
        return $userEvents;
    }

    public function readUserEventsArchived($userId)
    {
        $this->loadDao("EventDao");
        $userEventsArchived = $this->EventDao->readAllEventsArchivedById($userId);
        return $userEventsArchived;
    }



    //Actions renvoyant une variable
    public function getEventPlayersNumber($eventPlayersList)
    {
        $eventPlayersNumber = count($eventPlayersList);
        return $eventPlayersNumber;
    }

    public function getPseudoById($id)
    {
        $this->loadDao("UserDao");
        $pseudo = $this->UserDao->getPseudo($id);
        return $pseudo;
    }



    //Ajoutent des valeurs aux objets
    public function setEventCreatorPseudo($eventsObject)
    {
        if (is_array($eventsObject))
        {
            foreach ($eventsObject as $key => $event)
            {
                $id = $event->getEventCreatorId();
                $pseudo = $this->getPseudoById($id);
                $event->setEventCreatorPseudo($pseudo);
            }
        }
        else
        {
            $id = $eventsObject->getEventCreatorId();
            $pseudo = $this->getPseudoById($id);
            $eventsObject->setEventCreatorPseudo($pseudo);
        }
        return $eventsObject;
    }

    public function setReputationStars($userObject)
    {
        if ($userObject->getUserReputation() > 4)
        {
            $userObject->setUserReputationStars('<img src="'.WEBROOT.'public/images/reputation_5.png" alt="Réputation 5 étoiles" style="height: 10px">');
        }
        elseif ($userObject->getUserReputation() > 3)
        {
            $userObject->setUserReputationStars('<img src="'.WEBROOT.'public/images/reputation_4.png" alt="Réputation 4 étoiles" style="height: 10px">');
        }
        elseif ($userObject->getUserReputation() > 2)
        {
            $userObject->setUserReputationStars('<img src="'.WEBROOT.'public/images/reputation_3.png" alt="Réputation 3 étoiles" style="height: 10px">');
        }
        elseif ($userObject->getUserReputation() > 1)
        {
            $userObject->setUserReputationStars('<img src="'.WEBROOT.'public/images/reputation_2.png" alt="Réputation 2 étoiles" style="height: 10px">');
        }
        elseif ($userObject->getUserReputation() > 0)
        {
            $userObject->setUserReputationStars('<img src="'.WEBROOT.'public/images/reputation_1.png" alt="Réputation 1 étoiles" style="height: 10px">');
        }
        return $userObject;
    }

    public function setEventCreatorReputationStars($eventsObject)
    {
        $this->loadDao("UserDao");

        if (is_array($eventsObject))
        {
            foreach ($eventsObject as $key => $event)
            {
                $creatorId = $event->getEventCreatorId();
                $creatorReputation = $this->UserDao->getReputation($creatorId);
                if ($creatorReputation > 4)
                {
                    $creatorReputationStars = '<img src="'.WEBROOT.'public/images/reputation_5.png" alt="Réputation 5 étoiles" style="height: 10px">';
                }
                elseif ($creatorReputation > 3)
                {
                    $creatorReputationStars = '<img src="'.WEBROOT.'public/images/reputation_4.png" alt="Réputation 4 étoiles" style="height: 10px">';
                }
                elseif ($creatorReputation > 2)
                {
                    $creatorReputationStars = '<img src="'.WEBROOT.'public/images/reputation_3.png" alt="Réputation 3 étoiles" style="height: 10px">';
                }
                elseif ($creatorReputation > 1)
                {
                    $creatorReputationStars = '<img src="'.WEBROOT.'public/images/reputation_2.png" alt="Réputation 2 étoiles" style="height: 10px">';
                }
                elseif ($creatorReputation > 0)
                {
                    $creatorReputationStars = '<img src="'.WEBROOT.'public/images/reputation_1.png" alt="Réputation 1 étoiles" style="height: 10px">';
                }
                $event->setEventCreatorReputationStars($creatorReputationStars);
            }
        }
        else
        {
            $creatorId = $eventsObject->getEventCreatorId();
            $creatorReputation = $this->UserDao->getReputation($creatorId);
            if ($creatorReputation > 4)
            {
                $creatorReputationStars = '<img src="'.WEBROOT.'public/images/reputation_5.png" alt="Réputation 5 étoiles" style="height: 10px">';
            }
            elseif ($creatorReputation > 3)
            {
                $creatorReputationStars = '<img src="'.WEBROOT.'public/images/reputation_4.png" alt="Réputation 4 étoiles" style="height: 10px">';
            }
            elseif ($creatorReputation > 2)
            {
                $creatorReputationStars = '<img src="'.WEBROOT.'public/images/reputation_3.png" alt="Réputation 3 étoiles" style="height: 10px">';
            }
            elseif ($creatorReputation > 1)
            {
                $creatorReputationStars = '<img src="'.WEBROOT.'public/images/reputation_2.png" alt="Réputation 2 étoiles" style="height: 10px">';
            }
            elseif ($creatorReputation > 0)
            {
                $creatorReputationStars = '<img src="'.WEBROOT.'public/images/reputation_1.png" alt="Réputation 1 étoiles" style="height: 10px">';
            }
            $eventsObject->setEventCreatorReputationStars($creatorReputationStars);
        }
        return $eventsObject;
    }

    public function setEventPlayerReputationStars($eventPlayersObject)
    {
        $this->loadDao("UserDao");

        if (is_array($eventPlayersObject))
        {
            foreach ($eventPlayersObject as $key => $player)
            {
                $playerId = $player["event_player_fk"];
                $playerReputation = $this->UserDao->getReputation($playerId);
                if ($playerReputation > 4)
                {
                    $playerReputationStars = '<img src="'.WEBROOT.'public/images/reputation_5.png" alt="Réputation 5 étoiles" style="height: 10px">';
                }
                elseif ($playerReputation > 3)
                {
                    $playerReputationStars = '<img src="'.WEBROOT.'public/images/reputation_4.png" alt="Réputation 4 étoiles" style="height: 10px">';
                }
                elseif ($playerReputation > 2)
                {
                    $playerReputationStars = '<img src="'.WEBROOT.'public/images/reputation_3.png" alt="Réputation 3 étoiles" style="height: 10px">';
                }
                elseif ($playerReputation > 1)
                {
                    $playerReputationStars = '<img src="'.WEBROOT.'public/images/reputation_2.png" alt="Réputation 2 étoiles" style="height: 10px">';
                }
                elseif ($playerReputation > 0)
                {
                    $playerReputationStars = '<img src="'.WEBROOT.'public/images/reputation_1.png" alt="Réputation 1 étoiles" style="height: 10px">';
                }
                $player->setEventplayerReputationStars($playerReputationStars);
            }
        }
        else
        {
            $playerId = $eventPlayersObject->getEventPlayerFk();
            $playerReputation = $this->UserDao->getReputation($playerId);

            if ($playerReputation > 4)
            {
                $playerReputationStars = '<img src="'.WEBROOT.'public/images/reputation_5.png" alt="Réputation 5 étoiles" style="height: 10px">';
            }
            elseif ($playerReputation > 3)
            {
                $playerReputationStars = '<img src="'.WEBROOT.'public/images/reputation_4.png" alt="Réputation 4 étoiles" style="height: 10px">';
            }
            elseif ($playerReputation > 2)
            {
                $playerReputationStars = '<img src="'.WEBROOT.'public/images/reputation_3.png" alt="Réputation 3 étoiles" style="height: 10px">';
            }
            elseif ($playerReputation > 1)
            {
                $playerReputationStars = '<img src="'.WEBROOT.'public/images/reputation_2.png" alt="Réputation 2 étoiles" style="height: 10px">';
            }
            elseif ($playerReputation > 0)
            {
                $playerReputationStars = '<img src="'.WEBROOT.'public/images/reputation_1.png" alt="Réputation 1 étoiles" style="height: 10px">';
            }
            $eventPlayersObject->setEventPlayerReputationStars($playerReputationStars);
        }
        return $eventPlayersObject;
    }

    public function setEventWaiterReputationStars($eventWaitersObject)
    {
        $this->loadDao("UserDao");

        if (is_array($eventWaitersObject))
        {
            foreach ($eventWaitersObject as $key => $waiter)
            {
                $waiterId = $waiter["event_waiter_fk"];
                $waiterReputation = $this->UserDao->getReputation($waiterId);
                if ($waiterReputation > 4)
                {
                    $waiterReputationStars = '<img src="'.WEBROOT.'public/images/reputation_5.png" alt="Réputation 5 étoiles" style="height: 10px">';
                }
                elseif ($waiterReputation > 3)
                {
                    $waiterReputationStars = '<img src="'.WEBROOT.'public/images/reputation_4.png" alt="Réputation 4 étoiles" style="height: 10px">';
                }
                elseif ($waiterReputation > 2)
                {
                    $waiterReputationStars = '<img src="'.WEBROOT.'public/images/reputation_3.png" alt="Réputation 3 étoiles" style="height: 10px">';
                }
                elseif ($waiterReputation > 1)
                {
                    $waiterReputationStars = '<img src="'.WEBROOT.'public/images/reputation_2.png" alt="Réputation 2 étoiles" style="height: 10px">';
                }
                elseif ($waiterReputation > 0)
                {
                    $waiterReputationStars = '<img src="'.WEBROOT.'public/images/reputation_1.png" alt="Réputation 1 étoiles" style="height: 10px">';
                }
                $waiter->setEventWaiterReputationStars($waiterReputationStars);
            }
        }
        else
        {
            $waiterId = $eventWaitersObject->getEventWaiterFk();
            $waiterReputation = $this->UserDao->getReputation($waiterId);
            if ($waiterReputation > 4)
            {
                $waiterReputationStars = '<img src="'.WEBROOT.'public/images/reputation_5.png" alt="Réputation 5 étoiles" style="height: 10px">';
            }
            elseif ($waiterReputation > 3)
            {
                $waiterReputationStars = '<img src="'.WEBROOT.'public/images/reputation_4.png" alt="Réputation 4 étoiles" style="height: 10px">';
            }
            elseif ($waiterReputation > 2)
            {
                $waiterReputationStars = '<img src="'.WEBROOT.'public/images/reputation_3.png" alt="Réputation 3 étoiles" style="height: 10px">';
            }
            elseif ($waiterReputation > 1)
            {
                $waiterReputationStars = '<img src="'.WEBROOT.'public/images/reputation_2.png" alt="Réputation 2 étoiles" style="height: 10px">';
            }
            elseif ($waiterReputation > 0)
            {
                $waiterReputationStars = '<img src="'.WEBROOT.'public/images/reputation_1.png" alt="Réputation 1 étoiles" style="height: 10px">';
            }
            $eventWaitersObject->setEventWaiterReputationStars($waiterReputationStars);
        }
        return $eventWaitersObject;
    }

    public function setEventPlayersNumber($eventObject)
    {
        if (is_array($eventObject))
        {
            foreach ($eventObject as $key => $event)
            {
                $this->loadDao("EventDao");
                $numberOfPlayers = $this->EventDao->getAllPlayersOfEvent($event->getId());
                if (array_key_exists("0", $numberOfPlayers))
                {
                    $event->setEventPlayersNumber(count($numberOfPlayers));
                }
                else
                {
                    $event->setEventPlayersNumber(1);
                }
            }
        }
        else
        {
            $this->loadDao("EventDao");
            $numberOfPlayers = $this->EventDao->getAllPlayersOfEvent($eventObject->getId());
            if (array_key_exists("0", $numberOfPlayers))
            {
                $eventObject->setEventPlayersNumber(count($numberOfPlayers));
            }
            else
            {
                $eventObject->setEventPlayersNumber(1);
            }
        }
        return $eventObject;
    }

    public function setEventWaitersNumber($eventObject)
    {
        if (is_array($eventObject))
        {
            foreach ($eventObject as $key => $event)
            {
                $this->loadDao("EventWaitersDao");

                $numberOfWaiters = $this->EventWaitersDao->getEventWaiters($event->getId());
                if (array_key_exists("0", $numberOfWaiters))
                {
                    $event->setEventWaitersNumber(count($numberOfWaiters));
                }
                else
                {
                    $event->setEventWaitersNumber(0);
                }
            }
        }
        else
        {
            $this->loadDao("EventWaitersDao");
            $numberOfWaiters = $this->EventWaitersDao->getEventWaiters($eventObject->getId());
            if (array_key_exists("0", $numberOfWaiters))
            {
                $eventObject->setEventWaitersNumber(count($numberOfWaiters));
            }
            else
            {
                $eventObject->setEventWaitersNumber(0);
            }
        }
        return $eventObject;
    }

    public function setEventTimestamp($eventObject)
    {
        if ($eventObject != null)
        {
            if (is_array($eventObject))
            {
                foreach ($eventObject as $key => $event)
                {
                    $datetime = $event->getEventDate() . " " . $event->getEventTime();
                    $timestamp = date_format(new DateTime($datetime), "U");
                    $event->setEventTimestamp($timestamp);
                }
            }
            else
            {
                $datetime = $eventObject->getEventDate() . " " . $eventObject->getEventTime();
                $timestamp = date_format(new DateTime($datetime), "U");
                $eventObject->setEventTimestamp($timestamp);
            }
            return $eventObject;
        }
    }

    public function setUserIncomingEventsNumber($userObject)
    {
        $this->loadDao("EventPlayersDao");
        $playerEventsArray = $this->EventPlayersDao->getPlayerEvents($userObject->getId());

        if (isset($playerEventsArray))
        {
            $this->loadDao("EventDao");
            foreach ($playerEventsArray as $key => $playerEvent)
            {
                $playerEventOnlineObject = $this->EventDao->readOnlineEventById($playerEvent["event_fk"]);
                if (!empty($playerEventOnlineObject))
                {
                    $this->setEventTimestamp($playerEventOnlineObject);
                    $dayTimestamp = date_format(new DateTime(), "U");

                    if ($dayTimestamp < $playerEventOnlineObject->getEventTimestamp())
                    {
                        $playerEventsOnlineArray[] = $playerEventOnlineObject;
                    }
                }
            }
        }

        if (isset($playerEventsOnlineArray))
        {
            $userEventsNumber = count($playerEventsOnlineArray);
        }
        else
        {
            $userEventsNumber = 0;
        }

        $userObject->setUserEventsNumber($userEventsNumber);
        return $userObject;
    }

    public function setStatusName($userObject)
    {
        if ($userObject->getUserStatus() === 0)
        {
            $userObject->setUserStatusName("Utilisateur");
        }
        elseif ($userObject->getUserStatus() === 1)
        {
            $userObject->setUserStatusName("Modérateur");
        }
        elseif ($userObject->getUserStatus() === 99)
        {
            $userObject->setUserStatusName("Administrateur");
        }

        return $userObject;
    }

}
