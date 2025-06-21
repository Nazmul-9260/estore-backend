<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\File;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $roles = [
            [
                'name' => 'administrator',
                'description' => 'Oversees human resources, recruitment, and staff welfare.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'doctor',
                'description' => 'Responsible for diagnosing and treating patients.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'nurse',
                'description' => 'Provides care to patients and assists doctors in medical procedures.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'it_manager',
                'description' => 'Oversees hospital IT systems and ensures their smooth operation.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'executive',
                'description' => 'Manages high-level administrative tasks and hospital strategies.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'lab_technician',
                'description' => 'Conducts lab tests and provides results for diagnosis.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'pharmacist',
                'description' => 'Dispenses medications and advises on their proper use.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'receptionist',
                'description' => 'Handles patient appointments, inquiries, and administrative tasks.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'accountant',
                'description' => 'Manages hospital finances and ensures accurate billing and reporting.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'hr_manager',
                'description' => 'Oversees human resources, recruitment, and staff welfare.',
                'guard_name' => 'web',
            ]
        ];

        foreach ($roles as $role) {
            $roleToInsert = Role::create($role);
        }

        $jsonData = json_encode($roles);

        $path = database_path('seeders/export-data/roles.json');

        File::put($path, $jsonData);
    }
}
