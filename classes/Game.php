<?php

class Game
{
    private $decks = array();

    public $dealerHand;
    public $playerHand;

    public function __construct()
    {
        //Build decks
        $deck = 0;
        do {
            $this->decks[$deck] = new Deck();
            $deck++;
        } while ($deck<STAND);
    }

    /**
     * Draws a card from the decks
     * @return object Card
     */
    private function getCard()
    {
        //Mix the decks
        shuffle($this->decks);
        //Get a card
        return $this->decks[0]->getCard();
    }

    /**
     * Dealer play
     * @return void
     */
    public function dealerPlay()
    {
        $this->dealerHand = new Hand(true);
        //Get a card
        $this->dealerHand->addCard($this->getCard());
        do {
            //Get another card
            $this->dealerHand->addCard($this->getCard());
        } while ($this->dealerHand->value < STAND && $this->playerHand->value < 21);
    }

    /**
     * Player play
     * @return void
     */
    public function playerPlay()
    {
        $this->playerHand = new Hand();
        //Get a card
        $this->playerHand->addCard($this->getCard());
        do {
            //Get another card
            $this->playerHand->addCard($this->getCard());
            //Apply logic
            $action = Logic::play($this);
        } while ($action != LOGIC_STAND && $this->playerHand->value < 21);
    }

    /**
     * Check if player wins
     * @return int
     */
    public function playerWins()
    {
        // Player bust?
        if ($this->playerHand->value <= 21) {
            // Dealer bust?
            if ($this->dealerHand->value > 21) {
                return 1;
            }
            // Player has the same as dealer?
            if ($this->playerHand->value == $this->dealerHand->value) {
                // Equals?
                if ($this->dealerHand->hasBlackJack() == $this->playerHand->hasBlackJack()) {
                    return 0;
                // Player BlackJack?
                } elseif ($this->playerHand->hasBlackJack()) {
                    return 1;
                // Dealer BlackJack?
                } else {
                    return -1;
                }
            }
            // Dealer BlackJack?
            if ($this->dealerHand->hasBlackJack()) {
                return -1;
            }
            // Player has more than dealer?
            if ($this->playerHand->value > $this->dealerHand->value) {
                return 1;
            }
        }

        return -1;
    }
}
