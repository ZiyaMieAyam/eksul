<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Mr Profesor')</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>

<body>

    {{-- NAVBAR: HANYA UNTUK SISWA --}}
    @if(Auth::check() && Auth::user()->role === 'siswa')
        @include('partials.navbarsiswa')
    @endif

    <div class="app-layout">
        
        {{-- SIDEBAR: HANYA UNTUK GURU & PEMBINA --}}
        @auth
            @if(Auth::user()->role === 'guru')
                @include('partials.sidebarg')
            @elseif(Auth::user()->role === 'pembina')
                @include('partials.sidebarp')
            @endif
        @endauth

        {{-- MAIN CONTENT --}}
        <main class="main-content">
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- show success popup --}}
    @if(session('success'))
        <script>
            (function() {
                const msg = @json(session('success'));
                setTimeout(() => { alert(msg); }, 150);
            })();
        </script>
    @endif

</body>
</html>
