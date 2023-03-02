<?php session_start(); ?>

<head>
    <?php include_once("./includes/head.php") ?>
</head>

<body id="game">
    <?php
    require_once 'includes/header.php';
    // Open session
    if (!$player->isConnected()) {
        // Le joueur n'est pas connecté, rediriger vers la page de connexion
        header('Location: login.php');
        exit();
    } ?>

    <?php
    // Vérifier si le niveau a été sélectionné
    if (isset($_POST['level'])) {
        // Le niveau a été sélectionné, créer une session
        $game->reset();
        $_SESSION['level'] = $_POST['level'];
        $_SESSION['new'] = true;

        // Créer une instance de la classe Game
        $game->getCards();
        /* var_dump($_SESSION['board']); */

        // enlever variable post
        $_POST['level'] = null;
        unset($_POST['level']);
    }
    if (isset($_SESSION['level'])) {
        // Créer les cartes
        for ($i = 0; $i < ((int)$_SESSION['level'] * 2); $i++) {
            $card = new Card($i);
            $cards[] = $card;
        }
    }
    // Vérifier le match
    if (isset($_SESSION['flip2'])) {
        // appel de la fonction checkMatch
        $game->checkMatch();
    }
    // Enlever la variable post
    $_POST['card'] = null;
    unset($_POST['card']);
    ?>
    <!-- Afficher le tableau -->
    <main>

        <section class="board">
            <?php if (!isset($_SESSION['new'])) { ?>
                <div class="level">
                    <form method="post" action="">
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
                        <input type="submit" value="Play" class="button success">
                    </form>
                </div>
            <?php
            }

            if (isset($_SESSION['new'])) {
                /* var_dump($_SESSION['level']) */ ?>
                <div>
                    <form action="verif.php" method="post">
                        <?php
                        foreach ($cards as $card) { ?>
                            <div>
                                <?php
                                $card->displayCard();
                                ?>

                            </div>
                        <?php
                        }
                        ?>
                    </form>
                </div>
                <div>
                    <a class="button" href='game.php?reset=true'>RESET</a>
                </div>

            <?php }
            if (isset($_SESSION['level']) && $game->checkEnd()) { // Vérifier si la partie est terminée
                unset($_SESSION['new']);

            ?>
                <div class="align-center">
                    <h1>Congratulation, the game is end !</h1>
                    <?php
                    $score = $_SESSION['level'] / $_SESSION['coup'];
                    $player->saveScore($_SESSION['level'], $_SESSION['coup'])
                    ?>
                    <br>
                    <p>Your score is <?= $score; ?></p>
                    <p>You have tries <?= $_SESSION['coup']; ?> times</p>
                    <a class="button" href='game.php?reset=true'>RESTART</a>
                <?php
            }       ?>
                </div>

        </section>
    </main>
    <div class="push"></div>
    </div> <!-- wrapper -->
    <?php
    require_once 'includes/footer.php'; ?>