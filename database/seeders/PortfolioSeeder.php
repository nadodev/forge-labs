<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $portfolios = [
            [
                'title' => 'PetAdota',
                'subtitle' => 'Plataforma de adoção de pets',
                'description' => 'Um site feito no estudo de Next.js e TypeScript para conectar pessoas que querem adotar pets com aqueles que precisam de um lar. O projeto inclui sistema de cadastro, busca por localização, chat entre usuários e galeria de fotos.',
                'content' => '<h3>Sobre o Projeto</h3><p>PetAdota foi desenvolvido como um projeto de estudo para aprender Next.js 13+ com App Router, TypeScript e TailwindCSS. O objetivo é criar uma plataforma completa para adoção de animais de estimação.</p><h4>Funcionalidades Principais:</h4><ul><li>Cadastro de usuários e pets</li><li>Busca por localização usando Leaflet</li><li>Chat em tempo real</li><li>Galeria de fotos</li><li>Sistema de favoritos</li></ul>',
                'technologies' => ['Next.js', 'TypeScript', 'TailwindCSS', 'Zustand', 'Leaflet'],
                'demo_url' => 'https://petadota-demo.vercel.app',
                'github_url' => 'https://github.com/geja/petadota',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'TaskFlow',
                'subtitle' => 'Sistema de gerenciamento de tarefas',
                'description' => 'Aplicação web para gerenciamento de projetos e tarefas com interface moderna e funcionalidades avançadas como drag-and-drop, notificações e relatórios.',
                'content' => '<h3>Sobre o Projeto</h3><p>TaskFlow é um sistema completo de gerenciamento de tarefas desenvolvido com Laravel e Vue.js. Oferece uma interface intuitiva para organizar projetos e acompanhar o progresso das atividades.</p>',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Bootstrap'],
                'demo_url' => null,
                'github_url' => 'https://github.com/geja/taskflow',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'title' => 'EcoTracker',
                'subtitle' => 'Monitoramento de pegada ecológica',
                'description' => 'Aplicativo mobile para rastrear e reduzir a pegada ecológica pessoal, com gamificação e desafios sustentáveis.',
                'content' => '<h3>Sobre o Projeto</h3><p>EcoTracker foi desenvolvido para conscientizar sobre sustentabilidade através de gamificação. Os usuários podem registrar suas atividades diárias e receber pontos por ações sustentáveis.</p>',
                'technologies' => ['React Native', 'Node.js', 'MongoDB', 'Firebase'],
                'demo_url' => null,
                'github_url' => 'https://github.com/geja/ecotracker',
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            $portfolio['slug'] = Str::slug($portfolio['title']);
            Portfolio::create($portfolio);
        }
    }
}