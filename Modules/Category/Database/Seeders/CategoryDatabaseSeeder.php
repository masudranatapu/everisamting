<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $categories = [
            [
                'name' => 'Electronics',
                'image' => 'https://picsum.photos/id/20/700/600',
                'slug' => 'electronics',
                'icon' => 'fas fa-tv',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mobile Phone',
                'image' => 'https://picsum.photos/id/21/700/600',
                'slug' => 'mobile-phone',
                'icon' => 'fas fa-mobile-alt',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vehicles',
                'image' => 'https://picsum.photos/id/22/700/600',
                'slug' => 'vehicles',
                'icon' => 'fas fa-car-alt',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sports & Kids',
                'image' => 'https://picsum.photos/id/23/700/600',
                'slug' => 'sports-&-kids',
                'icon' => 'far fa-futbol',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fashion',
                'image' => 'https://picsum.photos/id/24/700/600',
                'slug' => 'fashion',
                'icon' => 'fas fa-tshirt',
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Essentials',
                'image' => 'https://picsum.photos/id/29/700/600',
                'slug' => 'essentials',
                'icon' => 'fas fa-gift',
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Category::insert($categories);
    }
}
