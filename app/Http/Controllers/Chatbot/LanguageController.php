<?php

namespace App\Http\Controllers\Chatbot;

class LanguageController
{
    public function hello()
    {
        return [
            'ok',
            'hi',
            'xin chao',
            'chao',
            'alo',
            'hello',
        ];
    }
}
