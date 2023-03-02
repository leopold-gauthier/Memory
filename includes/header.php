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
            <a href="index.php">HOME</a>
            <a href="profile.php">PROFIL</a>
            <a href="game.php">PLAY</a>
            <a href="scores.php">CLASSEMENT</a>
            <a href="index.php?logout=true"><i class="fa-sharp fa-solid fa-right-from-bracket"></i></a>
        </nav>
    <?php
    } else {
        // Sinon afficher le menu de connexion
    ?>
        <nav>
            <a href="index.php">HOME</a>
            <a href="login.php">LOGIN</a>
            <a href="register.php">JOIN US</a>
        </nav>

    <?php
    }
    ?>
</header>