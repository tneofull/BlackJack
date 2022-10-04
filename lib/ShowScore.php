<?php

namespace BlackJack;

use BlackJack\CalculateScore;

require_once __DIR__ . '/../vendor/autoload.php';

class ShowScore
{
    // 合計得点を表示する
    public static function showScore(Person $person): void
    {
        echo $person->getName() . 'の得点は' . CalculateScore::calculateScore($person) . 'です。' . PHP_EOL;
    }
}
