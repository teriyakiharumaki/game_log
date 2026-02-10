@extends('layouts.app')

@section('title', 'トップページ')

@section('content')
  <p>ゲームのレビューを記録するアプリです。</p>

  <a href="{{ route('games.index') }}">
    ゲーム一覧を見る →
  </a>
@endsection
