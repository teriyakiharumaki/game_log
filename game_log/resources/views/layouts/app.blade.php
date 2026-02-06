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
      @yield('content')
    </main>
  </body>
</html>
