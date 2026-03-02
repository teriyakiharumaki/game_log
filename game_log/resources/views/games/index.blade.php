@extends('layouts.app')

@section('content')
  <h2>ゲーム一覧</h2>
  <p><a href="{{ route('games.create') }}">＋ 新規登録</a></p>

  @php
    $h = intdiv($totalMinutes, 60);
    $m = $totalMinutes % 60;
  @endphp

  <div style="margin-bottom:15px; padding:10px; background:#f0f9ff;">
    🎮 総プレイ時間：
    @if($h > 0) {{ $h }}時間 @endif
    @if($m > 0) {{ $m }}分 @endif
  </div>

  <div style="margin-bottom:15px; padding:10px; background:#7fffd4; border-radius:5px;">
    プレイ状況：

    未プレイ：{{ $statusCounts['unplayed'] ?? 0 }}件

    プレイ中：{{ $statusCounts['playing'] ?? 0 }}件

    クリア済み：{{ $statusCounts['cleared'] ?? 0 }}件
  </div>

  <div style="margin-bottom:15px;">
    <div style="margin-bottom:6px;">
      🏆 クリア率：{{ $clearRate }}%
    </div>

    <div style="width: 320px; max-width: 100%; background: #e5e7eb; border-radius: 9999px; overflow: hidden;">
      <div style="width: {{ $clearRate }}%; background: #22c55e; padding: 6px 0;"></div>
    </div>
  </div>

  @php
    if ($clearRate < 20) {
      $title = '積みゲーマー';
    } elseif ($clearRate < 60) {
      $title = '冒険中ゲーマー';
    } elseif ($clearRate < 90) {
      $title = 'クリア職人';
    } else {
      $title = 'コンプリート勢';
    }
  @endphp

  <div style="margin-top:8px; font-weight:bold; color:#f59e0b;">
    称号：{{ $title }}
  </div>

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
