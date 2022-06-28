<a href="<?= WEBROOT ?>Event/calendar/<?= date("Y-m") ?>">
    <button class="show_calendar_button normal">Calendrier</button>
</a>

<a class="event_creation_link" href="<?= WEBROOT ?>Event/creation/<?= $_SESSION["user_id"] ?>">
    <button class="event_creation_button good">Créer un évènement</button>
</a>
