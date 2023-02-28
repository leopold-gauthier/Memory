<?php require_once 'autoloader.php'; ?>
<?php
$db = new DbConnect();
$player = new Player($db);
$game = new Game();

// si l'utilisateur click sur déconnexion
if (isset($_GET['logout'])) {
    if ($_GET['logout'] == true) {
        $player->disconnect();
        header('Location: index.php');
    }
}
if (isset($_GET['reset'])) {
    $game->reset();
    header('Location: game.php');
}
?>
<header>
    <?php
    // Si le joueur est connecté, afficher le menu
    if ($player->isConnected()) {
    ?>
        <nav>
            <button class="btn info"><a href="index.php">Accueil</a></button>
            <button class="btn info"><a href="profile.php">Profil</a></button>
            <button class="btn info"><a href="game.php">Jouer</a></button>
            <button class="btn info"><a href="scores.php">Classement</a></button>
            <button class="btn info"><a href="index.php?logout=true">Deconnexion</a></button>
        </nav>
    <?php
    } else {
        // Sinon afficher le menu de connexion
    ?>
        <nav>
            <button class="btn info"><a href="index.php">Accueil</a></button>
            <button class="btn info"><a href="login.php">Connexion</a></button>
            <button class="btn info"><a href="register.php">Inscription</a></button>
        </nav>

    <?php
    }
    ?>
</header>