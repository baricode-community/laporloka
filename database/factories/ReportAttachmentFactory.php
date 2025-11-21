<?php

namespace Database\Factories;

use App\Models\ReportAttachment;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportAttachment>
 */
class ReportAttachmentFactory extends Factory
{
    protected $model = ReportAttachment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mimeTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'video/mp4',
            'video/avi',
        ];

        $mimeType = $this->faker->randomElement($mimeTypes);
        $filename = $this->faker->uuid() . '.' . $this->getExtensionFromMimeType($mimeType);
        
        // Indonesian file names
        $fileNames = [
            'foto_jalan_rusak',
            'dokumentasi_lampu_mati',
            'buki_sampah_menumpuk',
            'video_selokan_mampet',
            'gambar_taman_rusak',
            'laporan_fasilitas_umum',
            'foto_gangguan_keamanan',
            'dokumen_marka_jalan',
            'gambar_kondisi_puskesmas',
            'video_sekolah_rusak',
            'foto_jalur_pejalan_kaki',
            'dokumen_lampu_lalu_lintas',
            'gambar_kebisingan_pabrik',
            'video_pohon_tumbang',
            'foto_air_pdam_mati',
            'dokumen_jalur_sepeda',
            'gambar_parkir_liar',
            'video_gorong_gorong',
            'foto_fasilitas_disabilitas',
            'dokumen_pos_kamling'
        ];
        
        $descriptions = [
            'Dokumentasi foto kondisi saat ini di lokasi kejadian.',
            'Bukti video yang menunjukkan masalah secara jelas.',
            'File pendukung untuk memperkuat laporan yang dibuat.',
            'Dokumen resmi dari instansi terkait mengenai masalah ini.',
            'Foto tambahan dari sudut pandang yang berbeda.',
            'Video rekaman kronologis kejadian yang terjadi.',
            'Dokumen keterangan saksi mata di lokasi.',
            'Foto close-up detail kerusakan yang terjadi.',
            'Video situasi umum di sekitar lokasi laporan.',
            'Dokumen surat pengaduan resmi ke pihak berwenang.'
        ];

        return [
            'report_id' => Report::factory(),
            'user_id' => User::factory(),
            'filename' => $filename,
            'original_name' => $this->faker->randomElement($fileNames) . '_' . $this->faker->numberBetween(1, 99) . '.' . $this->getExtensionFromMimeType($mimeType),
            'mime_type' => $mimeType,
            'file_size' => $this->faker->numberBetween(1024, 10485760), // 1KB to 10MB
            'file_path' => 'reports/' . $filename,
            'description' => $this->faker->optional(0.6)->randomElement($descriptions),
            'is_public' => $this->faker->boolean(85), // 85% chance of being public
        ];
    }

    /**
     * Get file extension from MIME type.
     */
    private function getExtensionFromMimeType(string $mimeType): string
    {
        return match($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'video/mp4' => 'mp4',
            'video/avi' => 'avi',
            default => 'txt',
        };
    }

    /**
     * Indicate that the attachment is an image.
     */
    public function image(): static
    {
        $imageNames = [
            'foto_bukti_kejadian',
            'gambar_kondisi_lokasi',
            'dokumentasi_visual',
            'foto_detail_kerusakan',
            'gambar_situasi_terkini'
        ];
        
        return $this->state(fn (array $attributes) => [
            'mime_type' => $this->faker->randomElement(['image/jpeg', 'image/png', 'image/gif']),
            'filename' => $this->faker->uuid() . '.' . $this->faker->randomElement(['jpg', 'png', 'gif']),
            'original_name' => $this->faker->randomElement($imageNames) . '_' . $this->faker->numberBetween(1, 99) . '.' . $this->faker->randomElement(['jpg', 'png', 'gif']),
        ]);
    }

    /**
     * Indicate that the attachment is a document.
     */
    public function document(): static
    {
        return $this->state(fn (array $attributes) => [
            'mime_type' => $this->faker->randomElement([
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]),
        ]);
    }

    /**
     * Indicate that the attachment is a video.
     */
    public function video(): static
    {
        $videoNames = [
            'video_rekaman_kejadian',
            'dokumentasi_video',
            'rekaman_situasi_lokasi',
            'video_kronologis',
            'buki_video_laporan'
        ];
        
        return $this->state(fn (array $attributes) => [
            'mime_type' => $this->faker->randomElement(['video/mp4', 'video/avi']),
            'filename' => $this->faker->uuid() . '.' . $this->faker->randomElement(['mp4', 'avi']),
            'original_name' => $this->faker->randomElement($videoNames) . '_' . $this->faker->numberBetween(1, 99) . '.' . $this->faker->randomElement(['mp4', 'avi']),
            'file_size' => $this->faker->numberBetween(1048576, 52428800), // 1MB to 50MB
        ]);
    }

    /**
     * Indicate that the attachment is private.
     */
    public function private(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_public' => false,
        ]);
    }
}
