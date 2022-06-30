<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function permission()
    {
    	$super_admin_permission = Permission::where('slug','delete-users')->first();
		$admin_permission = Permission::where('slug', 'create-users')->first();
		$user_permission = Permission::where('slug', 'view-users')->first();


		//RoleTableSeeder.php
		$super_admin_role = new Role();
		$super_admin_role->slug = 'super-admin';
		$super_admin_role->name = 'Super Admin';
		$super_admin_role->save();
		$super_admin_role->permissions()->attach($super_admin_permission);

		$admin_role = new Role();
		$admin_role->slug = 'admin';
		$admin_role->name = 'Admin';
		$admin_role->save();
		$admin_role->permissions()->attach($admin_permission);

        $user_role = new Role();
		$user_role->slug = 'user';
		$user_role->name = 'User';
		$user_role->save();
		$user_role->permissions()->attach($user_permission);

		$super_admin_role = Role::where('slug','super-admin')->first();
		$admin_role = Role::where('slug', 'admin')->first();
		$user_role = Role::where('slug', 'user')->first();

        $deleteUsers = new Permission();
		$deleteUsers->slug = 'edelete-users';
		$deleteUsers->name = 'Delete Users';
		$deleteUsers->save();
		$deleteUsers->roles()->attach($super_admin_role);

		$createUsers = new Permission();
		$createUsers->slug = 'create-users';
		$createUsers->name = 'Create Users';
		$createUsers->save();
		$createUsers->roles()->attach($admin_role);

		$viewUsers = new Permission();
		$viewUsers->slug = 'view-users';
		$viewUsers->name = 'View Users';
		$viewUsers->save();
		$viewUsers->roles()->attach($user_role);

		$super_admin_role = Role::where('slug','super-admin')->first();
		$admin_role = Role::where('slug', 'admin')->first();
		$user_role = Role::where('slug', 'user')->first();

		$super_admin_perm = Permission::where('slug','delete-users')->first();
		$admin_perm = Permission::where('slug','create-users')->first();
		$user_perm = Permission::where('slug','view-users')->first();


		$super_admin = new User();
		$super_admin->name = 'Super Admin';
		$super_admin->email = 'sadmin@gmail.com';
		$super_admin->password = bcrypt('123456789');
		$super_admin->save();
		$super_admin->roles()->attach($super_admin_role);
		$super_admin->permissions()->attach($super_admin_perm);

		$admin = new User();
		$admin->name = 'Admin';
		$admin->email = 'admin@gmail.com';
		$admin->password = bcrypt('123456789');
		$admin->save();
		$admin->roles()->attach($admin_role);
		$admin->permissions()->attach($admin_perm);

        $user = new User();
		$user->name = 'User';
		$user->email = 'user@gmail.com';
		$user->password = bcrypt('123456789');
		$user->save();
		$user->roles()->attach($user_role);
		$user->permissions()->attach($user_perm);


        // $user = auth()->user();
         // dd($user);
        // dd($user->hasRole('user')); 
        // dd($user->givePermissionsTo('view-users'));
        // dd($user->can('view-users')); 

		return redirect()->back();
    }
}
