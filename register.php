<?php session_start() ?>

<head>
    <?php require_once 'includes/head.php'; ?>
</head>

<body>
    <header>
        <?php require_once 'includes/header.php'; ?>
    </header>
    <?php
    // Créer une instance de la classe DbConnect
    $db = new DbConnect();
    // Créer une instance de la classe Player
    $player = new Player($db);

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the form data
        $login = trim(htmlspecialchars($_POST['login']));
        $password = trim(htmlspecialchars($_POST['password']));
        $password2 = trim(htmlspecialchars($_POST['password2']));

        // Validate the form data
        if (empty($login)) {
            $error = "Veuillez saisir un login.";
        } elseif (empty($password)) {
            $error = "Veuillez saisir un mot de passe.";
        } elseif (empty($password2)) {
            $error = "Veuillez confirmer le mot de passe.";
        } elseif ($password !== $password2) {
            $error = "Les mots de passe ne correspondent pas.";
        } else {
            // Le formulaire est valide, enregistrer le joueur
            $error = $player->register($login, $password);
            header("Refresh:1; url=Location: login.php");
        }
    }
    ?>

    <main class="align-center">
        <h1>Inscription</h1>
        <!-- Register form -->
        <form class="align-center" method="post" action="register.php">
            <div>
                <div>
                    <label for="login">Login</label>
                </div>
                <div>
                    <input type="text" id="login" name="login">
                </div>
            </div>

            <div>
                <div>
                    <label for="password">Mot de passe</label>
                </div>
                <div>
                    <input type="password" id="password" name="password">
                </div>
            </div>

            <div>
                <div>
                    <label for="password2">Confirmez<br>le mot de passe:</label>
                </div>
                <div>
                    <input type="password" id="password2" name="password2">
                </div>
            </div>

            <div>
                <input class="button" type="submit" value="Inscription">
            </div>
            <div>
                <p>Deja inscrit ?&nbsp;<a href="login.php">Connexion</a></p>
            </div>

        </form>

    </main>
    <?php require_once 'includes/footer.php'; ?>
    <?php
    if (isset($error)) {
        echo $error;
    }
    ?>
    <footer>

    </footer>
</body>