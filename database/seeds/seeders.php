<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\SessionType;
class seeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = SessionType::create(['name' => 'qna']);
        $type = SessionType::create(['name' => 'survey']);

        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'guest']);
        $role = Role::create(['name' => 'super']);
    }
}
