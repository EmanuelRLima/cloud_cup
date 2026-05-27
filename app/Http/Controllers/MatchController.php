<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use App\Models\WorldCupGroup;
use App\Models\WorldCupMatch;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MatchController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $groups = WorldCupGroup::with(['teams', 'matches.homeTeam', 'matches.awayTeam'])
            ->orderBy('name')
            ->get()
            ->map(function ($group) use ($userId) {
                $group->matches->each(function ($match) use ($userId) {
                    $match->user_prediction = $match->predictions()
                        ->where('user_id', $userId)
                        ->first(['home_score', 'away_score', 'points']);
                });
                return $group;
            });

        $knockoutStages = ['r32', 'r16', 'qf', 'sf', '3rd', 'final'];
        $knockout = [];

        foreach ($knockoutStages as $stage) {
            $matches = WorldCupMatch::with(['homeTeam', 'awayTeam'])
                ->where('stage', $stage)
                ->orderBy('match_number')
                ->get()
                ->map(function ($match) use ($userId) {
                    $match->user_prediction = $match->predictions()
                        ->where('user_id', $userId)
                        ->first(['home_score', 'away_score', 'points']);
                    return $match;
                });

            $knockout[$stage] = $matches;
        }

        return Inertia::render('Matches/Index', [
            'groups'  => $groups,
            'knockout' => $knockout,
        ]);
    }
}

