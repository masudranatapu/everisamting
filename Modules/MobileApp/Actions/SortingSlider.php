<?php

namespace Modules\MobileApp\Actions;

use Modules\MobileApp\Entities\MobileAppSlider;

class SortingSlider
{
    public static function sort($request)
    {
        $tasks = MobileAppSlider::all();
        foreach ($tasks as $task) {
            $task->timestamps = false;
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order' => $order['position']]);
                }
            }
        }

        return true;
    }
}
