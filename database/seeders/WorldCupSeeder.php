<?php

namespace Database\Seeders;

use App\Models\GroupTeam;
use App\Models\Team;
use App\Models\WorldCupGroup;
use App\Models\WorldCupMatch;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WorldCupSeeder extends Seeder
{
    // All times in BRT (America/Sao_Paulo = UTC-3)
    private const TZ = 'America/Sao_Paulo';

    public function run(): void
    {
        // -------------------------------------------------------
        // TEAMS  (48 seleções — Copa do Mundo 2026)
        // -------------------------------------------------------
        $teams = [
            // Group A
            'MEX' => ['name' => 'México',              'flag' => '🇲🇽', 'conf' => 'CONCACAF'],
            'RSA' => ['name' => 'África do Sul',        'flag' => '🇿🇦', 'conf' => 'CAF'],
            'KOR' => ['name' => 'Coreia do Sul',        'flag' => '🇰🇷', 'conf' => 'AFC'],
            'CZE' => ['name' => 'República Tcheca',     'flag' => '🇨🇿', 'conf' => 'UEFA'],
            // Group B
            'CAN' => ['name' => 'Canadá',               'flag' => '🇨🇦', 'conf' => 'CONCACAF'],
            'BIH' => ['name' => 'Bósnia-Herzegovina',   'flag' => '🇧🇦', 'conf' => 'UEFA'],
            'QAT' => ['name' => 'Catar',                'flag' => '🇶🇦', 'conf' => 'AFC'],
            'SUI' => ['name' => 'Suíça',                'flag' => '🇨🇭', 'conf' => 'UEFA'],
            // Group C
            'BRA' => ['name' => 'Brasil',               'flag' => '🇧🇷', 'conf' => 'CONMEBOL'],
            'MAR' => ['name' => 'Marrocos',             'flag' => '🇲🇦', 'conf' => 'CAF'],
            'HAI' => ['name' => 'Haiti',                'flag' => '🇭🇹', 'conf' => 'CONCACAF'],
            'SCO' => ['name' => 'Escócia',              'flag' => '🏴󠁧󠁢󠁳󠁣󠁴󠁿', 'conf' => 'UEFA'],
            // Group D
            'USA' => ['name' => 'Estados Unidos',       'flag' => '🇺🇸', 'conf' => 'CONCACAF'],
            'PAR' => ['name' => 'Paraguai',             'flag' => '🇵🇾', 'conf' => 'CONMEBOL'],
            'AUS' => ['name' => 'Austrália',            'flag' => '🇦🇺', 'conf' => 'AFC'],
            'TUR' => ['name' => 'Turquia',              'flag' => '🇹🇷', 'conf' => 'UEFA'],
            // Group E
            'GER' => ['name' => 'Alemanha',             'flag' => '🇩🇪', 'conf' => 'UEFA'],
            'CIV' => ['name' => 'Costa do Marfim',      'flag' => '🇨🇮', 'conf' => 'CAF'],
            'ECU' => ['name' => 'Equador',              'flag' => '🇪🇨', 'conf' => 'CONMEBOL'],
            'CUW' => ['name' => 'Curaçao',              'flag' => '🇨🇼', 'conf' => 'CONCACAF'],
            // Group F
            'NED' => ['name' => 'Países Baixos',        'flag' => '🇳🇱', 'conf' => 'UEFA'],
            'JPN' => ['name' => 'Japão',                'flag' => '🇯🇵', 'conf' => 'AFC'],
            'SWE' => ['name' => 'Suécia',               'flag' => '🇸🇪', 'conf' => 'UEFA'],
            'TUN' => ['name' => 'Tunísia',              'flag' => '🇹🇳', 'conf' => 'CAF'],
            // Group G
            'BEL' => ['name' => 'Bélgica',             'flag' => '🇧🇪', 'conf' => 'UEFA'],
            'EGY' => ['name' => 'Egito',                'flag' => '🇪🇬', 'conf' => 'CAF'],
            'IRN' => ['name' => 'Irã',                  'flag' => '🇮🇷', 'conf' => 'AFC'],
            'NZL' => ['name' => 'Nova Zelândia',        'flag' => '🇳🇿', 'conf' => 'OFC'],
            // Group H
            'ESP' => ['name' => 'Espanha',              'flag' => '🇪🇸', 'conf' => 'UEFA'],
            'CPV' => ['name' => 'Cabo Verde',           'flag' => '🇨🇻', 'conf' => 'CAF'],
            'KSA' => ['name' => 'Arábia Saudita',       'flag' => '🇸🇦', 'conf' => 'AFC'],
            'URU' => ['name' => 'Uruguai',              'flag' => '🇺🇾', 'conf' => 'CONMEBOL'],
            // Group I
            'FRA' => ['name' => 'França',               'flag' => '🇫🇷', 'conf' => 'UEFA'],
            'SEN' => ['name' => 'Senegal',              'flag' => '🇸🇳', 'conf' => 'CAF'],
            'IRQ' => ['name' => 'Iraque',               'flag' => '🇮🇶', 'conf' => 'AFC'],
            'NOR' => ['name' => 'Noruega',              'flag' => '🇳🇴', 'conf' => 'UEFA'],
            // Group J
            'ARG' => ['name' => 'Argentina',            'flag' => '🇦🇷', 'conf' => 'CONMEBOL'],
            'ALG' => ['name' => 'Argélia',              'flag' => '🇩🇿', 'conf' => 'CAF'],
            'AUT' => ['name' => 'Áustria',              'flag' => '🇦🇹', 'conf' => 'UEFA'],
            'JOR' => ['name' => 'Jordânia',             'flag' => '🇯🇴', 'conf' => 'AFC'],
            // Group K
            'POR' => ['name' => 'Portugal',             'flag' => '🇵🇹', 'conf' => 'UEFA'],
            'COD' => ['name' => 'Congo (RD)',            'flag' => '🇨🇩', 'conf' => 'CAF'],
            'UZB' => ['name' => 'Uzbequistão',          'flag' => '🇺🇿', 'conf' => 'AFC'],
            'COL' => ['name' => 'Colômbia',             'flag' => '🇨🇴', 'conf' => 'CONMEBOL'],
            // Group L
            'ENG' => ['name' => 'Inglaterra',           'flag' => '🏴󠁧󠁢󠁥󠁮󠁧󠁿', 'conf' => 'UEFA'],
            'CRO' => ['name' => 'Croácia',              'flag' => '🇭🇷', 'conf' => 'UEFA'],
            'GHA' => ['name' => 'Gana',                 'flag' => '🇬🇭', 'conf' => 'CAF'],
            'PAN' => ['name' => 'Panamá',               'flag' => '🇵🇦', 'conf' => 'CONCACAF'],
        ];

        // Create all teams
        $created = [];
        foreach ($teams as $code => $data) {
            $created[$code] = Team::create([
                'name'          => $data['name'],
                'code'          => $code,
                'flag_emoji'    => $data['flag'],
                'confederation' => $data['conf'],
            ]);
        }

        // -------------------------------------------------------
        // GROUPS + MATCHES  (12 grupos × 6 jogos = 72 partidas)
        // -------------------------------------------------------
        $groupsData = [
            'A' => [
                'teams'   => ['MEX', 'RSA', 'KOR', 'CZE'],
                'matches' => [
                    ['home' => 'MEX', 'away' => 'RSA', 'date' => '2026-06-11 16:00', 'city' => 'Cidade do México',  'venue' => 'Estadio Azteca'],
                    ['home' => 'KOR', 'away' => 'CZE', 'date' => '2026-06-11 23:00', 'city' => 'Guadalajara',       'venue' => 'Estadio Akron'],
                    ['home' => 'CZE', 'away' => 'RSA', 'date' => '2026-06-18 13:00', 'city' => 'Atlanta',           'venue' => 'Mercedes-Benz Stadium'],
                    ['home' => 'MEX', 'away' => 'KOR', 'date' => '2026-06-18 22:00', 'city' => 'Guadalajara',       'venue' => 'Estadio Akron'],
                    ['home' => 'CZE', 'away' => 'MEX', 'date' => '2026-06-24 22:00', 'city' => 'Cidade do México',  'venue' => 'Estadio Azteca'],
                    ['home' => 'RSA', 'away' => 'KOR', 'date' => '2026-06-24 22:00', 'city' => 'Monterrey',         'venue' => 'Estadio BBVA'],
                ],
            ],
            'B' => [
                'teams'   => ['CAN', 'BIH', 'QAT', 'SUI'],
                'matches' => [
                    ['home' => 'CAN', 'away' => 'BIH', 'date' => '2026-06-12 16:00', 'city' => 'Toronto',          'venue' => 'BMO Field'],
                    ['home' => 'QAT', 'away' => 'SUI', 'date' => '2026-06-13 16:00', 'city' => 'San Francisco',    'venue' => "Levi's Stadium"],
                    ['home' => 'SUI', 'away' => 'BIH', 'date' => '2026-06-18 16:00', 'city' => 'Los Angeles',      'venue' => 'SoFi Stadium'],
                    ['home' => 'CAN', 'away' => 'QAT', 'date' => '2026-06-18 19:00', 'city' => 'Vancouver',        'venue' => 'BC Place'],
                    ['home' => 'SUI', 'away' => 'CAN', 'date' => '2026-06-24 16:00', 'city' => 'Vancouver',        'venue' => 'BC Place'],
                    ['home' => 'BIH', 'away' => 'QAT', 'date' => '2026-06-24 16:00', 'city' => 'Seattle',          'venue' => 'Lumen Field'],
                ],
            ],
            'C' => [
                'teams'   => ['BRA', 'MAR', 'HAI', 'SCO'],
                'matches' => [
                    ['home' => 'BRA', 'away' => 'MAR', 'date' => '2026-06-13 19:00', 'city' => 'Nova York/NJ',     'venue' => 'MetLife Stadium'],
                    ['home' => 'HAI', 'away' => 'SCO', 'date' => '2026-06-13 22:00', 'city' => 'Boston',           'venue' => 'Gillette Stadium'],
                    ['home' => 'SCO', 'away' => 'MAR', 'date' => '2026-06-19 19:00', 'city' => 'Boston',           'venue' => 'Gillette Stadium'],
                    ['home' => 'BRA', 'away' => 'HAI', 'date' => '2026-06-19 21:30', 'city' => 'Filadélfia',       'venue' => 'Lincoln Financial Field'],
                    ['home' => 'SCO', 'away' => 'BRA', 'date' => '2026-06-24 19:00', 'city' => 'Miami',            'venue' => 'Hard Rock Stadium'],
                    ['home' => 'MAR', 'away' => 'HAI', 'date' => '2026-06-24 19:00', 'city' => 'Atlanta',          'venue' => 'Mercedes-Benz Stadium'],
                ],
            ],
            'D' => [
                'teams'   => ['USA', 'PAR', 'AUS', 'TUR'],
                'matches' => [
                    ['home' => 'USA', 'away' => 'PAR', 'date' => '2026-06-12 22:00', 'city' => 'Los Angeles',      'venue' => 'SoFi Stadium'],
                    ['home' => 'AUS', 'away' => 'TUR', 'date' => '2026-06-13 01:00', 'city' => 'Vancouver',        'venue' => 'BC Place'],
                    ['home' => 'TUR', 'away' => 'PAR', 'date' => '2026-06-19 01:00', 'city' => 'San Francisco',    'venue' => "Levi's Stadium"],
                    ['home' => 'USA', 'away' => 'AUS', 'date' => '2026-06-19 16:00', 'city' => 'Seattle',          'venue' => 'Lumen Field'],
                    ['home' => 'TUR', 'away' => 'USA', 'date' => '2026-06-25 23:00', 'city' => 'Los Angeles',      'venue' => 'SoFi Stadium'],
                    ['home' => 'PAR', 'away' => 'AUS', 'date' => '2026-06-25 23:00', 'city' => 'San Francisco',    'venue' => "Levi's Stadium"],
                ],
            ],
            'E' => [
                'teams'   => ['GER', 'CIV', 'ECU', 'CUW'],
                'matches' => [
                    ['home' => 'GER', 'away' => 'CUW', 'date' => '2026-06-14 14:00', 'city' => 'Houston',          'venue' => 'NRG Stadium'],
                    ['home' => 'CIV', 'away' => 'ECU', 'date' => '2026-06-14 20:00', 'city' => 'Filadélfia',       'venue' => 'Lincoln Financial Field'],
                    ['home' => 'GER', 'away' => 'CIV', 'date' => '2026-06-20 17:00', 'city' => 'Toronto',          'venue' => 'BMO Field'],
                    ['home' => 'ECU', 'away' => 'CUW', 'date' => '2026-06-20 21:00', 'city' => 'Kansas City',      'venue' => 'Arrowhead Stadium'],
                    ['home' => 'CUW', 'away' => 'CIV', 'date' => '2026-06-25 17:00', 'city' => 'Filadélfia',       'venue' => 'Lincoln Financial Field'],
                    ['home' => 'ECU', 'away' => 'GER', 'date' => '2026-06-25 17:00', 'city' => 'Nova York/NJ',     'venue' => 'MetLife Stadium'],
                ],
            ],
            'F' => [
                'teams'   => ['NED', 'JPN', 'SWE', 'TUN'],
                'matches' => [
                    ['home' => 'NED', 'away' => 'JPN', 'date' => '2026-06-14 17:00', 'city' => 'Dallas',           'venue' => 'AT&T Stadium'],
                    ['home' => 'SWE', 'away' => 'TUN', 'date' => '2026-06-14 23:00', 'city' => 'Monterrey',        'venue' => 'Estadio BBVA'],
                    ['home' => 'TUN', 'away' => 'JPN', 'date' => '2026-06-20 01:00', 'city' => 'Monterrey',        'venue' => 'Estadio BBVA'],
                    ['home' => 'NED', 'away' => 'SWE', 'date' => '2026-06-20 14:00', 'city' => 'Houston',          'venue' => 'NRG Stadium'],
                    ['home' => 'JPN', 'away' => 'SWE', 'date' => '2026-06-25 20:00', 'city' => 'Dallas',           'venue' => 'AT&T Stadium'],
                    ['home' => 'TUN', 'away' => 'NED', 'date' => '2026-06-25 20:00', 'city' => 'Kansas City',      'venue' => 'Arrowhead Stadium'],
                ],
            ],
            'G' => [
                'teams'   => ['BEL', 'EGY', 'IRN', 'NZL'],
                'matches' => [
                    ['home' => 'BEL', 'away' => 'EGY', 'date' => '2026-06-15 16:00', 'city' => 'Seattle',          'venue' => 'Lumen Field'],
                    ['home' => 'IRN', 'away' => 'NZL', 'date' => '2026-06-15 22:00', 'city' => 'Los Angeles',      'venue' => 'SoFi Stadium'],
                    ['home' => 'BEL', 'away' => 'IRN', 'date' => '2026-06-21 16:00', 'city' => 'Los Angeles',      'venue' => 'SoFi Stadium'],
                    ['home' => 'NZL', 'away' => 'EGY', 'date' => '2026-06-21 22:00', 'city' => 'Vancouver',        'venue' => 'BC Place'],
                    ['home' => 'EGY', 'away' => 'IRN', 'date' => '2026-06-27 00:00', 'city' => 'Seattle',          'venue' => 'Lumen Field'],
                    ['home' => 'NZL', 'away' => 'BEL', 'date' => '2026-06-27 00:00', 'city' => 'Vancouver',        'venue' => 'BC Place'],
                ],
            ],
            'H' => [
                'teams'   => ['ESP', 'CPV', 'KSA', 'URU'],
                'matches' => [
                    ['home' => 'ESP', 'away' => 'CPV', 'date' => '2026-06-15 13:00', 'city' => 'Atlanta',          'venue' => 'Mercedes-Benz Stadium'],
                    ['home' => 'KSA', 'away' => 'URU', 'date' => '2026-06-15 19:00', 'city' => 'Miami',            'venue' => 'Hard Rock Stadium'],
                    ['home' => 'ESP', 'away' => 'KSA', 'date' => '2026-06-21 13:00', 'city' => 'Atlanta',          'venue' => 'Mercedes-Benz Stadium'],
                    ['home' => 'URU', 'away' => 'CPV', 'date' => '2026-06-21 19:00', 'city' => 'Miami',            'venue' => 'Hard Rock Stadium'],
                    ['home' => 'CPV', 'away' => 'KSA', 'date' => '2026-06-26 21:00', 'city' => 'Houston',          'venue' => 'NRG Stadium'],
                    ['home' => 'URU', 'away' => 'ESP', 'date' => '2026-06-26 21:00', 'city' => 'Guadalajara',      'venue' => 'Estadio Akron'],
                ],
            ],
            'I' => [
                'teams'   => ['FRA', 'SEN', 'IRQ', 'NOR'],
                'matches' => [
                    ['home' => 'FRA', 'away' => 'SEN', 'date' => '2026-06-16 16:00', 'city' => 'Nova York/NJ',     'venue' => 'MetLife Stadium'],
                    ['home' => 'IRQ', 'away' => 'NOR', 'date' => '2026-06-16 19:00', 'city' => 'Boston',           'venue' => 'Gillette Stadium'],
                    ['home' => 'FRA', 'away' => 'IRQ', 'date' => '2026-06-22 18:00', 'city' => 'Filadélfia',       'venue' => 'Lincoln Financial Field'],
                    ['home' => 'NOR', 'away' => 'SEN', 'date' => '2026-06-22 21:00', 'city' => 'Nova York/NJ',     'venue' => 'MetLife Stadium'],
                    ['home' => 'NOR', 'away' => 'FRA', 'date' => '2026-06-26 16:00', 'city' => 'Boston',           'venue' => 'Gillette Stadium'],
                    ['home' => 'SEN', 'away' => 'IRQ', 'date' => '2026-06-26 16:00', 'city' => 'Toronto',          'venue' => 'BMO Field'],
                ],
            ],
            'J' => [
                'teams'   => ['ARG', 'ALG', 'AUT', 'JOR'],
                'matches' => [
                    ['home' => 'ARG', 'away' => 'ALG', 'date' => '2026-06-16 22:00', 'city' => 'Kansas City',      'venue' => 'Arrowhead Stadium'],
                    ['home' => 'AUT', 'away' => 'JOR', 'date' => '2026-06-17 01:00', 'city' => 'San Francisco',    'venue' => "Levi's Stadium"],
                    ['home' => 'ARG', 'away' => 'AUT', 'date' => '2026-06-22 14:00', 'city' => 'Dallas',           'venue' => 'AT&T Stadium'],
                    ['home' => 'JOR', 'away' => 'ALG', 'date' => '2026-06-23 00:00', 'city' => 'San Francisco',    'venue' => "Levi's Stadium"],
                    ['home' => 'ALG', 'away' => 'AUT', 'date' => '2026-06-27 23:00', 'city' => 'Kansas City',      'venue' => 'Arrowhead Stadium'],
                    ['home' => 'JOR', 'away' => 'ARG', 'date' => '2026-06-27 23:00', 'city' => 'Dallas',           'venue' => 'AT&T Stadium'],
                ],
            ],
            'K' => [
                'teams'   => ['POR', 'COD', 'UZB', 'COL'],
                'matches' => [
                    ['home' => 'POR', 'away' => 'COD', 'date' => '2026-06-17 14:00', 'city' => 'Houston',          'venue' => 'NRG Stadium'],
                    ['home' => 'UZB', 'away' => 'COL', 'date' => '2026-06-17 23:00', 'city' => 'Cidade do México', 'venue' => 'Estadio Azteca'],
                    ['home' => 'POR', 'away' => 'UZB', 'date' => '2026-06-23 14:00', 'city' => 'Houston',          'venue' => 'NRG Stadium'],
                    ['home' => 'COL', 'away' => 'COD', 'date' => '2026-06-23 23:00', 'city' => 'Guadalajara',      'venue' => 'Estadio Akron'],
                    ['home' => 'COL', 'away' => 'POR', 'date' => '2026-06-27 20:30', 'city' => 'Miami',            'venue' => 'Hard Rock Stadium'],
                    ['home' => 'COD', 'away' => 'UZB', 'date' => '2026-06-27 20:30', 'city' => 'Atlanta',          'venue' => 'Mercedes-Benz Stadium'],
                ],
            ],
            'L' => [
                'teams'   => ['ENG', 'CRO', 'GHA', 'PAN'],
                'matches' => [
                    ['home' => 'ENG', 'away' => 'CRO', 'date' => '2026-06-17 17:00', 'city' => 'Dallas',           'venue' => 'AT&T Stadium'],
                    ['home' => 'GHA', 'away' => 'PAN', 'date' => '2026-06-17 20:00', 'city' => 'Toronto',          'venue' => 'BMO Field'],
                    ['home' => 'ENG', 'away' => 'GHA', 'date' => '2026-06-23 17:00', 'city' => 'Boston',           'venue' => 'Gillette Stadium'],
                    ['home' => 'PAN', 'away' => 'CRO', 'date' => '2026-06-23 20:00', 'city' => 'Toronto',          'venue' => 'BMO Field'],
                    ['home' => 'PAN', 'away' => 'ENG', 'date' => '2026-06-27 18:00', 'city' => 'Nova York/NJ',     'venue' => 'MetLife Stadium'],
                    ['home' => 'CRO', 'away' => 'GHA', 'date' => '2026-06-27 18:00', 'city' => 'Filadélfia',       'venue' => 'Lincoln Financial Field'],
                ],
            ],
        ];

        $matchNumber = 1;

        foreach ($groupsData as $groupName => $data) {
            $group = WorldCupGroup::create(['name' => $groupName]);

            foreach ($data['teams'] as $code) {
                GroupTeam::create([
                    'world_cup_group_id' => $group->id,
                    'team_id'            => $created[$code]->id,
                ]);
            }

            foreach ($data['matches'] as $match) {
                WorldCupMatch::create([
                    'home_team_id'       => $created[$match['home']]->id,
                    'away_team_id'       => $created[$match['away']]->id,
                    'world_cup_group_id' => $group->id,
                    'stage'              => 'group',
                    'match_number'       => $matchNumber++,
                    'scheduled_at'       => Carbon::parse($match['date'], self::TZ)->utc(),
                    'city'               => $match['city'],
                    'venue'              => $match['venue'],
                    'status'             => 'scheduled',
                ]);
            }
        }

        // -------------------------------------------------------
        // KNOCKOUT  (32 matches — teams TBD)
        // -------------------------------------------------------
        $knockoutStages = [
            'r32'   => 16,
            'r16'   => 8,
            'qf'    => 4,
            'sf'    => 2,
            '3rd'   => 1,
            'final' => 1,
        ];

        foreach ($knockoutStages as $stage => $count) {
            for ($i = 1; $i <= $count; $i++) {
                WorldCupMatch::create([
                    'stage'            => $stage,
                    'match_number'     => $matchNumber++,
                    'status'           => 'scheduled',
                    'home_placeholder' => 'A definir',
                    'away_placeholder' => 'A definir',
                ]);
            }
        }
    }
}
