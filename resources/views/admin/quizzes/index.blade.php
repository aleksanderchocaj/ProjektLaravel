<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Zarządzanie Quizami
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="container">
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mb-3">
                        <h3>Lista Quizów</h3>
                        <a href="{{ route('admin.quizzes.create') }}" class="btn btn-primary">Dodaj nowy Quiz</a>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tytuł</th>
                                <th>Opis</th>
                                <th>Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                                <tr>
                                    <td>{{ $quiz->id }}</td>
                                    <td>{{ $quiz->title }}</td>
                                    <td>{{Str::limit($quiz->description, 50)}}</td>
                                    <td>
                                        <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="btn btn-sm btn-warning">Edytuj</a>
                                        
                                        <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" class="d-inline" onsubmit="return confirm('Czy na pewno usunąć ten quiz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Usuń</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>