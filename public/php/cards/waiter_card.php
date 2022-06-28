<div class="waiter_card_grid" style="display: none" id="waiter_<?= $waiterTempId ?>_card">
    <div class="waiter_card_grid_intro">
        <div class="waiter_card_intro_div">
            <a href="<?= WEBROOT ?>User/player/<?= $waiter->getId() ?>"><span class="waiter_card_pseudo"><?= $waiter->getUserPseudo() ?></span></a>
            <span class="waiter_card_reputation_stars"><?= $waiter->getUserReputationStars() ?></span>
        </div>
    </div>
    <div class="waiter_card_grid_avatar">
        <?php require (ROOT."public/php/avatars/waiter_avatar_image.php"); ?>
    </div>
    <div class="waiter_card_grid_infos">
        <div class="waiter_card_infos_div">
            <span class="waiter_card_status"><?= $waiter->getUserStatusName() ?></span>
            <span class="waiter_card_events"><a href="<?= WEBROOT ?>Event/incomingEvents/<?= $waiter->getId() ?>">Évènements à venir : <?= $waiter->getUserEventsNumber() ?></a></span>
        </div>
    </div>
    <div class="waiter_card_grid_footer">
        <a href="<?= WEBROOT ?>User/messages" ><button class="waiter_card_buttons normal">Message</button ></a>
        <a href="<?= WEBROOT ?>User/social" ><button class="waiter_card_buttons normal">Social</button></a>
        <a href="<?= WEBROOT ?>User/playerZoom/<?= $waiter->getId() ?>"><button class="waiter_card_buttons normal">Zoom</button></a>
    </div>
</div>
