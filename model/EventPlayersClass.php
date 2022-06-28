<?php
class EventPlayers
{
    private $event_fk;
    private $event_player_fk;
    private $event_player_pseudo;
    private $event_player_reputation_stars;

    public function __construct($event_fk, $event_player_fk)
    {
        $this->event_fk = $event_fk;
        $this->event_player_fk = $event_player_fk;
    }

    /**
     * @param mixed $event_fk
     */
    public function setEventFk($event_fk)
    {
        $this->event_fk = $event_fk;
    }

    /**
     * @param mixed $event_player_fk
     */
    public function setEventPlayerFk($event_player_fk)
    {
        $this->event_player_fk = $event_player_fk;
    }

    /**
     * @param mixed $event_player_pseudo
     */
    public function setEventPlayerPseudo($event_player_pseudo)
    {
        $this->event_player_pseudo = $event_player_pseudo;
    }

    /**
     * @param mixed $event_player_reputation_stars
     */
    public function setEventPlayerReputationStars($event_player_reputation_stars)
    {
        $this->event_player_reputation_stars = $event_player_reputation_stars;
    }

    /**
     * @return mixed
     */
    public function getEventFk()
    {
        return $this->event_fk;
    }

    /**
     * @return mixed
     */
    public function getEventPlayerFk()
    {
        return $this->event_player_fk;
    }

    /**
     * @return mixed
     */
    public function getEventPlayerPseudo()
    {
        return $this->event_player_pseudo;
    }

    /**
     * @return mixed
     */
    public function getEventPlayerReputationStars()
    {
        return $this->event_player_reputation_stars;
    }
}
