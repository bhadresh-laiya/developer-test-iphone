<?php

namespace App\Providers;

use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Listeners\UnlockAchievment;
use App\Listeners\UnlockBadge;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            UnlockCommentWrittenAchievment::class,
        ],
        LessonWatched::class => [
            UnlockLessonWatchedAchievment::class,
        ],
        AchievementUnlocked::class => [
            UnlockAchievment::class,
        ],
        BadgeUnlocked::class => [
            UnlockBadge::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
