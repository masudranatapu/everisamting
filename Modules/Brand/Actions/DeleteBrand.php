<?php

namespace Modules\Brand\Actions;

class DeleteBrand
{
    public static function delete($brand)
    {
        return $brand->delete();
    }
}
