<?php

if ($user->getUserAvatar() != null && $_SESSION["user_id"] != 0)
{
    echo '<a href="'.WEBROOT.'User/avatarChange/'.$_SESSION["user_id"].'"><img class="profile_avatar_image" id="user_profile_avatar_image" src="'.WEBROOT.'public/images/users_avatars/'.$user->getUserAvatar().'" alt="Avatar utilisateur"></a>';
}
else
{
    echo '<a href="'.WEBROOT.'User/avatarChange/'.$_SESSION["user_id"].'"><img class="profile_avatar_image" id="user_profile_avatar_image" src="'.WEBROOT.'public/images/users_avatars/base.png" alt="Avatar utilisateur"></a>';
}
