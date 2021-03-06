<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);

// Classes
include "classes/Game.php";
include "classes/Deck.php";
include "classes/Hand.php";
include "classes/Card.php";
include "logics/Basic.php";
// Libs
include "libs/Cli.php";
include "libs/functions.php";

// Dealer
define("DECKS", 4);
define("STAND", 17);
// Logic
define("LOGIC_HIT", 1);
define("LOGIC_STAND", 2);

// Args
if (count($argv)<2) {
    // Help
    Cli::output("Usage: ".$argv[0]." [options]\n", "help");
    Cli::output("   -r: Number of rolls", "help");
    Cli::finish("   -v: Verbosity level", "help");
} else {
    // Get args
    $parameters = Cli::getArgs($argv);
    // Rolls
    $rolls = $parameters["r"];
    // Debug
    if ($parameters["v"] > 0) {
        define("DEBUG", true);
    } else {
        define("DEBUG", false);
    }
}

$roll = 0;

$results = array("wins" => 0, "equals" => 0, "loses" => 0);

do {
    Cli::output("New Game", "title", "debug");
    $game = new Game();
    // Dealer
    $game->dealerPlay();
    Cli::output("Dealer: ".$game->dealerHand->toString(), "notice", "debug");
    // Player
    $game->playerPlay();
    Cli::output("Player: ".$game->playerHand->toString(), "notice", "debug");
    // Winner
    switch ($game->playerWins()) {
        case 1:
            Cli::output("Player wins", "success", "debug");
            $results["wins"]++;
        break;
        case 0:
            Cli::output("Equals", "warning", "debug");
            $results["equals"]++;
        break;
        case -1:
            Cli::output("Player loses", "error", "debug");
            $results["loses"]++;
        break;
    }
    // Next Roll
    $roll++;
} while ($rolls>$roll);

Cli::output("Odds", "title");
Cli::output("Odds to win: ".avg($results["wins"], $rolls), "info");
Cli::output("Odds to equal: ".avg($results["equals"], $rolls), "info");
Cli::finish("Odds to lose: ".avg($results["loses"], $rolls), "info");
