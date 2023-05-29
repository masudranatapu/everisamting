<?php

namespace Database\Seeders;

use App\Models\Cms;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cms::create([
            // Home
            'home_title' =>  'Buy, Sell And Find Just About Anythink.',
            'home_description' => 'Buy And Sell Everything From Used Cars To Mobile Phones And Computers, Or Search For Property And More All Over The World!',
            'download_app' => 'Sed Luctus Nibh At Consectetur Tempor. Proin Et Ipsum Tincidunt, Maximus Turpis Id, Mollis Lacus. Maecenas Nec Risus A Urna Sollicitudin Aliquet. Maecenas Pretium Tristique Sapien',
            'newsletter_content' => 'Vestibulum Consectetur Placerat Tellus. Sed Faucibus Fermentum Purus, At Facilisis.',
            'membership_content' => 'Vestibulum Consectetur Placerat Tellus. Sed Faucibus Fermentum Purus, At Facilisis Neque Auctor.',

            'create_account' => 'Vestibulum Ante Ipsum Primis In Faucibus Orci Luctus Et Ultrices Posuere Cubilia Curae. Donec Non Lorem Erat. Sed Vitae Vene.',

            'post_ads' => 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Mauris Eu Aliquet Odio. Nulla Pretium Congue Eros, Nec Rhoncus Mi.',
            'start_earning' => 'Vestibulum Quis Consectetur Est. Fusce Hendrerit Neque At Facilisis Facilisis. Praesent A Pretium Elit. Nulla Aliquam Puru.',

            //About
            'about_body' =>  'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Mauris Eu Aliquet Odio. Nulla Pretium Congue Eros, Nec Rhoncus Mi.',
            'about_video_thumb' => 'https://youtu.be/s7wmiS2mSXY',

            // Terms & Condition
            'terms_body' => '<p>Praesent Finibus Dictum Nisl Sit Amet Vulputate. Fusce A Metus Eu Velit Posuere Semper A Bibendum Ante. Donec Eu Tellus Dapibus, Semper Orci Eget, Commodo Lacu Praesent Ullamcorper.</p>',

            //Privacy
            'privacy_body' =>  '<p>Praesent Finibus Dictum Nisl Sit Amet Vulputate. Fusce A Metus Eu Velit Posuere Semper A Bibendum Ante. Donec Eu Tellus Dapibus, Semper Orci Eget, Commodo Lacu Praesent Ullamcorper.</p>',

            //Faq
            'faq_content' => 'Praesent Finibus Dictum Nisl Sit Amet Vulputate. Fusce A Metus Eu Velit Posuere Semper A Bibendum Ante. Donec Eu Tellus Dapibus, Semper Orci Eget, Commodo Lacu Praesent Ullamcorper.',

            // Login or Register
            'manage_ads_content' => 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Etiam Commodo Vel Ligula.',
            'chat_content' => 'Class Aptent Taciti Sociosqu Ad Litora Torquent Per Conubia Nostra, Per Inceptos Himenaeos.',
            'verified_user_content' => 'Class Aptent Taciti Sociosqu Ad Litora Torquent Per Conubia Nostra, Per Inceptos Himenaeos.',
            'posting_rules_body' => '<p>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Mauris Eu Aliquet Odio. Nulla Pretium Congue Eros, Nec Rhoncus Mi<p>',

            //Contact
            'contact_number' => '+1-202-555-0125',
            'contact_email' => 'templatecookie@gmail.com',
            'contact_address' => 'Mohammadpur, Dhaka, Bangladesh',
            
            'e404_title' => 'Opps! Page Not Found!',
            'e404_subtitle' => 'Something went wrong. It\'s look like the link is broken or the page is removed.',
            'e404_image' => 'frontend/images/bg/error.png',
            'e500_title' => 'Internal Server Error',
            'e500_subtitle' => 'Something went wrong. It\'s look like the Internal Server has some errors.',
            'e500_image' => 'frontend/default_images/error-banner.png',
            'e503_title' => 'Service Unavailable',
            'e503_subtitle' => 'Something went wrong. It\'s look like the Internal Server has some errors.',
            'e503_image' => 'frontend/default_images/error-banner.png',
        ]);
    }
}