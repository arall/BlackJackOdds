<?php

class Logic
{
    public static function play($game)
    {
        $playerValue = $game->playerHand->value;
        $dealerCard = $game->dealerHand->cards[0];
        if ($playerValue <= 15) {
            return LOGIC_HIT;
        }
        if ($playerValue == 18) {
            if ($dealerCard->value <= 9) {
                return LOGIC_HIT;
            } else {
                return LOGIC_STAND;
            }
        }
        if ($playerValue <= 21) {
            return LOGIC_STAND;
        }
    }
}
