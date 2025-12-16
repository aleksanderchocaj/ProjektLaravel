<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quizy o Skokach Narciarskich</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        
        <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
            <div class="card shadow-lg p-5 text-center" style="max-width: 600px;">
                <h1 class="mb-4">🎿 Quizy Narciarskie</h1>
                
                <p class="lead mb-5">
                    Witaj na stronie poświęconej quizom o skokach narciarskich, 
                    utwórz konto lub zaloguj się, aby móc rozwiązać quizy.
                </p>

                <div class="d-grid gap-2 col-8 mx-auto">
                    @if (Route::has('login'))
                        @auth
                            <div class="alert alert-info">
                                Jesteś już zalogowany jako <strong>{{ Auth::user()->name }}</strong>.
                            </div>
                            <a href="{{ url('/quizzes') }}" class="btn btn-primary btn-lg">Przejdź do Quizów</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Zaloguj się</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg">Utwórz konto</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
            
            <footer class="mt-5 text-muted">
                &copy; {{ date('Y') }} Projekt Zaliczeniowy - Programowanie Zaawansowane
            </footer>
        </div>

    </body>
</html>