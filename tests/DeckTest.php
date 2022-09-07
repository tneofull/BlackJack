<?php

require_once __DIR__ . '/../lib/Deck.php';

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{
    public function testDrawCards()
    {
        $deck = new Deck();
        $this->assertSame(4,count($deck->drawCards(2,[1,3])));
    }

}
