<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderByDesc('id')->get();
        return view('games.index', compact('games'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'platform' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:unplayed,playing,cleared'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'review' => ['nullable', 'string'],
            'price' => ['nullable', 'integer', 'min:0'],
            'condition' => ['nullable', 'in:new,used'],
            'play_time_minutes' => ['nullable', 'integer', 'min:0'],
            'purchased_at' => ['nullable', 'date'],
            'cleared_at' => ['nullable', 'date'],
        ]);

        Game::create($validated);

        return redirect()->route('games.index');
    }
}
