<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $role1 = new Role();

        $role1->name = 'super_user';
        $role1->description = 'Has overall system management';

        $role1->save();
        /******************************************************************************/
        $role2 = new Role();

        $role2->name = 'admin';
        $role2->description = 'Has partial system management';

        $role2->save();
        /******************************************************************************/
        $role3 = new Role();

        $role3->name = 'common_user';
        $role3->description = 'Has access only to frontend application';

        $role3->save();
    }
}
