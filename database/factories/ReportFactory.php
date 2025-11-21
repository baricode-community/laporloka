<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\ReportCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['pending', 'reviewed', 'in_progress', 'resolved', 'rejected'];
        $priorities = ['low', 'medium', 'high', 'urgent'];
        
        // Indonesian titles and descriptions
        $titles = [
            'Jalan Berlubang di Perumahan',
            'Lampu Jalan Mati Sudah 3 Minggu',
            'Sampah Menumpuk di TPS',
            'Selokan Mampet Akibatkan Banjir Kecil',
            'Fasilitas Playground Rusak',
            'Taman Kota Butuh Perawatan',
            'Gangguan Keamanan di Malam Hari',
            'Marka Jalan Sudah Hilang',
            'Puskesmas Butuh Tambahan Tenaga',
            'Sekolah Butuh Perbaikan Atap',
            'Jalur Pejalan Kaki Tertutup',
            'Lampu Lalu Lintas Rusak',
            'Kebisingan dari Pabrik',
            'Pohon Tumbang Menutup Jalan',
            'Air PDAM Tidak Mengalir',
            'Jalur Sepeda Tidak Aman',
            'Parkir Liar Mengganggu Lalu Lintas',
            'Gorong-gorong Penuh Sampah',
            'Fasilitas Disabilitas Rusak',
            'Pos Kamling Butuh Perbaikan'
        ];
        
        $descriptions = [
            'Sudah beberapa bulan ini kondisi jalan di perumahan kami sangat memprihatinkan. Banyak lubang yang bisa membahayakan pengendara terutama di malam hari. Mohon segera dilakukan perbaikan.',
            'Lampu jalan di sepanjang Jalan Merdeka sudah mati selama 3 minggu. Kondisi ini sangat berbahaya bagi warga yang pulang malam dan rawan terjadi kejahatan.',
            'Tempat pembuangan sampah sementara di RT 03/RW 02 sudah penuh dan menumpuk. Sampah sudah mulai menyebar ke jalan dan menimbulkan bau tidak sedap.',
            'Selokan di depan pasar tradisional mampet akibat tumpukan sampah dan lumpur. Saat hujan turun, air meluap ke jalan dan menyebabkan banjir kecil.',
            'Fasilitas playground di taman kota banyak yang rusak. Ayunan patah, perosotan pecah, dan jungkat-jungkit tidak bisa digunakan. Anak-anak kecewa.',
            'Taman kota yang seharusnya menjadi paru-paru kota kondisinya memprihatinkan. Rumput liar tumbuh, bangku rusak, dan banyak sampah berserakan.',
            'Akhir-akhir ini sering terjadi gangguan keamanan di malam hari di kawasan perumahan kami. Beberapa rumah menjadi sasaran pencurian. Mohon penambahan patroli.',
            'Marka jalan di persimpangan utama sudah tidak terlihat lagi. Ini sering menyebabkan kebingungan pengendara dan potensi kecelakaan.',
            'Puskesmas di kecamatan kami kekurangan tenaga medis. Pasien sering harus antre berjam-jam untuk mendapatkan pelayanan dasar.',
            'Atap sekolah dasar kami bocor di beberapa titik. Saat hujan, air menetes ke dalam ruang kelas dan mengganggu proses belajar mengajar.',
            'Jalur pejalan kaki di jalan protokol tertutup oleh pedagang kaki lima. Pejalan kaki terpaksa berjalan di bahu jalan yang sangat berbahaya.',
            'Lampu lalu lintas di perempatan strategis rusak. Ini sering menyebabkan kemacetan panjang dan potensi tabrakan.',
            'Pabrik di sebelah timur perumahan kami mengeluarkan suara bising 24 jam. Kebisingan sangat mengganggu ketenangan warga terutama di malam hari.',
            'Sebuah pohon besar tumbang menutupi separuh badan jalan. Sudah 2 hari belum ada penanganan dari dinas terkait. Lalu lintas menjadi macet.',
            'Air PDAM di wilayah kami sudah 3 hari tidak mengalir. Warga kesulitan mendapatkan air bersih untuk kebutuhan sehari-hari.',
            'Jalur sepeda yang baru dibuat tidak aman digunakan. Banyak kendaraan bermotor yang masih menggunakan jalur tersebut dan tidak ada rambu peringatan.',
            'Parkir liar di pinggir jalan utama semakin parah. Ini menyebabkan kemacetan dan mengurangi lebar jalan yang efektif.',
            'Gorong-gorang di jalan Sudirman penuh dengan sampah plastik. Saat hujan tidak bisa menampung air dengan baik dan menyebabkan genangan.',
            'Fasilitas untuk penyandang disabilitas di terminal bus rusak. Ramba taktil hilang dan toilet khusus tidak bisa digunakan.',
            'Pos kamling di ujung gang kami butuh perbaikan segera. Atap bocor, dinding retak, dan tidak ada listrik. Warga tidak berani berjaga malam.'
        ];
        
        $locations = [
            'Jl. Merdeka No. 123, Kelurahan Sukamaju, Kecamatan Makmur',
            'Jl. Sudirman No. 456, RT 03/RW 02, Kelurahan Jaya',
            'Perumahan Griya Indah Blok A No. 15, Kecamatan Sejahtera',
            'Jl. Ahmad Yani No. 789, Kelurahan Baru, Kecamatan Taman',
            'Kompleks Pertokoan Maju Jaya, Jl. Gatot Subroto No. 321',
            'Taman Kota Bunga, Jl. Pahlawan No. 654',
            'Pasar Tradisional Sumber Rejeki, Jl. Diponegoro No. 987',
            'Sekolah Dasar Negeri 01, Jl. Kartini No. 147',
            'Puskesmas Sehat Sejahtera, Jl. Gajah Mada No. 258',
            'Perumahan Harmoni Blok C No. 33, Kecamatan Damai'
        ];
        
        $adminNotes = [
            'Segera koordinasikan dengan dinas terkait untuk penanganan lebih lanjut.',
            'Perlu survei lapangan untuk menentukan prioritas penanganan.',
            'Mohon update status setelah melakukan peninjauan lokasi.',
            'Laporan sudah diverifikasi, siap untuk ditindaklanjuti.',
            'Perlu alokasi anggaran untuk perbaikan permanen.',
            'Sementara pasang rambu peringatan untuk keselamatan warga.',
            'Koordinasikan dengan kontraktor rekanan untuk estimasi biaya.',
            'Prioritaskan penanganan karena berdampak pada banyak warga.',
            'Lakukan monitoring berkala setelah perbaikan selesai.',
            'Dokumentasikan proses penanganan untuk laporan bulanan.'
        ];
        
        return [
            'user_id' => User::factory(),
            'category_id' => ReportCategory::factory(),
            'title' => $this->faker->randomElement($titles),
            'description' => $this->faker->randomElement($descriptions),
            'location_address' => $this->faker->randomElement($locations),
            'latitude' => $this->faker->latitude(-6.3, -6.1), // Jakarta area
            'longitude' => $this->faker->longitude(106.7, 106.9), // Jakarta area
            'status' => $this->faker->randomElement($statuses),
            'priority' => $this->faker->randomElement($priorities),
            'report_number' => 'LP-' . date('Y') . '-' . str_pad($this->faker->unique()->numberBetween(1, 999999), 6, '0', STR_PAD_LEFT),
            'reported_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'resolved_at' => $this->faker->optional(0.3)->dateTimeBetween('-1 month', 'now'),
            'admin_notes' => $this->faker->optional(0.4)->randomElement($adminNotes),
            'assigned_to' => $this->faker->optional(0.3)->numberBetween(1, 3), // Assuming admin IDs
            'views_count' => $this->faker->numberBetween(0, 500),
            'is_public' => $this->faker->boolean(90), // 90% chance of being public
        ];
    }

    /**
     * Indicate that the report is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'resolved_at' => null,
        ]);
    }

    /**
     * Indicate that the report is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
            'resolved_at' => null,
        ]);
    }

    /**
     * Indicate that the report is resolved.
     */
    public function resolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'resolved',
            'resolved_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    /**
     * Indicate that the report is high priority.
     */
    public function highPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'high',
        ]);
    }

    /**
     * Indicate that the report is urgent.
     */
    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'urgent',
        ]);
    }

    /**
     * Indicate that the report is private.
     */
    public function private(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_public' => false,
        ]);
    }
}
