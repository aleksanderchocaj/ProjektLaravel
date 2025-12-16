<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quizzes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:5',
            'questions' => 'required|array|min:1', 
            'questions.*.content' => 'required|min:3', 
            'questions.*.answers' => 'required|array|min:2', 
            'questions.*.answers.*.content' => 'required',
            'questions.*.correct_answer_index' => 'required|integer', 
        ]);

        //Transakcja (żeby nie dodało quizu bez pytań w razie błędu)
        DB::transaction(function () use ($validated) {
            $quiz = Quiz::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
            ]);

            foreach ($validated['questions'] as $qData) {
                $question = $quiz->questions()->create([
                    'content' => $qData['content']
                ]);

                foreach ($qData['answers'] as $index => $aData) {
                    $question->answers()->create([
                        'content' => $aData['content'],
                        'is_correct' => ($index == $qData['correct_answer_index']), 
                    ]);
                }
            }
        });

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz utworzony pomyślnie.');
    }

    public function edit(Quiz $quiz)
    {
        // Ładujemy relacje, żeby wypełnić formularz
        $quiz->load('questions.answers');
        return view('admin.quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:5',
            'questions' => 'required|array|min:1',
            'questions.*.content' => 'required|min:3',
            'questions.*.answers' => 'required|array|min:2',
            'questions.*.answers.*.content' => 'required',
            'questions.*.correct_answer_index' => 'required|integer',
        ]);

        DB::transaction(function () use ($quiz, $validated) {
            $quiz->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
            ]);

            $quiz->questions()->delete();

            foreach ($validated['questions'] as $qData) {
                $question = $quiz->questions()->create([
                    'content' => $qData['content']
                ]);

                foreach ($qData['answers'] as $index => $aData) {
                    $question->answers()->create([
                        'content' => $aData['content'],
                        'is_correct' => ($index == $qData['correct_answer_index']),
                    ]);
                }
            }
        });

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz zaktualizowany.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz usunięty.');
    }
}