<?php session_start() ?>

<head>
    <?php include_once('includes/head.php') ?>
</head>

<body>
    <?php include_once 'includes/header.php'; ?>

    <?php
    /* $_SESSION['login'] = $login; // Set la session login */
    // vérifier l'état du joueur, pour la protection des pages privées
    if (!$player->isConnected()) {
        // Le joueur n'est pas connecté, rediriger vers la page de connexion
        header('Location: login.php');
        exit();
    }

    // Créer une instance de la classe DbConnect
    $db = new DbConnect();
    // Créer une instance de la classe Player
    $player = new Player($db);

    // Récupérer les données des joueurs
    ?>

    <main>
        <h1>Classement</h1>
        <div>
            <form method="get" class="select">
                <select name="level">
                    <option value="3">3 pairs</option>
                    <option value="4">4 pairs</option>
                    <option value="5">5 pairs</option>
                    <option value="6">6 pairs</option>
                    <option value="7">7 pairs</option>
                    <option value="8">8 pairs</option>
                    <option value="9">9 pairs</option>
                    <option value="10">10 pairs</option>
                    <option value="11">11 pairs</option>
                    <option value="12">12 pairs</option>
                </select>
                <input type="submit" value="Choice your level" class="button success">
            </form>
        </div>

        <?php
        // Récupérer les données du joueur
        if (empty($_GET)) {
            $_GET['level'] = 3;
        } // Afficher le classement
        $player->getGlobalScore($_GET['level']);
        ?>
        <br>
    </main>
    <footer>
        <?php require_once 'includes/footer.php'; ?>
    </footer>