<?php

namespace Database\Factories;

use App\Models\ReportCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportCategory>
 */
class ReportCategoryFactory extends Factory
{
    protected $model = ReportCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Jalan Rusak' => [
                'icon' => 'road',
                'color' => '#8B4513',
                'description' => 'Laporan mengenai kerusakan jalan seperti lubang, retak, atau pengaspalan yang tidak merata.'
            ],
            'Penerangan Jalan' => [
                'icon' => 'lightbulb',
                'color' => '#FFD700',
                'description' => 'Laporan mengenai lampu jalan yang mati, redup, atau penerangan yang tidak memadai.'
            ],
            'Sampah' => [
                'icon' => 'trash',
                'color' => '#228B22',
                'description' => 'Laporan mengenai penumpukan sampah, TPS penuh, atau pengelolaan sampah yang tidak baik.'
            ],
            'Drainase' => [
                'icon' => 'water',
                'color' => '#4682B4',
                'description' => 'Laporan mengenai selokan mampet, gorong-gorong tersumbat, atau masalah drainase lainnya.'
            ],
            'Taman' => [
                'icon' => 'tree',
                'color' => '#32CD32',
                'description' => 'Laporan mengenai taman kota yang butuh perawatan, fasilitas rusak, atau kebersihan taman.'
            ],
            'Fasilitas Umum' => [
                'icon' => 'building',
                'color' => '#708090',
                'description' => 'Laporan mengenai fasilitas umum seperti toilet umum, halte bus, atau fasilitas publik lainnya.'
            ],
            'Keamanan' => [
                'icon' => 'shield',
                'color' => '#DC143C',
                'description' => 'Laporan mengenai gangguan keamanan, pos kamling rusak, atau masalah ketertiban umum.'
            ],
            'Lalu Lintas' => [
                'icon' => 'car',
                'color' => '#FF6347',
                'description' => 'Laporan mengenai marka jalan hilang, lampu lalu lintas rusak, atau kelengkapan jalan lainnya.'
            ],
            'Kesehatan' => [
                'icon' => 'heart',
                'color' => '#FF69B4',
                'description' => 'Laporan mengenai fasilitas kesehatan, puskesmas, atau layanan kesehatan masyarakat.'
            ],
            'Pendidikan' => [
                'icon' => 'book',
                'color' => '#4169E1',
                'description' => 'Laporan mengenai fasilitas pendidikan, sekolah rusak, atau sarana belajar yang tidak memadai.'
            ],
        ];

        $category = $this->faker->randomElement(array_keys($categories));
        $categoryData = $categories[$category];

        return [
            'name' => $category,
            'slug' => Str::slug($category) . '-' . $this->faker->unique()->randomNumber(4),
            'description' => $categoryData['description'],
            'icon' => $categoryData['icon'],
            'color' => $categoryData['color'],
            'is_active' => true,
            'sort_order' => $this->faker->numberBetween(1, 100),
        ];
    }
}
