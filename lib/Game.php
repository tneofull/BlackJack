<?php

require_once __DIR__ . '/Deck.php';
require_once __DIR__ . '/Card.php';
require_once __DIR__ . '/Player.php';
require_once __DIR__ . '/Dealer.php';

class Game
{

    public array $playerHands;
    public array $dealerHands;

    // プレイヤーの数字のみを格納
    public array $playerCount;

    // ディーラーの数字のみを格納
    public array $dealerCount;

    public function start()
    {
        echo 'ブラックジャックを開始します' . PHP_EOL;
        $deck = new Deck();

        $player = new Player('Mike');

        $this->playerHands = $player->getHand($deck);
        var_dump($this->playerHands);

        foreach ($this->playerHands as $card) {
            $this->showDrawCard($card);
            $this->addCard($card);
        }

        var_dump($this->playerCount);
        echo array_sum($this->playerCount) . PHP_EOL;

        // $dealer = new Dealer();
        // $this->dealerHands = $dealer->getHand($deck);
        // var_dump($this->dealerHands);

        // $dealerSuit = $this->dealerHands[0]['suit'];
        // $dealerNum = $this->dealerHands[0]['num'];
        // echo 'ディーラーの引いたカードは' . $dealerSuit . 'の' . $dealerNum . 'です。' . PHP_EOL;
        // echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;



        // カードを引き、表示する
        $drawCard = $player->addCard($deck);
        $this->showDrawCard($drawCard);

        // 手札にオブジェクトを追加
        $this->playerHands[] = $drawCard;
        var_dump($this->playerHands);

        // 手札合計値のみを表す配列の末尾に引いたカードを追加
        $this->addCard($drawCard);
        var_dump($this->playerCount);


        // echo 'あなたの現在の得点は' . array_sum($this->playerCount) . 'です。カードを引きますか？（Y/N）' . PHP_EOL;

        // Do  {
        //         $input = trim(fgets(STDIN));
        //         if ($input === 'Y') {
        //             echo 'y';
        //         } elseif ($input === 'N') {
        //             break;
        //         }  else {
        //             echo 'YかNを入力して下さい' . PHP_EOL;
        //         }
        //     } while (!($input === 'Y' || $input === 'N'));
        // あなたの引いたカードはスペードの５です。
        // あなたの現在の得点は20です。カードを引きますか？（Y/N）
    }


    // 引いたカードの表示
    public function showDrawCard(Card $card): void
    {
        $suit = $card->suitNum['suit'];
        $num = $card->suitNum['num'];
        echo 'あなたの引いたカードは' . $suit . 'の' . $num . 'です。' . PHP_EOL;
    }

    // 手札合計を表す配列末尾に引いたカードを追加
    public function addCard(Card $card): void
    {
        $this->playerCount[] = $card->getCardRank($card->suitNum['num']);
    }


    public function judgement()
    {
        echo 'あなたの現在の得点は' . $this->calculateScore() . 'です。カードを引きますか？（Y/N）' . PHP_EOL;

        Do  {
                $input = trim(fgets(STDIN));
                if ($input === 'Y') {
                // カードを引き、表示する
                $drawCard = $player->addCard($deck);
                $this->showDrawCard($drawCard);

                // 手札にオブジェクトを追加
                $this->playerHands[] = $drawCard;

                // 手札合計値のみを表す配列の末尾に引いたカードを追加
                $this->addCard($drawCard);
                } elseif ($input === 'N') {
                    break;
                }  else {
                    echo 'YかNを入力して下さい' . PHP_EOL;
                }
            } while (!($input === 'Y' || $input === 'N'));


        // あなたの引いたカードはスペードの５です。
        // あなたの現在の得点は20です。カードを引きますか？（Y/N）
    }


    public function calculateScore (): int
    {
        return array_sum($this->playerCount);
    }
}

$game = new Game();
$game->start();
