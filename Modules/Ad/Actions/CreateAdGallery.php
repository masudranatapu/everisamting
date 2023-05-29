<?php

namespace Modules\Ad\Actions;

use App\Actions\File\FileUpload;
use Modules\Ad\Entities\AdGallery;

class CreateAdGallery
{
    public static function create($request, $id)
    {
        foreach ($request->file('images') as $image) {
            if ($image && $image->isValid()) {

                $url = uploadAdImage($image, 'addss_multiple', 850, 650, true);

                AdGallery::create([
                    'ad_id' => $id,
                    'image' => $url,
                ]);
            }
        }

        return true;
    }
}
