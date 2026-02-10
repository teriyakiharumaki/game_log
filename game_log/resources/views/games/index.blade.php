@extends('layouts.app')

@section('content')
  <h2>ゲーム一覧</h2>
  <p><a href="{{ route('games.create') }}">＋ 新規登録</a></p>

  @if ($games->isEmpty())
    <p>まだ登録がありません。</p>
  @else
    <ul>
      @foreach ($games as $game)
        <li>
          <strong>{{ $game->title }}</strong>
          @if($game->platform)（{{ $game->platform }}）@endif

          @if($game->rating)
            - {{ str_repeat('★', $game->rating) }}{{ str_repeat('☆', 5 - $game->rating) }}
          @endif

          - {{ ['unplayed'=>'未プレイ','playing'=>'プレイ中','cleared'=>'クリア済み'][$game->status] ?? $game->status }}
        </li>
      @endforeach
    </ul>
  @endif
@endsection
