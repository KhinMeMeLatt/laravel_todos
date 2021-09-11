<?php
use App\Http\Controllers\BotManController;
use App\Todo;

$botman = resolve('botman');

$botman->hears('show my todos', function ($bot) {
    $todos = Todo::all();
    if(count($todos) > 0) {
        $bot->reply('Your todos are:');
        foreach($todos as $todo) {
            $bot->reply($todo->task);
        }
    } else {
        $bot->reply('You do not have any todos.');
    }
});
