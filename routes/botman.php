<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('hi', BotManController::class.'@startConversation');
