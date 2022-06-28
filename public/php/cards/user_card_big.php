<div class="user_card_big_grid web">
    <div class="user_card_big_grid_intro">
        <div class="user_card_big_intro_div"><span class="user_card_big_pseudo"><?= $user->getUserPseudo() ?></span>
            <span class="user_card_big_reputation_stars"><?= $user->getUserReputationStars() ?></span>
        </div>
        <script>
            let reputationStars = document.querySelector('.user_card_big_reputation_stars').firstChild;
            reputationStars.style.height = "20px";
        </script>
    </div>
    <div class="user_card_big_grid_avatar">
        <?php require_once(ROOT . "public/php/avatars/user_profile_avatar_image.php") ?>
    </div>
    <div class="user_card_big_grid_infos">
        <div class="user_card_big_infos_div">
            <span class="user_card_big_status">Statut : <?= $user->getUserStatusName() ?></span>
            <span class="user_card_big_events"><a href="<?= WEBROOT ?>Event/incomingEvents/<?= $user->getId() ?>">Évènements à venir : <?= $user->getUserEventsNumber() ?></a></span>
        </div>
    </div>
    <div class="user_card_big_grid_footer">
        <a href="<?= WEBROOT ?>User/messages">
            <button class="user_card_big_buttons normal">Messages</button>
        </a>
        <a href="<?= WEBROOT ?>User/social">
            <button class="user_card_big_buttons normal">Social</button>
        </a>
        <a href="<?= WEBROOT ?>User/zoom/<?= $user->getId() ?>">
            <button class="user_card_big_buttons normal">Zoom</button>
        </a>
    </div>

    <a style="margin-left: 15px" href="<?= WEBROOT ?>User/avatarChange/<?= $_SESSION['user_id'] ?>">
        <button class="avatar_change_button neutral">Changer d'avatar</button>
    </a>
</div>
