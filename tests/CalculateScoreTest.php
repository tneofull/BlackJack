<?php

namespace BlackJack\Test;

use BlackJack\Dealer;
use BlackJack\CalculateScore;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';

class CalculateScoreTest extends TestCase
{
    public function testCalculateScore()
    {
        $dealer = new Dealer('ディーラー');

        $dealer->handSum = [10, 6];
        $this->assertSame(16, CalculateScore::calculateScore($dealer));

        $dealer->handSum = [10, 7];
        $this->assertSame(17, CalculateScore::calculateScore($dealer));
    }
}
