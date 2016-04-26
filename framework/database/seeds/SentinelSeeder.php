<?php

use Illuminate\Database\Seeder;

class SentinelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('role_users')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        DB::table('persistences')->truncate();
        DB::table('reminders')->truncate();
        DB::table('throttle')->truncate();
        DB::table('activations')->truncate();

        try {
        	$role = Sentinel::getRoleRepository()->createModel()->create(['id'   => 1,'name'  => 'Super Admin','slug'  => 'super-admin']);
            $user = Sentinel::register([
                    'id'    => 1,
                    'email' => 'suadmin@email.com',
                    'username' => 'suadmin',
                    'password'  => 'suadmin',
                    'first_name'    => 'Dhany',
                    'last_name'     => 'Seskoadi',
                ], true);

            $role->users()->attach($user);

            $role = Sentinel::getRoleRepository()->createModel()->create(['id'   => 2,'name'  => 'SPV','slug'  => 'supervisor']);
            $user = Sentinel::register([
                    'id'    => 2,
                    'email' => 'spv@email.com',
                    'username' => 'spv',
                    'password'  => 'spvspv',
                    'first_name'    => 'Ari Ina',
                    'last_name'     => 'Hadianti',
                ], true);
            $role->users()->attach($user);

        } catch (Exception $e) {
        	print "Error Exception ";
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
