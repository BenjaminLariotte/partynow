<?php
/**
 * Created by PhpStorm.
 * User: LaryBenji
 * Date: 23/07/2019
 * Time: 10:10
 */

class Event extends IdClass

{
    private $event_creator_id;
    private $event_creator_pseudo;
    private $event_creator_reputation_stars;
    private $event_game_id;
    private $event_name;
    private $event_date;
    private $event_time;
    private $event_timestamp;
    private $event_description;
    private $event_players_number;
    private $event_waiters_number;
    private $event_max_players;
    private $event_archived;

    public function __construct($event_creator_id, $event_game_id, $event_name, $event_date, $event_time, $event_description, $event_max_players)
    {
        $this->event_creator_id = $event_creator_id;
        $this->event_game_id = $event_game_id;
        $this->event_name = $event_name;
        $this->event_date = $event_date;
        $this->event_time = $event_time;
        $this->event_description = $event_description;
        $this->event_max_players = $event_max_players;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $event_creator_id
     */
    public function setEventCreatorId($event_creator_id)
    {
        $this->event_creator_id = $event_creator_id;
    }

    /**
     * @return mixed
     */
    public function getEventCreatorId()
    {
        return $this->event_creator_id;
    }

    /**
     * @param mixed $event_creator_pseudo
     */
    public function setEventCreatorPseudo($event_creator_pseudo)
    {
        $this->event_creator_pseudo = $event_creator_pseudo;
    }

    /**
     * @return mixed
     */
    public function getEventCreatorPseudo()
    {
        return $this->event_creator_pseudo;
    }

    /**
     * @param mixed $event_creator_reputation_stars
     */
    public function setEventCreatorReputationStars($event_creator_reputation_stars)
    {
        $this->event_creator_reputation_stars = $event_creator_reputation_stars;
    }

    /**
     * @return mixed
     */
    public function getEventCreatorReputationStars()
    {
        return $this->event_creator_reputation_stars;
    }

    /**
     * @param mixed $event_game_id
     */
    public function setEventGameId($event_game_id)
    {
        $this->event_game_id = $event_game_id;
    }

    /**
     * @return mixed
     */
    public function getEventGameId()
    {
        return $this->event_game_id;
    }

    /**
     * @param mixed $event_name
     */
    public function setEventName($event_name)
    {
        $this->event_name = $event_name;
    }

    /**
     * @return mixed
     */
    public function getEventName()
    {
        return $this->event_name;
    }

    /**
     * @param mixed $event_date
     */
    public function setEventDate($event_date)
    {
        $this->event_date = $event_date;
    }

    /**
     * @return mixed
     */
    public function getEventDate()
    {
        return $this->event_date;
    }

    /**
     * @param mixed $event_time
     */
    public function setEventTime($event_time)
    {
        $this->event_time = $event_time;
    }

    /**
     * @return mixed
     */
    public function getEventTime()
    {
        return $this->event_time;
    }

    /**
     * @param mixed $event_timestamp
     */
    public function setEventTimestamp($event_timestamp)
    {
        $this->event_timestamp = $event_timestamp;
    }

    /**
     * @return mixed
     */
    public function getEventTimestamp()
    {
        return $this->event_timestamp;
    }

    /**
     * @param mixed $event_description
     */
    public function setEventDescription($event_description)
    {
        $this->event_description = $event_description;
    }

    /**
     * @return mixed
     */
    public function getEventDescription()
    {
        return $this->event_description;
    }

    /**
     * @param mixed $event_players_number
     */
    public function setEventPlayersNumber($event_players_number)
    {
        $this->event_players_number = $event_players_number;
    }

    /**
     * @return mixed
     */
    public function getEventPlayersNumber()
    {
        return $this->event_players_number;
    }

    /**
     * @param mixed $event_waiters_number
     */
    public function setEventWaitersNumber($event_waiters_number)
    {
        $this->event_waiters_number = $event_waiters_number;
    }

    /**
     * @return mixed
     */
    public function getEventWaitersNumber()
    {
        return $this->event_waiters_number;
    }

    /**
     * @param mixed $event_max_players
     */
    public function setEventMaxPlayers($event_max_players)
    {
        $this->event_max_players = $event_max_players;
    }

    /**
     * @return mixed
     */
    public function getEventMaxPlayers()
    {
        return $this->event_max_players;
    }

    /**
     * @param mixed $event_archived
     */
    public function setEventArchived($event_archived)
    {
        $this->event_archived = $event_archived;
    }

    /**
     * @return mixed
     */
    public function getEventArchived()
    {
        return $this->event_archived;
    }
}