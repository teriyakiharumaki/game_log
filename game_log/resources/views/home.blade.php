@extends('layouts.app')

@section('title', 'トップページ')

@section('content')
  <div class="hero min-h-screen">
    <div class="hero-content text-center">
      <div class="max-w-md">
        <h1 class="text-5xl font-bold">GAME LOG</h1>
        <p class="py-6">
          ゲームのレビューを記録するアプリです。
        </p>
        <a href="{{ route('games.index') }}" class="btn btn-primary">
          ゲーム一覧
        </a>
      </div>
    </div>
  </div>
@endsection
