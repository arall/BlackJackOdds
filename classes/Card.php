<?php

class Card
{
    public $suit = null;
    public $value = null;

    public function __construct($suit, $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    /**
     * Gets Card value
     *
     * @param  boolean $isDealer
     * @param  boolean $lowerAs  Count A as 1, not 11
     * @return int
     */
    public function getValue($isDealer = false, $lowerAs = false)
    {
        // Monkey?
        if (!is_numeric($this->value)) {
            // As
            if ($this->value == "A") {
                // Dealer
                if ($isDealer) {
                    return 1;
                }
                // Player
                if ($lowerAs) {
                    return 1;
                } else {
                    return 11;
                }
            } else {
                return 10;
            }
        }

        return $this->value;
    }

    public function toString()
    {
        return $this->value.$this->suit;
    }
}
