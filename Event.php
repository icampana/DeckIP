<?php
/**
 * @package   ImpressPages
 */


/**
 * User: icampana
 * Date: 3/3/15
 * Time: 00:00 AM
 */

namespace Plugin\Deck;


class Event
{
    public static function ipBeforeController()
    {
		// Add elements that are necessary only in administration state
        //if (ipIsManagementState()) {
        //    ipAddCss('assets/AdminDeck.css');
        //}
		
		// Add Stylesheet
		ipAddCss('assets/Deck.css');
		ipAddJs('assets/jquery.easing.min.js');
		ipAddJs('assets/DeckFlip.js');
    }
}
