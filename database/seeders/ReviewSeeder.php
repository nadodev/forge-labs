<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\System;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $azendaMe = System::where('slug', 'azendame')->first();
        $eduManager = System::where('slug', 'edumanager')->first();
        $financeFlow = System::where('slug', 'financeflow')->first();
        $smartCRM = System::where('slug', 'smartcrm')->first();
        $businessHub = System::where('slug', 'businesshub')->first();
        $cloudOffice = System::where('slug', 'cloudoffice')->first();

        $reviews = [
            // AzendaMe Reviews
            [
                'system_id' => $azendaMe->id,
                'author_name' => 'João Silva',
                'author_email' => 'joao@barbearia.com',
                'rating' => 5,
                'comment' => 'O AzendaMe revolucionou minha barbearia! Interface super intuitiva e os clientes adoram agendar pelo app.',
                'is_approved' => true
            ],
            [
                'system_id' => $azendaMe->id,
                'author_name' => 'Maria Santos',
                'author_email' => 'maria@salon.com',
                'rating' => 5,
                'comment' => 'Sistema perfeito para salão de beleza. Controle total dos agendamentos e relatórios detalhados.',
                'is_approved' => true
            ],
            [
                'system_id' => $azendaMe->id,
                'author_name' => 'Carlos Oliveira',
                'author_email' => 'carlos@clinica.com',
                'rating' => 4,
                'comment' => 'Muito bom! Apenas gostaria de mais opções de personalização, mas no geral atende perfeitamente.',
                'is_approved' => true
            ],

            // EduManager Reviews
            [
                'system_id' => $eduManager->id,
                'author_name' => 'Ana Costa',
                'author_email' => 'ana@escola.com',
                'rating' => 5,
                'comment' => 'Excelente sistema educacional! Facilitou muito a gestão da nossa escola. Interface limpa e funcional.',
                'is_approved' => true
            ],
            [
                'system_id' => $eduManager->id,
                'author_name' => 'Pedro Lima',
                'author_email' => 'pedro@universidade.com',
                'rating' => 4,
                'comment' => 'Sistema robusto e bem estruturado. Ideal para instituições de ensino que buscam modernização.',
                'is_approved' => true
            ],

            // FinanceFlow Reviews
            [
                'system_id' => $financeFlow->id,
                'author_name' => 'Roberto Alves',
                'author_email' => 'roberto@empresa.com',
                'rating' => 5,
                'comment' => 'A IA do FinanceFlow é impressionante! As previsões são precisas e me ajudam muito na tomada de decisões.',
                'is_approved' => true
            ],
            [
                'system_id' => $financeFlow->id,
                'author_name' => 'Lucia Ferreira',
                'author_email' => 'lucia@startup.com',
                'rating' => 5,
                'comment' => 'Dashboard incrível e análises muito detalhadas. Vale cada centavo investido!',
                'is_approved' => true
            ],

            // SmartCRM Reviews
            [
                'system_id' => $smartCRM->id,
                'author_name' => 'Fernando Souza',
                'author_email' => 'fernando@vendas.com',
                'rating' => 4,
                'comment' => 'Automação de leads funciona perfeitamente. Aumentou significativamente nossa conversão.',
                'is_approved' => true
            ],

            // BusinessHub Reviews
            [
                'system_id' => $businessHub->id,
                'author_name' => 'Patricia Mendes',
                'author_email' => 'patricia@loja.com',
                'rating' => 4,
                'comment' => 'Solução completa para meu negócio. Gestão de estoque e vendas em um só lugar.',
                'is_approved' => true
            ],
            [
                'system_id' => $businessHub->id,
                'author_name' => 'Marcos Rocha',
                'author_email' => 'marcos@comercio.com',
                'rating' => 5,
                'comment' => 'Interface amigável e funcionalidades que realmente fazem a diferença no dia a dia.',
                'is_approved' => true
            ],

            // CloudOffice Reviews
            [
                'system_id' => $cloudOffice->id,
                'author_name' => 'Sandra Vieira',
                'author_email' => 'sandra@empresa.com',
                'rating' => 4,
                'comment' => 'Ótima solução para trabalho remoto. Colaboração em tempo real funciona perfeitamente.',
                'is_approved' => true
            ],
            [
                'system_id' => $cloudOffice->id,
                'author_name' => 'Ricardo Nunes',
                'author_email' => 'ricardo@startup.com',
                'rating' => 5,
                'comment' => 'Preço justo e funcionalidades completas. Nossa equipe está muito satisfeita.',
                'is_approved' => true
            ]
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
