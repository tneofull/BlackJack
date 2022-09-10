<?php

require_once __DIR__ . '/../lib/Deck.php';

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{

    public function testDistributeCards()
    {
        $deck = new Deck();
        $this->assertSame(2,count($deck->distributeCards()));
    }

    public function testAddCard()
    {
        $deck = new Deck();
        $this->assertSame(3,count($deck->addCard([1,3])));
    }

}
