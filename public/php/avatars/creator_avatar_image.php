<?php

if ($creator->getUserAvatar() != null)
{
    echo '<a href="'.WEBROOT.'User/player/'.$creator->getId().'"><img class="user_avatar_image" src="'.WEBROOT.'public/images/users_avatars/'.$creator->getUserAvatar().'" alt="Avatar utilisateur"></a>';
}
else
{
    echo '<a href="'.WEBROOT.'User/player/'.$creator->getId().'"><img class="user_avatar_image" src="'.WEBROOT.'public/images/users_avatars/base.png" alt="Avatar utilisateur"></a>';
}
