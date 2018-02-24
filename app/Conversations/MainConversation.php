<?php

namespace App\Conversations;

use App\Complain;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

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
                        return $this->say('Checking fuel prices..');
                    case 'complain':
                        //return $this->say('Registering complain..');
                        return $this->addComplain();
                    case 'parking':
                        return $this->say('Checking parking spaces..');
                    case 'pay_fine':
                        return $this->say('Paying fine..');
                    case 'pay_parking':
                        return $this->say('Paying parking..');
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

        $this->ask('Please describe the issue as detailed as possible', function(Answer $answer) {
            try {
                $complain = new Complain(['description' => $answer->getText()]);

                $complain->save();

            } catch (\Exception $e) {
                \Log::debug($answer);
                \Log::debug($e->getMessage());
            }
            $this->say('Your complain has been submitted successfully!');

            $question = Question::create('Do you need anything else?')
                                ->fallback('It seems like there is a problem with our connection. :/')
                                ->callbackId('anything_else')
                                ->addButtons([
                                    Button::create('Yes!')->value('yes'),
                                    Button::create('No, thank you')->value('no'),
                                ]);

            $this->ask($question, function(Answer $answer) {
                // Detect if button was clicked:
                if ($answer->isInteractiveMessageReply()) {
                    $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
                    $selectedText  = $answer->getText(); // will be either 'Of course' or 'Hell no!'
                    if ($selectedValue === 'yes') {
                        $this->bot->startConversation(new MainConversation());
                    } else {
                        $this->say('No problem! I will be here when you need me again :)');
                    }
                }
            });
        });

    }
}
