<?php

namespace BlackJack;

use BlackJack\Person;

require_once __DIR__ . '/../vendor/autoload.php';

class CalculateScore
{
    // 手札の合計数を表示
    public static function calculateScore(Person $person): int
    {
        return array_sum($person->handSum);/* @phpstan-ignore-line */
    }
}
