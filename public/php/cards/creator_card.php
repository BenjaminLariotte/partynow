<div class="creator_card_grid" style="display: none" id="creator_<?= $creator->getId() ?>_card">
    <div class="creator_card_grid_intro">
        <div class="creator_card_intro_div">
            <a href="<?= WEBROOT ?>User/player/<?= $creator->getId() ?>"><span class="creator_card_pseudo"><?= $creator->getUserPseudo() ?></span></a>
            <span class="creator_card_reputation_stars"><?= $creator->getUserReputationStars() ?></span>
        </div>
    </div>
    <div class="creator_card_grid_avatar">
        <?php require (ROOT."public/php/avatars/creator_avatar_image.php"); ?>
    </div>
    <div class="creator_card_grid_infos">
        <div class="creator_card_infos_div">
            <span class="creator_card_status"><?= $creator->getUserStatusName() ?></span>
            <span class="creator_card_events"><a href="<?= WEBROOT ?>Event/incomingEvents/<?= $creator->getId() ?>">Évènements à venir : <?= $creator->getUserEventsNumber() ?></a></span>
        </div>
    </div>
    <div class="creator_card_grid_footer">
        <a href="<?= WEBROOT ?>User/messages" ><button class="creator_card_buttons normal">Message</button ></a>
        <a href="<?= WEBROOT ?>User/social" ><button class="creator_card_buttons normal">Social</button></a>
        <a href="<?= WEBROOT ?>User/playerZoom/<?= $creator->getId() ?>"><button class="creator_card_buttons normal">Zoom</button></a>
    </div>
</div>
