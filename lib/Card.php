<?php
class Card
{
    public $id;
    private $front;
    private $back;
    private $flip1;
    private $flip2;
    private $height;
    private $width;

    public function __construct($id)
    {
        $this->id = $id;
        $this->front = $_SESSION['board'][$id];
        $this->back = 'assets/img/cards/back_img.webp';

        if (isset($_SESSION['flip1'])) {
            $this->flip1['id'] = $_SESSION['flip1']['id'];
            $this->flip1['front'] = $_SESSION['flip1']['front'];
        } else {
            $this->flip1['id'] = "";
            $this->flip1['front'] = "";
        }
        if (isset($_SESSION['flip2'])) {
            $this->flip2['id'] = $_SESSION['flip2']['id'];
            $this->flip2['front'] = $_SESSION['flip2']['front'];
        }
        // Gestion taille des cartes selon le nbre de paires
        else {
            $this->flip2['id'] = "";
            $this->flip2['front'] = "";
        }
        if ((int)$_SESSION['level']) {
            $this->height = 200;
            $this->width = 133;
        }
    }

    public function getId()
    {
        return $this->id;
    }
    public function displayCard()
    {
        // Si la carte est trouvée, on affiche l'image de la carte
        if ($this->isFound()) { ?>
            <img src="<?= $this->front ?>" alt="card" class="card" height="<?= $this->height ?>" width="<?= $this->width ?>">
        <?php
        } else {
        ?>
            <button class="btn-card-back" type="submit" name="id" value="<?= $this->id ?>"><img src="<?= $this->back ?>" alt="card" id="btn-card" class="btn-card-img" height="<?= $this->height ?>" width="<?= $this->width ?>">
            </button>
<?php
        }
    }

    public function flippedCards()
    {
        if ($this->flip1['id'] === "") {
            // On stocke les infos de la carte retournée dans la session
            $_SESSION['flip1']['id'] = $this->id;
            $_SESSION['flip1']['front'] = $this->front;
            $this->flip1['id'] = $this->id;
            $this->flip1['front'] = $this->front;
        } else {
            $_SESSION['flip2']['id'] = $this->id;
            $_SESSION['flip2']['front'] = $this->front;
            $this->flip2['id'] = $this->id;
            $this->flip2['front'] = $this->front;
        }
    }

    public function isFound()
    {
        // Si la carte est trouvée, on retourne les valeur true ou false
        if ($this->id === $this->flip1['id'] || $this->id === $this->flip2['id'] || in_array($this->id, $_SESSION['find'])) {
            return true;
        } else {
            return false;
        }
    }
}

?>