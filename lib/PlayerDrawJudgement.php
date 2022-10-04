<?php

namespace BlackJack;

use BlackJack\CalculateScore;

require_once __DIR__ . '/../vendor/autoload.php';

class PlayerDrawJudgement
{
    public static function playerDrawJudgement(Player $player, Deck $deck): void
    {
        echo "{$player->getName()}の得点は" . CalculateScore::calculateScore($player) . 'です。カードを引きますか？（Y/N）' . PHP_EOL;


        // 勝負したい数字になるまでカードを繰り返し引く
        do {
            $input = trim(fgets(STDIN));
            if ($input === 'Y') {
                // カードを引き、表示する
                $drawCard = $player->addCard($deck);
                GAME::showDrawCard($drawCard, $player);

                // 手札にオブジェクトを追加
                $player->playerHands[] = $drawCard;

                // 手札合計値のみを表す配列の末尾に引いたカードを追加
                GAME::addCard($drawCard, $player);
                self::playerDrawJudgement($player, $deck); //再帰的に処理
            } elseif ($input === 'N') {
                break;
            } else {
                echo 'YかNを入力して下さい。' . PHP_EOL;
            }
        } while (!($input === 'Y' || $input === 'N'));
    }
}
