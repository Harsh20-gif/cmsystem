<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReplaceFooter extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cms:replace-footer';

    /**
     * The console command description.
     */
    protected $description = 'Replace inline <footer> blocks in all frontend Blade views with @include("frontend.partials.footer")';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dir   = resource_path('views/frontend');
        $files = glob($dir . '/*.blade.php');

        $updatedCount = 0;
        foreach ($files as $file) {
            if (basename($file) === 'footer.blade.php') {
                continue;
            }

            $content    = file_get_contents($file);
            $newContent = preg_replace(
                '/<footer class="footer">.*?<\/footer>/s',
                "@include('frontend.partials.footer')",
                $content
            );

            if ($content !== $newContent) {
                file_put_contents($file, $newContent);
                $this->info('Updated: ' . basename($file));
                $updatedCount++;
            }
        }

        $this->info("Done. {$updatedCount} file(s) updated.");

        return self::SUCCESS;
    }
}
