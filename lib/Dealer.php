<?php

namespace BlackJack;

require_once __DIR__ . '/Person.php';

class Dealer implements Person
{
    // 手札の数字とマークを格納
    public array $dealerHands;

    // 手札の数字のみを格納
    public array $handSum;

    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHand(Deck $deck): array
    {
        return $deck->distributeCards();
    }

    public function addCard(Deck $deck): Card
    {
        return $deck->addCard();
    }
}
