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
        echo 'ブラックジャックを開始します' . PHP_EOL;
        $deck = new Deck();

        $player = new Player('Mike');

        $player->playerHands = $player->getHand($deck);
        // var_dump($this->playerHands);


        foreach ($player->playerHands as $card) {
            $this->showDrawCard($card,$player);
            $this->addCard($card, $player);
        }

        // var_dump($this->handSum);

        $dealer = new Dealer('ディーラー');
        $dealer->dealerHands = $dealer->getHand($deck);

        $this->showDrawCard($dealer->dealerHands[0],$dealer);


        foreach ($dealer->dealerHands as $card) {
            $this->addCard($card, $dealer);
        }

        echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;

        // var_dump($this->dealerHands);


        // プレイヤーが勝負したい数値になるまで再起的にカードを引く
        $this->playerDrawJudgement($player,$deck);


        $this->showDrawCard($dealer->dealerHands[1], $dealer);


        // ディラーの数字判定考え方
        // カード合計が16以下なら引き続ける
        while ($this->DealerDrawJudgement($dealer)) {

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


    public function playerDrawJudgement(Player $player, Deck $deck)
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
                self::playerDrawJudgement($player,$deck);

                } elseif ($input === 'N') {
                    break;
                }  else {
                    echo 'YかNを入力して下さい' . PHP_EOL;
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
        echo "{$person->getName()}の得点は{$this->calculateScore($person)}です" . PHP_EOL;
    }

}

$game = new Game();
$game->start();
