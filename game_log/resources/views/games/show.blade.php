@extends('layouts.app')

@section('content')
  <h2>{{ $game->title }}</h2>

  <p>プラットフォーム：{{ $game->platform }}</p>
  <p>評価：{{ $game->rating }}</p>

  <p>ステータス：
    @if($game->status === 'unplayed')
      未プレイ
    @elseif($game->status === 'playing')
      プレイ中
    @else
      クリア済み
    @endif
  </p>

  <p>感想：</p>
  <div>
    {{ $game->review }}
  </div>

  <p><a href="{{ route('games.index') }}">← 一覧へ戻る</a></p>
@endsection