<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorldCupGroup extends Model
{
    protected $fillable = ['name'];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'group_teams')
            ->withPivot('final_position')
            ->withTimestamps();
    }

    public function groupTeams()
    {
        return $this->hasMany(GroupTeam::class);
    }

    public function matches()
    {
        return $this->hasMany(WorldCupMatch::class);
    }
}
