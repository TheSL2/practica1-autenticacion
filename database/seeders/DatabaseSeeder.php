<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario admin
        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Asignar rol admin
        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        $admin->roles()->attach($adminRole);

        // Crear más usuarios
        $users = \App\Models\User::factory(10)->create();
         
        $editorRole = \App\Models\Role::where('name', 'editor')->first();
        $users->random(5)->each(function ($user) use ($editorRole) {
            $user->roles()->attach($editorRole);
        });

        // Crear categorías
        $categories = \App\Models\Category::factory(5)->create();

        // Crear posts
        \App\Models\Post::factory(50)
            ->for($users->random(), 'author')
            ->for($categories->random(), 'category')
            ->create()
            ->each(function ($post) {
                // Agregar tags aleatorios
                $tags = \App\Models\Tag::factory(3)->create();
                $post->tags()->attach($tags);

                // Agregar comentarios
                \App\Models\Comment::factory(5)
                    ->for($post)
                    ->create();
            });
    }
}