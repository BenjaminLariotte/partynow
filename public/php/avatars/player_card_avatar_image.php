<?php

if ($player->getUserAvatar() != null && $player->getId() != 0)
{
    echo '<a href="'.WEBROOT.'User/main/'.$player->getId().'"><img class="user_avatar_image" id="player_card_avatar_image" src="'.WEBROOT.'public/images/users_avatars/'.$player->getUserAvatar().'" alt="Avatar utilisateur"></a>';
}
else
{
    echo '<a href="'.WEBROOT.'User/main/'.$player->getId().'"><img class="user_avatar_image" id="player_card_avatar_image" src="'.WEBROOT.'public/images/users_avatars/base.png" alt="Avatar utilisateur"></a>';
}
