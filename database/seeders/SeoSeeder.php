<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'page_slug' => 'home',
                'title' => 'Welcome To adlisting',
                'description' => 'Adlisting - Laravel Classified Ads is a PHP script with minimal, clean, flexible, and structured code. This script will provide you amazing user interface with lots of dynamic frontend and backend features.',
                'image' => 'backend/image/default.png',
            ],
            [
                'page_slug' => 'about',
                'title' => 'About',
                'description' => 'Adlisting - Laravel Classified Ads is a PHP script with minimal, clean, flexible, and structured code. This script will provide you amazing user interface with lots of dynamic frontend and backend features.',
                'image' => 'backend/image/default.png',
            ],
            [
                'page_slug' => 'contact',
                'title' => 'About',
                'description' => 'Adlisting - Laravel Classified Ads is a PHP script with minimal, clean, flexible, and structured code. This script will provide you amazing user interface with lots of dynamic frontend and backend features.',
                'image' => 'backend/image/default.png',
            ],
            [
                'page_slug' => 'ads',
                'title' => 'Ads',
                'description' => 'Adlisting - Laravel Classified Ads is a PHP script with minimal, clean, flexible, and structured code. This script will provide you amazing user interface with lots of dynamic frontend and backend features.',
                'image' => 'backend/image/default.png',
            ],
            [
                'page_slug' => 'blog',
                'title' => 'Blog',
                'description' => 'Adlisting - Laravel Classified Ads is a PHP script with minimal, clean, flexible, and structured code. This script will provide you amazing user interface with lots of dynamic frontend and backend features.',
                'image' => 'backend/image/default.png',
            ],
            [
                'page_slug' => 'pricing',
                'title' => 'Pricing',
                'description' => 'Adlisting - Laravel Classified Ads is a PHP script with minimal, clean, flexible, and structured code. This script will provide you amazing user interface with lots of dynamic frontend and backend features.',
                'image' => 'backend/image/default.png',
            ],
            [
                'page_slug' => 'login',
                'title' => 'Login',
                'description' => 'Adlisting - Laravel Classified Ads is a PHP script with minimal, clean, flexible, and structured code. This script will provide you amazing user interface with lots of dynamic frontend and backend features.',
                'image' => 'backend/image/default.png',
            ],
            [
                'page_slug' => 'register',
                'title' => 'Register',
                'description' => 'Adlisting - Laravel Classified Ads is a PHP script with minimal, clean, flexible, and structured code. This script will provide you amazing user interface with lots of dynamic frontend and backend features.',
                'image' => 'backend/image/default.png',
            ],
            [
                'page_slug' => 'faq',
                'title' => 'FAQ',
                'description' => 'Adlisting - Laravel Classified Ads is a PHP script with minimal, clean, flexible, and structured code. This script will provide you amazing user interface with lots of dynamic frontend and backend features.',
                'image' => 'backend/image/default.png',
            ]
        ];

        foreach ($pages as $page) {
            Seo::create($page);
        }
    }
}
