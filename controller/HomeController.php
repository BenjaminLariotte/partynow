<?php
class HomeController extends Controller
{
    public function main($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $this->loadDao("UserDao");

            $userObject = $this->readAndCard($_SESSION["user_id"]);

            $FreeNextEvents = $this->setFreeNextEvents();
            if (isset($FreeNextEvents) && $FreeNextEvents != null)
            {
                foreach ($FreeNextEvents as $key => $NextEvent)
                {
                    $Creators[] = $this->readAndCard($NextEvent->getEventCreatorId());
                }
                $d["freeNextEventsCreators"] = $Creators;
            }
            $d["freeNextEvents"] = $FreeNextEvents;
            $d["log"] = $log;
            $d["user"] = $userObject;

            $this->set($d);
            $this->render("Home", "main");
        }
        else
        {
            $d["log"] = $log;
            $this->render("Home", "main");
        }
    }

    public function contact($log = null)
    {
        $this->loadDao("UserDao");
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $userObject = $this->read($_SESSION["user_id"]);
            $userObject = $this->setReputationStars($userObject);
            $userObject = $this->setStatusName($userObject);
            $userObject = $this->setUserIncomingEventsNumber($userObject);

            $d["user"] = $userObject;
        }
        $d["log"] = $log;
        $this->set($d);
        $this->render("Home", "contact");
    }

    // Affichage d'élément


    // Actions
    public function contactEmail()
    {
        $contactEmail = htmlspecialchars($this->input["contact_email"]);
        $contactObject = htmlspecialchars($this->input["contact_object"]);
        $contactMessage = htmlspecialchars($this->input["contact_message"]);

        ini_set("SMTP", "smtp.free.fr");
        mail("contact@partynow.eu", $contactObject, $contactMessage, "From : ".$contactEmail);

        $log = 'Votre message a bien été envoyée, nous vous répondrons dans les meilleurs délais.';
        $this->main($log);
    }

    // Actions renvoyant un objet
    public function read($id)
    {

        $this->loadDao("UserDao");

        $userObject = $this->UserDao->readUserInfos($id);

        return $userObject;
    }

    public function readAndCard($id)
    {
        $userObject = $this->read($id);

        $userObject = $this->setReputationStars($userObject);
        $userObject = $this->setStatusName($userObject);
        $userObject = $this->setUserIncomingEventsNumber($userObject);

        return $userObject;
    }

    public function setFreeNextEvents()
    {
        $FreeNextEvents = null;

        $this->loadDao("EventDao");

        $date = new DateTime();

        $month = date_format($date, "m");
        $timestamp = date_format($date, "U");

        $MonthEvents = $this->EventDao->readAllEventsOfMonth($month);
        $MonthEvents = $this->setEventTimestamp($MonthEvents);
        $MonthEvents = $this->setEventPlayersNumber($MonthEvents);

        foreach ($MonthEvents as $key => $MonthEvent)
        {
            if ($MonthEvent->getEventTimestamp() >= $timestamp && $MonthEvent->getEventPlayersNumber() < $MonthEvent->getEventMaxPlayers())
            {
                $FreeNextEvents[] = $MonthEvent;
            }
        }

        if ($FreeNextEvents != null)
        {
            $FreeNextEvents = $this->setEventWaitersNumber($FreeNextEvents);
            $FreeNextEvents = $this->setEventCreatorPseudo($FreeNextEvents);
        }
        return $FreeNextEvents;
    }


    //Ajoutent des valeurs aux objets
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

    public function setGenderName($userObject)
    {
        if ($userObject->getUserDataGender() === 4)
        {
            $userObject->setUserDataGenderName("Non spécifié");
        }
        elseif ($userObject->getUserDataGender() === 1)
        {
            $userObject->setUserDataGenderName("Homme");
        }
        elseif ($userObject->getUserDataGender() === 2)
        {
            $userObject->setUserDataGenderName("Femme");
        }
        elseif ($userObject->getUserDataGender() === 3)
        {
            $userObject->setUserDataGenderName("Autre");
        }

        return $userObject;
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

    public function setEventTimestamp($eventObject)
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

    public function getPseudoById($id)
    {
        $this->loadDao("UserDao");
        $pseudo = $this->UserDao->getPseudo($id);
        return $pseudo;
    }
}
