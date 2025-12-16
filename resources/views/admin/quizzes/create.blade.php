<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Stwórz kompletny Quiz</h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
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

                    <form action="{{ route('admin.quizzes.store') }}" method="POST">
                        @csrf
                        
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">Dane podstawowe</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Tytuł</label>
                                    <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                                </div>
                                <div class="mb-3">
                                    <label>Opis</label>
                                    <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div id="questions-container"></div>

                        <button type="button" class="btn btn-info text-white mb-3" onclick="addQuestion()">+ Dodaj Pytanie</button>
                        
                        <hr>
                        <button type="submit" class="btn btn-success btn-lg">Zapisz cały Quiz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let questionIndex = 0;

        function addQuestion() {
            const container = document.getElementById('questions-container');
            
            const html = `
            <div class="card mb-4 border-secondary" id="question-row-${questionIndex}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span>Pytanie #${questionIndex + 1}</span>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeQuestion(${questionIndex})">Usuń</button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Treść pytania:</label>
                        <input type="text" name="questions[${questionIndex}][content]" class="form-control" required placeholder="np. Kto wygrał w 2002 roku?">
                    </div>
                    
                    <label>Odpowiedzi (zaznacz kółkiem poprawną):</label>
                    <div class="row">
                        ${generateAnswerField(questionIndex, 0)}
                        ${generateAnswerField(questionIndex, 1)}
                        ${generateAnswerField(questionIndex, 2)}
                        ${generateAnswerField(questionIndex, 3)}
                    </div>
                </div>
            </div>
            `;
            
            container.insertAdjacentHTML('beforeend', html);
            questionIndex++;
        }

        function generateAnswerField(qIdx, aIdx) {
            return `
            <div class="col-md-6 mb-2">
                <div class="input-group">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" required 
                               name="questions[${qIdx}][correct_answer_index]" 
                               value="${aIdx}">
                    </div>
                    <input type="text" class="form-control" required 
                           name="questions[${qIdx}][answers][${aIdx}][content]" 
                           placeholder="Odpowiedź ${aIdx + 1}">
                </div>
            </div>
            `;
        }

        function removeQuestion(index) {
            document.getElementById(`question-row-${index}`).remove();
        }

        // Dodaj jedno pytanie na start
        document.addEventListener('DOMContentLoaded', function() {
            addQuestion();
        });
    </script>
</x-app-layout>