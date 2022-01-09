<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role= DB::table('roles')->delete();
      $roles=  [
           [
            'name' => 'Admin',
           ],
           [
            'name'=>'User',
           ],
           [
            'name'=>'Vendor'
           ]
      ];
        Role::insert($roles);
      
    }
}
