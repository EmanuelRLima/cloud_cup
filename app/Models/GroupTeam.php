<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupTeam extends Model
{
    protected $fillable = ['world_cup_group_id', 'team_id', 'final_position'];

    public function group()
    {
        return $this->belongsTo(WorldCupGroup::class, 'world_cup_group_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
