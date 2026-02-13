@extends('layouts.app')

@section('content')
  <h2>ゲーム登録</h2>

  @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  <form method="POST" action="{{ route('games.store') }}">
    @csrf

    <div>
      <label>ゲーム名 *</label><br>
      <input type="text" name="title" value="{{ old('title') }}" required>
    </div>

    <div>
      <label>プラットフォーム</label><br>
      <input type="text" name="platform" value="{{ old('platform') }}">
    </div>

    <div>
      <label>ステータス *</label><br>
      <select name="status" required>
        <option value="unplayed" @selected(old('status','unplayed')==='unplayed')>未プレイ</option>
        <option value="playing"  @selected(old('status')==='playing')>プレイ中</option>
        <option value="cleared"  @selected(old('status')==='cleared')>クリア済み</option>
      </select>
    </div>

    <div>
      <label>評価（1〜5）</label><br>
      <input type="number" name="rating" min="1" max="5" value="{{ old('rating') }}">
    </div>

    <div>
      <label>感想</label><br>
      <textarea name="review">{{ old('review') }}</textarea>
    </div>

    <div>
      <label>プレイ時間</label><br>

      <input type="number" name="play_time_hours" min="0" 
            value="{{ old('play_time_hours') }}" style="width:80px;">
      時間

      <input type="number" name="play_time_minutes_part" min="0" max="59"
            value="{{ old('play_time_minutes_part') }}" style="width:80px;">
      分
    </div>

    <button type="submit">登録</button>
  </form>

  <p><a href="{{ route('games.index') }}">← 一覧へ戻る</a></p>
@endsection
