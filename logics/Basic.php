<?php

class Logic
{
    public static function play($game)
    {
        $playerValue = $game->playerHand->value;
        if ($playerValue>=21) {
            return LOGIC_STAND;
        } else {
            return LOGIC_HIT;
        }
    }
}
