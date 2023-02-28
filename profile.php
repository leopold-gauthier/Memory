<?php session_start() ?>

<head>
    <?php require_once 'includes/head.php' ?>
</head>

<body id="profile">
    <?php require_once 'includes/header.php'; ?>

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

    // Vérifier si le joueur est connecté
    if ($player->isConnected()) { ?>

        <h1>Vos infos personnelles</h1>
        <div>

            <div>
                <?php $perso = $player->getAllInfos(); ?>
            </div> <!-- /col -->

            <?php
            if (isset($_POST['delete'])) {
                $player->delete();
            }
            ?>
            <div>
                <form method="post">
                    <h5><span>Attention !</span>ceci supprimera définitivement votre compte</h5>
                    <input type="submit" name="delete" value="Supprimer mon compte">
                </form>
            </div>

        </div>
    <?php
    }
    // Récupérer les données du joueur
    ?>

    <main>
        <div>
            <h1>Vos scores</h1>
            <div>
                <form method="get">
                    <select name="level">
                        <option value="3">3 paires</option>
                        <option value="4">4 paires</option>
                        <option value="5">5 paires</option>
                        <option value="6">6 paires</option>
                        <option value="7">7 paires</option>
                        <option value="8">8 paires</option>
                        <option value="9">9 paires</option>
                        <option value="10">10 paires</option>
                        <option value="11">11 paires</option>
                        <option value="12">12 paires</option>
                    </select>
                    <input type="submit" value="Choisir le niveau des scores">
                </form>
            </div>

            <?php
            // Récupérer les données du joueur
            if (empty($_GET)) {
                $_GET['level'] = 3;
            }
            $player->getScore($_GET['level']);
            ?>
            <br>
            <br>

        </div>
    </main>
    <footer>
        <?php require_once 'includes/footer.php'; ?>
    </footer>
</body>