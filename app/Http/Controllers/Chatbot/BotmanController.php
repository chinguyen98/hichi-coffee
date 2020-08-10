<?php

namespace App\Http\Controllers\Chatbot;

use App\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotmanController extends Controller
{
    public function handle()
    {
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

        $botman = BotManFactory::create([]);

        $botman->hears('{message}', function ($botman, $message) {
            if ($message == 'hi') {
                $botman->reply("hi bạn");
            } else {
                $botman->reply("Nhấn hi để test");
            }
        });

        $botman->listen();
    }
}
