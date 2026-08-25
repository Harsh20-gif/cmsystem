<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Seed the home Page record with the registration-strip content.
     *
     * Uses updateOrCreate so it is safe to run multiple times without
     * duplicating rows.
     */
    public function run(): void
    {
        $homeContent = <<<'HTML'
<div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2><i class="fas fa-bullhorn text-accent-cyan" style="margin-right: 0.6rem;"></i> Registrations Open
            For Virtual &amp; Industrial Internship Batch <span>2026</span></h2>
        <p class="text-sm" style="margin: 0; opacity: 0.9;">Hands-on practical labs, mentorship, and guaranteed
            interview opportunities across CS, EC, EE, ME &amp; Civil.</p>
    </div>
    <a href="javascript:void(0)" onclick="openEnrollModal('Virtual Internship 2026')" class="strip-btn">
        Register Now <i class="fas fa-arrow-right" style="margin-left: 0.4rem;"></i>
    </a>
</div>
HTML;

        Page::updateOrCreate(
            ['page_key' => 'home'],
            [
                'title'   => 'Home Page Settings',
                'content' => $homeContent,
                'status'  => 'published',
            ]
        );

        $this->command->info('Home page seeded successfully.');
    }
}
