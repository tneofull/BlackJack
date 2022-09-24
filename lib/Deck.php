<?php

namespace BlackJack;

require_once __DIR__ . '/Card.php';

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
        for ($i = 1; $i <= 2; $i++) {
            $hands[] = $this->drawCard();
        }
        return $hands;
    }

    // 手札に1枚加える
    public function addCard(): Card
    {
        return $this->drawCard();
    }

    // カードを1枚引く
    public function drawCard(): Card
    {
        return array_pop($this->deck);
    }
}
