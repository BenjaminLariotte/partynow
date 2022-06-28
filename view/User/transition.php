<main>
    <div>
        <?php
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            echo '<p>Vous êtes bien connecté à votre compte</p>';
            echo '<a href="'. WEBROOT .'Home/main">Aller à l\'accueil</a>';
        }
        elseif (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == 0)
        {
            echo '<p>Vous êtes bien déconnecté de votre compte</p>';
            echo '<a href="'. WEBROOT .'Home/main">Aller à l\'accueil</a>';
        }
        ?>
    </div>
</main>
