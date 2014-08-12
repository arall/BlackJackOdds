<?php

class Logic
{
    // TODO
    private $logic = array(
        "10,10" => "S", "S", "S", "S", "S", "S", "S", "S", "S", "S",
        "9,9"   => "Z", "Z", "Z", "Z", "Z", "S", "Z", "Z", "S", "S",
        "7,7"   => "Z", "Z", "Z", "Z", "Z", "Z", "H", "H", "H", "H",
        "6,6"   => "Z", "Z", "Z", "Z", "Z", "H", "H", "H", "H", "H",
        "5,5"   => "D", "D", "D", "D", "D", "D", "D", "D", "H", "H",
        "4,4"   => "H", "H", "H", "Z", "Z", "H", "H", "H", "H", "H",
        "3,3"   => "Z", "Z", "Z", "Z", "Z", "Z", "H", "H", "H", "H",
        "2,2"   => "Z", "Z", "Z", "Z", "Z", "Z", "H", "H", "H", "H",
    );
    public static function play($game)
    {
        $playerValue = $game->playerHand->value;
        $c1 = $game->playerHand->cards[0];
        $c2 = $game->playerHand->cards[1];
        // Dealer Card Value
        $dc = $game->dealerHand->cards[0];
        // Logic
        return LOGIC_HIT;
    }
}
