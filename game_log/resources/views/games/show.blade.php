@extends('layouts.app')

@section('content')
  <div class="max-w-3xl mx-auto">
    <div class="card bg-base-100 shadow-xl border border-base-200 m-8">
      <div class="card-body">
        <h2 class="card-title text-2xl">
          {{ $game->title }}
        </h2>

        <div class="divider my-1"></div>

        <div class="grid gap-3 sm:grid-cols-2">
          <div>
            <span class="font-bold">プラットフォーム：</span>
            <span>{{ $game->platform ?: '未登録' }}</span>
          </div>

          <div>
            <span class="font-bold">評価：</span>
            <span>
              @if($game->rating)
                {{ str_repeat('★', $game->rating) }}{{ str_repeat('☆', 5 - $game->rating) }}
              @else
                未登録
              @endif
            </span>
          </div>

          <div>
            <span class="font-bold">ステータス：</span>
            @if($game->status === 'unplayed')
              <span class="badge badge-neutral">未プレイ</span>
            @elseif($game->status === 'playing')
              <span class="badge badge-warning">プレイ中</span>
            @else
              <span class="badge badge-success">クリア済み</span>
            @endif
          </div>

          <div>
            <span class="font-bold">プレイ時間：</span>
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
            @else
              未登録
            @endif
          </div>
        </div>

        <div class="mt-4">
          <p class="font-bold mb-2">感想</p>
          <div class="bg-base-200 rounded-lg p-4 whitespace-pre-wrap">
            {{ $game->review ?: '感想はまだありません。' }}
          </div>
        </div>

        <div class="card-actions justify-end mt-6">
          <a href="{{ route('games.index') }}" class="btn btn-outline">
            ← 一覧へ戻る
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection