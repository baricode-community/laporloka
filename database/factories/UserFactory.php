<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Indonesian names
        $firstNames = [
            'Ahmad', 'Budi', 'Chandra', 'Dedi', 'Eko', 'Fajar', 'Gunawan', 'Hendra', 'Iwan', 'Joko',
            'Kusumo', 'Lukman', 'Muhammad', 'Nur', 'Omar', 'Prabowo', 'Rudi', 'Sukma', 'Toni', 'Umar',
            'Viktor', 'Wahyu', 'Yudi', 'Zainal', 'Agus', 'Bambang', 'Cahyo', 'Doni', 'Eko', 'Fikri',
            'Gilang', 'Hadi', 'Indra', 'Jaka', 'Kurniawan', 'Lutfi', 'Mochammad', 'Nanda', 'Oman', 'Putra',
            'Qori', 'Rizki', 'Satria', 'Teguh', 'Ujang', 'Vino', 'Wahyu', 'Yoga', 'Zulkifli', 'Andi',
            'Siti', 'Dewi', 'Ratna', 'Sri', 'Nur', 'Fitri', 'Indah', 'Maya', 'Rini', 'Wati',
            'Susanti', 'Permata', 'Sari', 'Ayu', 'Lestari', 'Puspita', 'Mawar', 'Melati', 'Sakura', 'Anggrek'
        ];
        
        $lastNames = [
            'Santoso', 'Wijaya', 'Hidayat', 'Pratama', 'Saputra', 'Gunawan', 'Sutrisno', 'Hidayat', 'Kusumo', 'Siregar',
            'Pangestu', 'Nugroho', 'Firmansyah', 'Rahman', 'Hakim', 'Sudirman', 'Kurniawan', 'Suharto', 'Wibowo', 'Prasetyo',
            'Setiawan', 'Utomo', 'Suryono', 'Rahardjo', 'Wibisono', 'Santoso', 'Suyanto', 'Purnomo', 'Mulyono', 'Suharsono',
            'Wijanarko', 'Prabowo', 'Sulistyo', 'Waskito', 'Handoko', 'Riyadi', 'Wibawa', 'Saptono', 'Widodo', 'Sutanto',
            'Permadi', 'Wijayanto', 'Suyono', 'Wibisono', 'Sutopo', 'Wijaya', 'Suharyono', 'Wibowo', 'Sutrisno', 'Widodo'
        ];
        
        $firstName = $this->faker->randomElement($firstNames);
        $lastName = $this->faker->randomElement($lastNames);
        $fullName = $firstName . ' ' . $lastName;
        
        return [
            'name' => $fullName,
            'email' => strtolower(str_replace(' ', '.', $fullName)) . '@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= 'password',
            'remember_token' => Str::random(10),
            'two_factor_secret' => Str::random(10),
            'two_factor_recovery_codes' => Str::random(10),
            'two_factor_confirmed_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model does not have two-factor authentication configured.
     */
    public function withoutTwoFactor(): static
    {
        return $this->state(fn (array $attributes) => [
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ]);
    }
}
