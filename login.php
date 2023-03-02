<?php session_start() ?>

<head>
    <?php require_once 'includes/head.php' ?>
</head>

<body>

    <?php require_once 'includes/header.php'; ?>

    <?php
    if ($player->isConnected()) {
        // Le joueur n'est pas connecté, rediriger vers la page de connexion
        header('Location: index.php');
        exit();
    }
    /* $db = new DbConnect();

// Créer une instance de la classe Player
$player = new Player($db); */


    ?>

    <main class="align-center">
        <h1>Connexion</h1>
        <!-- Login form -->
        <form class="align-center" method="post" action="login.php">
            <div>
                <div>
                    <label for="login">Login :</label>
                </div>
                <div>
                    <input type="text" id="login" name="login">
                </div>
            </div>

            <div>
                <div>
                    <label for="password">Mot de passe :</label>
                </div>
                <div>
                    <input type="password" id="password" name="password">
                </div>
            </div>
            <div>
                <input class="button" type="submit" value="Connexion">
            </div>
            <?php
            // Vérifier si le formulaire a été soumis
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer les données du formulaire
                $login = trim(htmlspecialchars($_POST['login']));
                $password = trim(htmlspecialchars($_POST['password']));

                // Faire appel à la méthode connect()
                $player->connect($login, $password);
            }
            ?>
            <div>
                <p>Vous etes nouveau ici ?&nbsp;<a href="login.php">Inscription</a></p>
            </div>
        </form>
    </main>
    <footer>

    </footer>
</body>