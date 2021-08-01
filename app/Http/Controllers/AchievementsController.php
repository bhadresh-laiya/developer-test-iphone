<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Events\CommentWritten;
use App\Events\BadgeUnlocked;
use App\Events\AchievementUnlocked;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        // fires events and listen
        $result = event(new AchievementUnlocked($user));

        return response()->json([
            'unlocked_achievements' => !empty($result[0]['unlockedAchivementArry']) ? $result[0]['unlockedAchivementArry'] : [],
            'next_available_achievements' => !empty($result[0]['nextAvailAchivementArry']) ? $result[0]['nextAvailAchivementArry'] : [],
            'current_badge' => $result[0]['currnetBedgeArry'],
            'next_badge' => $result[0]['nextBedgeArry'],
            'remaing_to_unlock_next_badge' => $result[0]['reminaingtoUnlockNextBedgeArry'],
        ]);
    }

    public function achievementUnlocked(User $user)
    {
        $result = event(new AchievementUnlocked($user));

        return response()->json($result);
    }

    public function badgeUnlock(User $user)
    {
        $result = event(new BadgeUnlocked($user));

        return response()->json($result);
    }
}
