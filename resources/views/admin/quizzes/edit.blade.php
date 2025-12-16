<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edytuj Quiz</h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="container">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">Błędy w formularzu. Sprawdź pola.</div>
                    @endif

                    <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-dark">Dane podstawowe</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Tytuł</label>
                                    <input type="text" name="title" class="form-control" required value="{{ old('title', $quiz->title) }}">
                                </div>
                                <div class="mb-3">
                                    <label>Opis</label>
                                    <textarea name="description" class="form-control" required>{{ old('description', $quiz->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div id="questions-container"></div>

                        <button type="button" class="btn btn-info text-white mb-3" onclick="addQuestion()">+ Dodaj Pytanie</button>
                        
                        <hr>
                        <button type="submit" class="btn btn-success btn-lg">Zaktualizuj Quiz</button>
                        <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary btn-lg">Anuluj</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let questionIndex = 0;

        function addQuestion(content = '', answers = []) {
            const container = document.getElementById('questions-container');
            
            if (answers.length === 0) {
                for(let i=0; i<4; i++) answers.push({content: '', is_correct: 0});
            }

            // Generowanie pól odpowiedzi
            let answersHtml = '';
            answers.forEach((ans, idx) => {
                const checked = ans.is_correct ? 'checked' : '';
                const val = ans.content.replace(/"/g, '&quot;');
                
                answersHtml += `
                <div class="col-md-6 mb-2">
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" type="radio" required 
                                   name="questions[${questionIndex}][correct_answer_index]" 
                                   value="${idx}" ${checked}>
                        </div>
                        <input type="text" class="form-control" required 
                               name="questions[${questionIndex}][answers][${idx}][content]" 
                               value="${val}"
                               placeholder="Odpowiedź ${idx + 1}">
                    </div>
                </div>`;
            });

            const html = `
            <div class="card mb-4 border-secondary" id="question-row-${questionIndex}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span>Pytanie</span>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeQuestion(${questionIndex})">Usuń</button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Treść pytania:</label>
                        <input type="text" name="questions[${questionIndex}][content]" 
                               class="form-control" required 
                               value="${content.replace(/"/g, '&quot;')}"
                               placeholder="Treść pytania">
                    </div>
                    <div class="row">
                        ${answersHtml}
                    </div>
                </div>
            </div>
            `;
            
            container.insertAdjacentHTML('beforeend', html);
            questionIndex++;
        }

        function removeQuestion(index) {
            document.getElementById(`question-row-${index}`).remove();
        }

        // Ładowanie danych z backendu do JS
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($quiz->questions as $question)
                addQuestion(
                    "{!! addslashes($question->content) !!}", 
                    @json($question->answers)
                );
            @endforeach
        });
    </script>
</x-app-layout>