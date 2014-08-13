<?php

class Logic
{
    private static $logic = array(
        //          2    3    4    5    6    7    8    9   10    A
        "17"    => "S", "S", "S", "S", "S", "S", "S", "S", "S", "S",
        "16"    => "S", "S", "S", "S", "S", "H", "H", "H", "H", "H",
        "15"    => "S", "S", "S", "S", "S", "H", "H", "H", "H", "H",
        "14"    => "S", "S", "S", "S", "S", "H", "H", "H", "H", "H",
        "13"    => "S", "S", "S", "S", "S", "H", "H", "H", "H", "H",
        "12"    => "H", "H", "S", "S", "S", "H", "H", "H", "H", "H",
        "11"    => "D", "D", "D", "D", "D", "D", "D", "D", "D", "H",
        "10"    => "D", "D", "D", "D", "D", "D", "D", "D", "H", "H",
        "9"     => "H", "D", "D", "D", "D", "H", "H", "H", "H", "H",
        "8"     => "H", "H", "H", "H", "H", "H", "H", "H", "H", "H",
        "7"     => "H", "H", "H", "H", "H", "H", "H", "H", "H", "H",
        "6"     => "H", "H", "H", "H", "H", "H", "H", "H", "H", "H",
        "5"     => "H", "H", "H", "H", "H", "H", "H", "H", "H", "H",
        "A,10"  => "S", "S", "S", "S", "S", "S", "S", "S", "S", "S",
        "A,9"   => "S", "S", "S", "S", "S", "S", "S", "S", "S", "S",
        "A,8"   => "S", "S", "S", "S", "S", "S", "S", "S", "S", "S",
        "A,7"   => "S", "D", "D", "D", "D", "S", "S", "H", "H", "H",
        "A,6"   => "H", "D", "D", "D", "D", "H", "H", "H", "H", "H",
        "A,5"   => "H", "H", "D", "D", "D", "H", "H", "H", "H", "H",
        "A,4"   => "H", "H", "D", "D", "D", "H", "H", "H", "H", "H",
        "A,3"   => "H", "H", "H", "D", "D", "H", "H", "H", "H", "H",
        "A,2"   => "H", "H", "H", "D", "D", "H", "H", "H", "H", "H",
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
        $c1value = self::calcValue($game->playerHand->cards[0]->value);
        $c2value = self::calcValue($game->playerHand->cards[1]->value);
        //Order
        $order = array();
        if ($c1value >= $c2value || $c1value == "A") {
            $order = array($c1value, $c2value);
        } else {
            $order = array($c2value, $c1value);
        }
        // Dealer Card Value
        $dc = $game->dealerHand->cards[0];
        // Logic
        $index = implode(",", $order);
        $dcValue = self::calcValue($dc->value);
        $dcIndex = self::calcIndex($dcValue);
        // 2 Cards logic
        if (isset(self::$logic[$index][$dcIndex])) {
            $action = self::$logic[$index][$dcIndex];
        // Value logic
        } elseif (isset(self::$logic[$playerValue][$dcIndex])) {
            $action = self::$logic[$playerValue][$dcIndex];
        }

        $return = self::calcAction($action);;

        Cli::output("Index: ".$index."(".$playerValue.")::".$dcValue." -> ".$action."::".$return, "debug", "debug");

        return $return;
    }

    private static function calcValue($cardValue)
    {
        if (!is_numeric($cardValue)) {
            if (in_array($cardValue, array("J", "Q", "K"))) {
                return 10;
            }
        }

        return $cardValue;
    }

    private static function calcIndex($value)
    {
        if ($value == "A") {
            return 9;
        } else {
            return $value - 2;
        }
    }

    /**
     * Returns a constant value action
     * @todo Split, Double
     * @param  string $action
     * @return int
     */
    private static function calcAction($action)
    {
        switch ($action) {
            default:
                return LOGIC_STAND;
                break;
            case 'H':
            case 'D':
                return LOGIC_HIT;
            break;
        }
    }
}
