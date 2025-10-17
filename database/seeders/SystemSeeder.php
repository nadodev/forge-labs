<?php

namespace Database\Seeders;

use App\Models\System;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    public function run()
    {
        $gestaoCategory = Category::where('slug', 'gestao')->first();
        $iaCategory = Category::where('slug', 'inteligencia-artificial')->first();
        $escolarCategory = Category::where('slug', 'escolar')->first();
        $negociosCategory = Category::where('slug', 'negocios-locais')->first();
        $financeiroCategory = Category::where('slug', 'financeiro')->first();
        $saasCategory = Category::where('slug', 'saas')->first();

        $laravelTag = Tag::where('slug', 'laravel')->first();
        $vueTag = Tag::where('slug', 'vuejs')->first();
        $reactTag = Tag::where('slug', 'react')->first();
        $tailwindTag = Tag::where('slug', 'tailwind-css')->first();
        $mysqlTag = Tag::where('slug', 'mysql')->first();
        $apiTag = Tag::where('slug', 'api-rest')->first();
        $responsivoTag = Tag::where('slug', 'responsivo')->first();
        $pwaTag = Tag::where('slug', 'pwa')->first();

        $systems = [
            [
                'name' => 'AzendaMe',
                'slug' => 'azendame',
                'description' => 'Sistema completo de agendamento para barbearias, salões e clínicas.',
                'full_description' => 'O AzendaMe é uma solução completa para gestão de agendamentos, desenvolvida especificamente para barbearias, salões de beleza e clínicas. Com interface intuitiva e funcionalidades avançadas, facilita o controle de clientes, serviços e horários.',
                'icon' => '💈',
                'price' => 297.00,
                'license_type' => 'paid',
                'status' => 'active',
                'is_featured' => true,
                'views_count' => 1250,
                'downloads_count' => 89,
                'rating' => 4.8,
                'reviews_count' => 24,
                'features' => [
                    'Agendamento online',
                    'Gestão de clientes',
                    'Controle financeiro',
                    'Relatórios detalhados',
                    'App mobile',
                    'Integração com WhatsApp'
                ],
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS'],
                'category_id' => $negociosCategory->id,
                'tags' => [$laravelTag->id, $vueTag->id, $mysqlTag->id, $responsivoTag->id]
            ],
            [
                'name' => 'EduManager',
                'slug' => 'edumanager',
                'description' => 'Plataforma educacional completa para escolas e universidades.',
                'full_description' => 'Sistema de gestão educacional que integra todas as funcionalidades necessárias para administrar uma instituição de ensino, desde o controle acadêmico até a gestão financeira.',
                'icon' => '🎓',
                'price' => 0.00,
                'license_type' => 'open_source',
                'status' => 'active',
                'is_featured' => true,
                'views_count' => 2100,
                'downloads_count' => 156,
                'rating' => 4.6,
                'reviews_count' => 18,
                'features' => [
                    'Gestão de alunos',
                    'Controle de notas',
                    'Calendário acadêmico',
                    'Portal do aluno',
                    'Relatórios pedagógicos',
                    'Comunicação escolar'
                ],
                'technologies' => ['Laravel', 'React', 'PostgreSQL', 'Tailwind CSS'],
                'category_id' => $escolarCategory->id,
                'tags' => [$laravelTag->id, $reactTag->id, $apiTag->id, $pwaTag->id]
            ],
            [
                'name' => 'FinanceFlow',
                'slug' => 'financeflow',
                'description' => 'Sistema de gestão financeira com IA para análise de dados.',
                'full_description' => 'Plataforma avançada de gestão financeira que utiliza inteligência artificial para análise de padrões, previsões e recomendações inteligentes para otimização de recursos.',
                'icon' => '💰',
                'price' => 497.00,
                'license_type' => 'saas',
                'status' => 'active',
                'is_featured' => true,
                'views_count' => 890,
                'downloads_count' => 45,
                'rating' => 4.9,
                'reviews_count' => 12,
                'features' => [
                    'Análise com IA',
                    'Previsões financeiras',
                    'Dashboard inteligente',
                    'Integração bancária',
                    'Relatórios automáticos',
                    'Alertas personalizados'
                ],
                'technologies' => ['Laravel', 'Vue.js', 'Python', 'MySQL'],
                'category_id' => $financeiroCategory->id,
                'tags' => [$laravelTag->id, $vueTag->id, $mysqlTag->id, $apiTag->id]
            ],
            [
                'name' => 'SmartCRM',
                'slug' => 'smartcrm',
                'description' => 'CRM inteligente com automação de processos e IA.',
                'full_description' => 'Sistema de gestão de relacionamento com clientes que utiliza inteligência artificial para automatizar processos, qualificar leads e otimizar vendas.',
                'icon' => '🤖',
                'price' => 397.00,
                'license_type' => 'saas',
                'status' => 'active',
                'is_featured' => false,
                'views_count' => 650,
                'downloads_count' => 23,
                'rating' => 4.7,
                'reviews_count' => 8,
                'features' => [
                    'Automação de leads',
                    'IA para qualificação',
                    'Pipeline inteligente',
                    'Integração com redes sociais',
                    'Análise de comportamento',
                    'Relatórios preditivos'
                ],
                'technologies' => ['Laravel', 'React', 'Python', 'PostgreSQL'],
                'category_id' => $iaCategory->id,
                'tags' => [$laravelTag->id, $reactTag->id, $apiTag->id, $responsivoTag->id]
            ],
            [
                'name' => 'BusinessHub',
                'slug' => 'businesshub',
                'description' => 'Hub completo para gestão de pequenos negócios.',
                'full_description' => 'Solução integrada que combina gestão de estoque, vendas, clientes e financeiro em uma única plataforma, ideal para pequenos e médios negócios.',
                'icon' => '🏪',
                'price' => 197.00,
                'license_type' => 'paid',
                'status' => 'active',
                'is_featured' => false,
                'views_count' => 420,
                'downloads_count' => 34,
                'rating' => 4.5,
                'reviews_count' => 15,
                'features' => [
                    'Gestão de estoque',
                    'Controle de vendas',
                    'CRM integrado',
                    'Relatórios financeiros',
                    'App mobile',
                    'Integração com marketplaces'
                ],
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS'],
                'category_id' => $gestaoCategory->id,
                'tags' => [$laravelTag->id, $vueTag->id, $mysqlTag->id, $responsivoTag->id]
            ],
            [
                'name' => 'CloudOffice',
                'slug' => 'cloudoffice',
                'description' => 'Suíte de produtividade na nuvem para equipes.',
                'full_description' => 'Plataforma SaaS que oferece ferramentas de produtividade, colaboração e gestão de projetos, tudo integrado em uma única solução na nuvem.',
                'icon' => '☁️',
                'price' => 29.90,
                'license_type' => 'saas',
                'status' => 'active',
                'is_featured' => false,
                'views_count' => 780,
                'downloads_count' => 67,
                'rating' => 4.4,
                'reviews_count' => 21,
                'features' => [
                    'Documentos colaborativos',
                    'Gestão de projetos',
                    'Chat em tempo real',
                    'Armazenamento na nuvem',
                    'Calendário compartilhado',
                    'Integração com ferramentas'
                ],
                'technologies' => ['Laravel', 'React', 'PostgreSQL', 'WebSocket'],
                'category_id' => $saasCategory->id,
                'tags' => [$laravelTag->id, $reactTag->id, $apiTag->id, $pwaTag->id]
            ]
        ];

        foreach ($systems as $systemData) {
            $tags = $systemData['tags'];
            unset($systemData['tags']);
            
            $system = System::create($systemData);
            $system->tags()->attach($tags);
        }
    }
}
