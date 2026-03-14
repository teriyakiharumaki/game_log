@extends('layouts.app')

@section('content')
  <div class="max-w-3xl mx-auto">
    <div class="card bg-base-100 shadow-xl border border-base-200">
      <div class="card-body">
        <h2 class="card-title text-2xl">🎮 ゲーム編集</h2>

        @if ($errors->any())
          <div class="alert alert-error mt-2">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @php
          $total = old('play_time_hours') !== null || old('play_time_minutes_part') !== null
            ? null
            : ($game->play_time_minutes ?? 0);

          $defaultHours = $total !== null ? intdiv($total, 60) : null;
          $defaultMinutes = $total !== null ? ($total % 60) : null;
        @endphp

        <form method="POST" action="{{ route('games.update', $game) }}" class="space-y-5">
          @csrf
          @method('PUT')

          <div class="form-control">
            <label class="label">
              <span class="label-text font-bold">ゲーム名</span>
            </label>
            <input
              type="text"
              name="title"
              value="{{ old('title', $game->title) }}"
              required
              class="input input-bordered w-full"
            >
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text font-bold">プラットフォーム</span>
            </label>
            <input
              type="text"
              name="platform"
              value="{{ old('platform', $game->platform) }}"
              class="input input-bordered w-full"
            >
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text font-bold">プレイ状況</span>
            </label>
            <select name="status" required class="select select-bordered w-full">
              <option value="unplayed" @selected(old('status', $game->status) === 'unplayed')>未プレイ</option>
              <option value="playing" @selected(old('status', $game->status) === 'playing')>プレイ中</option>
              <option value="cleared" @selected(old('status', $game->status) === 'cleared')>クリア済み</option>
            </select>
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text font-bold">評価（1〜5）</span>
            </label>
            <input
              type="number"
              name="rating"
              min="1"
              max="5"
              value="{{ old('rating', $game->rating) }}"
              class="input input-bordered w-full"
            >
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text font-bold">感想</span>
            </label>
            <textarea
              name="review"
              rows="5"
              class="textarea textarea-bordered w-full"
            >{{ old('review', $game->review) }}</textarea>
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text font-bold">プレイ時間</span>
            </label>
            <div class="flex items-center gap-3">
              <input
                type="number"
                name="play_time_hours"
                min="0"
                value="{{ old('play_time_hours', $defaultHours) }}"
                class="input input-bordered w-24"
              >
              <span>時間</span>

              <input
                type="number"
                name="play_time_minutes_part"
                min="0"
                max="59"
                value="{{ old('play_time_minutes_part', $defaultMinutes) }}"
                class="input input-bordered w-24"
              >
              <span>分</span>
            </div>
          </div>

          <div class="card-actions justify-end pt-4">
            <a href="{{ route('games.index') }}" class="btn btn-outline">
              ← 一覧へ戻る
            </a>
            <button type="submit" class="btn btn-primary">
              更新
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection