<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Wynik Quizu: {{ $quiz->title }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="container text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-4">Twój wynik</h3>
                            
                            @php
                                $percentage = ($points / $total) * 100;
                                $alertType = $percentage >= 50 ? 'alert-success' : 'alert-danger';
                                $message = $percentage >= 50 ? 'Gratulacje! Zdałeś.' : 'Niestety, musisz jeszcze poćwiczyć.';
                            @endphp

                            <div class="alert {{ $alertType }} display-4">
                                {{ $points }} / {{ $total }}
                            </div>

                            <p class="lead">{{ $message }}</p>

                            <hr>
                            
                            <a href="{{ route('quizzes.index') }}" class="btn btn-primary mt-3">Wróć do listy quizów</a>
                            <a href="{{ route('quizzes.show', $quiz) }}" class="btn btn-outline-secondary mt-3">Spróbuj ponownie</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>