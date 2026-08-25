<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    /**
     * Seed the footer Page record from the existing footer partial.
     *
     * Reads resources/views/frontend/partials/footer.blade.php, strips
     * Blade/PHP directives and converts Laravel route/asset helpers to plain
     * URLs, then upserts the row into the pages table with page_key = 'footer'.
     */
    public function run(): void
    {
        $partialPath = resource_path('views/frontend/partials/footer.blade.php');

        if (! file_exists($partialPath)) {
            $this->command->warn("Footer partial not found at: {$partialPath}");
            return;
        }

        $footerContent = file_get_contents($partialPath);

        // Strip raw PHP blocks
        $footerContent = preg_replace('/<\?php.*?\?>/s', '', $footerContent);

        // Strip Blade conditionals (keep the content inside @else block)
        $footerContent = preg_replace('/@if.*?@else/s', '', $footerContent);
        $footerContent = preg_replace('/@endif/', '', $footerContent);

        // Convert Laravel helpers to plain URLs
        $footerContent = str_replace("{{ route('courses') }}",           '/courses',           $footerContent);
        $footerContent = str_replace("{{ route('corporate-training') }}", '/corporate-training', $footerContent);
        $footerContent = str_replace("{{ route('placements') }}",         '/placements',         $footerContent);
        $footerContent = str_replace("{{ route('gallery') }}",            '/gallery',            $footerContent);
        $footerContent = str_replace("{{ route('about') }}",              '/about',              $footerContent);
        $footerContent = str_replace("{{ route('contact') }}",            '/contact',            $footerContent);
        $footerContent = str_replace("{{ route('cs-it-courses') }}",      '/cs-it-courses',      $footerContent);
        $footerContent = str_replace("{{ asset('frontend/assets/logo_v1.png') }}", '/frontend/assets/logo_v1.png', $footerContent);

        // Remove fallback comment marker
        $footerContent = trim(preg_replace('/<!-- Fallback Footer -->/', '', $footerContent));

        Page::updateOrCreate(
            ['page_key' => 'footer'],
            [
                'title'   => 'Footer Settings',
                'content' => $footerContent,
                'status'  => 'published',
            ]
        );

        $this->command->info('Footer page seeded successfully.');
    }
}
