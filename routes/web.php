<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mainpage', function () {
    return view('main');
});

Route::get('/quizlist', function () {
    return view('quizzes');
});