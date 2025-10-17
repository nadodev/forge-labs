<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\StackItem;
use App\Models\Certificate;
use App\Models\TimelineItem;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        // Criar perfil
        About::create([
            'title' => 'Desenvolvedor Full-Stack',
            'subtitle' => 'Especialista em Laravel, Vue.js e IA',
            'bio' => 'Desenvolvedor apaixonado por criar soluções digitais inovadoras. Com mais de 5 anos de experiência, foco em transformar ideias complexas em sistemas simples e eficientes.',
            'photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=face'
        ]);

        // Stack tecnológica
        $stackItems = [
            ['name' => 'Laravel', 'icon' => '🐘', 'level' => 'Expert', 'sort_order' => 1],
            ['name' => 'Vue.js', 'icon' => '💚', 'level' => 'Avançado', 'sort_order' => 2],
            ['name' => 'PHP', 'icon' => '🔷', 'level' => 'Expert', 'sort_order' => 3],
            ['name' => 'JavaScript', 'icon' => '🟨', 'level' => 'Avançado', 'sort_order' => 4],
            ['name' => 'MySQL', 'icon' => '🐬', 'level' => 'Avançado', 'sort_order' => 5],
            ['name' => 'TailwindCSS', 'icon' => '🎨', 'level' => 'Avançado', 'sort_order' => 6],
            ['name' => 'Docker', 'icon' => '🐳', 'level' => 'Intermediário', 'sort_order' => 7],
            ['name' => 'Git', 'icon' => '📝', 'level' => 'Avançado', 'sort_order' => 8],
        ];

        foreach ($stackItems as $item) {
            StackItem::create($item);
        }

        // Certificados
        $certificates = [
            [
                'title' => 'Laravel Certified Developer',
                'issuer' => 'Laravel LLC',
                'icon' => '🏆',
                'url' => 'https://laravel.com/certification',
                'issued_at' => '2023-06-15',
                'sort_order' => 1
            ],
            [
                'title' => 'AWS Cloud Practitioner',
                'issuer' => 'Amazon Web Services',
                'icon' => '☁️',
                'url' => 'https://aws.amazon.com/certification/',
                'issued_at' => '2023-03-20',
                'sort_order' => 2
            ],
            [
                'title' => 'Vue.js Developer Certification',
                'issuer' => 'Vue School',
                'icon' => '💚',
                'url' => 'https://vueschool.io/certification/',
                'issued_at' => '2022-11-10',
                'sort_order' => 3
            ],
        ];

        foreach ($certificates as $cert) {
            Certificate::create($cert);
        }

        // Timeline
        $timelineItems = [
            [
                'title' => 'Primeiro emprego como desenvolvedor',
                'subtitle' => 'TechStart Solutions',
                'description' => 'Início da carreira como desenvolvedor júnior, trabalhando com PHP e MySQL em sistemas web corporativos.',
                'date' => '2019-01-15',
                'icon' => '🚀',
                'sort_order' => 1
            ],
            [
                'title' => 'Especialização em Laravel',
                'subtitle' => 'Curso Avançado',
                'description' => 'Aprofundamento no framework Laravel, aprendendo arquiteturas avançadas e melhores práticas.',
                'date' => '2020-06-01',
                'icon' => '🐘',
                'sort_order' => 2
            ],
            [
                'title' => 'Desenvolvedor Sênior',
                'subtitle' => 'Digital Innovations',
                'description' => 'Promoção para desenvolvedor sênior, liderando projetos complexos e mentorando desenvolvedores júnior.',
                'date' => '2021-03-01',
                'icon' => '⭐',
                'sort_order' => 3
            ],
            [
                'title' => 'Fundação da Geja Systems',
                'subtitle' => 'Empreendedorismo',
                'description' => 'Criação da própria empresa focada em desenvolvimento de sistemas personalizados e consultoria tecnológica.',
                'date' => '2023-01-01',
                'icon' => '🏢',
                'sort_order' => 4
            ],
        ];

        foreach ($timelineItems as $item) {
            TimelineItem::create($item);
        }
    }
}