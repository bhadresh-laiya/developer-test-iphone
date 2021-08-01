<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UnlockBadge
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
     * @param  BadgeUnlocked  $event
     * @return void
     */
    public function handle(BadgeUnlocked $event)
    {
        $commentCount = 0;
        $watchedCount = 0;

        if(!empty($event->user)){

            $commentCount = $event->user->comments->count();
            $watchedCount = $event->user->watched->count();

            $getUser = $event->user;

            $totalCount = $commentCount+$watchedCount;

            if((0 <= $totalCount) && ($totalCount <= 4)):
                // Beginner: 0 Achievements
                $resultArray['achievement_name'] = 'Beginner';
                $resultArray['user'] = $getUser;
            elseif((4 <= $totalCount) && ($totalCount <= 8)):
                // Intermediate: 4 Achievements
                $resultArray['achievement_name'] = 'Intermediate';
                $resultArray['user'] = $getUser;
            elseif((8 <= $totalCount) && ($totalCount <= 10)):
                // Advanced: 8 Achievements
                $resultArray['achievement_name'] = 'Advanced';
                $resultArray['user'] = $getUser;
            elseif((10 <= $totalCount) && ($totalCount <= 10)):
                // Master: 10 Achievements
                $resultArray['achievement_name'] = 'Master';
                $resultArray['user'] = $getUser;
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
