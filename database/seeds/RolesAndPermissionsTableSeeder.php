<?php 

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{ 
  public function run()
  {
      // Reset cached roles and permissions
      app()['cache']->forget('spatie.permission.cache');

      // create permissions
      Permission::create(['name' => 'create user']);
      Permission::create(['name' => 'edit user']);
      Permission::create(['name' => 'delete user']);
      Permission::create(['name' => 'create product']);
      Permission::create(['name' => 'edit product']);
      Permission::create(['name' => 'delete product']);
      Permission::create(['name' => 'create product category']);
      Permission::create(['name' => 'edit product category']);
      Permission::create(['name' => 'delete product category']);

      Permission::create(['name' => 'bid']);

      // create roles and assign created permissions
      $role = Role::create(['name' => 'bidder']);
      $role->givePermissionTo('bid');

      $role = Role::create(['name' => 'user']);
      $role->givePermissionTo(['create product', 'edit product', 'create product category', 'edit product category']);

      $role = Role::create(['name' => 'super-admin']);
      $role->givePermissionTo(Permission::all());

  }
}
