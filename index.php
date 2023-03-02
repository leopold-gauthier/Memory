<?php session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <?php include_once("./includes/head.php") ?>
</head>

<?php require_once 'includes/header.php'; ?>


<body>
    <header>
        <?php require_once 'includes/header.php'; ?>
    </header>
    <main class="align-center">
        <p>
            Welcome
            <?php
            if (isset($_SESSION['login'])) {
                echo " back " . $_SESSION['login']['login'];
            }
            ?>
            !
        </p>
        <div id="explication" class="align-center">
            <img src="assets/css/ct.png" class="img_ex">
            <h1>Memory</h1>
            <img src="assets/css/t.png" class="img_ex">
        </div>
    </main>
    <footer>
        <?php require_once 'includes/footer.php' ?>
    </footer>
</body>