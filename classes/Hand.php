<?php

class Hand
{
    public $cards;
    public $value;
    private $isDealer = false;

    public function __construct($isDealer = false)
    {
        $this->isDealer = $isDealer;
    }

    /**
     * Check if hand got any As
     * @return bool
     */
    private function gotAs()
    {
        foreach ($this->cards as $card) {
            if ($card->value == "A") {
                return true;
            }
        }
    }

    /**
     * Add a Card to hand
     * @param object $card
     */
    public function addCard($card)
    {
        $this->cards[] = $card;
        $this->value = $this->getValue();
    }

    /**
     * Get hand value
     * @return int
     */
    public function getValue()
    {
        $max = 0;
        $min = 0;
        $lowAs = false;
        // Hand got any As?
        if ($this->gotAs()) {
            // Min value
            foreach ($this->cards as $card) {
                $min += $card->getValue(true);
            }
        }
        // Max value
        foreach ($this->cards as $card) {
            $max += $card->getValue($lowAs);
            // Car is an As?
            if ($card->value == "A") {
                $lowAs = true;
            }
        }
        // Better min?
        if ($min != 0 && $max > 21) {
            if ($max<$min) {
                return $min;
            }
        }

        return $max;
    }

    /**
     * Check if hand has BlackJack
     * @return boolean
     */
    public function hasBlackJack()
    {
        if ($this->value == 21 && count($this->cards) == 2) {
            return true;
        }

        return false;
    }

    public function toString()
    {
        $return = array();
        foreach ($this->cards as $card) {
            $return[] = $card->toString();
        }

        $string = $this->value." (".implode(" ", $return).")";
        if ($this->hasBlackJack()) {
            $string .= " BlackJack!";
        }

        return $string;
    }
}
