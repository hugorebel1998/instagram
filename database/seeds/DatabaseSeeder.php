<?php

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
        $this->call(UserSeeder::class);
        $this->call(ImageSeeder::class);     
        $this->call(CommentSeeder::class);
        $this->call(LikeSeeder::class);
        
        
    }
}
