<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{

    public function run()
    {
        factory(App\Article::class, 30)->create();
        // factory(App\Comment::class, 10)->create();
    }
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
