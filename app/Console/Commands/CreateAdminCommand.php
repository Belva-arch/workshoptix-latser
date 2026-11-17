<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {name?} {email?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat akun Panitia / Admin baru untuk WORKSHOPTIX';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->argument('name') ?? $this->ask('Nama Lengkap Panitia / Admin');
        $email = $this->argument('email') ?? $this->ask('Alamat Email Admin');
        $password = $this->argument('password') ?? $this->secret('Kata Sandi (Password)');

        if (User::where('email', $email)->exists()) {
            $this->error("Email [{$email}] sudah terdaftar di sistem!");
            return Command::FAILURE;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'panitia',
        ]);

        $this->info("✓ Akun Panitia/Admin [{$user->name}] berhasil dibuat dengan email [{$user->email}].");
        return Command::SUCCESS;
    }
}
