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
    public function getValue($lowerAs = false)
    {
        // Monkey?
        if (!is_numeric($this->value)) {
            // As
            if ($this->value == "A") {
                // Lower As
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

    /**
     * Card to string
     * @return string
     */
    public function toString()
    {
        return $this->value.$this->suit;
    }
}
