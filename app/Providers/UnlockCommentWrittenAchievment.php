<?php

namespace App\Providers;

use App\Events\CommentWritten;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class UnlockCommentWrittenAchievment
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
     * @param  CommentWritten  $event
     * @return void
     */
    public function handle(CommentWritten $event)
    {
        $resultArray = [];
        if(!empty($event->user)){

            // find user
            $getUser = $event->user;

            $commentCount = $getUser->comments->count();

            if($commentCount == 0) :
                // no comment
                $resultArray['unlockedAchivementArry'] = "";
                $resultArray['user'] = $getUser;
            elseif($commentCount >= 1):
                // First Comment Written
                $resultArray['achievement_name'] = 'First comment written.';
                $resultArray['user'] = $getUser;
            elseif($commentCount >= 3):
                // 3 Comments Written
                $resultArray['achievement_name'] = 'Three comment written.';
                $resultArray['user'] = $getUser;
            elseif($commentCount >= 5):
                // 5 Comments Written
                $resultArray['achievement_name'] = 'Five comment written.';
                $resultArray['user'] = $getUser;
            elseif($commentCount >= 10):
                // 10 Comments Written
                $resultArray['achievement_name'] = 'Ten comment written.';
                $resultArray['user'] = $getUser;
            elseif($commentCount >= 20):
                // 20 Comments Written
                $resultArray['achievement_name'] = 'Twenty comment written.';
                $resultArray['user'] = $getUser;
            else :
                // current achievment
                $resultArray['achievement_name'] = "";
                $resultArray['user'] = $getUser;
            endif;
        }

        return $resultArray;
    }
}
