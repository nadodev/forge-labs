<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'color' => '#ff2d20',
                'description' => 'Framework PHP Laravel'
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'vuejs',
                'color' => '#4fc08d',
                'description' => 'Framework JavaScript Vue.js'
            ],
            [
                'name' => 'React',
                'slug' => 'react',
                'color' => '#61dafb',
                'description' => 'Biblioteca JavaScript React'
            ],
            [
                'name' => 'Tailwind CSS',
                'slug' => 'tailwind-css',
                'color' => '#06b6d4',
                'description' => 'Framework CSS Tailwind'
            ],
            [
                'name' => 'MySQL',
                'slug' => 'mysql',
                'color' => '#4479a1',
                'description' => 'Banco de dados MySQL'
            ],
            [
                'name' => 'PostgreSQL',
                'slug' => 'postgresql',
                'color' => '#336791',
                'description' => 'Banco de dados PostgreSQL'
            ],
            [
                'name' => 'API REST',
                'slug' => 'api-rest',
                'color' => '#ff6b6b',
                'description' => 'API RESTful'
            ],
            [
                'name' => 'GraphQL',
                'slug' => 'graphql',
                'color' => '#e10098',
                'description' => 'Query language GraphQL'
            ],
            [
                'name' => 'Docker',
                'slug' => 'docker',
                'color' => '#2496ed',
                'description' => 'Containerização Docker'
            ],
            [
                'name' => 'AWS',
                'slug' => 'aws',
                'color' => '#ff9900',
                'description' => 'Amazon Web Services'
            ],
            [
                'name' => 'Responsivo',
                'slug' => 'responsivo',
                'color' => '#8b5cf6',
                'description' => 'Design responsivo'
            ],
            [
                'name' => 'PWA',
                'slug' => 'pwa',
                'color' => '#4285f4',
                'description' => 'Progressive Web App'
            ]
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
