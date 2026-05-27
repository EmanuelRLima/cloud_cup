<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = ['user_id', 'match_id', 'home_score', 'away_score', 'points'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function match()
    {
        return $this->belongsTo(WorldCupMatch::class, 'match_id');
    }

    public function calculatePoints(): int
    {
        $match = $this->match;

        if (! $match->isFinished()) {
            return 0;
        }

        $realHome = $match->home_score;
        $realAway = $match->away_score;

        // Placar exato
        if ($this->home_score === $realHome && $this->away_score === $realAway) {
            return 10;
        }

        // Resultado certo (vitória, empate)
        $predictedResult = $this->home_score <=> $this->away_score;
        $realResult = $realHome <=> $realAway;

        if ($predictedResult === $realResult) {
            return 5;
        }

        return 0;
    }
}
