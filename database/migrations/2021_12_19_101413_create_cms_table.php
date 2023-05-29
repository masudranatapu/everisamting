<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->id();
            $table->string('home_main_banner')->nullable();
            $table->string('home_counter_background')->nullable();
            $table->string('home_mobile_app_banner')->nullable();

            // Home
            $table->string('home_title')->nullable();
            $table->string('home_description')->nullable();
            $table->string('download_app')->nullable();
            $table->string('newsletter_content')->nullable();
            $table->string('membership_content')->nullable();
            $table->string('create_account')->nullable();
            $table->string('post_ads')->nullable();
            $table->string('start_earning')->nullable();

            //Terms & Condition
            $table->string('terms_background')->nullable();
            $table->text('terms_body')->nullable();

            //About
            $table->string('about_background')->nullable();
            $table->string('about_video_thumb')->nullable();
            $table->text('about_body')->nullable();

            //Privacy
            $table->string('privacy_background')->nullable();
            $table->text('privacy_body')->nullable();

            //Contact
            $table->string('contact_background')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_address')->nullable();

            //Get Membership
            $table->string('get_membership_background')->nullable();
            $table->string('get_membership_image')->nullable();

            //Pricing Plan Background
            $table->string('pricing_plan_background')->nullable();

            //Faq
            $table->string('faq_background')->nullable();
            $table->string('faq_content')->nullable();

            // Login or Register
            $table->string('manage_ads_content')->nullable();
            $table->string('chat_content')->nullable();
            $table->string('verified_user_content')->nullable();

            //Dashboard Overview
            $table->string('dashboard_overview_background')->nullable();
            $table->string('dashboard_post_ads_background')->nullable();
            $table->string('dashboard_my_ads_background')->nullable();
            $table->string('dashboard_plan_background')->nullable();
            $table->string('dashboard_account_setting_background')->nullable();
            $table->string('dashboard_favorite_ads_background')->nullable();
            $table->string('dashboard_messenger_background')->nullable();

            $table->string('posting_rules_background')->nullable();
            $table->text('posting_rules_body')->nullable();

            // blog and ads
            $table->string('blog_background')->nullable();
            $table->string('ads_background')->nullable();

            // coming soon
            $table->string('coming_soon_title')->nullable();
            $table->string('coming_soon_subtitle')->nullable();

            // maintenance
            $table->string('maintenance_title')->nullable();
            $table->string('maintenance_subtitle')->nullable();

            // 404 page
            $table->string('e404_title')->nullable();
            $table->string('e404_subtitle')->nullable();
            $table->string('e404_image')->nullable();
            // 500 page
            $table->string('e500_title')->nullable();
            $table->string('e500_subtitle')->nullable();
            $table->string('e500_image')->nullable();
            // 503 page
            $table->string('e503_title')->nullable();
            $table->string('e503_subtitle')->nullable();
            $table->string('e503_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms');
    }
}
