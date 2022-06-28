<?php

require_once ("model/EventWaitersClass.php");

class EventWaitersDao
{
    public function insertWaiter($eventId, $userId)
    {
        DataBase::databaseRequest("INSERT INTO events_waiters (event_fk, event_waiter_fk) VALUES (?, ?)", array($eventId, $userId));
    }

    public function removeWaiter($eventId, $userId)
    {
        DataBase::databaseRequest("DELETE FROM events_waiters WHERE event_fk = ? AND event_waiter_fk = ?", array($eventId, $userId));
    }

    public function getEventWaiters($eventId)
    {
        $eventPlayers = DataBase::databaseRequest("SELECT * FROM events_waiters WHERE event_fk = ? ORDER BY event_waiter_timestamp", array($eventId));
        return $eventPlayers;
    }

    public function getWaiterEvents($userId)
    {
        $playerEvents = DataBase::databaseRequest("SELECT * FROM events_waiters WHERE event_waiter_fk = ?", array($userId));
        return $playerEvents;
    }

    public function checkIfIsOnWaitersList($eventId, $userId)
    {
        $checkList = DataBase::databaseRequest("SELECT * FROM events_waiters WHERE event_fk = ? AND event_waiter_fk = ?", array($eventId, $userId));

        $isOnList = false;

        if ($checkList != null)
        {
            $isOnList = true;
        }
        return $isOnList;
    }
}