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
          <a href="{{ route('games.show', $game) }}">
            {{ $game->title }}
          </a>

          @if($game->platform)（{{ $game->platform }}）@endif

          @if($game->rating)
            - {{ str_repeat('★', $game->rating) }}{{ str_repeat('☆', 5 - $game->rating) }}
          @endif

          @if($game->status === 'unplayed')
            <span style="color: gray;">未プレイ</span>
          @elseif($game->status === 'playing')
            <span style="color: orange;">プレイ中</span>
          @elseif($game->status === 'cleared')
            <span style="color: green;">クリア済み</span>
          @else
            <span>{{ $game->status }}</span>
          @endif

          @if($game->play_time_minutes)
            @php
              $h = intdiv($game->play_time_minutes, 60);
              $m = $game->play_time_minutes % 60;
            @endphp
            
            @if($h > 0)
              {{ $h }}時間
            @endif

            @if($m > 0)
              {{ $m }}分
            @endif
          @endif

          <a href="{{ route('games.edit', $game) }}">編集</a>

          <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('この記録を削除しますか？')">削除</button>
          </form>
        </li>
      @endforeach
    </ul>
  @endif
@endsection
