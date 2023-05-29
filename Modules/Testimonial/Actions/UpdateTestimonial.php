<?php

namespace Modules\Testimonial\Actions;

use App\Actions\File\FileUpload;

class UpdateTestimonial
{
    public static function update($request, $testimonial)
    {
        $testimonial->update($request->all());

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            deleteImage($testimonial->image);
            $url = $request->image->move('uploads/testimonial',$request->image->hashName());
            $testimonial->update(['image' => $url]);
        }

        return $testimonial;
    }
}
