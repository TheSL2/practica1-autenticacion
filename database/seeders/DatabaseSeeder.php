<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoleSeeder::class);

        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        $admin->roles()->attach($adminRole);

        $users = \App\Models\User::factory(10)->create();
         
        $editorRole = \App\Models\Role::where('name', 'editor')->first();
        $users->random(5)->each(function ($user) use ($editorRole) {
            $user->roles()->attach($editorRole);
        });

        $categories = \App\Models\Category::factory(5)->create();

        \App\Models\Post::factory(50)
            ->for($users->random(), 'author')
            ->for($categories->random(), 'category')
            ->create()
            ->each(function ($post) {
                $tags = \App\Models\Tag::factory(3)->create();
                $post->tags()->attach($tags);

                \App\Models\Comment::factory(5)
                    ->for($post)
                    ->create();
            });
    }
}