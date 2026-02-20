<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::latest()->get();
        return view('games.index', compact('games'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index');
    }


    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'platform' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:unplayed,playing,cleared'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'review' => ['nullable', 'string'],
            'play_time_hours' => ['nullable', 'integer', 'min:0'],
            'play_time_minutes_part' => ['nullable', 'integer', 'min:0', 'max:59'],
        ]);

        $hours = (int) ($validated['play_time_hours'] ?? 0);
        $minutes = (int) ($validated['play_time_minutes_part'] ?? 0);
        $validated['play_time_minutes'] = $hours * 60 + $minutes;

        unset($validated['play_time_hours'], $validated['play_time_minutes_part']);

        $game->update($validated);

        return redirect()->route('games.index');
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

        $hours = (int) $request->input('play_time_hours', 0);
        $minutes = (int) $request->input('play_time_minutes_part', 0);

        $validated['play_time_minutes'] = $hours * 60 + $minutes;

        Game::create($validated);

        return redirect()->route('games.index');
    }
}
