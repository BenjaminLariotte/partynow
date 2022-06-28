<?php
class EventWaiters
{
    private $event_fk;
    private $event_waiter_fk;
    private $event_waiter_pseudo;
    private $event_waiter_timestamp;
    private $event_waiter_reputation_stars;

    public function __construct($event_fk, $event_waiter_fk)
    {
        $this->event_fk = $event_fk;
        $this->event_waiter_fk = $event_waiter_fk;
    }

    /**
     * @param mixed $event_fk
     */
    public function setEventFk($event_fk)
    {
        $this->event_fk = $event_fk;
    }
    /**
     * @return mixed
     */
    public function getEventFk()
    {
        return $this->event_fk;
    }

    /**
     * @param mixed $event_waiter_fk
     */
    public function setEventWaiterFk($event_waiter_fk)
    {
        $this->event_waiter_fk = $event_waiter_fk;
    }
    /**
     * @return mixed
     */
    public function getEventWaiterFk()
    {
        return $this->event_waiter_fk;
    }

    /**
     * @param mixed $event_waiter_pseudo
     */
    public function setEventWaiterPseudo($event_waiter_pseudo)
    {
        $this->event_waiter_pseudo = $event_waiter_pseudo;
    }
    /**
     * @return mixed
     */
    public function getEventWaiterPseudo()
    {
        return $this->event_waiter_pseudo;
    }

    /**
     * @param mixed $event_waiter_datetime
     */
    public function setEventWaiterTimestamp($event_waiter_timestamp)
    {
        $this->event_waiter_timestamp = $event_waiter_timestamp;
    }
    /**
     * @return mixed
     */
    public function getEventWaiterTimestamp()
    {
        return $this->event_waiter_timestamp;
    }

    /**
     * @param mixed $event_waiter_reputation_stars
     */
    public function setEventWaiterReputationStars($event_waiter_reputation_stars)
    {
        $this->event_waiter_reputation_stars = $event_waiter_reputation_stars;
    }

    /**
     * @return mixed
     */
    public function getEventWaiterReputationStars()
    {
        return $this->event_waiter_reputation_stars;
    }
}