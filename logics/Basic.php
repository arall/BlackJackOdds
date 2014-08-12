<?php

class Logic
{
    public static function play($game)
    {
        $playerValue = $game->playerHand->value;
        if ($playerValue>=17) {
            return LOGIC_STAND;
        } else {
            return LOGIC_HIT;
        }
    }
}
