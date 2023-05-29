<?php

namespace Modules\Brand\Actions;

class UpdateBrand
{
    public static function update($request, $brand)
    {
        return $brand->update($request->all());
    }
}
