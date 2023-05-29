<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * image upload
 *
 * @param object $file
 * @param string $path
 * @return string
 */
function uploadImage(?object $file, string $path, $watermark = false): string
{
    $pathCreate = public_path("/uploads/$path/");
    if (!File::isDirectory($pathCreate)) {
        File::makeDirectory($pathCreate, 0777, true, true);
    }

    if ($watermark && setting('watermark_status')) {

        $watermark_image = Image::make(setting('watermark_image'));
        $type = setting('watermark_type');
        $text = setting('watermark_text');

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $updated_img = Image::make($file);

        if ($type == 'text') {

            $updated_img->text($text, 100, 100, function ($font) {
                $font->file(public_path('RobotoMono-Bold.ttf'));
                $font->size(30);
                $font->color('#e1e1e1');
                $font->valign('center');
                $font->align('center');
            });
        } else {

            $imageWidth = $updated_img->width();
            $watermarkSize = round(10 * $imageWidth / 50);
            $watermark_image->resize($watermarkSize, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $updated_img->insert($watermark_image, 'bottom-right', 10, 10);
        }

        $updated_img->save(public_path('/uploads/' . $path . '/') . $fileName);
        return "uploads/$path/" . $fileName;
    } else {

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploads/' . $path . '/'), $fileName);
        return "uploads/$path/" . $fileName;
    }
}

function uploadAdImage(?object $file, string $path, int $width, int $height, $watermark = false): string
{
    // $width = 850;
    // $height = 650;
    $blank_img =  Image::canvas($width, $height, '#EBEEF7');
    $pathCreate = public_path("/uploads/$path/");
    if (!File::isDirectory($pathCreate)) {
        File::makeDirectory($pathCreate, 0777, true, true);
    }

    if ($watermark && setting('watermark_status')) {

        $watermark_image = Image::make(setting('watermark_image'));
        $type = setting('watermark_type');
        $text = setting('watermark_text');

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $updated_img = Image::make($file);
        $imageWidth = $updated_img->width();
        $imageHeight = $updated_img->height();

        if ($type == 'text') {

            $updated_img->text($text, 100, 100, function ($font) {
                $font->file(public_path('RobotoMono-Bold.ttf'));
                $font->size(30);
                $font->color('#e1e1e1');
                $font->valign('center');
                $font->align('center');
            });
        } else {


            $watermarkSize = round(10 * $imageWidth / 50);
            $watermark_image->resize($watermarkSize, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $updated_img->insert($watermark_image, 'bottom-right', 10, 10);
        }
        if ($imageWidth > $width) {

            $updated_img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        if ($imageHeight > $height) {

            $updated_img->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }


        $blank_img->insert($updated_img, 'center');
        $blank_img->save(public_path('/uploads/' . $path . '/') . $fileName);
        return "uploads/$path/" . $fileName;
    } else {

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        // $file->move(public_path('/uploads/' . $path . '/'), $fileName);
        $updated_img = Image::make($file);
        $imageWidth = $updated_img->width();
        $imageHeight = $updated_img->height();
        if ($imageWidth > $width) {

            $updated_img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        if ($imageHeight > $height) {

            $updated_img->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }


        $blank_img->insert($updated_img, 'center');
        $blank_img->save(public_path('/uploads/' . $path . '/') . $fileName);
        return "uploads/$path/" . $fileName;
    }
}

/**
 * image delete
 *
 * @param string $image
 * @return void
 */
function deleteImage(?string $image)
{
    $imageExists = file_exists($image);
    // dd($imageExists);

    if ($imageExists) {
        @unlink($image);
    }
}

/**
 * base64 image upload
 *
 * @param string $img
 * @param string $path
 * @return void
 */
function uploadBase64FileToPublic($img, string $path)
{
    // return $path;
    if ($img && $path) {
        $folderPath = public_path($path);

        if (!File::isDirectory($folderPath)) {
            File::makeDirectory($folderPath, 0777, true, true);
        }

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.' . $image_type;
        $filePath = $folderPath . $fileName;

        file_put_contents($filePath, $image_base64);

        return $path . $fileName;
    } else {
        return null;
    }
}
