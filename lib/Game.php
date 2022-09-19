<?php

require_once __DIR__ . '/Deck.php';
require_once __DIR__ . '/Card.php';
require_once __DIR__ . '/Player.php';
require_once __DIR__ . '/Dealer.php';

class Game
{
    // ディーラーが勝負できない最小値を定義
    public const DEALER_MIN_VALUE = 16;

    public function start()
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        $deck = new Deck();

        $player = new Player('Mike');

        $player->playerHands = $player->getHand($deck);
        // var_dump($this->playerHands);


        foreach ($player->playerHands as $card) {
            $this->showDrawCard($card,$player);
            $this->addCard($card, $player);
        }

        $dealer = new Dealer('ディーラー');
        $dealer->dealerHands = $dealer->getHand($deck);

        $this->showDrawCard($dealer->dealerHands[0],$dealer);


        foreach ($dealer->dealerHands as $card) {
            $this->addCard($card, $dealer);
        }

        echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;

        // var_dump($this->dealerHands);

        // プレイヤーが勝負したい数値になるまで再帰的にカードを引く
        $this->playerDrawJudgement($player,$deck);

        // ディーラーの2枚目のカードを表示する(もっと良い表現ないかね、、)
        echo "ディーラーの引いた2枚目のカードは{$dealer->dealerHands[1]->suitNum['suit']}の{$dealer->dealerHands[1]->suitNum['num']}でした。" . PHP_EOL;


        // 【ディーラーの数字判定考え方】
        // カード合計が16以下なら引き続ける
        while ($this->DealerDrawJudgement($dealer)) {
            echo "{$dealer->getName()}の現在の得点は{$this->calculateScore($dealer)}です。" . PHP_EOL;

            // カードを引き、表示する
            $drawCard = $dealer->addCard($deck);
            $this->showDrawCard($drawCard, $dealer);

            // 手札にオブジェクトを追加
            $dealer->dealerHands[] = $drawCard;

            // 手札合計値のみを表す配列の末尾に引いたカードを追加
            $this->addCard($drawCard, $dealer);
        }

        $this->showScore($player);
        $this->showScore($dealer);

        echo "{$this->judgeWinner($dealer, $player)}の勝ちです!" . PHP_EOL;
        echo 'ゲームを終了します。' . PHP_EOL;

    }


    // 引いたカードの表示
    public function showDrawCard(Card $card, Person $person): void
    {
        $suit = $card->suitNum['suit'];
        $num = $card->suitNum['num'];
        echo "{$person->getName()}の引いたカードは{$suit}の{$num}です。" . PHP_EOL;
    }

    // 手札合計を表す配列末尾に引いたカードを追加
    public function addCard(Card $card, Person $person): void
    {
        $person->handSum[] = $card->getCardRank($card->suitNum['num']);
    }


    public function playerDrawJudgement(Player $player, Deck $deck): void
    {
        echo "{$player->getName()}の得点は{$this->calculateScore($player)}です。カードを引きますか？（Y/N）" . PHP_EOL;


        // 勝負したい数字になるまでカードを繰り返し引く
        Do  {
                $input = trim(fgets(STDIN));
                if ($input === 'Y') {

                // カードを引き、表示する
                $drawCard = $player->addCard($deck);
                $this->showDrawCard($drawCard,$player);

                // 手札にオブジェクトを追加
                $player->playerHands[] = $drawCard;

                // 手札合計値のみを表す配列の末尾に引いたカードを追加
                $this->addCard($drawCard, $player);
                self::playerDrawJudgement($player,$deck); //再帰的に処理

                } elseif ($input === 'N') {
                    break;
                }  else {
                    echo 'YかNを入力して下さい。' . PHP_EOL;
                }
            } while (!($input === 'Y' || $input === 'N'));
    }

    // ディーラーがカードを引くか機械的に判定
    public function DealerDrawJudgement(Dealer $dealer): bool
    {
        if ($this->calculateScore($dealer) <= GAME::DEALER_MIN_VALUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    // 手札の合計数を表示
    public function calculateScore (Person $person): int
    {
        return array_sum($person->handSum);
    }

    // 合計得点を表示する
    public function showScore (Person $person): void
    {
        echo "{$person->getName()}の得点は{$this->calculateScore($person)}です。" . PHP_EOL;
    }

    public function judgeWinner (Dealer $dealer, Player $player): string
    {
        // どちらかが21を超えているケースの処理
        if ($this->calculateScore($player) > 21) {
            return $dealer->getName();
        } elseif ($this->calculateScore($dealer) > 21)
            return $player->getName();

        // プレイヤーはディーラーより大きい場合には勝利(引き分けはディーラーの勝利)
        if ($this->calculateScore($player) > $this->calculateScore($dealer)) {
            return $player->getName();
        } else {
            return $dealer->getName();
        }
    }
}

// ↓ターミナルでゲームの流れを確認する時は下記コメントアウトを解除する↓
$game = new Game();
$game->start();
