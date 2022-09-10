<?php


interface Person
{
    public function getHand(Deck $deck);
    public function addCard(Deck $deck, array $hand);
}
