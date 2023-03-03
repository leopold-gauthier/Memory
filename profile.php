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

        // Créer une instance de la classe DbConnect
        $db = new DbConnect();
        // Créer une instance de la classe Player
        $player = new Player($db);

        //Met automatiquement le level par défault a 3
        if (empty($_GET)) {
            $_GET['level'] = 3;
        }
        // récupére le score
        $player->getScore($_GET['level']);
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
            if (isset($_POST['delete'])) {
                $player->delete();
            }
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