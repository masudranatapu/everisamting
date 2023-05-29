<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\BusinessDirectory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Category\Entities\Category;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BusinessDirectoryImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row['categories']);
        if ($row['categories']) {
            $categories = $row['categories'];
        } else {
            $categories = 'Others';
        }

        $category = Category::where('slug', Str::slug($categories))->first();
        if ($category) {
            $category_id[] = (string) $category->id;
        } else {
            $cat = new Category();
            $cat->name = $categories;
            $cat->slug = Str::slug($categories);
            $cat->type = 2;
            $cat->save();
            $category_id[] = (string) $cat->id;
        }
        // dd($category_id);
        return new BusinessDirectory([
            'title' => $row['name'],
            'slug' => Str::slug($row['name']),
            'address' => $row['full_address'],
            'phone' => $row['phones'],
            'user_id' => Auth::guard('admin')->id(),
            'email' => $row['emails'] ?? '',
            'map' => $row['google_maps_url'] ?? '',
            'thumbnail' => $row['featured_image'] ?? '',
            'street' => $row['Street'] ?? '',
            'municipality' => $row['municipality'] ?? '',
            'plus_code' => $row['plus_code'] ?? '',
            'lat' => $row['latitude'] ?? '',
            'lang' => $row['longitude'] ?? '',
            'business_profile_link' => $row['website'] ?? '',
            'website' => $row['website'] ?? '',
            'domain' => $row['domain'] ?? '',
            'opening_hours' => $row['opening_hours'] ?? '',
            'review_count' => $row['review_count'] ?? '',
            'average_rating' => $row['average_rating'] ?? '',
            'review_url' => $row['review_url'] ?? '',
            'google_knowledge_url' => $row['google_knowledge_url'] ?? '',
            'category_id' => $category_id,
        ]);
    }
}
