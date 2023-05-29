<?php

namespace Modules\CustomField\Actions;

use Modules\Category\Entities\Category;
use Modules\CustomField\Entities\CustomField;

class SortingCustomField
{
    public static function sort($request)
    {
        $category = Category::FindOrFail($request->category);
        $tasks = $category->customFields;

        foreach ($tasks as $task) {
            $task->timestamps = false;
            $id = $task->id;



            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->pivot->update(['order' => $order['position']]);
                }
            }
        }

        return true;
    }
}
