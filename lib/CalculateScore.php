<?php

namespace BlackJack;

use BlackJack\Person;

require_once __DIR__ . '/../vendor/autoload.php';

class CalculateScore
{
    // 手札の合計数を表示
    public static function calculateScore(Person $person): int
    {
        $cards = $person->handSum; /* @phpstan-ignore-line */
        $total = array_sum($cards);

        // Aを含み、合計が21以下の範囲なら、Aを11としてカウントするため+10する
        if (self::hasAce($cards, $total)) {
            $total += 10;
        }

        return $total;
    }

    // 手札にAを含み、+10でカウントした合計が21以下か判定
    public static function hasAce($cards, $total): bool
    {
        if (in_array(1, $cards) && $total + 10 <= 21) {
            return true;
        } else {
            return false;
        }
    }
}
