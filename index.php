<?php session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <?php include_once("./includes/head.php") ?>
</head>

<?php require_once 'includes/header.php'; ?>

<?php
// Créer une instance de la classe DbConnect
$db = new DbConnect();
// Créer une instance de la classe Player
$player = new Player($db);

// Vérifier si le joueur est connecté
if ($player->isConnected()) {
    $login = $player->getLogin();

?>


    <body>
        <header>
            <?php require_once 'includes/header.php'; ?>
        </header>
        <main>

            <?php
            // Le jour est connecté, afficher le menu de niveau
            if (isset($_POST['level'])) {
                $level = $_POST['level'];
                header("Location: game.php?level=$level");
                exit;
            }
            ?>
        <?php } else {
    }
        ?>
        </main>
        <footer>
            <?php require_once 'includes/footer.php' ?>
        </footer>
    </body>