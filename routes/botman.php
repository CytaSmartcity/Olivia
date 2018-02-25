<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('(hi|Hi|HI|hi olivia|Hi olivia|HI OLIVIA|Hi Olivia|hey|Hey|geia|Geia|γεια|help|Help)', BotManController::class.'@startConversation');
