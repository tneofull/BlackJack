<?php

require_once __DIR__ . '/Person.php';

class Player implements Person
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHand (Deck $deck): array
    {
        return $deck->distributeCards();
    }

    public function addCard (Deck $deck): Card
    {
        return $deck->addCard();
    }
}
