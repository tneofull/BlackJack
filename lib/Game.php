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
            $this->showDrawCard($card,$player);
            $this->addCard($card);
        }

        // var_dump($this->playerCount);

        $dealer = new Dealer('ディーラー');
        $this->dealerHands = $dealer->getHand($deck);

        $this->showDrawCard($this->dealerHands[0],$dealer);

        echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;

        var_dump($this->dealerHands);


        // 望みの数値のなるまで再起的にカードを引く処理
        $this->judgement($player,$deck);

    }


    // 引いたカードの表示
    public function showDrawCard(Card $card, Person $person): void
    {
        $suit = $card->suitNum['suit'];
        $num = $card->suitNum['num'];
        echo "{$person->getName()}の引いたカードは{$suit}の{$num}です。" . PHP_EOL;
    }

    // 手札合計を表す配列末尾に引いたカードを追加
    public function addCard(Card $card): void
    {
        $this->playerCount[] = $card->getCardRank($card->suitNum['num']);
    }


    public function judgement(Player $player, Deck $deck)
    {
        echo "{$player->getName()}の得点は{$this->calculateScore()}です。カードを引きますか？（Y/N）" . PHP_EOL;

        Do  {
                $input = trim(fgets(STDIN));
                if ($input === 'Y') {

                // カードを引き、表示する
                $drawCard = $player->addCard($deck);
                $this->showDrawCard($drawCard,$player);

                // 手札にオブジェクトを追加
                $this->playerHands[] = $drawCard;

                // 手札合計値のみを表す配列の末尾に引いたカードを追加
                $this->addCard($drawCard);
                self::judgement($player,$deck);

                } elseif ($input === 'N') {
                    echo "{$player->getName()}の得点は{$this-> calculateScore()}で確定しました";
                    break;
                }  else {
                    echo 'YかNを入力して下さい' . PHP_EOL;
                }
            } while (!($input === 'Y' || $input === 'N'));
    }


    public function calculateScore (): int
    {
        return array_sum($this->playerCount);
    }
}

$game = new Game();
$game->start();
