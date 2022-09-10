<?php

require_once __DIR__ . '/../lib/Card.php';
require_once __DIR__ . '/../lib/Deck.php';

use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{

    public function testGetSuit()
    {
        $card = new Card('H',9);
        $this->assertSame('H',$card->getSuit());
    }

    public function testGetNum()
    {
        $card = new Card('H',9);
        $this->assertSame(9,$card->getNum());
    }

    public function testGetCardRank()
    {
        $card = new Card('H','J');
        $this->assertSame(10,$card->getCardRank());
    }

    public function testGetCardName()
    {
        $card = new Card('H','J');
        $this->assertSame('ハート',$card->getCardName());
    }

}
