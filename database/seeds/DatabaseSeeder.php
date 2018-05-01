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
        $this->call(ArticlesTableSeeder::class);
        // Model::unguard();

        // // $this->call(UserTableSeeder::class);
        // DB::table('article')->delete();

        // $users = array(
        //     ['title' => 'first Chenkie', 'body' => 'ryanchenki dhfaskjhf fjhsdufghd hdsag dghdsufgksdd udgb  dhgd'],
        //     ['title' => 'second title', 'body' => 'ryanchenki dhfaskjhf fjhsdufghd hdsag dghdsufgksdd udgb  dhgd'],
        //     ['title' => 'third seed', 'body' => 'ryanchenkie@gmail.comryanchenki dhfaskjhf fjhsdufghd hdsag dghdsufgksdd udgb  dhgd'],);

        // // Loop through each user above and create the record for them in the database
        // foreach ($articles as $article)
        // {
        //     Article::create($article);
        // }

        // Model::reguard();
    }
}

/*{
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        DB::table('users')->delete();

        $users = array(
            ['name' => 'Ryan Chenkie', 'email' => 'ryanchenkie@gmail.com', 'password' => Hash::make('secret')],
            ['name' => 'Chris Sevilleja', 'email' => 'chris@scotch.io', 'password' => Hash::make('secret')],
            ['name' => 'Holly Lloyd', 'email' => 'holly@scotch.io', 'password' => Hash::make('secret')],
            ['name' => 'Adnan Kukic', 'email' => 'adnan@scotch.io', 'password' => Hash::make('secret')],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

        Model::reguard();
    }
}
*/
