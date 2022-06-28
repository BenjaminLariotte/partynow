<?php

if ($player->getUserAvatar() != null && $_SESSION["user_id"] != 0)
{
    echo '<img class="profile_avatar_image" id="player_profile_avatar_image" src="'.WEBROOT.'public/images/users_avatars/'.$player->getUserAvatar().'" alt="Avatar utilisateur">';
}
else
{
    echo '<img class="profile_avatar_image" id="player_profile_avatar_image" src="'.WEBROOT.'public/images/users_avatars/base.png" alt="Avatar utilisateur">';
}
