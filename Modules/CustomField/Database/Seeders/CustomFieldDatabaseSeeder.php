<?php

namespace Modules\CustomField\Database\Seeders;

use Illuminate\Support\Arr;
use Modules\Ad\Entities\Ad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\CustomField\Entities\CustomField;
use Modules\CustomField\Entities\CustomFieldGroup;

class CustomFieldDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Custom Field Groups
        $custom_field_groups = [
            [
                'name' => 'Details',
                'slug' => 'details',
            ],
            [
                'name' => 'Additional Details',
                'slug' => 'additional-details',
            ],
        ];

        foreach ($custom_field_groups as $custom_field_group) {
            CustomFieldGroup::create($custom_field_group);
        }

        // Custom FIeld Create
        $custom_fields = [
            [
                'custom_field_group_id' => 1,
                'name' => 'Model',
                'slug' => str_slug('Model'),
                'type' => 'text',
                'required' => false,
                'filterable' => true,
                'icon' => 'fas fa-award',
                'listable' => 1,
            ],
            [
                'custom_field_group_id' => 1,
                'name' => 'Authenticity',
                'slug' => str_slug('Authenticity'),
                'type' => 'select',
                'required' => false,
                'filterable' => true,
                'icon' => 'fas fa-check',
                'listable' => 1,
            ],
            [
                'custom_field_group_id' => 1,
                'name' => 'Condition',
                'slug' => str_slug('Condition'),
                'type' => 'checkbox',
                'required' => false,
                'filterable' => true,
                'icon' => 'fas fa-info',
                'listable' => 1,
            ],
            [
                'custom_field_group_id' => 1,
                'name' => 'Features',
                'slug' => str_slug('Features'),
                'type' => 'checkbox_multiple',
                'required' => false,
                'filterable' => true,
                'icon' => 'fas fa-key',
            ],
            [
                'custom_field_group_id' => 1,
                'name' => 'Negotiable',
                'slug' => str_slug('Negotiable'),
                'type' => 'radio',
                'required' => false,
                'filterable' => true,
                'icon' => 'fas fa-info-circle',
                'listable' => 1,
            ],
            [
                'custom_field_group_id' => 2,
                'name' => 'Note',
                'slug' => str_slug('Note'),
                'type' => 'textarea',
                'required' => false,
                'icon' => 'fas fa-sticky-note',
            ],
            [
                'custom_field_group_id' => 2,
                'name' => 'Attachment',
                'slug' => str_slug('Attachment'),
                'type' => 'file',
                'required' => false,
                'icon' => 'far fa-file-alt',
            ],
            [
                'custom_field_group_id' => 2,
                'name' => 'Established',
                'slug' => str_slug('Established'),
                'type' => 'date',
                'required' => false,
                'icon' => 'fas fa-calendar-alt',
            ],
            [
                'custom_field_group_id' => 2,
                'name' => 'Website',
                'slug' => str_slug('Website'),
                'type' => 'url',
                'required' => false,
                'icon' => 'fas fa-link',
            ],
            [
                'custom_field_group_id' => 2,
                'name' => 'Phone',
                'slug' => str_slug('Phone'),
                'type' => 'number',
                'required' => false,
                'icon' => 'fas fa-phone',
            ]
        ];

        // Custom Field and Custom Field Value Create
        foreach ($custom_fields as $custom_field) {
            $custom_field = CustomField::create($custom_field);

            // Model
            if ($custom_field && $custom_field->type == 'text' && $custom_field->slug == 'model') {
                $custom_field->values()->create([
                    'value' => 'F100',
                ]);
            }

            // Authenticity
            if ($custom_field && $custom_field->type == 'select' && $custom_field->slug == 'authenticity') {
                $custom_field->values()->create([
                    'value' => 'New',
                ]);
                $custom_field->values()->create([
                    'value' => 'Used',
                ]);
            }

            // Condition
            if ($custom_field && $custom_field->type == 'checkbox' && $custom_field->slug == 'condition') {
                $custom_field->values()->create([
                    'value' => 'Fresh',
                ]);
            }

            // Features
            if ($custom_field && $custom_field->type == 'checkbox_multiple' && $custom_field->slug == 'features') {
                $custom_field->values()->create([
                    'value' => 'Comfortable',
                ]);
                $custom_field->values()->create([
                    'value' => 'Beautiful Look',
                ]);
                $custom_field->values()->create([
                    'value' => 'Good Condition',
                ]);
            }

            // Negotiable
            if ($custom_field && $custom_field->type == 'radio' && $custom_field->slug == 'negotiable') {
                $custom_field->values()->create([
                    'value' => 'Yes',
                ]);
                $custom_field->values()->create([
                    'value' => 'No',
                ]);
            }

            // Note
            if ($custom_field && $custom_field->type == 'textarea' && $custom_field->slug == 'note') {
                $custom_field->values()->create([
                    'value' => 'This is a note',
                ]);
            }

            // Attachment
            if ($custom_field && $custom_field->type == 'file' && $custom_field->slug == 'attachment') {
                $custom_field->values()->create([
                    'value' => 'https://youtu.be/Ic_Kkmzm3uQ',
                ]);
            }

            // Established
            if ($custom_field && $custom_field->type == 'date' && $custom_field->slug == 'established') {
                $custom_field->values()->create([
                    'value' => '2020-05-05',
                ]);
            }

            // Website
            if ($custom_field && $custom_field->type == 'url' && $custom_field->slug == 'website') {
                $custom_field->values()->create([
                    'value' => 'https://www.templatecookie.com',
                ]);
            }

            // Phone
            if ($custom_field && $custom_field->type == 'number' && $custom_field->slug == 'phone') {
                $custom_field->values()->create([
                    'value' => '0123456789',
                ]);
            }
        }

        // Category Custom Field Create
        $categories = Category::all();

        foreach ($categories as $category) {
            $category->customFields()->attach([
                1, 2, 3, 4, 5, 6, 7, 8, 9, 10
            ]);
        }

        // Ad Custom Field Create
        $ads = Ad::all();
        $custom_fields = CustomField::all();
        foreach ($ads as $ad) {
            foreach ($custom_fields as $custom_field) {
                $value = $custom_field->values->first();
                $group = $custom_field->customFieldGroup;

                if ($custom_field->type == 'checkbox') {
                    $ad->productCustomFields()->create([
                        'custom_field_id' => $custom_field->id,
                        'value' => rand(0, 1),
                        'custom_field_group_id' => $group->id,
                        // 'group' => $group->name,
                        // 'field' => $custom_field->name,
                        // 'icon' => $custom_field->icon,
                        // 'listable' => $custom_field->listable,
                    ]);
                } elseif ($custom_field->type == 'checkbox_multiple') {
                    $random_select_values = Arr::random($custom_field->values->pluck('value')->toArray(), rand(2, 3));

                    $ad->productCustomFields()->create([
                        'custom_field_id' => $custom_field->id,
                        'value' => implode(', ', $random_select_values),
                        'custom_field_group_id' => $group->id,
                        // 'group' => $group->name,
                        // 'field' => $custom_field->name,
                        // 'icon' => $custom_field->icon,
                        // 'listable' => $custom_field->listable,
                    ]);
                } else {
                    $ad->productCustomFields()->create([
                        'custom_field_id' => $custom_field->id,
                        'value' => $value->value,
                        'custom_field_group_id' => $group->id,
                        // 'group' => $group->name,
                        // 'field' => $custom_field->name,
                        // 'icon' => $custom_field->icon,
                        // 'listable' => $custom_field->listable,
                    ]);
                }
            }
        }
    }
}
