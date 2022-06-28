<?php

if ($player->getUserAvatar() != null)
{
    echo '<a href="'.WEBROOT.'User/player/'.$player->getId().'"><img class="user_avatar_image" src="'.WEBROOT.'public/images/users_avatars/'.$player->getUserAvatar().'" alt="Avatar utilisateur"></a>';
}
else
{
    echo '<a href="'.WEBROOT.'User/player/'.$player->getId().'"><img class="user_avatar_image" src="'.WEBROOT.'public/images/users_avatars/base.png" alt="Avatar utilisateur"></a>';
}
