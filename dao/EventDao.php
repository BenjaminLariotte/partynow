<?php

require_once ("model/EventClass.php");

class EventDao
{
    public function createNewEvent($event)
    {
        DataBase::databaseRequest("INSERT INTO events (event_creator_id, event_game_id, event_name, event_date, event_time, event_description, event_max_players) VALUES (?, ?, ?, ?, ?, ?, ?)", array($event->getEventCreatorId(), $event->getEventGameId(), $event->getEventName(), $event->getEventDate(), $event->getEventTime(), $event->getEventDescription(), $event->getEventMaxPlayers()));
    }

    public function readEventById($eventId)
    {
        $event = DataBase::databaseRequest("SELECT * FROM events WHERE event_id = ?", array($eventId));

        $eventObject = new Event($event[0]["event_creator_id"], $event[0]["event_game_id"], $event[0]["event_name"], $event[0]["event_date"], $event[0]["event_time"], $event[0]["event_description"], $event[0]["event_max_players"]);
        $eventObject->setId($event[0]["event_id"]);
        $eventObject->setEventArchived($event[0]["event_archived"]);

        return $eventObject;
    }

    public function readOnlineEventById($eventId)
    {
        $event = DataBase::databaseRequest("SELECT * FROM events WHERE event_id = ? AND event_archived = 0", array($eventId));

        if ($event!= null)
        {
            $eventObject = new Event($event[0]["event_creator_id"], $event[0]["event_game_id"], $event[0]["event_name"], $event[0]["event_date"], $event[0]["event_time"], $event[0]["event_description"], $event[0]["event_max_players"]);
            $eventObject->setId($event[0]["event_id"]);
            $eventObject->setEventArchived($event[0]["event_archived"]);

            return $eventObject;
        }
    }

    public function readAllEventsById($userId)
    {
        $userCreatedEvents = DataBase::databaseRequest("SELECT * FROM events WHERE event_creator_id = ? AND event_archived = 0", array($userId));

        return $userCreatedEvents;
    }

    public function readAllEventsArchivedById($userId)
    {
        $userEventsArchived = DataBase::databaseRequest("SELECT * FROM events WHERE event_creator_id = ? AND event_archived = 1", array($userId));

        return $userEventsArchived;
    }

    public function readAllEventsOfDay($date)
    {
        $dayEventsObject = null;

        $eventsArray = DataBase::databaseRequest("SELECT * FROM events WHERE event_date = ? AND event_archived = 0 ORDER BY event_time", array($date));

        foreach ($eventsArray as $key => $events)
        {
            $dayEventsObject[$key] = new Event($events["event_creator_id"], $events["event_game_id"], $events["event_name"], $events["event_date"], $events["event_time"], $events["event_description"], $events["event_max_players"]);
            $dayEventsObject[$key]->setId($events["event_id"]);
        }
        return $dayEventsObject;
    }

    public function readAllEventsOfMonth($month)
    {
        $monthEventsObject = null;

        $eventsArray = DataBase::databaseRequest("SELECT * FROM events WHERE MONTH (event_date) = ? AND event_archived = '0'", array($month));

        foreach ($eventsArray as $key => $event)
        {
            $monthEventsObject[$key] = new Event($event["event_creator_id"], $event["event_game_id"], $event["event_name"], $event["event_date"], $event["event_time"], $event["event_description"], $event["event_max_players"]);
            $monthEventsObject[$key]->setEventArchived($event["event_archived"]);
            $monthEventsObject[$key]->setId($event["event_id"]);
        }
        return $monthEventsObject;
    }

    public function readAllEventsOfYear($year)
    {
        $yearEventsObject = null;

        $eventsArray = DataBase::databaseRequest("SELECT * FROM events WHERE YEAR (event_date) = ? AND event_archived = '0'", array($year));

        foreach ($eventsArray as $key => $events)
        {
            $yearEventsObject[$key] = new Event($events["event_creator_id"], $events["event_game_id"], $events["event_name"], $events["event_date"], $events["event_time"], $events["event_description"], $events["event_max_players"]);
            $yearEventsObject[$key]->setEventArchived($events["event_archived"]);
            $yearEventsObject[$key]->setId($events["event_id"]);
        }
        return $yearEventsObject;
    }

    public function getAllPlayersOfEvent($eventId)
    {
        $eventPlayersList = DataBase::databaseRequest("SELECT * FROM events_players WHERE event_fk = ?", array($eventId));

        return $eventPlayersList;
    }

    public function getAllEventsOfPlayer($playerId)
    {
        $eventsFk = DataBase::databaseRequest("Select event_fk FROM events_players WHERE event_player_fk = ?", array($playerId));

        $playerEvents = null;
        foreach ($eventsFk as $key => $eventsId)
        {
            $playerEvents[$key] = DataBase::databaseRequest("Select * FROM events WHERE event_id = ?", array($eventsId["event_fk"]));
        }
        return $playerEvents;
    }

    public function updateEvent($eventId, $eventObject)
    {
        DataBase::databaseRequest("UPDATE events SET event_game_id = ?, event_name = ?, event_date = ?, event_time = ?, event_description = ?, event_max_players = ?, event_archived = ? WHERE event_id = ?", array($eventObject->getEventGameId(), $eventObject->getEventName(), $eventObject->getEventDate(), $eventObject->getEventTime(), $eventObject->getEventDescription(), $eventObject->getEventMaxPlayers(), $eventObject->getEventArchived(), $eventId));
    }

    public function deleteUserFromPlayersList($eventId, $userId)
    {
        DataBase::databaseRequest("DELETE FROM events_players WHERE event_fk = ? AND event_player_fk = ?", array($eventId, $userId));
    }
}