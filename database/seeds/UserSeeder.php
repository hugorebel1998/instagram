<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role' => 'user',
            'name' => 'Hugo',
            'surname' => 'Guillermo',
            'nick' => 'hugoguillermoweb',
            'image' => 'hugo.jpg',
            'email' => 'hugorebel1998@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'role' => 'user',
            'name' => 'Juan Pablo',
            'surname' => 'Guillermo Segundo',
            'nick' => 'juanpabloweb',
            'image' => 'juan.jpg',
            'email' => 'juanpablo@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'role' => 'user',
            'name' => 'Jose Luis',
            'surname' => 'Guillermo Segundo',
            'nick' => 'joseluisweb',
            'image' => 'jose.jpg',
            'email' => 'joseluis@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
