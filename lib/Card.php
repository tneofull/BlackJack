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

    public const CARD_NAME = [
        'S' => 'スペード',
        'C' => 'クラブ',
        'H' => 'ハート',
        'D' => 'ダイヤ',
    ];

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getNum(): mixed
    {
        return $this->num;
    }

    public function getCardRank(): int
    {
        $this->num = self::CARD_RANK[$this->getNum()];
        return $this->num;
    }

    public function getCardName(): string
    {
        return self::CARD_NAME[$this->getSuit()];
    }
}
