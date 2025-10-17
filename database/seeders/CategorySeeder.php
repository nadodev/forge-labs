<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Gestão',
                'slug' => 'gestao',
                'icon' => '📊',
                'color' => '#3b82f6',
                'description' => 'Sistemas de gestão empresarial e administrativa',
                'sort_order' => 1
            ],
            [
                'name' => 'Inteligência Artificial',
                'slug' => 'inteligencia-artificial',
                'icon' => '🤖',
                'color' => '#8b5cf6',
                'description' => 'Soluções com IA e machine learning',
                'sort_order' => 2
            ],
            [
                'name' => 'Escolar',
                'slug' => 'escolar',
                'icon' => '🎓',
                'color' => '#10b981',
                'description' => 'Sistemas educacionais e acadêmicos',
                'sort_order' => 3
            ],
            [
                'name' => 'Negócios Locais',
                'slug' => 'negocios-locais',
                'icon' => '🏪',
                'color' => '#f59e0b',
                'description' => 'Soluções para pequenos negócios e comércio local',
                'sort_order' => 4
            ],
            [
                'name' => 'Financeiro',
                'slug' => 'financeiro',
                'icon' => '💰',
                'color' => '#ef4444',
                'description' => 'Sistemas financeiros e de pagamento',
                'sort_order' => 5
            ],
            [
                'name' => 'SaaS',
                'slug' => 'saas',
                'icon' => '☁️',
                'color' => '#06b6d4',
                'description' => 'Software as a Service - Soluções na nuvem',
                'sort_order' => 6
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
