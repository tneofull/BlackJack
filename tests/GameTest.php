<?php

require_once __DIR__ . '/../lib/Game.php';

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testDealerDrawJudgement()
    {
        $game = new Game();
        $dealer = new Dealer('ディーラー');

        $dealer->handSum = [10,6];
        $this->assertSame(TRUE, $game->DealerDrawJudgement($dealer));

        $dealer->handSum = [10,7];
        $this->assertSame(FALSE, $game->DealerDrawJudgement($dealer));
    }

    public function testCalculateScore()
    {
        $game = new Game();
        $dealer = new Dealer('ディーラー');

        $dealer->handSum = [10, 6];
        $this->assertSame(16, $game->calculateScore($dealer));

        $dealer->handSum = [10, 7];
        $this->assertSame(17, $game->calculateScore($dealer));
    }

    public function testJudgeWinner()
    {

        $game = new Game();
        $dealer = new Dealer('ディーラー');
        $player = new Player('Mike');

        // プレイヤーが21を超えるケース
        $dealer->handSum = [10,8];
        $player->handSum = [10,10,6];
        $this->assertSame('ディーラー', $game->judgeWinner($dealer, $player));

        // ディーラーが21を超えるケース
        $dealer->handSum = [10, 6, 8];
        $player->handSum = [10, 7];
        $this->assertSame('Mike', $game->judgeWinner($dealer, $player));

        // ディーラーの方が大きいケース
        $dealer->handSum = [10, 8];
        $player->handSum = [10, 7];
        $this->assertSame('ディーラー', $game->judgeWinner($dealer, $player));

        // 引き分けのケース(ディーラーの勝ち)
        $dealer->handSum = [10, 8];
        $player->handSum = [10, 8];
        $this->assertSame('ディーラー', $game->judgeWinner($dealer, $player));

        // プレイヤーの方が大きいケース
        $dealer->handSum = [10, 7];
        $player->handSum = [10, 8];
        $this->assertSame('Mike', $game->judgeWinner($dealer, $player));
    }
}
