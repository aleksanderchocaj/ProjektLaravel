<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        // Pobieramy wszystkie quizy
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');
        return view('quizzes.show', compact('quiz'));
    }

    public function check(Request $request, Quiz $quiz)
    {
        // 1. Walidacja Sprawdzamy, czy przesłano tablicę 'answers' oraz czy liczba odpowiedzi zgadza się z liczbą pytań w quizie.
        $questionCount = $quiz->questions()->count();

        $validated = $request->validate([
            'answers' => "required|array|size:$questionCount",
            'answers.*' => 'required|exists:answers,id', 
        ], [
            'answers.size' => 'Musisz udzielić odpowiedzi na wszystkie pytania!',
            'answers.required' => 'Nie przesłano żadnych odpowiedzi.',
        ]);

        $points = 0;
        $submittedAnswers = $validated['answers'];

        // Pobieramy wybrane odpowiedzi z bazy danych w jednym zapytaniu (używam whereIn dla optymalizacji, zamiast robić pętlę po bazie)
        $answers = \App\Models\Answer::whereIn('id', $submittedAnswers)->get();

        foreach ($answers as $answer) {
            if ($answer->is_correct) {
                $points++;
            }
        }

        return view('quizzes.result', [
            'quiz' => $quiz,
            'points' => $points,
            'total' => $questionCount
        ]);
    }
}
