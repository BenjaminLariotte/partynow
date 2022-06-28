<div id="user_card_profile_mobile" class="user_card_grid">
    <div class="user_card_grid_intro">
        <div class="user_card_intro_div"><a href="<?= WEBROOT ?>User/main/<?= $user->getId() ?>"><span class="user_card_pseudo"><?= $user->getUserPseudo() ?></span></a>
            <span class="user_card_reputation_stars"><?= $user->getUserReputationStars() ?></span>
        </div>
    </div>
    <div class="user_card_grid_avatar">
        <?php require (ROOT."public/php/avatars/user_card_avatar_image.php")?>
    </div>
    <div class="user_card_grid_infos">
        <div class="user_card_infos_div">
            <span class="user_card_status"><?= $user->getUserStatusName() ?></span>
            <span class="user_card_events"><a href="<?= WEBROOT ?>Event/incomingEvents/<?= $user->getId() ?>">Évènements à venir : <?= $user->getUserEventsNumber() ?></a></span>
        </div>
    </div>
    <div class="user_card_grid_footer">
        <a href="<?= WEBROOT ?>User/messages" ><button class="user_card_buttons normal">Messages</button ></a >
        <a href="<?= WEBROOT ?>User/social" ><button class="user_card_buttons normal">Social</button ></a >
        <a href="<?= WEBROOT ?>User/zoom/<?= $user->getId() ?>"><button class="user_card_buttons normal">Zoom</button></a>
    </div>

    <a style="margin-left: 5px" href="<?= WEBROOT ?>User/avatarChange/<?= $_SESSION['user_id'] ?>">
        <button class="avatar_change_button neutral">Changer d'avatar</button>
    </a>
</div>
