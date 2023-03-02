<?php session_start() ?>

<head>
    <?php require_once 'includes/head.php' ?>
</head>

<body>
    <header>
        <?php require_once 'includes/header.php'; ?>
    </header>
    <main>

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

            <h1>Your informations</h1>
            <div>

                <div>
                    <?php $perso = $player->getAllInfos(); ?>
                </div> <!-- /col -->

                <?php
                if (isset($_POST['delete'])) {
                    $player->delete();
                }
                ?>
            </div>
        <?php
        }
        // Récupérer les données du joueur
        ?>

        <div>
            <h1>Your scores</h1>
            <div>
                <form method="get">
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
                    <input class="button" type="submit" value="Choice level">
                </form>
            </div>
            <?php
            // Récupérer les données du joueur
            if (empty($_GET)) {
                $_GET['level'] = 3;
            }
            $player->getScore($_GET['level']);
            ?>
            <form class="align-center" method="post">
                <p>Warning ! this deleting your account</p>
                <input class="button_red" type="submit" name="delete" value="Delete account">
            </form>
        </div>
    </main>
    <footer>
        <?php require_once 'includes/footer.php'; ?>
    </footer>
</body>