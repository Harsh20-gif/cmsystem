<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReplaceCourseNav extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cms:replace-course-nav';

    /**
     * The console command description.
     */
    protected $description = 'Replace hardcoded course navigation dropdown in frontend Blade views with a dynamic @foreach loop over $courseCategories';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dir   = resource_path('views/frontend');
        $files = glob($dir . '/*.blade.php');

        // Two variants of the hardcoded dropdown that may exist across files
        $search1 = '<div class="dropdown-menu-custom">
            <a href="{{ route(\'cs-it-courses\') }}" class="dropdown-item-custom"><i class="fas fa-laptop-code"></i>
              Computer Science &amp; IT</a>
            <a href="core-engineering.html#electrical" class="dropdown-item-custom"><i class="fas fa-bolt"></i>
              Electrical Engineering</a>
            <a href="core-engineering.html#mechanical" class="dropdown-item-custom"><i class="fas fa-cogs"></i>
              Mechanical &amp; MEP / HVAC</a>
            <a href="core-engineering.html#electronics" class="dropdown-item-custom"><i class="fas fa-microchip"></i>
              Electronics &amp; Embedded</a>
            <a href="core-engineering.html#civil" class="dropdown-item-custom"><i class="fas fa-drafting-compass"></i>
              Civil Engineering</a>
          </div>';

        $search2 = '<div class="dropdown-menu-custom">
            <a href="{{ route(\'cs-it-courses\') }}" class="dropdown-item-custom"><i class="fas fa-laptop-code"></i> Computer Science &amp; IT</a>
            <a href="core-engineering.html#electrical" class="dropdown-item-custom"><i class="fas fa-bolt"></i> Electrical Engineering</a>
            <a href="core-engineering.html#mechanical" class="dropdown-item-custom"><i class="fas fa-cogs"></i> Mechanical &amp; MEP / HVAC</a>
            <a href="core-engineering.html#electronics" class="dropdown-item-custom"><i class="fas fa-microchip"></i> Electronics &amp; Embedded</a>
            <a href="core-engineering.html#civil" class="dropdown-item-custom"><i class="fas fa-drafting-compass"></i> Civil Engineering</a>
          </div>';

        $replace = '<div class="dropdown-menu-custom">
            @foreach($courseCategories as $category)
            <a href="{{ route(\'courses\') }}?category={{ $category->slug }}" class="dropdown-item-custom">
              <i class="{{ $category->icon ?? \'fas fa-book\' }}"></i> {{ $category->name }}
            </a>
            @endforeach
          </div>';

        $replacedCount = 0;
        foreach ($files as $file) {
            $content = file_get_contents($file);

            // Normalize newlines for consistent matching
            $normalizedContent = str_replace("\r\n", "\n", $content);
            $normalizedSearch1  = str_replace("\r\n", "\n", $search1);
            $normalizedSearch2  = str_replace("\r\n", "\n", $search2);

            if (strpos($normalizedContent, $normalizedSearch1) !== false) {
                $newContent = str_replace($normalizedSearch1, $replace, $normalizedContent);
                file_put_contents($file, $newContent);
                $this->info('Updated (variant 1): ' . basename($file));
                $replacedCount++;
            } elseif (strpos($normalizedContent, $normalizedSearch2) !== false) {
                $newContent = str_replace($normalizedSearch2, $replace, $normalizedContent);
                file_put_contents($file, $newContent);
                $this->info('Updated (variant 2): ' . basename($file));
                $replacedCount++;
            }
        }

        $this->info("Done. {$replacedCount} file(s) updated.");

        return self::SUCCESS;
    }
}
