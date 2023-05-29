<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Create roles
        $roleAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);

        //  permission List as array
        $permissions = [
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    // Dashboard permission
                    'dashboard.view',
                ]
            ],
            [
                'group_name' => 'admin',
                'permissions' => [
                    // Admin permission
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // Role permission
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                ]
            ],
            [
                'group_name' => 'map',
                'permissions' => [
                    // Role permission
                    'map.create',
                    'map.view',
                    'map.edit',
                    'map.delete',
                ]
            ],
            [
                'group_name' => 'profile',
                'permissions' => [
                    // Profile permission
                    'profile.view',
                    'profile.edit',
                ]
            ],
            [
                'group_name' => 'settings',
                'permissions' => [
                    'setting.view',
                    'setting.update',
                ]
            ],
            [
                'group_name' => 'ad',
                'permissions' => [
                    // Ad permission
                    'ad.create',
                    'ad.view',
                    'ad.update',
                    'ad.delete',
                ]
            ],
            [
                'group_name' => 'category',
                'permissions' => [
                    // Category permission
                    'category.create',
                    'category.view',
                    'category.update',
                    'category.delete',
                    'subcategory.create',
                    'subcategory.view',
                    'subcategory.update',
                    'subcategory.delete',
                ]
            ],
            [
                'group_name' => 'custom-field',
                'permissions' => [
                    // custom-field permission
                    'custom-field.create',
                    'custom-field.view',
                    'custom-field.update',
                    'custom-field.delete',
                    'custom-field-group.create',
                    'custom-field-group.view',
                    'custom-field-group.update',
                    'custom-field-group.delete',
                ]
            ],
            [
                'group_name' => 'newsletter',
                'permissions' => [
                    // Category permission
                    'newsletter.view',
                    'newsletter.mailsend',
                    'newsletter.delete',
                ]
            ],
            [
                'group_name' => 'brand',
                'permissions' => [
                    // Brand permission
                    'brand.create',
                    'brand.view',
                    'brand.update',
                    'brand.delete',
                ]
            ],
      
            [
                'group_name' => 'plan',
                'permissions' => [
                    // Role permission
                    'plan.create',
                    'plan.view',
                    'plan.update',
                    'plan.delete',
                ]
            ],
            [
                'group_name' => 'Blog',
                'permissions' => [
                    // Role permission
                    'postcategory.create',
                    'postcategory.view',
                    'postcategory.update',
                    'postcategory.delete',
                    'post.create',
                    'post.view',
                    'post.update',
                    'post.delete',
                    'tag.create',
                    'tag.view',
                    'tag.update',
                    'tag.delete',
                ]
            ],
            [
                'group_name' => 'testimonial',
                'permissions' => [
                    // Role permission
                    'testimonial.create',
                    'testimonial.view',
                    'testimonial.update',
                    'testimonial.delete',
                ]
            ],
            [
                'group_name' => 'faq',
                'permissions' => [
                    // Role permission
                    'faqcategory.create',
                    'faqcategory.view',
                    'faqcategory.update',
                    'faqcategory.delete',
                    'faq.create',
                    'faq.view',
                    'faq.update',
                    'faq.delete',
                ]
            ],
            [
                'group_name' => 'others',
                'permissions' => [
                    // Role permission
                    'customer.view',
                    'contact.view',
                ]
            ],
        ];

        // Assaign Permission
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'admin']);
                $roleAdmin->givePermissionTo($permission);
                //  $permission->assignRole($roleAdmin);
            }
        }
    }
}
