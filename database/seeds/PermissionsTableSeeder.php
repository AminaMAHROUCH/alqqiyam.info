<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'private_news_create',
            ],
            [
                'id'    => 18,
                'title' => 'private_news_edit',
            ],
            [
                'id'    => 19,
                'title' => 'private_news_show',
            ],
            [
                'id'    => 20,
                'title' => 'private_news_delete',
            ],
            [
                'id'    => 21,
                'title' => 'private_news_access',
            ],
            [
                'id'    => 22,
                'title' => 'news_access',
            ],
            [
                'id'    => 23,
                'title' => 'public_news_create',
            ],
            [
                'id'    => 24,
                'title' => 'public_news_edit',
            ],
            [
                'id'    => 25,
                'title' => 'public_news_show',
            ],
            [
                'id'    => 26,
                'title' => 'public_news_delete',
            ],
            [
                'id'    => 27,
                'title' => 'public_news_access',
            ],
            [
                'id'    => 28,
                'title' => 'test_access',
            ],
            [
                'id'    => 29,
                'title' => 'region_create',
            ],
            [
                'id'    => 30,
                'title' => 'region_edit',
            ],
            [
                'id'    => 31,
                'title' => 'region_show',
            ],
            [
                'id'    => 32,
                'title' => 'region_delete',
            ],
            [
                'id'    => 33,
                'title' => 'region_access',
            ],
            [
                'id'    => 34,
                'title' => 'province_create',
            ],
            [
                'id'    => 35,
                'title' => 'province_edit',
            ],
            [
                'id'    => 36,
                'title' => 'province_show',
            ],
            [
                'id'    => 37,
                'title' => 'province_delete',
            ],
            [
                'id'    => 38,
                'title' => 'province_access',
            ],
            [
                'id'    => 39,
                'title' => 'service_create',
            ],
            [
                'id'    => 40,
                'title' => 'service_edit',
            ],
            [
                'id'    => 41,
                'title' => 'service_show',
            ],
            [
                'id'    => 42,
                'title' => 'service_delete',
            ],
            [
                'id'    => 43,
                'title' => 'service_access',
            ],
            [
                'id'    => 44,
                'title' => 'help_case_create',
            ],
            [
                'id'    => 45,
                'title' => 'help_case_edit',
            ],
            [
                'id'    => 46,
                'title' => 'help_case_show',
            ],
            [
                'id'    => 47,
                'title' => 'help_case_delete',
            ],
            [
                'id'    => 48,
                'title' => 'help_case_access',
            ],
            [
                'id'    => 49,
                'title' => 'link_create',
            ],
            [
                'id'    => 50,
                'title' => 'link_edit',
            ],
            [
                'id'    => 51,
                'title' => 'link_show',
            ],
            [
                'id'    => 52,
                'title' => 'link_delete',
            ],
            [
                'id'    => 53,
                'title' => 'link_access',
            ],
            [
                'id'    => 54,
                'title' => 'province_partner_create',
            ],
            [
                'id'    => 55,
                'title' => 'province_partner_edit',
            ],
            [
                'id'    => 56,
                'title' => 'province_partner_show',
            ],
            [
                'id'    => 57,
                'title' => 'province_partner_delete',
            ],
            [
                'id'    => 58,
                'title' => 'province_partner_access',
            ],
            [
                'id'    => 59,
                'title' => 'partenaire_access',
            ],
            [
                'id'    => 60,
                'title' => 'national_partner_create',
            ],
            [
                'id'    => 61,
                'title' => 'national_partner_edit',
            ],
            [
                'id'    => 62,
                'title' => 'national_partner_show',
            ],
            [
                'id'    => 63,
                'title' => 'national_partner_delete',
            ],
            [
                'id'    => 64,
                'title' => 'national_partner_access',
            ],
            [
                'id'    => 65,
                'title' => 'handbook_access',
            ],
            [
                'id'    => 66,
                'title' => 'directorate_create',
            ],
            [
                'id'    => 67,
                'title' => 'directorate_edit',
            ],
            [
                'id'    => 68,
                'title' => 'directorate_show',
            ],
            [
                'id'    => 69,
                'title' => 'directorate_delete',
            ],
            [
                'id'    => 70,
                'title' => 'directorate_access',
            ],
            [
                'id'    => 71,
                'title' => 'unit_create',
            ],
            [
                'id'    => 72,
                'title' => 'unit_edit',
            ],
            [
                'id'    => 73,
                'title' => 'unit_show',
            ],
            [
                'id'    => 74,
                'title' => 'unit_delete',
            ],
            [
                'id'    => 75,
                'title' => 'unit_access',
            ],
            [
                'id'    => 76,
                'title' => 'profession_create',
            ],
            [
                'id'    => 77,
                'title' => 'profession_edit',
            ],
            [
                'id'    => 78,
                'title' => 'profession_show',
            ],
            [
                'id'    => 79,
                'title' => 'profession_delete',
            ],
            [
                'id'    => 80,
                'title' => 'profession_access',
            ],
            [
                'id'    => 81,
                'title' => 'etablissement_create',
            ],
            [
                'id'    => 82,
                'title' => 'etablissement_edit',
            ],
            [
                'id'    => 83,
                'title' => 'etablissement_show',
            ],
            [
                'id'    => 84,
                'title' => 'etablissement_delete',
            ],
            [
                'id'    => 85,
                'title' => 'etablissement_access',
            ],
            [
                'id'    => 86,
                'title' => 'unite_regional_create',
            ],
            [
                'id'    => 87,
                'title' => 'unite_regional_edit',
            ],
            [
                'id'    => 88,
                'title' => 'unite_regional_show',
            ],
            [
                'id'    => 89,
                'title' => 'unite_regional_delete',
            ],
            [
                'id'    => 90,
                'title' => 'unite_regional_access',
            ],
            [
                'id'    => 91,
                'title' => 'links_request_access',
            ],
            [
                'id'    => 92,
                'title' => 'question_create',
            ],
            [
                'id'    => 93,
                'title' => 'question_edit',
            ],
            [
                'id'    => 94,
                'title' => 'question_show',
            ],
            [
                'id'    => 95,
                'title' => 'question_delete',
            ],
            [
                'id'    => 96,
                'title' => 'question_access',
            ],
            [
                'id'    => 97,
                'title' => 'unit_detail_create',
            ],
            [
                'id'    => 98,
                'title' => 'unit_detail_edit',
            ],
            [
                'id'    => 99,
                'title' => 'unit_detail_show',
            ],
            [
                'id'    => 100,
                'title' => 'unit_detail_delete',
            ],
            [
                'id'    => 101,
                'title' => 'unit_detail_access',
            ],
            [
                'id'    => 102,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}