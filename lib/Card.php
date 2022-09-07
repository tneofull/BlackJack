<?php

class Card
{
    public function __construct(private string $suit, private mixed $num)
    {
    }

    public const CARD_RANK = [
        'A' => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9,
        10 => 10,
        'J' => 10,
        'Q' => 10,
        'K' => 10,
    ];

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getNum(): int
    {
        return $this->num;
    }

    public function getCardRank()
    {
        $this->num = self::CARD_RANK[$this->num];
        return $this->num;
    }
}

$hand = new Card('H', 'K');
var_dump($hand->getCardRank());
