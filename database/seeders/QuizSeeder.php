<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // QUIZ 1: Ogólny (istniejący wcześniej)
        // ==========================================
        $quiz1 = Quiz::create([
            'title' => 'Wielki Quiz o Skokach Narciarskich',
            'description' => 'Sprawdź swoją wiedzę o legendach skoków, skoczniach i zasadach tego sportu.',
        ]);

        $questionsData1 = [
            [
                'content' => 'Kto jest czterokrotnym zdobywcą Kryształowej Kuli?',
                'answers' => [
                    ['content' => 'Adam Małysz', 'is_correct' => true],
                    ['content' => 'Piotr Żyła', 'is_correct' => false],
                    ['content' => 'Dawid Kubacki', 'is_correct' => false],
                    ['content' => 'Robert Mateja', 'is_correct' => false],
                ]
            ],
            [
                'content' => 'Jak nazywa się największa skocznia narciarska w Słowenii?',
                'answers' => [
                    ['content' => 'Vikersund', 'is_correct' => false],
                    ['content' => 'Planica (Letalnica)', 'is_correct' => true],
                    ['content' => 'Zakopane', 'is_correct' => false],
                    ['content' => 'Kulm', 'is_correct' => false],
                ]
            ],
            [
                'content' => 'Kto wprowadził styl "V" w skokach narciarskich?',
                'answers' => [
                    ['content' => 'Walter Hofer', 'is_correct' => false],
                    ['content' => 'Jens Weißflog', 'is_correct' => false],
                    ['content' => 'Jan Boklöv', 'is_correct' => true],
                    ['content' => 'Eddie "The Eagle" Edwards', 'is_correct' => false],
                ]
            ],
            [
                'content' => 'Ile indywidualnych złotych medali olimpijskich zdobył Kamil Stoch?',
                'answers' => [
                    ['content' => 'Jeden', 'is_correct' => false],
                    ['content' => 'Dwa', 'is_correct' => false],
                    ['content' => 'Trzy', 'is_correct' => true],
                    ['content' => 'Cztery', 'is_correct' => false],
                ]
            ],
            [
                'content' => 'Co oznacza punkt "K" na skoczni?',
                'answers' => [
                    ['content' => 'Punkt krytyczny', 'is_correct' => false],
                    ['content' => 'Punkt konstrukcyjny', 'is_correct' => true],
                    ['content' => 'Koniec rozbiegu', 'is_correct' => false],
                    ['content' => 'Punkt lądowania sędziów', 'is_correct' => false],
                ]
            ],
        ];

        foreach ($questionsData1 as $qData) {
            $question = $quiz1->questions()->create(['content' => $qData['content']]);
            foreach ($qData['answers'] as $aData) {
                $question->answers()->create($aData);
            }
        }

        // ==========================================
        // QUIZ 2: Polskie Skocznie (NOWY)
        // ==========================================
        $quiz2 = Quiz::create([
            'title' => 'Polskie Skocznie Narciarskie',
            'description' => 'Test wiedzy o obiektach w Wiśle, Zakopanem, Szczyrku i Karpaczu.',
        ]);

        $questionsData2 = [
            [
                'content' => 'Jak nazywa się duża skocznia w Zakopanem?',
                'answers' => [
                    ['content' => 'Wielka Krokiew', 'is_correct' => true],
                    ['content' => 'Średnia Krokiew', 'is_correct' => false],
                    ['content' => 'Mała Krokiew', 'is_correct' => false],
                ]
            ],
            [
                'content' => 'Która skocznia nosi imię Adama Małysza?',
                'answers' => [
                    ['content' => 'Skocznia w Zakopanem', 'is_correct' => false],
                    ['content' => 'Skocznia w Wiśle-Malince', 'is_correct' => true],
                    ['content' => 'Skocznia w Szczyrku', 'is_correct' => false],
                ]
            ],
            [
                'content' => 'W jakim mieście znajduje się kompleks skoczni "Skalite"?',
                'answers' => [
                    ['content' => 'W Wiśle', 'is_correct' => false],
                    ['content' => 'W Szczyrku', 'is_correct' => true],
                    ['content' => 'W Poroninie', 'is_correct' => false],
                ]
            ],
            [
                'content' => 'Gdzie znajduje się nieczynna już skocznia "Orlinek"?',
                'answers' => [
                    ['content' => 'W Karpaczu', 'is_correct' => true],
                    ['content' => 'W Gdańsku', 'is_correct' => false],
                    ['content' => 'W Białymstoku', 'is_correct' => false],
                ]
            ],
        ];

        foreach ($questionsData2 as $qData) {
            $question = $quiz2->questions()->create(['content' => $qData['content']]);
            foreach ($qData['answers'] as $aData) {
                $question->answers()->create($aData);
            }
        }
    }
}