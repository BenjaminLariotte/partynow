<?php
if (isset($user) && $user->getUserAvatar() != null && $_SESSION["user_id"] != 0)
{
    echo '<img class="user_avatar_image" id="header_avatar_image" onmouseup="toggleHeaderButtonsDiv()" src="'.WEBROOT.'public/images/users_avatars/'.$user->getUserAvatar().'" alt="Avatar utilisateur">';
}
else
{
    echo '<img class="user_avatar_image" id="header_avatar_image" onmouseup="toggleHeaderButtonsDiv()" src="'.WEBROOT.'public/images/users_avatars/base.png" alt="Avatar utilisateur">';
}