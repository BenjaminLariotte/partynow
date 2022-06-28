<div class="player_card_big_grid web">
    <div class="player_card_big_grid_intro">
        <div class="player_card_big_intro_div"><span class="player_card_big_pseudo"><?= $player->getUserPseudo() ?></span>
            <span class="player_card_big_reputation_stars"><?= $player->getUserReputationStars() ?></span>
        </div>
        <script>
            let reputationStars = document.querySelector('.player_card_big_reputation_stars').firstChild;
            reputationStars.style.height = "20px";
        </script>
    </div>
    <div class="player_card_big_grid_avatar">
        <?php require_once(ROOT . "public/php/avatars/player_profile_avatar_image.php") ?>
    </div>
    <div class="player_card_big_grid_infos">
        <div class="player_card_big_infos_div">
            <span class="player_card_big_status">Statut : <?= $player->getUserStatusName() ?></span>
            <span class="player_card_big_events"><a href="<?= WEBROOT ?>Event/incomingEvents/<?= $player->getId() ?>">Évènements à venir : <?= $player->getUserEventsNumber() ?></a></span>
        </div>
    </div>
    <div class="player_card_big_grid_footer">
        <a href="<?= WEBROOT ?>User/messages">
            <button class="player_card_big_buttons normal">Messages</button>
        </a>
        <a href="<?= WEBROOT ?>User/social">
            <button class="player_card_big_buttons normal">Social</button>
        </a>
        <a href="<?= WEBROOT ?>User/playerZoom/<?= $player->getId() ?>">
            <button class="player_card_big_buttons normal">Zoom</button>
        </a>
    </div>
</div>
