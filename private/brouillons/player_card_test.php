<?php
/*foreach ($eventPlayersObject as $key => $eventPlayerObject)
{
    $playerObject = $this->UserDao->readUserInfos($eventPlayerObject->getEventPlayerFk());
    $playerObject = $this->setReputationStars($playerObject);
    $playerObject = $this->setUserIncomingEventsNumber($playerObject);
    $playersArray[] = $playerObject;
}
$d["players"] = $playersArray;*/

foreach ($players as $player)
{
    require(ROOT . "public/php/player_card.php");
}

if (isset($players))
{
    foreach ($players as $player)
    {
        require(ROOT . "public/php/player_card.php");
    }
}
