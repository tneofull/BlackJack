<?php

namespace BlackJack;

use BlackJack\Dealer;
use BlackJack\Player;
use BlackJack\Deck;
use BlackJack\CalculateScore;
use BlackJack\ShowScore;

require_once __DIR__ . '/../vendor/autoload.php';

class Game
{
    // ディーラーが勝負できない最小値を定義
    public const DEALER_MIN_VALUE = 16;

    public function start(): void
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        $deck = new Deck();

        $player = new Player('Mike');

        $player->playerHands = $player->getHand($deck);
        // var_dump($this->playerHands);


        foreach ($player->playerHands as $card) {
            $this->showDrawCard($card, $player);
            $this->addCard($card, $player);
        }

        $dealer = new Dealer('ディーラー');
        $dealer->dealerHands = $dealer->getHand($deck);

        $this->showDrawCard($dealer->dealerHands[0], $dealer);


        foreach ($dealer->dealerHands as $card) {
            $this->addCard($card, $dealer);
        }

        echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;

        // var_dump($this->dealerHands);

        // プレイヤーが勝負したい数値になるまで再帰的にカードを引く
        PlayerDrawJudgement::playerDrawJudgement($player, $deck);

        // ディーラーの2枚目のカードを表示する(もっと良い表現ないかね、、)
        $dealerSuitNo2 = $dealer->dealerHands[1]->suitNum['suit'];
        $dealerNumNo2 = $dealer->dealerHands[1]->suitNum['num'];
        echo "ディーラーの引いた2枚目のカードは{$dealerSuitNo2}の{$dealerNumNo2}でした。" . PHP_EOL;


        // 【ディーラーの数字判定考え方】
        // カード合計が16以下なら引き続ける
        while ($this->dealerDrawJudgement($dealer)) {
            echo $dealer->getName() . 'の現在の得点は' . CalculateScore::calculateScore($dealer) . 'です。' . PHP_EOL;

            // カードを引き、表示する
            $drawCard = $dealer->addCard($deck);
            $this->showDrawCard($drawCard, $dealer);

            // 手札にオブジェクトを追加
            $dealer->dealerHands[] = $drawCard;

            // 手札合計値のみを表す配列の末尾に引いたカードを追加
            $this->addCard($drawCard, $dealer);
        }

        ShowScore::showScore($player);
        ShowScore::showScore($dealer);

        echo "{$this->judgeWinner($dealer,$player)}の勝ちです!" . PHP_EOL;
        echo 'ゲームを終了します。' . PHP_EOL;
    }


    // 引いたカードの表示
    public static function showDrawCard(Card $card, Person $person): void
    {
        $suit = $card->suitNum['suit'];
        $num = $card->suitNum['num'];
        echo "{$person->getName()}の引いたカードは{$suit}の{$num}です。" . PHP_EOL;
    }

    // 手札合計を表す配列末尾に引いたカードを追加
    public static function addCard(Card $card, Person $person): void
    {
        $person->handSum[] = $card->getCardRank($card->suitNum['num']); /* @phpstan-ignore-line */
    }

    // ディーラーがカードを引くか機械的に判定
    public function dealerDrawJudgement(Dealer $dealer): bool
    {
        if (CalculateScore::calculateScore($dealer) <= self::DEALER_MIN_VALUE) {
            return true;
        } else {
            return false;
        }
    }


    public function judgeWinner(Dealer $dealer, Player $player): string
    {
        // どちらかが21を超えているケースの処理
        if (CalculateScore::calculateScore($player) > 21) {
            return $dealer->getName();
        } elseif (CalculateScore::calculateScore($dealer) > 21) {
            return $player->getName();
        }

        // プレイヤーはディーラーより大きい場合には勝利(引き分けはディーラーの勝利)
        if (CalculateScore::calculateScore($player) > CalculateScore::calculateScore($dealer)) {
            return $player->getName();
        } else {
            return $dealer->getName();
        }
    }
}

// ↓ターミナルでゲームの流れを確認する時は下記コメントアウトを解除する↓
$game = new Game();
$game->start();
