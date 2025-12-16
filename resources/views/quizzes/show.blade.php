<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $quiz->title }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="container">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('quizzes.check', $quiz) }}" method="POST">
                        @csrf
                        
                        @foreach($quiz->questions as $index => $question)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <strong>Pytanie {{ $index + 1 }}:</strong> {{ $question->content }}
                                </div>
                                <div class="card-body">
                                    @foreach($question->answers as $answer)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                   name="answers[{{ $question->id }}]" 
                                                   value="{{ $answer->id }}" 
                                                   id="answer_{{ $answer->id }}">
                                            <label class="form-check-label" for="answer_{{ $answer->id }}">
                                                {{ $answer->content }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-success btn-lg">Zakończ i sprawdź wynik</button>
                        <a href="{{ route('quizzes.index') }}" class="btn btn-secondary btn-lg">Wróć</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>