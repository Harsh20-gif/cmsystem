<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ReplaceIcon extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cms:replace-icon';

    /**
     * The console command description.
     */
    protected $description = 'Replace plain <i class="$category->icon"> tags with a smart image/icon conditional block across all frontend Blade views';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dir   = resource_path('views/frontend');
        $files = glob($dir . '/*.blade.php');

        $search = '<i class="{{ $category->icon ?? \'fas fa-book\' }}"></i>';

        $replace = '@if($category->icon && \Illuminate\Support\Str::contains($category->icon, [\'/\', \'.png\', \'.jpg\', \'.jpeg\', \'.svg\', \'.webp\']))
              <img src="{{ \Illuminate\Support\Facades\Storage::url($category->icon) }}" alt="" style="width: 16px; height: 16px; object-fit: contain; display: inline-block; vertical-align: middle; margin-right: 0.2rem;">
            @else
              <i class="{{ $category->icon ?? \'fas fa-book\' }}"></i>
            @endif';

        $replacedCount = 0;
        foreach ($files as $file) {
            $content = file_get_contents($file);

            if (strpos($content, $search) !== false) {
                $content = str_replace($search, $replace, $content);
                file_put_contents($file, $content);
                $this->info('Updated: ' . basename($file));
                $replacedCount++;
            }
        }

        $this->info("Done. {$replacedCount} file(s) updated.");

        return self::SUCCESS;
    }
}
