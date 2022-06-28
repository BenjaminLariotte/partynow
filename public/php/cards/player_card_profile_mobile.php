<div id="player_card_profile_mobile" class="player_card_grid">
    <div class="player_card_grid_intro">
        <div class="player_card_intro_div"><a href="<?= WEBROOT ?>User/main/<?= $player->getId() ?>"><span class="player_card_pseudo"><?= $player->getUserPseudo() ?></span></a>
            <span class="player_card_reputation_stars"><?= $player->getUserReputationStars() ?></span>
        </div>
    </div>
    <div class="player_card_grid_avatar">
        <?php require (ROOT."public/php/avatars/player_card_avatar_image.php")?>
    </div>
    <div class="player_card_grid_infos">
        <div class="player_card_infos_div">
            <span class="player_card_status"><?= $player->getUserStatusName() ?></span>
            <span class="player_card_events"><a href="<?= WEBROOT ?>Event/incomingEvents/<?= $player->getId() ?>">Évènements à venir : <?= $player->getUserEventsNumber() ?></a></span>
        </div>
    </div>
    <div class="player_card_grid_footer">
        <a href="<?= WEBROOT ?>User/messages" ><button class="player_card_buttons normal">Messages</button ></a >
        <a href="<?= WEBROOT ?>User/social" ><button class="player_card_buttons normal">Social</button ></a >
        <a href="<?= WEBROOT ?>User/playerZoom/<?= $player->getId() ?>"><button class="player_card_buttons normal">Zoom</button></a>
    </div>
</div>
