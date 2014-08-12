<?php

class Deck
{
    private $cards = array();

    public function __construct()
    {
        $values = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A");
        $suits = array("♥", "♦", "♣", "♠");
        //Build cards
        foreach ($suits as $suit) {
            foreach ($values as $value) {
               $this->cards[] = new Card($suit, $value);
            }
        }
    }

    /**
     * Get a card from the deck
     * @return object Card
     */
    public function getCard()
    {
        //Mix the deck
        shuffle($this->cards);
        //Get a card
        $card = $this->cards[0];
        //Unset that card
        array_shift($this->cards);

        return $card;
    }
}
