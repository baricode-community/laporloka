<?php

namespace Database\Factories;

use App\Models\ReportComment;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportComment>
 */
class ReportCommentFactory extends Factory
{
    protected $model = ReportComment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commentTypes = ['comment', 'status_change', 'admin_note'];
        
        // Indonesian comments
        $comments = [
            'Terima kasih atas laporannya, kami akan segera menindaklanjuti.',
            'Saya juga mengalami hal yang sama di lokasi dekat rumah saya.',
            'Mohon update terkini mengenai penanganan laporan ini.',
            'Sudah seminggu belum ada tindakan, kapan akan diperbaiki?',
            'Alhamdulillah sudah diperbaiki, terima kasih pemerintah.',
            'Masih belum ada perubahan, tolong segera ditindaklanjuti.',
            'Apakah ada estimasi waktu untuk penyelesaian masalah ini?',
            'Saya harap ini segera diselesaikan karena sangat mengganggu.',
            'Terima kasih atas perhatiannya, semoga cepat selesai.',
            'Mohon prioritaskan penanganan karena membahayakan anak-anak.',
            'Saya akan memantau perkembangan penanganan laporan ini.',
            'Bagus sekali responsnya, cepat dan tepat sasaran.',
            'Semoga dengan laporan ini lingkungan kita menjadi lebih baik.',
            'Tolong beritahu jika sudah ada petugas yang datang ke lokasi.',
            'Saya ikut membantu menginformasikan ke tetangga sekitar.'
        ];
        
        return [
            'report_id' => Report::factory(),
            'user_id' => User::factory(),
            'content' => $this->faker->randomElement($comments),
            'type' => $this->faker->randomElement($commentTypes),
            'is_internal' => $this->faker->boolean(20), // 20% chance of being internal
        ];
    }

    /**
     * Indicate that the comment is a public comment.
     */
    public function public(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'comment',
            'is_internal' => false,
        ]);
    }

    /**
     * Indicate that the comment is a status change.
     */
    public function statusChange(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'status_change',
            'content' => $this->faker->randomElement([
                'Status diubah dari pending ke reviewed',
                'Status diubah dari reviewed ke in_progress', 
                'Status diubah dari in_progress ke resolved',
                'Laporan telah ditinjau ulang',
                'Laporan sedang dalam proses penanganan',
                'Laporan telah selesai ditangani',
            ]),
        ]);
    }

    /**
     * Indicate that the comment is an admin note.
     */
    public function adminNote(): static
    {
        $adminNotes = [
            'Perlu koordinasi dengan dinas terkait untuk penanganan lebih lanjut.',
            'Sudah melakukan survei lapangan, akan segera ditindaklanjuti.',
            'Menunggu alokasi anggaran dari APBD tahun ini.',
            'Prioritaskan penanganan karena berdampak pada banyak warga.',
            'Perlu perbaikan permanen, bukan hanya solusi sementara.',
            'Sudah diusulkan dalam rapat koordinasi bulan ini.',
            'Mohon update status setelah melakukan peninjauan lokasi.',
            'Laporan sudah diverifikasi dan siap untuk ditindaklanjuti.',
            'Koordinasikan dengan kontraktor rekanan untuk estimasi biaya.',
            'Dokumentasikan proses penanganan untuk laporan bulanan.'
        ];
        
        return $this->state(fn (array $attributes) => [
            'type' => 'admin_note',
            'is_internal' => true,
            'content' => $this->faker->randomElement($adminNotes),
        ]);
    }

    /**
     * Indicate that the comment is internal.
     */
    public function internal(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_internal' => true,
        ]);
    }
}
