<?php

namespace Modules\Testimonial\Actions;

use App\Actions\File\FileUpload;
use Modules\Testimonial\Entities\Testimonial;

class CreateTestimonial
{
    public static function create($request)
    {
        $testimonial = Testimonial::create($request->except('image'));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $url = $request->image->move('uploads/testimonial',$request->image->hashName());
            $testimonial->update(['image' => $url]);
        }

        return $testimonial;
    }
}
