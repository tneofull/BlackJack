<?php

namespace BlackJack\Test;

use BlackJack\Deck;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';

class DeckTest extends TestCase
{
    public function testDistributeCards()
    {
        $deck = new Deck();
        $this->assertSame(2, count($deck->distributeCards()));
    }

    public function testAddCard()
    {
        $deck = new Deck();
        $this->assertSame(2, count($deck->addCard()->suitNum));
    }
}
