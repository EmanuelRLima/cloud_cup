<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RankingController extends Controller
{
    public function index()
    {
        $ranking = User::select('users.id', 'users.name')
            ->selectRaw('COALESCE(SUM(predictions.points), 0) as total_points')
            ->selectRaw('COUNT(predictions.id) as total_predictions')
            ->selectRaw('COUNT(CASE WHEN predictions.points = 10 THEN 1 END) as exact_scores')
            ->selectRaw('COUNT(CASE WHEN predictions.points = 5 THEN 1 END) as correct_results')
            ->leftJoin('predictions', 'users.id', '=', 'predictions.user_id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_points')
            ->orderByDesc('exact_scores')
            ->get()
            ->map(function ($user, $index) {
                $user->position = $index + 1;
                return $user;
            });

        $currentUser = Auth::user();
        $userPosition = $ranking->firstWhere('id', $currentUser->id);

        return Inertia::render('Ranking/Index', [
            'ranking'      => $ranking,
            'userPosition' => $userPosition,
        ]);
    }
}

