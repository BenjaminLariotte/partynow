<?php

require_once ("model/EventPlayersClass.php");

class EventPlayersDao
{
    public function insertPlayer($eventId, $userId)
    {
        DataBase::databaseRequest("INSERT INTO events_players (event_fk, event_player_fk) VALUES (?, ?)", array($eventId, $userId));
    }

    public function removePlayer($eventId, $userId)
    {
        DataBase::databaseRequest("DELETE FROM events_players WHERE event_fk = ? AND event_player_fk = ?", array($eventId, $userId));
    }

    public function getEventPlayers($eventId)
    {
        $eventPlayers = DataBase::databaseRequest("SELECT * FROM events_players WHERE event_fk = ?", array($eventId));
        return $eventPlayers;
    }

    public function getPlayerEvents($userId)
    {
        $playerEventsArray = DataBase::databaseRequest("SELECT * FROM events_players WHERE event_player_fk = ?", array($userId));
        return $playerEventsArray;
    }

    public function checkIfIsOnPlayersList($eventId, $userId)
    {
        $checkList = DataBase::databaseRequest("SELECT * FROM events_players WHERE event_fk = ? AND event_player_fk = ?", array($eventId, $userId));

        $isOnList = false;

        if ($checkList != null)
        {
            $isOnList = true;
        }

        return $isOnList;
    }
}