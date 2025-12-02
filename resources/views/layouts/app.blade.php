<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    @include('partials.sidebarg')

    <div class="app-content" style="margin-left: var(--sidebar-collapsed-width); transition: margin-left 0.25s ease; padding: 24px;">
        @yield('content')
    </div>

    <script>
    (function(){
        const aside = document.querySelector('aside.sidebar');
        const app = document.querySelector('.app-content');
        if(!aside || !app) return;
        const root = document.documentElement;
        const collapsed = getComputedStyle(root).getPropertyValue('--sidebar-collapsed-width').trim() || '5rem';
        const expanded  = getComputedStyle(root).getPropertyValue('--sidebar-expanded-width').trim() || '16rem';
        aside.addEventListener('mouseenter', ()=> app.style.marginLeft = expanded);
        aside.addEventListener('mouseleave', ()=> app.style.marginLeft = collapsed);
    })();
    </script>
</body>
</html>
