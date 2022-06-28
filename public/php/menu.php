<div class="web">
    <img id="header_menu_image" src="<?= WEBROOT ?>public/images/menu.png" alt="menu" onmouseover="showHeaderMenuParents()"
         onmouseout="hideHeaderMenuParents()">
    <div>
        <ul id="header_menu_parents" style="display: none">
            <li id="header_menu_parent_home" onmouseover="showHeaderMenuParents()" onmouseout="hideHeaderMenuParents()">
                <a class="header_menu_parents" href="<?= WEBROOT ?>Home/main">Accueil</a>
            </li>

            <div id="header_menu_parent_events_div">
                <a class="header_menu_parents" href="<?= WEBROOT ?>Event/main/<?= date("Y-m-d") ?>"
                   onmouseover="showHeaderMenuParents(); showHeaderMenuChildrenEvents();"
                   onmouseout="hideHeaderMenuParents(); hideHeaderMenuChildrenEvents();">Évènements</a>
                <li id="header_menu_parent_events">
                    <ul id="header_menu_children_events" style="display: none" onmouseover="showHeaderMenuParents(); showHeaderMenuChildrenEvents();"
                        onmouseout="hideHeaderMenuParents(); hideHeaderMenuChildrenEvents();">
                        <li><a class="header_menu_children_events"
                               href="<?= WEBROOT ?>Event/calendar/<?= date("Y-m") ?>">Calendrier</a></li>
                        <li><a class="header_menu_children_events"
                               href="<?= WEBROOT ?>Event/userEvents/<?= isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "0" ?>">Mes
                                Évènements</a></li>
                    </ul>
                </li>
            </div>

            <div id="header_menu_parent_profile_div">
                <a class="header_menu_parents" href="<?= WEBROOT ?>User/main/<?= isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "0" ?>"
                   onmouseover="showHeaderMenuParents(); showHeaderMenuChildrenProfile();"
                   onmouseout="hideHeaderMenuParents(); hideHeaderMenuChildrenProfile();">Profil</a>
                <li id="header_menu_parent_profile">
                    <ul id="header_menu_children_profile" style="display: none"
                        onmouseover="showHeaderMenuParents(); showHeaderMenuChildrenProfile();"
                        onmouseout="hideHeaderMenuParents(); hideHeaderMenuChildrenProfile();">
                        <li><a class="header_menu_children_profile"
                               href="<?= WEBROOT ?>User/zoom/<?= isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "0" ?>">Zoom Profil</a></li>
                        <li><a class="header_menu_children_profile" href="<?= WEBROOT ?>User/messages">Messages</a></li>
                        <li><a class="header_menu_children_profile" href="<?= WEBROOT ?>User/social">Social</a></li>
                    </ul>
                </li>
            </div>

            <div id="header_menu_parent_more_div">
                <a class="header_menu_parents" onmouseover="showHeaderMenuParents(); showHeaderMenuChildrenMore();"
                   onmouseout="hideHeaderMenuParents(); hideHeaderMenuChildrenMore();">Plus</a>
                <li id="header_menu_parent_more">
                    <ul id="header_menu_children_more" style="display: none" onmouseover="showHeaderMenuParents(); showHeaderMenuChildrenMore();"
                        onmouseout="hideHeaderMenuParents(); hideHeaderMenuChildrenMore();">
                        <li><a class="header_menu_children_more" href="<?= WEBROOT ?>More/research">Recherche avancée</a></li>
                        <li><a class="header_menu_children_more" href="<?= WEBROOT ?>More/contests">Concours</a></li>
                        <li><a class="header_menu_children_more" href="<?= WEBROOT ?>More/contact">Contact</a></li>
                        <li><a class="header_menu_children_more" href="<?= WEBROOT ?>More/legalMentions">Mentions légales</a></li>
                        <li><a class="header_menu_children_more" href="<?= WEBROOT ?>More/termsOfService">CGU</a></li>
                    </ul>
                </li>
            </div>
        </ul>
    </div>
</div>


<div class="mobile">
    <img id="header_menu_image" onmouseup="toggleMenu()" src="<?= WEBROOT ?>public/images/menu.png" alt="menu">
    <div class="header_menu_parents_div">
        <ul id="header_menu_parents_mobile" style="display: none">
            <li id="header_menu_parent_home">
                <a class="header_menu_parents" href="<?= WEBROOT ?>Home/main">Accueil</a>
            </li>


            <li id="header_menu_parent_events">
                <div class="header_menu_parent_events_div">
                    <a class="header_menu_parents" href="<?= WEBROOT ?>Event/main/<?= date("Y-m-d") ?>">Évènements</a><img
                        class="header_menu_mobile_images" src="<?= WEBROOT ?>public/images/plus.png" alt="plus" onmouseup="toggleMenuEvents()">
                </div>
                <ul id="header_menu_children_events_mobile" style="display: none">
                    <li><a class="header_menu_children_events"
                           href="<?= WEBROOT ?>Event/calendar/<?= date("Y-m") ?>">Calendrier</a></li>
                    <li><a class="header_menu_children_events"
                           href="<?= WEBROOT ?>Event/userEvents/<?= isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "0" ?>">Mes
                            Évènements</a></li>
                </ul>
            </li>


            <li id="header_menu_parent_profile">
                <div class="header_menu_parent_profile_div">
                    <a class="header_menu_parents"
                       href="<?= WEBROOT ?>User/main/<?= isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "0" ?>">Profil</a><img
                        class="header_menu_mobile_images" src="<?= WEBROOT ?>public/images/plus.png" alt="plus" onmouseup="toggleMenuProfile()">
                </div>
                <ul id="header_menu_children_profile_mobile" style="display: none">
                    <li><a class="header_menu_children_profile"
                           href="<?= WEBROOT ?>User/zoom/<?= isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "0" ?>">Zoom
                            Profil</a></li>
                    <li><a class="header_menu_children_profile" href="<?= WEBROOT ?>User/messages">Messages</a></li>
                    <li><a class="header_menu_children_profile" href="<?= WEBROOT ?>User/social">Social</a></li>
                </ul>
            </li>


            <li id="header_menu_parent_more">
                <div class="header_menu_parent_more_div">
                    <a class="header_menu_parents">Plus</a><img class="header_menu_mobile_images" src="<?= WEBROOT ?>public/images/plus.png"
                                                                alt="plus" onmouseup="toggleMenuMore()">
                </div>
                <ul id="header_menu_children_more_mobile" style="display: none">
                    <li><a class="header_menu_children_more" href="<?= WEBROOT ?>More/research">Recherche avancée</a></li>
                    <li><a class="header_menu_children_more" href="<?= WEBROOT ?>More/contests">Concours</a></li>
                    <li><a class="header_menu_children_more" href="<?= WEBROOT ?>More/contact">Contact</a></li>
                    <li><a class="header_menu_children_more" href="<?= WEBROOT ?>More/legalMentions">Mentions légales</a></li>
                    <li><a class="header_menu_children_more" href="<?= WEBROOT ?>More/termsOfService">CGU</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
