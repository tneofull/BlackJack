<?php


interface Person
{
    public function getName();
    public function getHand(Deck $deck);
    public function addCard(Deck $deck);
}
