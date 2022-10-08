<?php

namespace BlackJack;

use BlackJack\Card;

require_once __DIR__ . '/../vendor/autoload.php';

class Deck
{
    public array $deck;

    public function __construct()
    {
        $this->deck = [];
        foreach (["S", "C", "H", "D"] as $suit) {
            foreach (["A", 2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K"] as $num) {
                $this->deck[] = new Card($suit, $num);
            }
        }

        // 52枚のカードの束をシャッフルする
        shuffle($this->deck);
    }

    // カードを2枚配る(ゲームの初期セット)
    public function distributeCards(): array
    {
        $hands = [];
        for ($i = 1; $i <= 2; $i++) {
            $hands[] = $this->addCard();
        }
        return $hands;
    }

    // 手札に1枚加える
    public function addCard(): Card
    {
        return array_pop($this->deck);
    }
}
