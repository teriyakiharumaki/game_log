<!doctype html>
<html lang="ja" data-theme="retro">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <title>@yield('title', 'Game Log')</title>
  </head>
  <body class="bg-base-200 text-base-content min-h-screen">
    
    @include('partials.header')

    <main>
      @if(session('success'))
        <div style="
            background:#e6fffa;
            border:1px solid #38b2ac;
            padding:10px;
            margin-bottom:15px;
            border-radius:5px;
        ">
            {{ session('success') }}
        </div>
      @endif

      @yield('content')
    </main>
  </body>
</html>
