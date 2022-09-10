<?php

require_once __DIR__ . '/Person.php';

class Dealer implements Person
{

    public function getHand(Deck $deck): array
    {
        return $deck->distributeCards();
    }

    public function addCard(Deck $deck, array $hand): array
    {
        return $deck->addCard($hand);
    }
}
