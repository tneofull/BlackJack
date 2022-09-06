<?php

$deck = [];
foreach (["S","C","H","D"] as $suit) {
    foreach (["A",2,3,4,5,6,7,8,9,10,"J","Q","K"] as $num) {
        $deck[] = $suit . $num;
    }
}

shuffle($deck);
var_dump($deck);
