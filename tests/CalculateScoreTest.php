<?php

namespace BlackJack\Test;

use BlackJack\Dealer;
use BlackJack\Player;
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

        // 合計が21以下なので11としてカウント
        $dealer->handSum = [3, 1];
        $this->assertSame(14, CalculateScore::calculateScore($dealer));

        // 合計が21を超えるので1としてカウント
        $dealer->handSum = [3, 1, 10];
        $this->assertSame(14, CalculateScore::calculateScore($dealer));


        $player = new Player('Mike');

        $player->handSum = [10, 6];
        $this->assertSame(16, CalculateScore::calculateScore($player));

        // 合計が21以下なので11としてカウント
        $player->handSum = [3, 1];
        $this->assertSame(14, CalculateScore::calculateScore($player));

        // 合計が21を超えるので1としてカウント
        $dealer->handSum = [3, 1, 10];
        $this->assertSame(14, CalculateScore::calculateScore($dealer));
    }

    public function testHasAce()
    {
        $this->assertSame(true, CalculateScore::hasAce([1, 3], 4));
        $this->assertSame(false, CalculateScore::hasAce([1, 3, 10], 14));
    }
}
