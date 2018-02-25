<?php

namespace App\Conversations;

use App\Complain;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;

class MainConversation extends Conversation
{

    /**
     * First question
     */
    public function askReason()
    {
        $question = Question::create('How can I help you?')
                            ->fallback('It looks like this is not supported yet. We will include it in the next version though.')
                            ->callbackId('ask_reason')
                            ->addButtons([
                                Button::create('Cheapest fuel prices')->value('fuel'),
                                Button::create('Available parking')->value('parking'),
                                Button::create('Register a complain')->value('complain'),
                                Button::create('Pay fine')->value('pay_fine'),
                                Button::create('Pay parking')->value('pay_parking'),
                            ]);

        return $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 'fuel':
                        return $this->checkFuelPrices();
                    case 'complain':
                        return $this->addComplain();
                    case 'parking':
                        return $this->say('Checking parking spaces..');
                    case 'pay_fine':
                        return $this->say('Paying fine..');
                    case 'pay_parking':
                        return $this->payParking();
                    //return $this->payParking();
                    default:
                        return $this->say('It looks like this is not supported yet. We will include it in the next version though.');
                }
            }
        });
    }


    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }


    private function addComplain()
    {

        $this->bot->typesAndWaits(1);
        $this->ask('Please describe the issue as detailed as possible', function(Answer $answer) {
            try {
                $complain = new Complain(['description' => $answer->getText()]);

                $complain->save();

            } catch (\Exception $e) {
                \Log::debug($answer);
                \Log::debug($e->getMessage());
            }
            $this->bot->typesAndWaits(2);
            $this->say('Your complain has been submitted successfully!');

            $question = Question::create('Do you need anything else?')
                                ->fallback('It seems like there is a problem with our connection. :/')
                                ->callbackId('anything_else')
                                ->addButtons([
                                    Button::create('Yes!')->value('yes'),
                                    Button::create('No, thank you')->value('no'),
                                ]);

            $this->bot->typesAndWaits(1);
            $this->ask($question, function(Answer $answer) {
                // Detect if button was clicked:
                if ($answer->isInteractiveMessageReply()) {
                    $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
                    $selectedText  = $answer->getText(); // will be either 'Of course' or 'Hell no!'

                    if ($selectedValue === 'yes') {
                        $this->bot->startConversation(new MainConversation());
                    } else {
                        $this->bot->typesAndWaits(1);
                        $this->say('No problem! I will be here when you need me again :)');
                    }
                }
            });
        });

    }


    private function checkFuelPrices()
    {
        $fuel_prices = \DB::table('fuel_records')
                          ->where('station_city', 'ΛΕΥΚΩΣΙΑ')
                          ->orderBy('fuel_price')
                          ->take(5)
                          ->get()
                          ->toArray();

        $locations = [];
        \array_map(function($item) use (&$locations) {
            $link = "https://www.google.com/maps/dir/{$item->latitude},{$item->longitude}/'@35.1066982,33.2756088'/";

            $locations[] = Element::create($item->station_name)
                                  ->subtitle($item->fuel_price.'('.$item->fuel_company_name.')')
                                  ->addButton(ElementButton::create('Directions')->url($link));

        }, $fuel_prices);

        $this->bot->reply(GenericTemplate::create()
                                         ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                                         ->addElements($locations));

    }


    private function payParking()
    {
        //$this->bot->typesAndWaits(2);

        $this->bot->reply(ButtonTemplate::create('Before paying your parking you need to login to Bank of Cyprus.')
                                  ->addButton(ElementButton::create('No')
                                                           ->type('postback')
                                                           ->payload('no'))
                                  ->addButton(ElementButton::create('Sure!')->url('https://olivia-cyta.herokuapp.com/login')));

        return true;
    }
}
