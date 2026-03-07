@extends('layouts.app')

@section('content')
  <p class="text-4xl">ゲーム一覧</p>
  <p><a href="{{ route('games.create') }}" class="btn btn-neutral">＋ 新規登録</a></p>

  @php
    $h = intdiv($totalMinutes, 60);
    $m = $totalMinutes % 60;
  @endphp

  <div style="margin:15px; padding:10px; background:#f0f9ff;">
    🎮 総プレイ時間：
    @if($h > 0) {{ $h }}時間 @endif
    @if($m > 0) {{ $m }}分 @endif
  </div>

  <div style="margin:15px; padding:10px; background:#7fffd4; border-radius:5px;">

    <strong>総ゲーム数：{{ $totalGames }}本</strong><br>

    プレイ状況：

    未プレイ：{{ $statusCounts['unplayed'] ?? 0 }}本

    プレイ中：{{ $statusCounts['playing'] ?? 0 }}本

    クリア済み：{{ $statusCounts['cleared'] ?? 0 }}本
  </div>

  <div style="margin:15px;">
    <div style="margin:6px;">
      🏆 クリア率：{{ $clearRate }}%
    </div>

    <div style="width: 320px; max-width: 100%; background: #e5e7eb; border-radius: 9999px; overflow: hidden;">
      <div style="width: {{ $clearRate }}%; background: #22c55e; padding: 6px 0;"></div>
    </div>
  </div>

  <div style="margin:15px;">
    <a href="{{ route('games.index') }}">すべて</a> |

    <a href="{{ route('games.index', ['status'=>'unplayed']) }}">
      未プレイ
    </a> |

    <a href="{{ route('games.index', ['status'=>'playing']) }}">
      プレイ中
    </a> |

    <a href="{{ route('games.index', ['status'=>'cleared']) }}">
      クリア済み
    </a>
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

  <div style="margin:15px; font-weight:bold; color:#f59e0b;">
    称号：{{ $title }}
  </div>

  @if ($games->isEmpty())
    <p>まだ登録がありません。</p>
  @else
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
      @foreach ($games as $game)
        <div class="card w-96 bg-base-100 card-lg shadow-sm m-8">
          <div class="card-body">
            <h2 class="card-title">
              <a href="{{ route('games.show', $game) }}" class="link link-hover">
                @if($game->status === 'cleared')
                  🏆
                @endif
                {{ $game->title }}
              </a>
            </h2>

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

            <div x-data="{ open: false }">
              <button type="button" @click="open = !open">
                <span x-text="open ? 'レビューを閉じる' : 'レビューを見る'"></span>
              </button>
              <div x-show="open" x-transition style="margin:6px;">
                {{ $game->review }}
              </div>
            </div>

            <div class="card-actions justify-end">
              <a href="{{ route('games.edit', $game) }}" class="btn btn-outline btn-success">編集</a>

              <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('この記録を削除しますか？')" class="btn btn-outline btn-error">削除</button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
  </div>
  @endif
@endsection
