<?php

namespace Database\Seeders;

use App\Models\GroupTeam;
use App\Models\Team;
use App\Models\WorldCupGroup;
use App\Models\WorldCupMatch;
use Illuminate\Database\Seeder;

class WorldCupSeeder extends Seeder
{
    public function run(): void
    {
        // 48 teams, 12 groups (A-L) — FIFA World Cup 2026
        $groupsData = [
            'A' => [
                ['name' => 'México',       'code' => 'MEX', 'flag' => '🇲🇽', 'conf' => 'CONCACAF'],
                ['name' => 'Equador',      'code' => 'ECU', 'flag' => '🇪🇨', 'conf' => 'CONMEBOL'],
                ['name' => 'Alemanha',     'code' => 'GER', 'flag' => '🇩🇪', 'conf' => 'UEFA'],
                ['name' => 'Arábia Saudita','code'=> 'KSA', 'flag' => '🇸🇦', 'conf' => 'AFC'],
            ],
            'B' => [
                ['name' => 'Espanha',      'code' => 'ESP', 'flag' => '🇪🇸', 'conf' => 'UEFA'],
                ['name' => 'Chile',        'code' => 'CHI', 'flag' => '🇨🇱', 'conf' => 'CONMEBOL'],
                ['name' => 'Japão',        'code' => 'JPN', 'flag' => '🇯🇵', 'conf' => 'AFC'],
                ['name' => 'Camarões',     'code' => 'CMR', 'flag' => '🇨🇲', 'conf' => 'CAF'],
            ],
            'C' => [
                ['name' => 'EUA',          'code' => 'USA', 'flag' => '🇺🇸', 'conf' => 'CONCACAF'],
                ['name' => 'Argentina',    'code' => 'ARG', 'flag' => '🇦🇷', 'conf' => 'CONMEBOL'],
                ['name' => 'França',       'code' => 'FRA', 'flag' => '🇫🇷', 'conf' => 'UEFA'],
                ['name' => 'Austrália',    'code' => 'AUS', 'flag' => '🇦🇺', 'conf' => 'AFC'],
            ],
            'D' => [
                ['name' => 'Canadá',       'code' => 'CAN', 'flag' => '🇨🇦', 'conf' => 'CONCACAF'],
                ['name' => 'Colômbia',     'code' => 'COL', 'flag' => '🇨🇴', 'conf' => 'CONMEBOL'],
                ['name' => 'Inglaterra',   'code' => 'ENG', 'flag' => '🏴󠁧󠁢󠁥󠁮󠁧󠁿', 'conf' => 'UEFA'],
                ['name' => 'Marrocos',     'code' => 'MAR', 'flag' => '🇲🇦', 'conf' => 'CAF'],
            ],
            'E' => [
                ['name' => 'Brasil',       'code' => 'BRA', 'flag' => '🇧🇷', 'conf' => 'CONMEBOL'],
                ['name' => 'Países Baixos','code' => 'NED', 'flag' => '🇳🇱', 'conf' => 'UEFA'],
                ['name' => 'Coreia do Sul','code' => 'KOR', 'flag' => '🇰🇷', 'conf' => 'AFC'],
                ['name' => 'Costa Rica',   'code' => 'CRC', 'flag' => '🇨🇷', 'conf' => 'CONCACAF'],
            ],
            'F' => [
                ['name' => 'Uruguai',      'code' => 'URU', 'flag' => '🇺🇾', 'conf' => 'CONMEBOL'],
                ['name' => 'Portugal',     'code' => 'POR', 'flag' => '🇵🇹', 'conf' => 'UEFA'],
                ['name' => 'Irã',          'code' => 'IRN', 'flag' => '🇮🇷', 'conf' => 'AFC'],
                ['name' => 'Senegal',      'code' => 'SEN', 'flag' => '🇸🇳', 'conf' => 'CAF'],
            ],
            'G' => [
                ['name' => 'Bélgica',      'code' => 'BEL', 'flag' => '🇧🇪', 'conf' => 'UEFA'],
                ['name' => 'Croácia',      'code' => 'CRO', 'flag' => '🇭🇷', 'conf' => 'UEFA'],
                ['name' => 'Egito',        'code' => 'EGY', 'flag' => '🇪🇬', 'conf' => 'CAF'],
                ['name' => 'Panamá',       'code' => 'PAN', 'flag' => '🇵🇦', 'conf' => 'CONCACAF'],
            ],
            'H' => [
                ['name' => 'Suíça',        'code' => 'SUI', 'flag' => '🇨🇭', 'conf' => 'UEFA'],
                ['name' => 'Dinamarca',    'code' => 'DEN', 'flag' => '🇩🇰', 'conf' => 'UEFA'],
                ['name' => 'Sérvia',       'code' => 'SRB', 'flag' => '🇷🇸', 'conf' => 'UEFA'],
                ['name' => 'Gana',         'code' => 'GHA', 'flag' => '🇬🇭', 'conf' => 'CAF'],
            ],
            'I' => [
                ['name' => 'Itália',       'code' => 'ITA', 'flag' => '🇮🇹', 'conf' => 'UEFA'],
                ['name' => 'Polônia',      'code' => 'POL', 'flag' => '🇵🇱', 'conf' => 'UEFA'],
                ['name' => 'Nigéria',      'code' => 'NGA', 'flag' => '🇳🇬', 'conf' => 'CAF'],
                ['name' => 'Iraque',       'code' => 'IRQ', 'flag' => '🇮🇶', 'conf' => 'AFC'],
            ],
            'J' => [
                ['name' => 'Alemanha',     'code' => 'GER', 'flag' => '🇩🇪', 'conf' => 'UEFA'],
                ['name' => 'Uzbequistão',  'code' => 'UZB', 'flag' => '🇺🇿', 'conf' => 'AFC'],
                ['name' => 'Honduras',     'code' => 'HON', 'flag' => '🇭🇳', 'conf' => 'CONCACAF'],
                ['name' => 'Argélia',      'code' => 'ALG', 'flag' => '🇩🇿', 'conf' => 'CAF'],
            ],
            'K' => [
                ['name' => 'Áustria',      'code' => 'AUT', 'flag' => '🇦🇹', 'conf' => 'UEFA'],
                ['name' => 'Venezuela',    'code' => 'VEN', 'flag' => '🇻🇪', 'conf' => 'CONMEBOL'],
                ['name' => 'Mali',         'code' => 'MLI', 'flag' => '🇲🇱', 'conf' => 'CAF'],
                ['name' => 'Nova Zelândia','code' => 'NZL', 'flag' => '🇳🇿', 'conf' => 'OFC'],
            ],
            'L' => [
                ['name' => 'Turquia',      'code' => 'TUR', 'flag' => '🇹🇷', 'conf' => 'UEFA'],
                ['name' => 'Paraguai',     'code' => 'PAR', 'flag' => '🇵🇾', 'conf' => 'CONMEBOL'],
                ['name' => 'Costa do Marfim','code'=> 'CIV','flag' => '🇨🇮', 'conf' => 'CAF'],
                ['name' => 'Jamaica',      'code' => 'JAM', 'flag' => '🇯🇲', 'conf' => 'CONCACAF'],
            ],
        ];

        // Fix: Germany appears twice - replace group J's Germany with a placeholder
        $groupsData['J'][0] = ['name' => 'Escócia', 'code' => 'SCO', 'flag' => '🏴󠁧󠁢󠁳󠁣󠁴󠁿', 'conf' => 'UEFA'];

        $matchNumber = 1;

        foreach ($groupsData as $groupName => $teams) {
            $group = WorldCupGroup::create(['name' => $groupName]);

            $teamModels = [];
            foreach ($teams as $teamData) {
                $team = Team::firstOrCreate(
                    ['code' => $teamData['code']],
                    [
                        'name'          => $teamData['name'],
                        'flag_emoji'    => $teamData['flag'],
                        'confederation' => $teamData['conf'],
                    ]
                );
                $teamModels[] = $team;
                GroupTeam::create([
                    'world_cup_group_id' => $group->id,
                    'team_id'            => $team->id,
                ]);
            }

            // Create round-robin matches within the group (6 matches per group)
            $pairs = [
                [0, 1], [2, 3],
                [0, 2], [1, 3],
                [0, 3], [1, 2],
            ];

            foreach ($pairs as $pair) {
                WorldCupMatch::create([
                    'home_team_id'       => $teamModels[$pair[0]]->id,
                    'away_team_id'       => $teamModels[$pair[1]]->id,
                    'world_cup_group_id' => $group->id,
                    'stage'              => 'group',
                    'match_number'       => $matchNumber++,
                    'status'             => 'scheduled',
                ]);
            }
        }

        // Knockout stage matches (teams TBD)
        $knockoutStages = [
            'r32' => 16,
            'r16' => 8,
            'qf'  => 4,
            'sf'  => 2,
            '3rd' => 1,
            'final' => 1,
        ];

        foreach ($knockoutStages as $stage => $count) {
            for ($i = 1; $i <= $count; $i++) {
                WorldCupMatch::create([
                    'stage'              => $stage,
                    'match_number'       => $matchNumber++,
                    'status'             => 'scheduled',
                    'home_placeholder'   => "A definir",
                    'away_placeholder'   => "A definir",
                ]);
            }
        }
    }
}
