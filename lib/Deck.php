<?php
require_once __DIR__ . '/Card.php';

class Deck
{
    public array $cards;

    public function __construct()
    {
        $this->cards = [];
        foreach (["S","C","H","D"] as $suit) {
            foreach (["A",2,3,4,5,6,7,8,9,10,"J","Q","K"] as $num) {
                $this->cards[] = new Card($suit, $num);
            }
        }

        // 52枚のカードの束をシャッフルする
        shuffle($this->cards);
    }

    public function drawCards(int $num, array $hands)
    {
        // 束から1枚引く
        for ($i = 1; $i <= $num; $i++) {
            $hands[] = array_pop($this->cards);
        }
        return $hands;
    }
}
