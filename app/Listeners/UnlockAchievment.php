<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnlockAchievment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AchievementUnlocked  $event
     * @return void
     */
    public function handle(AchievementUnlocked $event)
    {
        $commentCount = 0;
        $watchedCount = 0;

        if(!empty($event->user)){

            $commentCount = $event->user->comments->count();
            $watchedCount = $event->user->watched->count();

            if($commentCount == 0) :
                // no comment
                $resultArray['unlockedAchivementArry'] = "";
                $resultArray['nextAvailAchivementArry'][] = 'First comment written.';
            elseif($commentCount >= 1):
                // First Comment Written
                $resultArray['unlockedAchivementArry'][] = 'First comment written.';
                $resultArray['nextAvailAchivementArry'][] = 'Three comment written.';
            elseif($commentCount >= 3):
                // 3 Comments Written
                $resultArray['unlockedAchivementArry'][] = 'Three comment written.';
                $resultArray['nextAvailAchivementArry'][] = 'Five comment written.';
            elseif($commentCount >= 5):
                // 5 Comments Written
                $resultArray['unlockedAchivementArry'][] = 'Five comment written.';
                $resultArray['nextAvailAchivementArry'][] = 'Ten comment written.';
            elseif($commentCount >= 10):
                // 10 Comments Written
                $resultArray['unlockedAchivementArry'][] = 'Ten comment written.';
                $resultArray['nextAvailAchivementArry'][] = 'Twenty comment written.';
            elseif($commentCount >= 20):
                // 20 Comments Written
                $resultArray['unlockedAchivementArry'][] = 'Twenty comment written.';
                $resultArray['nextAvailAchivementArry'][] = '';
            else :
                // current achievment
                return "1 Current Achievement";
            endif;

            if($watchedCount == 0):
                // no Watched
                $resultArray['unlockedAchivementArry'] = "";
                $resultArray['nextAvailAchivementArry'][] = 'First Lesson Watched';
            elseif($watchedCount >= 1):
                // First Watched
                $resultArray['unlockedAchivementArry'][] = 'First Lesson Watched';
                $resultArray['nextAvailAchivementArry'][] = 'Five Lesson Watched';
            elseif($watchedCount >= 5):
                // 5 Watched
                $resultArray['unlockedAchivementArry'][] = 'Five Lesson Watched';
                $resultArray['nextAvailAchivementArry'][] = 'Ten Lesson Watched';
            elseif($watchedCount >= 10):
                // 10 Watched
                $resultArray['unlockedAchivementArry'][] = 'Ten Lesson Watched';
                $resultArray['nextAvailAchivementArry'][] = 'Twenty Five Lesson Watched';
            elseif($watchedCount >= 25):
                // 25 Watched
                $resultArray['unlockedAchivementArry'][] = 'Twenty Five Lesson Watched';
                $resultArray['nextAvailAchivementArry'][] = 'Fifty Lesson Watched';
            elseif($watchedCount >= 50):
                // 50 Watched
                $resultArray['unlockedAchivementArry'][] = 'Fifty Lesson Watched';
                $resultArray['nextAvailAchivementArry'][] = '';
            else:
                // current achievment
                return "2 Current Achievement";
            endif;

            $totalCount = $commentCount+$watchedCount;

            if((0 <= $totalCount) && ($totalCount <= 4)):
                // Beginner: 0 Achievements
                $resultArray['currnetBedgeArry'] = "Beginner";
                $resultArray['nextBedgeArry'] = 'Intermediate';
                $resultArray['reminaingtoUnlockNextBedgeArry'] = 4-$totalCount;
            elseif((4 <= $totalCount) && ($totalCount <= 8)):
                // Intermediate: 4 Achievements
                $resultArray['currnetBedgeArry'] = 'Intermediate';
                $resultArray['nextBedgeArry'] = 'Advanced';
                $resultArray['reminaingtoUnlockNextBedgeArry'] = 8-$totalCount;
            elseif((8 <= $totalCount) && ($totalCount <= 10)):
                // Advanced: 8 Achievements
                $resultArray['currnetBedgeArry'][] = 'Advanced';
                $resultArray['nextBedgeArry'] = 'Master';
                $resultArray['reminaingtoUnlockNextBedgeArry'] = 10-$totalCount;
            elseif((10 <= $totalCount) && ($totalCount <= 10)):
                // Master: 10 Achievements
                $resultArray['unlockedAchivementArry'][] = 'Master';
                $resultArray['nextBedgeArry'] = '';
                $resultArray['reminaingtoUnlockNextBedgeArry'] = 0;
            else:
                // current achievment
                return "Current Badge";
            endif;

            return $resultArray;

        } else {
            return [
                'error' => true,
                'data'  => null,
                'message' => 'No user found.', 
            ];
        }
    }
}
