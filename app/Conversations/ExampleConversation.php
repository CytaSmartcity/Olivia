<?php

namespace App\Conversations;

use App\Complain;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ExampleConversation extends Conversation
{

    /**
     * First question
     */
    public function askReason()
    {
        $this->say('Hello dude 🤘');
        $question = Question::create('How can I help you today?')
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
                        return $this->addComplain();
                    //return $this->say('Registering complain..');
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

        return $this->ask('Please describe the issue as detailed as possible', function(Answer $answer) {
            try {
                $complain = new Complain(['description' => $answer->getText()]);

                $complain->save();

            } catch (\Exception $e) {
                \Log::debug($answer);
                \Log::debug($complain);
                \Log::debug($e->getMessage());
            }
            $this->say('Submitting complain..');
        });

    }
}
