<?php
require_once 'autoloader.php';

class Game
{
    private $card_1;
    private $card_2;
    private $card_3;
    private $card_4;
    private $card_5;
    private $card_6;
    private $card_7;
    private $card_8;
    private $card_9;
    private $card_10;
    private $card_11;
    private $card_12;
    private $cards;

    public function __construct()
    {
        $this->card_1 = './assets/img/cards/1.png';
        $this->card_2 = './assets/img/cards/2.png';
        $this->card_3 = './assets/img/cards/3.png';
        $this->card_4 = './assets/img/cards/4.png';
        $this->card_5 = './assets/img/cards/5.png';
        $this->card_6 = './assets/img/cards/6.png';
        $this->card_7 = './assets/img/cards/7.png';
        $this->card_8 = './assets/img/cards/8.png';
        $this->card_9 = './assets/img/cards/9.png';
        $this->card_10 = './assets/img/cards/10.png';
        $this->card_11 = './assets/img/cards/11.png';
        $this->card_12 = './assets/img/cards/12.png';
        $this->cards = [$this->card_1, $this->card_2, $this->card_3, $this->card_4, $this->card_5, $this->card_6, $this->card_7, $this->card_8, $this->card_9, $this->card_10, $this->card_11, $this->card_12];
    }

    public function reset()
    {
        unset($_SESSION['flip1']);
        unset($_SESSION['flip2']);
        unset($_SESSION['level']);
        unset($_SESSION['find']);
        unset($_SESSION['new']);
        $_SESSION['find'] = [];
        $_SESSION['coup'] = 1;
    }

    public function getCards()
    {
        // Envoi dans deux tableau pour aussi récupérer les doublons
        $rand = array_rand($this->cards, (int)$_SESSION['level']);
        for ($i = 0; isset($rand[$i]); $i++) {
            $board[] = $this->cards[$rand[$i]];
            $board[] = $this->cards[$rand[$i]];
        }
        shuffle($board);
        $_SESSION['board'] = $board;
    }

    public function checkMatch()
    {
        if ($_SESSION['flip1']['front'] === $_SESSION['flip2']['front']) {
            $_SESSION['find'][] = $_SESSION['flip1']['id'];
            $_SESSION['find'][] = $_SESSION['flip2']['id'];
            unset($_SESSION['flip1']);
            unset($_SESSION['flip2']);
        } else {
            unset($_SESSION['flip2']);
            unset($_SESSION['flip1']);
        }
        if ($this->checkEnd() == false) {
            $_SESSION['coup']++;
            header('Refresh: 1; URL=game.php');
        }
    }
    public function checkEnd()
    {
        if (count($_SESSION['find']) === (int)$_SESSION['level'] * 2) {
            return true;
        } else {
            return false;
        }
    }
}
