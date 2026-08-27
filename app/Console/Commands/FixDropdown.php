<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FixDropdown extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:fix-dropdown';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replace hardcoded About Us dropdown with a standard nav-link across all frontend Blade views';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dir = new RecursiveDirectoryIterator(resource_path('views/frontend'));
        $ite = new RecursiveIteratorIterator($dir);

        $pattern = '/<div class="nav-dropdown">\s*<a href="\{\{ route\(\'about\'\) \}\}" class="nav-link">About Us <i class="fas fa-chevron-down text-xs"\s*(style="margin-left: 0\.2rem;")?><\/i><\/a>\s*<div class="dropdown-menu-custom">\s*<a href="\{\{ route\(\'about\'\) \}\}" class="dropdown-item-custom"><i class="fas fa-building"><\/i> About Our\s*Institute<\/a>\s*<a href="about\.html#team" class="dropdown-item-custom"><i class="fas fa-users-gear"><\/i> Leadership Team<\/a>\s*<a href="about\.html#infra" class="dropdown-item-custom"><i class="fas fa-microchip"><\/i> Lab\s*Infrastructure<\/a>\s*<\/div>\s*<\/div>/i';
        $replacement = '<a href="{{ route(\'about\') }}" class="nav-link">About Us</a>';

        $totalUpdated = 0;

        foreach($ite as $file) {
            if ($file->isFile() && $file->getExtension() == 'php') {
                $content = file_get_contents($file->getPathname());
                $newContent = preg_replace($pattern, $replacement, $content, -1, $count);
                if ($count > 0) {
                    file_put_contents($file->getPathname(), $newContent);
                    $this->info("Updated: " . $file->getPathname());
                    $totalUpdated++;
                }
            }
        }

        if ($totalUpdated === 0) {
            $this->info('No files required updating.');
        } else {
            $this->info("Successfully updated {$totalUpdated} file(s).");
        }
    }
}
