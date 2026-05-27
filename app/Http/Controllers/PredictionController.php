<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use App\Models\WorldCupMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PredictionController extends Controller
{
    public function upsert(Request $request, WorldCupMatch $match)
    {
        if (! $match->canPredict()) {
            return back()->withErrors(['match' => 'Palpite não permitido para esta partida.']);
        }

        $validated = $request->validate([
            'home_score' => 'required|integer|min:0|max:30',
            'away_score' => 'required|integer|min:0|max:30',
        ]);

        Prediction::updateOrCreate(
            ['user_id' => Auth::id(), 'match_id' => $match->id],
            $validated
        );

        return back();
    }
}

