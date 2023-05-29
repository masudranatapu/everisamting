<?php

namespace App\Observers;

use Modules\Ad\Entities\Ad;
use Illuminate\Support\Facades\Cache;

class AdObserver
{
    private function clearCache()
    {
        for ($i=1; $i <= 100; $i++) {
            $key = 'ads-page-'.$i;

            if (Cache::has($key)) {
                info('Cache cleared: '.$key);
                Cache::forget($key);
            }else{
                break;
            }
        }
    }


    /**
     * Handle the Ad "created" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function created(Ad $ad)
    {
        $this->clearCache();
    }

    /**
     * Handle the Ad "updated" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function updated(Ad $ad)
    {
        $this->clearCache();
    }

    /**
     * Handle the Ad "deleted" event.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function deleted(Ad $ad)
    {
        $this->clearCache();
    }
}
