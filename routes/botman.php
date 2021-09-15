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

$botman->hears('add new todo (\w+)', function ($bot, $task) {
    Todo::create([
        'task' => $task
    ]);
    $bot->reply('You added a new todo for "'.$task.'"');
});

$botman->hears('add new todo', function ($bot) {
    $bot->ask('Which task do you want to add?', function($answer, $conversation) {
        Todo::create([
            'task' => $answer
        ]);
        $conversation->say('You added a new todo for "'.$answer.'"');
    });
});