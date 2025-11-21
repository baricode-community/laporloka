<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\ReportAttachment;
use App\Models\ReportCategory;
use App\Models\ReportComment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->faker = Faker::create();
        
        // Create users
        User::factory(10)->create();

        // Create test user (check if exists first)
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Pengguna Uji Coba',
                'email' => 'test@example.com',
            ]);
        }

        // Create admin user (check if exists first)
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Administrator',
                'email' => 'admin@example.com',
            ]);
        }

        // Create report categories
        $categories = ReportCategory::factory(10)->create();

        // Create reports with comments and attachments
        Report::factory(50)
            ->recycle($categories)
            ->create()
            ->each(function ($report) {
                // Create 0-5 comments per report
                ReportComment::factory(
                    $this->faker->numberBetween(0, 5)
                )->create([
                    'report_id' => $report->id,
                ]);

                // Create 0-3 attachments per report
                ReportAttachment::factory(
                    $this->faker->numberBetween(0, 3)
                )->create([
                    'report_id' => $report->id,
                ]);
            });

        // Create some specific reports for testing
        Report::factory(5)
            ->pending()
            ->highPriority()
            ->create()
            ->each(function ($report) {
                ReportComment::factory(2)->public()->create([
                    'report_id' => $report->id,
                ]);
                ReportAttachment::factory(2)->image()->create([
                    'report_id' => $report->id,
                ]);
            });

        // Create some resolved reports
        Report::factory(10)
            ->resolved()
            ->create()
            ->each(function ($report) {
                ReportComment::factory(3)->create([
                    'report_id' => $report->id,
                ]);
            });

        // Create reports with video attachments
        Report::factory(3)
            ->urgent()
            ->create()
            ->each(function ($report) {
                ReportAttachment::factory(1)->video()->create([
                    'report_id' => $report->id,
                ]);
            });
    }
}
