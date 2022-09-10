<?php

require_once __DIR__ . '/Deck.php';
require_once __DIR__ . '/Card.php';
require_once __DIR__ . '/Player.php';
require_once __DIR__ . '/Dealer.php';

class Game
{

    public array $playerHands;
    public array $dealerHands;

    public function start ()
    {
        echo 'ブラックジャックを開始します' . PHP_EOL;
        $deck = new Deck();

        $player = new Player('Mike');

        $this->playerHands = $player->getHand($deck);
        var_dump($this->playerHands);

        foreach ($this->playerHands as $card) {
            $num = $card->getCardRank();
            echo 'あなたの引いたカードは' . $card->getCardName() . 'の' . $num . 'です。' . PHP_EOL;
            $cards[] = $num;
        }

        var_dump($cards);
        echo array_sum($cards) . PHP_EOL;

        $dealer = new Dealer();
        $this->dealerHands = $dealer->getHand($deck);
        var_dump($this->dealerHands);

        $dealerNum = $this->dealerHands[0]->getCardRank();
        echo 'ディーラーの引いたカードは' . $this->dealerHands[0]->getCardName() . 'の' . $dealerNum . 'です。' . PHP_EOL;


        
    }
}

$game = new Game();
$game->start();
