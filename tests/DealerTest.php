<?php

require_once __DIR__ . '/../lib/Dealer.php';

use PHPUnit\Framework\TestCase;

class DealerTest extends TestCase
{

    public function testGetName()
    {
        $dealer = new Dealer('ディーラー');
        $this->assertSame('ディーラー',$dealer->getName());
    }

    public function testAddCard()
    {
        $dealer = new Dealer('ディーラー');
        $deck = new Deck();
        $this->assertSame(2,count($dealer->addCard($deck)->suitNum));
    }

    public function testGetHand()
    {
        $dealer = new dealer('ディーラー');
        $deck = new Deck();
        $this->assertSame(2,count($dealer->getHand($deck)));
    }

}
