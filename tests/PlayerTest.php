<?php

namespace BlackJack\Test;

use BlackJack\Player;
use BlackJack\Deck;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';

class PlayerTest extends TestCase
{
    public function testGetName()
    {
        $player = new Player('Mike');
        $this->assertSame('Mike', $player->getName());
    }

    public function testAddCard()
    {
        $player = new Player('Mike');
        $deck = new Deck();
        $this->assertSame(2, count($player->addCard($deck)->suitNum));
    }

    public function testGetHand()
    {
        $player = new Player('Mike');
        $deck = new Deck();
        $this->assertSame(2, count($player->getHand($deck)));
    }
}
