<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prediction;
use App\Models\WorldCupMatch;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MatchResultController extends Controller
{
    public function index()
    {
        $matches = WorldCupMatch::with(['homeTeam', 'awayTeam', 'group'])
            ->orderBy('match_number')
            ->get();

        return Inertia::render('Admin/Matches', ['matches' => $matches]);
    }

    public function update(Request $request, WorldCupMatch $match)
    {
        $validated = $request->validate([
            'home_score'    => 'required|integer|min:0|max:30',
            'away_score'    => 'required|integer|min:0|max:30',
            'home_score_et' => 'nullable|integer|min:0|max:30',
            'away_score_et' => 'nullable|integer|min:0|max:30',
            'home_penalties' => 'nullable|integer|min:0|max:30',
            'away_penalties' => 'nullable|integer|min:0|max:30',
            'status'        => 'required|in:scheduled,live,finished',
        ]);

        $match->update($validated);

        if ($match->status === 'finished') {
            $this->calculatePoints($match);
        }

        return back()->with('success', 'Resultado atualizado!');
    }

    private function calculatePoints(WorldCupMatch $match): void
    {
        $predictions = $match->predictions()->get();

        foreach ($predictions as $prediction) {
            $points = $prediction->calculatePoints();
            $prediction->update(['points' => $points]);
        }
    }
}

