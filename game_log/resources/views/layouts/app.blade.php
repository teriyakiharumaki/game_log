<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Game Log')</title>
  </head>
  <body>
    
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
