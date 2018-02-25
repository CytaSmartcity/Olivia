<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('(hi|hi olivia|hey|geia|γεια)', BotManController::class.'@startConversation');
