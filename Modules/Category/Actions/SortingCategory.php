<?php

namespace Modules\Category\Actions;

use Modules\Category\Entities\Category;

class SortingCategory
{
    public static function sort($request)
    {
        $tasks = Category::all();
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
