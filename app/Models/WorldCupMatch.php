<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorldCupMatch extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'home_team_id', 'away_team_id', 'home_placeholder', 'away_placeholder',
        'world_cup_group_id', 'stage', 'match_number', 'scheduled_at',
        'venue', 'city', 'home_score', 'away_score',
        'home_score_et', 'away_score_et', 'home_penalties', 'away_penalties', 'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function group()
    {
        return $this->belongsTo(WorldCupGroup::class, 'world_cup_group_id');
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class, 'match_id');
    }

    public function getStageNameAttribute(): string
    {
        return match($this->stage) {
            'group' => 'Fase de Grupos',
            'r32'   => '32 Avos de Final',
            'r16'   => '16 Avos de Final',
            'qf'    => 'Quartas de Final',
            'sf'    => 'Semifinal',
            '3rd'   => 'Disputa de 3º Lugar',
            'final' => 'Final',
        };
    }

    public function isFinished(): bool
    {
        return $this->status === 'finished';
    }

    public function canPredict(): bool
    {
        return $this->status === 'scheduled'
            && $this->home_team_id !== null
            && $this->away_team_id !== null;
    }
}
