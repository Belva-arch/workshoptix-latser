<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workshop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Panitia
        $panitia = User::updateOrCreate(
            ['email' => 'panitia@workshoptix.id'],
            [
                'name' => 'Admin Panitia Workshop',
                'password' => Hash::make('password123'),
                'role' => 'panitia',
            ]
        );

        // 2. Akun Peserta Demo
        $peserta = User::updateOrCreate(
            ['email' => 'peserta@workshoptix.id'],
            [
                'name' => 'Rian Hidayat (Siswa RPL)',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
            ]
        );

        // 3. Data Workshop IT Realistis & Menarik
        $workshops = [
            [
                'title' => 'Mastering Modern Full-Stack Laravel 11 & React Inertia',
                'category' => 'Web Development',
                'instructor' => 'Alex Pratama',
                'instructor_title' => 'Senior Lead Software Engineer at GoTo',
                'description' => 'Pelajari arsitektur full-stack modern menggunakan Laravel 11, React Inertia, SSR, dan database indexing skala jutaan user. Dilengkapi studi kasus real-world deployment.',
                'start_time' => now()->addDays(5)->setHour(9)->setMinute(0),
                'end_time' => now()->addDays(5)->setHour(16)->setMinute(0),
                'location' => 'Auditorium Cyber & Lab Software RPL',
                'price' => 75000,
                'quota' => 40,
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'title' => 'Cyber Security Defense: Penetration Testing & API Vulnerability',
                'category' => 'Cyber Security',
                'instructor' => 'Fadhil Kurniawan, CEH',
                'instructor_title' => 'Certified Ethical Hacker & Bug Hunter',
                'description' => 'Bedah tuntas OWASP Top 10, eksploitasi API endpoints, privilege escalation, dan implementasi automated security audit pada sistem berbasis cloud.',
                'start_time' => now()->addDays(7)->setHour(13)->setMinute(0),
                'end_time' => now()->addDays(7)->setHour(17)->setMinute(30),
                'location' => 'Lab Jaringan & Cyber Security',
                'price' => 95000,
                'quota' => 30,
                'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'title' => 'Microservices Architecture & Docker Containerization in Practice',
                'category' => 'Cloud & DevOps',
                'instructor' => 'Nabila Salsabila',
                'instructor_title' => 'Cloud Solutions Architect',
                'description' => 'Transformasi monolitik menjadi microservices efisien dengan Docker container, Redis queue messaging, CI/CD pipeline, dan monitoring berbasis Prometheus & Grafana.',
                'start_time' => now()->addDays(12)->setHour(9)->setMinute(30),
                'end_time' => now()->addDays(12)->setHour(15)->setMinute(30),
                'location' => 'Lab Komputasi Cloud',
                'price' => 85000,
                'quota' => 25,
                'image' => 'https://images.unsplash.com/photo-1667372393119-3d4c48d07fc9?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'title' => 'Generative AI & LLM Integration for Web Applications',
                'category' => 'Artificial Intelligence',
                'instructor' => 'Dr. Hendra Gunawan',
                'instructor_title' => 'AI Researcher & Data Science Specialist',
                'description' => 'Praktik langsung integrasi LLM API, function calling, Retrieval-Augmented Generation (RAG) dengan vector database pgvector pada aplikasi web produksi.',
                'start_time' => now()->addDays(15)->setHour(10)->setMinute(0),
                'end_time' => now()->addDays(15)->setHour(16)->setMinute(0),
                'location' => 'Hall Utama Kampus RPL',
                'price' => 120000,
                'quota' => 50,
                'image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1200&auto=format&fit=crop',
            ],
        ];

        foreach ($workshops as $ws) {
            Workshop::updateOrCreate(
                ['slug' => Str::slug($ws['title'])],
                array_merge($ws, ['slug' => Str::slug($ws['title'])])
            );
        }
    }
}
