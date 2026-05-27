<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'code', 'flag_emoji', 'confederation'];

    public function groupTeam()
    {
        return $this->hasOne(GroupTeam::class);
    }

    public function homeMatches()
    {
        return $this->hasMany(WorldCupMatch::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(WorldCupMatch::class, 'away_team_id');
    }
}
