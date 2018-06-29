<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //    working role user seeder

     // $this->call(UserTableSeeder::class);

     DB::table('permissions')->insert( array(
            ['name' => 'create-users'],
            ['name' => 'create-article'],
            ['name' => 'assign-admin'],
       ));
     DB::table('permission_role')->insert( array(
            ['permission_id' => '1', 'role_id' => '1'],
            ['permission_id' => '2', 'role_id' => '1'],
            ['permission_id' => '2',  'role_id' => '2'],
            ['permission_id' => '3', 'role_id' => '1'],
            ['permission_id' => '1', 'role_id' => '2'],
       ));


     // DB::table('roles')->insert( array(
     //        ['name' => 'admin'],
     //        ['name' => 'Writer'],
     //        ['name' => 'User'],
     //    ));
     //    DB::table('role_user')->insert( array(
     //        ['user_id' => '1', 'role_id' =>'1'],
     //        ['user_id' => '2', 'role_id' =>'2'],
     //        ['user_id' => '3', 'role_id' =>'3'],
     //      ));




      $this->call(ArticlesTableSeeder::class);


        // $this->call(UserTableSeeder::class);
        // Model::unguard();
     /* working ROLES seeder


    */


       // DB::table('categories')->insert( array(
       //      ['name' => 'addiction'],
       //      ['name' => 'marriage'],
       //      ['name' => 'health'],
       // ));


    /* body seeder not working
       DB::table('testimonies')->insert( array(
                ['Title' => str_random(10)],
                ['body' => str_random(20)],
                ['approval' => '0'],
        ));
    */

// factory(App\Testimony::class, 50)->create()->each(function ($u) {
//     $u->posts()->save(factory(App\User::class)->make());
// });

    }
}


        // Model::reguard();
