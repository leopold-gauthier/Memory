<?php require_once 'autoloader.php'; ?>

<?php

class Player
{
    public $id;
    public $login;
    private $password;
    public $level;
    public $score;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        if (isset($_SESSION['login'])) {
            $this->login = $_SESSION['login']['login'];
            $this->id = $_SESSION['login']['id'];
        }
    }
    public function register($login, $password)
    {
        if ($login != "" && $password != "") {
            $request = "SELECT * FROM players WHERE login = :login ";
            $select = $this->db->getPdo()->prepare($request);
            $select->execute(array(':login' => $login));
            $fetch = $select->fetchAll();
            $row = count($fetch);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Si le login n'existe pas, on peut l'enregistrer
            if ($row == 0) {
                $register = "INSERT INTO players (login, password) VALUES (:login, :password)";
                $insert = $this->db->getPdo()->prepare($register);
                $insert->execute(array(
                    ':login' => $login,
                    ':password' => $hashed_password
                ));
                echo "Registration successful!";
                header('Location: login.php');
            } else {
                $error = "This login already exists!";
                return $error;
            }
        } else {
            echo "You must fill in all fields!";
        }
    }
    public function connect($login, $password)
    {
        if ($login != "" && $password != "") {
            $request = "SELECT password FROM players WHERE login = ?";
            $select = $this->db->getPdo()->prepare($request);
            $select->execute(array($login));
            $result = $select->fetch();
            // Récupérer le mot de passe hashé si il n'est pas false alors continue sinon stop
            if ($result == true) {
                $hashed_password = $result['password'];
                if (password_verify($password, $hashed_password)) {
                    $request = "SELECT * FROM players WHERE login = :login";
                    $select = $this->db->getPdo()->prepare($request);
                    $select->execute(array(':login' => $login));
                    $result = $select->fetch();
                    $_SESSION['login'] = [
                        'id' => $result['id'],
                        'login' => $login,
                    ];
                    header('Location: index.php');
                } else {
                    echo "<p>Login ou mot de passe incorrect !</p>";
                }
            } else {
                echo "<p>Login ou mot de passe incorrect !</p>";
            }
        } else {
            echo "<p>Vous devez remplir tous les champs !</p>";
        }
    }
    public function disconnect()
    {
        if ($this->isConnected()) {
            $this->login = null;
            session_unset();
            session_destroy();
        } else {
            echo "Vous n'êtes pas connecté(e) !";
        }
    }
    public function delete()
    {
        if ($this->isConnected()) {
            $stmt = $this->db->getPdo()->prepare("DELETE FROM player_score WHERE player_id = :player_id");
            $stmt->execute(['player_id' => $this->id]);

            $stmt = $this->db->getPdo()->prepare("DELETE FROM players WHERE id = :id");
            $stmt->execute(['id' => $this->id]);
            session_destroy();
            header("Location: login.php");
        } else {
            echo "Vous devez etre connecte pour supprimer votre compte !";
        }
    }
    public function update($login, $password)
    {
        if ($this->isConnected()) {
            if ($login != "" && $password != "") {
                $_SESSION['user']['login'] = $login;
                $_SESSION['user']['password'] = $password;
                $request = "SELECT * FROM utilisateurs WHERE login = :login ";
                $select = $this->db->getPdo()->prepare($request);
                $select->execute(array(
                    ':login' => $login
                ));
                $fetch = $select->fetchAll();
                $row = count($fetch);

                if ($row == 0) {
                    $update = "UPDATE utilisateurs SET login = :login, password = :password, email = :email, firstname = :firstname, lastname = :lastname WHERE id = :id ";
                    $select = $this->db->getPdo()->prepare($update);
                    $select->execute(array(
                        ':login' => $login,
                        ':password' => $password,
                        ':id' => $this->id
                    ));
                    echo "Mise à jour terminée !";
                } else {
                    echo "Vous devez saisir un nouveau login !";
                }
            } else {
                echo "Vous devez remplir tous les champs !";
            }
        } else {
            echo "Vous devez être connecté pour modifier vos informations !";
        }
    }
    public function isConnected()
    {
        if ($this->login != null) {
            return true;
        } else {
            return false;
        }
    }
    public function getAllInfos()
    {
        if ($this->isConnected()) {   ?>
            <table>
                <thead>
                    <tr>
                        <th>login</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $this->login; ?></td>
                    </tr>
                </tbody>
            </table>

        <?php
        } else {
            echo "Vous devez être connecté(e) pour voir vos informations !";
        }
    }
    public function getLogin()
    {
        if ($this->isConnected()) {
            return $this->login;
        } else {
            echo "Vous devez être connecté(e) pour voir vos informations !";
        }
    }
    public function getId()
    {
        return $this->id;
    }
    public function saveScore($level, $coups)
    {
        $stmt = $this->db->getPdo()->prepare("INSERT INTO player_score (player_id, level, coups) VALUES (?, ?, ?)");
        $stmt->execute([$this->id, $level, $coups]);
    }
    public function getScore($level)
    {
        $stmt = $this->db->getPdo()->prepare("SELECT * FROM player_score WHERE player_id = :player_id AND level = :level ORDER BY coups DESC");
        $stmt->execute(array(
            ':player_id' => $this->id,
            ':level' => $level
        ));
        $fetchall = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table class="scoreProfile">
            <thead>
                <tr>
                    <th>Pairs</th>
                    <th>Score</th>
                    <th>Tries</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($fetchall as $row) {
                    $score = $row['level'] / $row['coups'];
                ?>
                    <tr>
                        <td><?php echo $row['level']; ?></td>
                        <td><?php echo $score; ?></td>
                        <td><?php echo $row['coups']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    public function getGlobalScore()
    {
        $stmt = $this->db->getPdo()->prepare("SELECT * FROM player_score INNER JOIN players ON player_score.player_id = players.id WHERE level = :level ORDER BY coups limit 10");
        $stmt->execute(array(':level' => $_GET['level']));
        $score = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
        <table>
            <thead>
                <tr>
                    <th>Login</th>
                    <th>Score</th>
                    <th>Pairs</th>
                    <th>Tries</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($score as $row) {
                    $score = $row['level'] / $row['coups'];
                ?>
                    <tr>
                        <td><?php echo $row['login']; ?></td>
                        <td><?php echo $score; ?></td>
                        <td><?php echo $row['level']; ?></td>
                        <td><?php echo $row['coups']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
<?php
    }
}
